window.addEventListener('scroll', manageNavbar);
document.addEventListener(
    'touchmove',
    function(event) {
        if (event.scale !== 1) {
            event.preventDefault();
        }
    }, { passive: false }
);

let vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);

window.addEventListener('resize', () => {
    // We execute the same script as before
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
});

function menuHandler(e) {
    closeOpenMenu();
}

function closeOpenMenu() {
    const mobileMenu = document.querySelector('.mobile-menu');
    const html = document.querySelector('html');
    const menuImg = document.querySelector('#menu-button');

    if (mobileMenu.dataset.active === 'false') {
        mobileMenu.style.top = window.pageYOffset + 60;
        menuImg.src = 'images/icons/clear.svg';
        html.dataset.overflow = 'hidden';
        mobileMenu.dataset.active = 'true';
    } else {
        menuImg.src = 'images/icons/burger.svg';
        html.dataset.overflow = 'auto';
        mobileMenu.dataset.active = 'false';
    }
}

function changeMenu(e) {
    e.preventDefault();
    const elem = e.currentTarget;
    const href = elem.getAttribute('href');
    const offsetTop = document.querySelector(href).offsetTop - 60;
    if (elem.closest('div').classList.contains('mobile-menu-items')) menuHandler(e);

    scroll({
        top: offsetTop,
        behavior: 'smooth'
    });
}

function manageNavbar() {
    let offsets = setOffsets();
    let scroll = window.pageYOffset;
    let curr;
    for (let key of offsets)
        if (scroll >= key.offset) curr = key.id;
    for (let key of document.querySelectorAll('a[data-active = "true"]')) key.dataset.active = 'false';
    for (let key of document.querySelectorAll(`a[href='` + `#` + curr + `']`)) key.dataset.active = 'true';
}

function setOffsets() {
    let offsets = [{
        id: 'home',
        offset: 0
    }];
    for (let key of document.querySelectorAll('section')) {
        if (key.id !== '')
            offsets.push({
                id: key.id,
                offset: document.querySelector('#' + key.id).offsetTop - 60
            });
    }
    return offsets;
}
setOffsets();

const menuButton = document.querySelector('#menu-button');
menuButton.addEventListener('click', menuHandler);

for (let key of document.querySelectorAll('.mobile-menu-items a')) key.addEventListener('click', changeMenu);
for (let key of document.querySelectorAll('.navigation a')) key.addEventListener('click', changeMenu);
document.querySelector('#discover').addEventListener('click', changeMenu);

for (let key of document.querySelectorAll('.button')) {
    if (key.id !== 'discover') {
        key.addEventListener('click', function(e) {
            sessionStorage.setItem('sign', e.currentTarget.dataset.send);
            location.href = 'login';
        });
    }
}