import axios from "axios";
import Swal from "sweetalert2";
import { handleValidationError, validator } from "../../utils/validation";
import { toggleButtonState, url } from "../../utils/helper";

const profileForm = $('#profile-form');
const passwordForm = $('#password-form');

const profileValidator = validator('#profile-form', {
    rules: {
        name: { required: true, maxlength: 150 },
        mobile_no: { required: true, digits: 10 },
    },
    submitHandler: submitProfileForm
})

const passwordValidator = validator('#password-form', {
    rules: {
        current_password: { required: true },
        password: { required: true },
        password_confirmation: { required: true }
    },
    submitHandler: submitPasswordForm
})

function submitProfileForm(form, event) {
    event.preventDefault();
    const button = profileForm.find('button[type="submit"]');
    const formdata = new FormData(form);
    toggleButtonState(button, true, 'Updating...');

    axios.patch('/profile', Object.fromEntries(formdata))
        .then(({ data }) => {
            Swal.fire({ text: data.message, icon: 'success' });
        }).catch((error) => {
            handleValidationError(error, profileValidator);
        }).finally(() => {
            toggleButtonState(button, false, 'Update');
        })
}

function submitPasswordForm(form, event) {
    event.preventDefault();
    const button = passwordForm.find('button[type="submit"]');
    const formdata = new FormData(form);
    toggleButtonState(button, true, 'Changing...');

    axios.put('/password', Object.fromEntries(formdata))
        .then(({ data }) => {
            Swal.fire({ text: data.message, icon: 'success' });
        }).catch((error) => {
            handleValidationError(error, passwordValidator);
        }).finally(() => {
            toggleButtonState(button, false, 'Change Password');
        })
}
