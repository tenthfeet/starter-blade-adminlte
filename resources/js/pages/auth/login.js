import axios from "axios";
import { toggleButtonState, url } from "../../utils/helper";
import { handleValidationError, validator } from "../../utils/validation";

const FORM_SELECTOR = '#login-form';
const loginForm = $(FORM_SELECTOR);

const loginValidator = validator(FORM_SELECTOR, {
    rules: {
        email: { required: true, email: true },
        password: { required: true }
    },
    messages: {
        email: {
            required: 'Please enter the email.',
            email: 'It must be a valid email id.'
        },
        password: { required: 'Please enter the password.' }
    },
    submitHandler: login
});

function login(form, event) {
    event.preventDefault();
    const btn = loginForm.find('button[type="submit"]');
    toggleButtonState(btn, true, 'Signing In...');
    const formData = new FormData(form);
    axios.post(url('/login'), formData)
        .then(({ data }) => {
            toggleButtonState(btn, false, 'Signed In');
            btn.prop('disabled', true);
            location.href = data.uri;
        }).catch((error) => {
            toggleButtonState(btn, false, 'Sign In');
            handleValidationError(error, loginValidator);
        });
}
