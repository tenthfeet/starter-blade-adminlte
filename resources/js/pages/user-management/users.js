import axios from "axios";
import { renderSerialNo, toggleButtonState, url } from "../../utils/helper";
import { handleValidationError, validator } from "../../utils/validation";
import Swal from "sweetalert2";
import DataTable from "datatables.net-dt";
import 'bootstrap/js/dist/modal';

// DOM elements
const addUserBtn = $('#add-user');
const userModal = $('#user-modal');
const userForm = $('#user-form');

// Initialize DataTable for Users
const usersTable = new DataTable('#users', {
    processing: true,
    ajax: url('/users'),
    columns: [
        { data: 'id', render: renderSerialNo },
        { data: 'name' },
        { data: 'email' },
        { data: 'status_label' },
        { data: 'id', render: renderEditBtn },
        { data: 'id', render: renderDeleteBtn }
    ]
});

// Validator configuration for User form
const userValidator = validator('#user-form', {
    rules: {
        name: { required: true, maxlength: 255 },
        email: { required: true, email: true },
        mobile_no: { required: true },
        status: { required: true },
    },
    submitHandler: submitUserForm
});

// Button event listeners
addUserBtn.on('click', showAddForm);
usersTable.on('click', 'button.edit', showUpdateForm);
usersTable.on('click', 'button.delete', deleteUser);

// Render Edit Button for each row
function renderEditBtn(id) {
    return `<button class="btn btn-sm edit py-0 btn-outline-primary" data-id="${id}">Edit</button>`;
}

// Render Delete Button for each row
function renderDeleteBtn(id) {
    return `<button class="btn btn-sm delete py-0 btn-outline-danger" data-id="${id}">Delete</button>`;
}

// Submit User form
function submitUserForm(form, event) {
    event.preventDefault();
    const btn = userForm.find('button[type="submit"]');
    const id = userForm.find('[name="id"]').val();

    const isUpdate = !!id;
    userForm.find('[name="_method"]').prop('disabled', !isUpdate);
    const formData = new FormData(form);

    const path = isUpdate ? `/users/${id}` : '/users';
    toggleButtonState(btn, true);

    axios.post(url(path), formData)
        .then(({ data }) => {
            Swal.fire({ text: data.message, icon: 'success' });
            toggleButtonState(btn, false);
            usersTable.ajax.reload();
            userModal.modal('hide');
        }).catch((error) => {
            toggleButtonState(btn, false);
            handleValidationError(error, userValidator);
        });
}

// Reset User form
function resetUserForm(title, btnText) {
    userModal.find('.modal-title').text(title);
    userForm.find('.reset').val('');
    userForm.find('.is-invalid').removeClass('is-invalid');
    const btn = userForm.find('button[type="submit"]');
    toggleButtonState(btn, false, btnText);
}

// Show Add Form
function showAddForm() {
    resetUserForm('Add User', 'Submit');
    userModal.find('.note').prop('hidden', false);
    userModal.modal('show');
}

// Show Update Form
function showUpdateForm() {
    resetUserForm('Update User', 'Update');
    userModal.find('.note').prop('hidden', true);
    const btn = $(this);
    const id = btn.data('id');
    axios.get(url(`/users/${id}`))
        .then(({ data }) => {
            const { user } = data;
            const fields = ['id', 'name', 'email', 'status', 'mobile_no'];
            fields.forEach(field => {
                userForm.find(`[name="${field}"]`).val(user[field]);
            });
            userModal.modal('show');
        })
}

// Delete User
async function deleteUser() {
    const btn = $(this);
    const id = btn.data('id');
    const tr = btn.closest('tr');
    const userName = tr.find('.name').text();

    const { isConfirmed } = await Swal.fire({
        title: `Do you really want to delete ${userName}?`,
        showCancelButton: true,
        confirmButtonText: "Delete",
    });

    if (!isConfirmed) return;

    axios.delete(url(`/users/${id}`))
        .then(({ data }) => {
            Swal.fire({ text: data.message, icon: 'success' })
                .then(() => {
                    tr.remove();
                });
        });
}
