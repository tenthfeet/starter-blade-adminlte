const APP_URL = (import.meta.env.VITE_APP_URL || window.location.origin);

function url(path) {
    path = path.startsWith('/') ? path : '/' + path;
    path = path.replace(/\/+/g, '/');
    return APP_URL + path;
}

function toggleButtonState($btn, submitting, text) {
    const action = text ?? (submitting ? 'Submitting...' : 'Submit');
    $btn.find('[role="status"]').text(action);
    $btn.find('.spinner-border').prop('hidden', !submitting);
    $btn.prop('disabled', submitting);
}

function renderSerialNo(data, type, row, meta) {
    return meta.row + meta.settings._iDisplayStart + 1;
}

function updateOptions(element,options,selected=[]){
    element.empty();
    const selections = new Set(selected);
    options.forEach(( {id, name, price }) => {
        let selected = selections.has(id) ? 'selected' : '';
        element.append(`<option value="${id}" ${selected}>${name} - ${price}</option>`);
    });
}

export {
    url,
    toggleButtonState,
    renderSerialNo,
    updateOptions
}
