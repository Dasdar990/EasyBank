function getChild(elem) {
    return new DOMParser().parseFromString(elem, 'text/html').body.firstChild;
}

function getChildren(elem) {
    return new DOMParser().parseFromString(elem, 'text/html').body.querySelectorAll('div');
}

function onResponse(response) {
    return response.json();
}

function onJson(json) {
    console.log(json);
}

function sleep(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

function hideDiv(e) {
    e.dataset.visible = 'hidden';
}

function showDiv(e) {
    e.dataset.visible = 'visible';
}

function emptyDiv(e) {
    while (e.firstChild) e.removeChild(e.firstChild);
}

//append error message on closest input
function print_error(key, html) {
    key.addEventListener('input', removeError);
    key.closest('.form-box').classList.add('error');
    if (key.closest('.form-element').querySelector('.form-error') === null)
        key.closest('.form-element').appendChild(getChild(html));
}

//check if all inputs are filled
function check_fill(inputs) {
    let err = false;
    for (let key of inputs)
        if (key.value.length === 0) {
            fetch('error_request', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': document.querySelector('input[name=_token]').value
                    },
                    credentials: 'same-origin'
                })
                .then(onResponse)
                .then((json) => {
                    print_error(key, json.error);
                });
            err = true;
        }
    return err;
}

function removeError(e) {
    const elem = e.currentTarget;
    elem.closest('.form-box').classList.remove('error');
    elem.removeEventListener('input', removeError);
    elem.closest('.form-element').querySelector('.form-error').remove();
}