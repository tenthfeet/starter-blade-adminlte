// ==========================================
// 1. IMPORTS & DEPENDENCIES
// ==========================================
import axios from "axios";
import { renderSerialNo, toggleButtonState, url } from "../../utils/helper";
import { handleValidationError, validator } from "../../utils/validation";
import Swal from "sweetalert2";
import DataTable from "datatables.net-dt";
import Modal from 'bootstrap/js/dist/modal';

// ==========================================
// 2. CONSTANTS & CONFIGURATION
// ==========================================
// Constants and configuration settings go here if any

// ==========================================
// 3. STATE & DOM REFERENCES
// ==========================================
const $addUserBtn = $('#add-user');
const $userModalElement = $('#user-modal');
const $userForm = $('#user-form');
const userModal = new Modal($userModalElement[0]);

// ==========================================
// 4. INITIALIZATION
// ==========================================
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

// ==========================================
// 5. EVENT BINDINGS
// ==========================================
$addUserBtn.on('click', handleAddUserClick);
usersTable.on('click', 'button.edit', handleEditUserClick);
usersTable.on('click', 'button.delete', handleDeleteUserClick);

// ==========================================
// 6. FUNCTIONS & EVENT HANDLERS
// ==========================================

/**
 * Render Edit Button for each row
 */
function renderEditBtn(id) {
    return `<button class="btn btn-sm edit py-0 btn-outline-primary" data-id="${id}">Edit</button>`;
}

/**
 * Render Delete Button for each row
 */
function renderDeleteBtn(id) {
    return `<button class="btn btn-sm delete py-0 btn-outline-danger" data-id="${id}">Delete</button>`;
}

/**
 * Reset User form fields and state
 */
function resetUserForm(title, btnText) {
    $userModalElement.find('.modal-title').text(title);
    $userForm.find('.reset').val('');
    $userForm.find('.is-invalid').removeClass('is-invalid');
    const btn = $userForm.find('button[type="submit"]');
    toggleButtonState(btn, false, btnText);
}

/**
 * Event Handler: Show Add User Modal
 */
function handleAddUserClick() {
    resetUserForm('Add User', 'Submit');
    $userModalElement.find('.note').prop('hidden', false);
    userModal.show();
}

/**
 * Event Handler: Show Edit/Update User Modal
 */
function handleEditUserClick() {
    resetUserForm('Update User', 'Update');
    $userModalElement.find('.note').prop('hidden', true);
    
    const $btn = $(this);
    const id = $btn.data('id');
    
    axios.get(url(`/users/${id}`))
        .then(({ data }) => {
            const { user } = data;
            const fields = ['id', 'name', 'email', 'status', 'mobile_no'];
            fields.forEach(field => {
                $userForm.find(`[name="${field}"]`).val(user[field]);
            });
            userModal.show();
        });
}

/**
 * Submit User form (Add or Update)
 */
function submitUserForm(form, event) {
    event.preventDefault();
    const btn = $userForm.find('button[type="submit"]');
    const id = $userForm.find('[name="id"]').val();

    const isUpdate = !!id;
    $userForm.find('[name="_method"]').prop('disabled', !isUpdate);
    const formData = new FormData(form);

    const path = isUpdate ? `/users/${id}` : '/users';
    toggleButtonState(btn, true);

    axios.post(url(path), formData)
        .then(({ data }) => {
            Swal.fire({ text: data.message, icon: 'success' });
            toggleButtonState(btn, false);
            usersTable.ajax.reload();
            userModal.hide();
        }).catch((error) => {
            toggleButtonState(btn, false);
            handleValidationError(error, userValidator);
        });
}

/**
 * Event Handler: Delete User with confirmation
 */
async function handleDeleteUserClick() {
    const $btn = $(this);
    const id = $btn.data('id');
    const $tr = $btn.closest('tr');
    const userName = $tr.find('.name').text();

    const { isConfirmed } = await Swal.fire({
        title: `Do you really want to delete ${userName}?`,
        showCancelButton: true,
        confirmButtonText: "Delete",
    });

    if (!isConfirmed) {
        return;
    }

    axios.delete(url(`/users/${id}`))
        .then(({ data }) => {
            Swal.fire({ text: data.message, icon: 'success' })
                .then(() => {
                    $tr.remove();
                });
        });
}

