window.addEventListener('load', function() {
    chooseForm(sessionStorage.getItem('sign'));
});

function changeVisibility(e) {
    const elem = e.currentTarget;
    const passBox = elem.closest('.form-box').querySelector('input');

    if (elem.dataset.type === 'invisible') {
        elem.src = 'images/icons/visibility_off.svg';
        elem.dataset.type = 'visible';
        passBox.type = 'text';
    } else {
        elem.src = 'images/icons/visibility.svg';
        elem.dataset.type = 'invisible';
        passBox.type = 'password';
    }
}

function signChange(e) {
    const elem = e.currentTarget;
    if (elem.dataset.active !== 'true') {
        //disable everything and load the right one
        elem.dataset.active = 'true';
        chooseForm(elem.dataset.form);
    }
}

function chooseForm(val) {
    if (val !== null) {
        document.querySelector('.container').dataset.pos = '';
        for (let key of document.querySelectorAll('.sign-selector span')) key.dataset.active = false;
        for (let key of document.querySelectorAll('.login-text')) key.dataset.active = false;
        for (let key of document.querySelectorAll('.form-container form')) key.dataset.active = false;
        switch (val) {
            case 'register':
                document.querySelector('.img-r img').src = 'images/register.svg';
                document.querySelector('.login-text[data-sign="register"]').dataset.active = true;
                document.querySelector('.sign-selector span[data-form="register"]').dataset.active = true;
                document.querySelector('#sign-up').dataset.active = true;
                break;
            case 'back':
                document.querySelector('.sign-selector').dataset.active = true;
                document.querySelector('.img-r img').src = 'images/register.svg';
                document.querySelector('.login-text[data-sign="register"]').dataset.active = true;
                document.querySelector('.sign-selector span[data-form="register"]').dataset.active = true;
                document.querySelector('#sign-up').dataset.active = true;
                break;
            case 'continue':
                document.querySelector('.img-r img').src = 'images/contracts.svg';
                document.querySelector('.container').dataset.pos = 'reverse';
                document.querySelector('.login-text[data-sign="continue"]').dataset.active = true;
                document.querySelector('.sign-selector').dataset.active = false;
                document.querySelector('#sign-up-2').dataset.active = true;
                break;
            default:
                //show login elements and set sign selector
                document.querySelector('.img-r img').src = 'images/secure_login.svg';
                document.querySelector('.login-text[data-sign="login"]').dataset.active = true;
                document.querySelector('.sign-selector span[data-form="login"]').dataset.active = true;
                document.querySelector('#sign-in').dataset.active = true;
                break;
        }
    } else {
        //if nothing is set, load login
        document.querySelector('.img-r img').src = 'images/secure_login.svg';
        document.querySelector('.login-text[data-sign="login"]').dataset.active = true;
        document.querySelector('.sign-selector span[data-form="login"]').dataset.active = true;
        document.querySelector('#sign-in').dataset.active = true;
    }
}

function checkMailPattern(mail) {
    var mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return mailformat.test(String(mail).toLowerCase());
}

function handleSubmit(e) {
    e.preventDefault();
    const elem = e.currentTarget;
    const inputs = elem.closest('form').querySelectorAll('input');
    const sel = e.currentTarget.dataset.sign;
    let formData = new FormData();
    const form = elem.closest('form');
    switch (sel) {
        case 'login':
            if (!check_fill(inputs)) {
                fetch('sign/login', {
                        method: 'POST',
                        credentials: 'same-origin',
                        'X-CSRF-Token': document.querySelector('input[name=_token]').value,
                        body: new FormData(form)
                    })
                    .then(onResponse)
                    .then((json) => {
                        if (json !== 'success') {
                            for (let key of inputs)
                                if (key.name === 'l-password') print_error(key, json.error);
                        } else {
                            location.href = 'dashboard';
                        }
                    });
            }
            break;
        case 'continue':
            if (!check_fill(inputs)) {
                for (let key of inputs)
                    if (key.name === 'email') {
                        const form = elem.closest('form');
                        fetch('sign/register', {
                                method: 'POST',
                                'X-CSRF-Token': document.querySelector('input[name=_token]').value,
                                body: new FormData(form)
                            })
                            .then(onResponse)
                            .then((json) => {
                                if (json.error === 'false') {
                                    //we can continue
                                    document.querySelector('#sign-up-2 #r-email span').textContent = json.mail;
                                    chooseForm(sel);
                                } else {
                                    print_error(key, json.response);
                                }
                            });
                    }
            }
            break;
        case 'back':
            for (let key of inputs)
                if (key.type !== 'submit') key.value = '';
            chooseForm(sel);
            break;
        case 'register':
            if (!check_fill(inputs)) {
                const form = elem.closest('form');

                fetch('sign/register_2', {
                        method: 'POST',
                        'X-CSRF-Token': document.querySelector('input[name=_token]').value,
                        credentials: 'include',
                        body: new FormData(form)
                    })
                    .then(onResponse)
                    .then((json) => {
                        console.log(json);
                        if (json.success === undefined) {
                            for (let key in json) {
                                for (let i of inputs)
                                    if (i.name === key) print_error(i, json[key]);
                            }
                        } else {
                            const f_size = document.querySelector('.full-size-container');
                            sessionStorage.setItem('sign', 'login');
                            f_size.innerHTML = '';
                            f_size.appendChild(getChild(json.success));
                            document
                                .querySelector('.checkmark-container .form-button')
                                .addEventListener('click', function() {
                                    location.reload();
                                });
                            setInterval(function() {
                                location.reload();
                            }, 5000);
                        }
                    });
            }
            break;
    }
}

const sign_selector = document.querySelectorAll('.sign-selector span');

for (let key of document.querySelectorAll('#visibility')) key.addEventListener('click', changeVisibility);
for (let key of document.querySelectorAll('.navbar img'))
    key.addEventListener('click', function() {
        location.href = 'homepage';
    });

for (let key of sign_selector) {
    key.addEventListener('click', signChange);
}
for (let key of document.querySelectorAll('.form-button')) {
    key.addEventListener('click', handleSubmit);
}

function onResponse(response) {
    return response.json();
}

function onJson(json) {
    console.log(json);
}

function getChild(elem) {
    return new DOMParser().parseFromString(elem, 'text/html').body.firstChild;
}