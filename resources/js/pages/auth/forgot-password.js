import axios from "axios";
import { toggleButtonState, url } from "../../utils/helper";
import { handleValidationError, validator } from "../../utils/validation";

const FORM_SELECTOR = '#forgot-password-form';
const forgotPasswordForm = $(FORM_SELECTOR);

const forgotPasswordValidator = validator(FORM_SELECTOR, {
    rules: {
        email: { required: true, email: true },
    },
    messages: {
        email: {
            required: 'Please enter the email.',
            email: 'It must be a valid email id.'
        }
    },
    //submitHandler: forgotPassword
});

// function forgetPassword(form, event) {
//     event.preventDefault();
//     const btn = forgotPasswordForm.find('button[type="submit"]');
//     toggleButtonState(btn, true, 'Sending mail...');
//     const formData = new FormData(form);
//     axios.post(url('/forgot-password'), formData)
//         .then(({ data }) => {
//             toggleButtonState(btn, false, 'Send me mail');
//             btn.prop('disabled', true);
//             location.href = data.uri;
//         }).catch((error) => {
//             toggleButtonState(btn, false, 'Send me mail');
//             handleValidationError(error, forgotPasswordValidator);
//         });
// }
