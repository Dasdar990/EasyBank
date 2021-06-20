async function changeSection(e) {
    const elem = e.currentTarget;

    //check if user is clicking on something that is already active, if so, do nothing
    if (elem.dataset.active !== 'true') {
        //disable last active section and change attribute of menu element
        document.querySelector('.menu-items-container div[data-active="true"]').dataset.active = 'false';
        //for mobile menu
        document.querySelector('.mobile-menu-items-container div[data-active="true"]').dataset.active = 'false';
        //activate the new element
        document.querySelector(
            '.menu-items-container div[data-link="' + elem.dataset.link + '"]'
        ).dataset.active = true;
        //for mobile menu
        document.querySelector(
            '.mobile-menu-items-container div[data-link="' + elem.dataset.link + '"]'
        ).dataset.active = true;

        //disable current section
        document.querySelector('section[data-opened="true"]').dataset.opened = 'false';
        //activate the new one but first check if there is already data. If not generate them
        const curr = document.querySelector('section#' + elem.dataset.link);
        if (curr.dataset.gen === 'false') {
            curr.appendChild(getChild(LOADING_TEMPLATE()));
            curr.dataset.opened = 'true';
            generateSection(elem.dataset.link);
            curr.dataset.gen = 'true';
            await sleep(150);
            document.querySelector('#loading').remove();
        }
        curr.dataset.opened = 'true';
        // if click is from menu then close it and restore the burger button
        if (elem.classList.contains('mobile-menu-item')) {
            openCloseMenu(document.querySelector('#mobile-menu-burger'));
        }
    }
}

//change active cc and shows card info or transaction by that card in overview section
function setActiveCard(e) {
    const elem = e.currentTarget;
    //check if clicked card is already clicked, if so, do nothing
    if (elem.dataset.active !== 'true') {
        //disable last selected card
        elem.closest('.cards-container').querySelector('.cc[data-active="true"]').dataset.active = false;
        //active the clicked one
        elem.dataset.active = 'true';
        //check the id of section of the element called and then choose to update transaction list or update the card info
        if (elem.closest('section').id === 'overview') updateTransactionList(elem);
        else updateCCInfo(elem);
    }
}

function updateTransactionList(elem) {
    //disable last transactions
    for (let key of document.querySelectorAll('#overview .activity-container .activity-row'))
        key.dataset.active = 'false';
    if (
        document.querySelectorAll(
            '#overview .activity-container .activity-row[data-number="' + elem.dataset.number + '"]'
        ).length === 0
    ) {
        const activity_container = document.querySelector('.activity-container');
        request_transactions(elem.dataset.number).then((json) => {
            for (let key of json) {
                const t = activity_container.appendChild(getChild(key));
                t.addEventListener('click', showMoreDetails);
            }
        });
    } else
        for (let key of document.querySelectorAll(
                '#overview .activity-container .activity-row[data-number="' + elem.dataset.number + '"]'
            ))
            key.dataset.active = 'true';
}

//update cards info
function updateCCInfo(elem) {
    //disable last info
    const id = elem.closest('section').id;
    document.querySelector('#' + id + ' .info-container>div[data-active="true"]').dataset.active = 'false';

    if (document.querySelector('#' + id + ' .info-container>div[data-number="' + elem.dataset.number + '"]') === null) {
        const info_container = document.querySelector('#' + id + ' .info-container');
        if (id === 'cards') {
            requestCCInfo(elem.dataset.number).then((json) => {
                const elem = info_container.appendChild(getChild(json));
                elem.querySelector('.button').addEventListener('click', setAsFavorite);
            });
        } else {
            requestLoanInfo(elem.dataset.number).then((json) => {
                info_container.appendChild(getChild(json));
            });
        }
    } else {
        document.querySelector(
                '#' + id + ' .info-container>div[data-number="' + elem.dataset.number + '"]'
            ).dataset.active =
            'true';
    }
}

//set filters (activity section) on transactions below
function setFilter(e) {
    const elem = e.currentTarget;
    const transaction_list = document.querySelectorAll('#activity #filter-cards .activity-row');
    if (elem.dataset.active === 'true') {
        filter_list.splice(filter_list.indexOf(elem.dataset.number), 1);
        elem.dataset.active = 'false';
    } else {
        filter_list.push(elem.dataset.number);
        elem.dataset.active = 'true';
    }
    //filter the transactions list
    for (let key of transaction_list)
        if (filter_list.includes(key.dataset.number)) key.dataset.active = 'true';
        else key.dataset.active = 'false';
    if (filter_list.length === 0)
        for (let key of transaction_list) key.dataset.active = 'true';
}

function removeAllFilters(e) {
    const filter_cards = document.querySelectorAll('#activity .filter-card');
    const filtered_div = document.querySelector('#activity #filter-cards');
    for (let key of filter_cards) key.dataset.active = 'false';
    filter_list = [];
    const transaction_list = document.querySelectorAll('#activity #filter-cards .activity-row');
    for (let key of transaction_list) key.dataset.active = 'true';
}

//expand/close transaction details
function showMoreDetails(e) {
    const curr_row = e.currentTarget;
    const expand_img = curr_row.querySelector('#expand');
    const details = curr_row.querySelector('.transaction-details');
    const toHide = curr_row.querySelectorAll('.value>span');
    if (curr_row.dataset.close === 'true') {
        //details are closed so we open them
        curr_row.dataset.close = 'false';
        expand_img.src = 'images/icons/expand_less.svg';
        details.classList.add('opened');
        for (let temp of toHide) temp.classList.add('open');
    } else {
        //details are opened so we close them
        curr_row.dataset.close = 'true';
        expand_img.src = 'images/icons/expand_more.svg';
        details.classList.remove('opened');
        for (let temp of toHide) temp.classList.remove('open');
    }
}
//search inside transaction list
function search(e) {
    const input = e.currentTarget.value.toLocaleLowerCase();
    const search_div = document.querySelector('#activity #filter-search');
    const cards_div = document.querySelector('#activity #filter-cards');
    const filter_container = document.querySelector('#activity .filter-container');

    //check if input is empty
    if (input.length === 0) {
        clearSearch(e);
    } else {
        //shows the filtered div if is not already visible
        if (search_div.dataset.visible !== 'visible') {
            search_div.dataset.visible = 'visible';
            cards_div.dataset.visible = 'hidden';
            filter_container.dataset.visible = 'hidden';
        }
        for (let key of search_div.querySelectorAll('.activity-row .agent')) {
            if (key.textContent.toLocaleLowerCase().includes(input)) {
                key.closest('.activity-row').dataset.active = 'true';
            } else key.closest('.activity-row').dataset.active = 'false';
        }
    }
}

//clear the search input and the filtered div
function clearSearch(e) {
    const input = document.querySelector('.search-container input');
    //set the value to empty
    input.value = '';
    //hide search div and enable filter by cards, also enable filter-cards container
    document.querySelector('#activity #filter-search').dataset.visible = 'hidden';
    document.querySelector('#activity #filter-cards').dataset.visible = 'visible';
    document.querySelector('#activity .filter-container').dataset.visible = 'visible';
    //reset the transaction rows
    for (let key of document.querySelectorAll('#fitler-search .activity-row')) key.dataset.active = 'false';
}

//opens and closes mobile menu
function openCloseMenu() {
    const elem = document.querySelector('#mobile-menu-burger');

    const mobile_menu = document.querySelector('.mobile-menu');
    if (elem.dataset.img === 'open') {
        elem.dataset.img = 'close';
        elem.src = 'images/icons/clear.svg';
        mobile_menu.dataset.active = 'true';
        document.querySelector('header').dataset.overflow = 'hidden';
    } else {
        mobile_menu.dataset.active = 'false';
        elem.dataset.img = 'open';
        elem.src = 'images/icons/burger.svg';
        document.querySelector('header').dataset.overflow = '';
    }
}

//change stock section
function changeStock(e) {
    const elem = e.currentTarget;
    const stock_container = document.querySelector('#market .stock-info-container');

    if (elem.dataset.active === 'false') {
        //disable last stock
        document.querySelector(
                '#market .scroll-container[data-set="stock"] .stock-card[data-active="true"]'
            ).dataset.active =
            'false';
        document.querySelector('#market .stock-info-container div[data-active="true"]').dataset.active = 'false';
        //active new one
        elem.dataset.active = 'true';
        document.querySelector(
                '#market .stock-info-container div[data-stock="' + elem.dataset.link + '"]'
            ).dataset.active =
            'true';
    }
}

//set as favorite card
function setAsFavorite(e) {
    const data = { Number: e.currentTarget.dataset.num };
    fetch('setAsFavorite', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        })
        .then(onResponse)
        .then(async(json) => {
            emptyDiv(document.querySelector('#cards .cards-container'));
            emptyDiv(document.querySelector('#cards .info-container'));
            emptyDiv(document.querySelector('#overview .cards-container'));
            emptyDiv(document.querySelector('#overview .activity-container'));
            emptyDiv(document.querySelector('#overview .info-container'));
            document.querySelector('#cards').appendChild(getChild(json.success));
            generateSection('Cards');
            generateInitial();

            await sleep(300);
            document.querySelector('#cards #loading').remove();
        });
}

//create add card modal
function createModal() {
    RequestNewCardModal().then((json) => {
        const modal = document.querySelector('body').prepend(getChild(json));
        document.querySelector('.modal-container #close').addEventListener('click', closeModal);
        document.querySelector('.modal-container').addEventListener('click', closeModal);
        document.querySelector('.modal-container .button').addEventListener('click', requestNewCard);
    });
}

//destroy add card modal
function closeModal(e) {
    e.stopPropagation();
    if (e.target.id === 'close') document.querySelector('.modal-container').remove();
    else if (e.target.classList.contains('modal-container')) document.querySelector('.modal-container').remove();
}

//Returns a new debit card if conditions are respected
function requestNewCard(e) {
    const elem = e.currentTarget;
    const inputs = elem.closest('form').querySelectorAll('input');
    e.preventDefault();
    const form = elem.closest('form');
    if (!check_fill(inputs)) {
        fetch('AddNewCard', {
                method: 'POST',
                credentials: 'same-origin',
                'X-CSRF-Token': document.querySelector('input[name=_token]').value,
                body: new FormData(form)
            })
            .then(onResponse)
            .then((json) => {
                if (json.error === undefined) {
                    emptyDiv(document.querySelector('.new-card-modal'));
                    document.querySelector('.new-card-modal').appendChild(getChild(json));
                    emptyDiv(document.querySelector('#cards .cards-container'));
                    emptyDiv(document.querySelector('#cards .info-container'));
                    generateSection('Cards');
                } else {
                    print_error(inputs[1], json.error);
                }
            });
    }
}

//log-out event listener
for (let key of document.querySelectorAll('#logout'))
    key.addEventListener('click', function() {
        location.href = 'logout';
    });

// Assigning event listeners to elements
const showAllTexts = document.querySelectorAll('.title h3');
const cc = document.querySelectorAll('#Overview .cards-container .cc');
const menu_items = document.querySelectorAll('.menu-item');
const loan_cc = document.querySelectorAll('#Services .cards-container .cc');
const removeFilter = document.querySelector('#activity #remove');
const searchInput = document.querySelector('.search-container input');
const searchClear = document.querySelector('.search-container #clear');
const mobile_menu_items = document.querySelectorAll('.mobile-menu .mobile-menu-item');
const burger_button = document.querySelector('#mobile-menu-burger');
const favorite_img = document.querySelectorAll('#activity .info-row div img');
let filter_list = [];

removeFilter.addEventListener('click', removeAllFilters);
searchInput.addEventListener('keyup', search);
searchClear.addEventListener('click', clearSearch);
burger_button.addEventListener('click', openCloseMenu);

document.querySelector('#cards #add').addEventListener('click', createModal);

for (let key of showAllTexts) {
    if (key.dataset.link !== undefined) key.addEventListener('click', changeSection);
}
for (let key of menu_items) key.addEventListener('click', changeSection);
for (let key of mobile_menu_items) key.addEventListener('click', changeSection);