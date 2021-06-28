window.addEventListener('load', async function() {
    generateInitial();
    await sleep(300);
    document.querySelector('#loading').remove();
});

function generateInitial() {
    //top bar
    const top_bar = document.querySelector('.top-bar');
    const mobile_bar = document.querySelector('.mobile-menu');

    if (!top_bar.hasChildNodes())
        request_topbar().then((json) => {
            top_bar.appendChild(getChild(json.balance));
            top_bar.appendChild(getChild(json.profile_info));
            mobile_bar.prepend(getChild(json.mobile_bar));
        });

    //Generate overview
    const overview_cards_container = document.querySelector('#overview .cards-container');
    const activity_container = document.querySelector('#overview .activity-container');

    requestCC().then((json) => {
        for (let key of json) {
            const elem = overview_cards_container.appendChild(getChild(key));
            elem.addEventListener('click', setActiveCard);
        }
        //load favorite card's transactions
        const fav = overview_cards_container.querySelector('.cc[data-active="true"]');
        request_transactions(fav.dataset.number).then((json) => {
            for (let key of json) {
                const t = activity_container.appendChild(getChild(key));
                t.addEventListener('click', showMoreDetails);
            }
        });
    });

    //generate history
    request_history().then((json) => {
        const info_container = document.querySelector('#overview .info-container');
        for (let key of json) {
            info_container.appendChild(getChild(key));
        }
    });
}

function generateSection(id) {
    switch (id) {
        case 'Cards':
            requestCC().then((json) => {
                const info_container = document.querySelector('#cards .info-container');
                const cards_container = document.querySelector('#cards .cards-container');
                for (let key of json) {
                    const elem = cards_container.appendChild(getChild(key));
                    elem.addEventListener('click', setActiveCard);
                }
                const fav = cards_container.querySelector('#cards .cc[data-active="true"]');
                requestCCInfo(fav.dataset.number).then((json) => {
                    info_container.appendChild(getChild(json));
                });
            });
            break;
        case 'Activity':
            //generate filters
            requestFilters().then((json) => {
                const filter_container = document.querySelector('#activity .filter-container');
                for (let key of json) {
                    let t = filter_container.appendChild(getChild(key));
                    t.addEventListener('click', setFilter);
                }
            });
            //generate list of all transactions
            requestAllTransactions().then((json) => {
                if (json.error === undefined) {
                    const filter_cards = document.querySelector('#activity #filter-cards');
                    const filter_search = document.querySelector('#activity #filter-search');
                    for (let temp of json) {
                        //generate elements where to search and a div for cards search
                        requestAllTransactions().then((json) => {
                            const fc = filter_cards.appendChild(getChild(temp));
                            fc.addEventListener('click', showMoreDetails);
                            fc.dataset.active = 'true';
                            const fs = filter_search.appendChild(getChild(temp));
                            fs.addEventListener('click', showMoreDetails);
                        });
                    }
                }
            });
            //generate history values
            request_history().then((json) => {
                const info_container = document.querySelector('#activity .info-container');
                for (let key of json) {
                    info_container.appendChild(getChild(key));
                }
            });
            break;
        case 'Services':
            //request loan information
            requestLoanCC().then((json) => {
                if (json.error === undefined) {
                    const cards_container = document.querySelector('#services .cards-container');
                    const info_container = document.querySelector('#services .info-container');
                    for (let key of json) {
                        const elem = cards_container.appendChild(getChild(key));
                        elem.addEventListener('click', setActiveCard);
                    }
                    const fav = cards_container.querySelector('#Services .cc[data-active="true"]');
                    requestLoanInfo(fav.dataset.number).then((json) => {
                        info_container.appendChild(getChild(json));
                    });
                }
            });
            //request safe deposit informations
            requestSafeDepositInfo().then((json) => {
                const branch_container = document.querySelector('#services #branch.cards-container');
                for (let key of json) branch_container.appendChild(getChild(key));
            });

            break;
        case 'Market':
            //add loading cirle
            requestLoading().then((json) => {
                document.querySelector('#stock-market').appendChild(getChild(json));
            });
            requestExchangeRates().then((json) => {
                const currency_container = document.querySelector('#market .scroll-container[data-set="currency"]');
                for (let key of json) currency_container.appendChild(getChild(key));
            });

            requestStock().then((json) => {
                const stock_card_container = document.querySelector('#market .scroll-container[data-set="stock"]');
                const stock_info_container = document.querySelector('#market .stock-info-container');
                for (let key in json) {
                    const t = stock_card_container.appendChild(getChild(json[key].card));
                    t.addEventListener('click', changeStock);
                    //generate charts and info
                    stock_info_container.appendChild(getChild(json[key].info));
                }
                //remove loading circle
                document.querySelector('#loading').remove();
            });
            break;
        case 'Account':
            //Personal Info
            requestAccountData().then((json) => {
                const personal_info = document.querySelector('#account .personal-info-container');
                const profile_image = document.querySelector('#account .profile-image-container');
                profile_image.appendChild(getChild(json.profile_image));
                const profile_children = getChildren(json.profile_info);
                for (let key of profile_children) personal_info.appendChild(key);
            });
            break;
    }
}