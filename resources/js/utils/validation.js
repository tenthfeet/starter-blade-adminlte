import axios, { Axios } from 'axios';
import 'jquery-validation';
import Swal from 'sweetalert2';

// Define default validator settings
const validatorConfig = {
    errorElement: 'span',
    errorClass: 'is-invalid',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass(errorClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass(errorClass);
    }
};

// Create a function to initialize the validator with default settings
function validator(selector, customConfig = {}) {
    const mergedConfig = { ...validatorConfig, ...customConfig };

    return $(selector).validate(mergedConfig);
}

function toValidationError(originalObj, arrays = []) {
    const newObj = {};
    const collection = new Set(arrays);
    for (const key in originalObj) {

        if (collection.has(key)) {
            newObj[`${key}[]`] = originalObj[key][0];
            continue;
        }

        const newKey = convertDotToSquareBracket(key);
        newObj[newKey] = originalObj[key][0];
    }

    return newObj;
}

function convertDotToSquareBracket(dotNotation) {
    return dotNotation.split('.')
        .reduce((result, part) => {
            return `${result}[${part}]`;
        });
}

function handleValidationError(error, validator, arrays = []) {
    if (!axios.isAxiosError(error)) {
        Swal.fire({ text: 'Something went wrong.', icon: 'error' });
        console.log(error);
        return;
    }
    const message = error.response.data.message ?? 'Could not complete the request.';
    Swal.fire({ text: message, icon: 'error' });
    if (error.response && error.response.status == 422) {
        validator.showErrors(toValidationError(error.response.data.errors, arrays));
    }
}

export { validator, handleValidationError };
