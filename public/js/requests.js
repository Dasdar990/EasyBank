//Returns TopBar info for logged user
csrf_token = document.querySelector('meta[name="csrf-token"]').content;

function request_topbar() {
    return fetch('requestTopbar', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//Returns CC for logged user
function requestCC() {
    return fetch('requestCC', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//Returns CC Info for logged user
function requestCCInfo(num) {
    const data = { Number: num };
    return fetch('requestCCInfo', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token
            },
            body: JSON.stringify(data)
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//Returns filters for activity section
function requestFilters() {
    return fetch('requestFilters', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}
//Returns all transactions
function requestAllTransactions() {
    return fetch('requestAllTransactions', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//request info about loans for logged user
function requestLoanCC() {
    return fetch('requestLoanCC', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//request info about loans for logged user
function requestLoanInfo(num) {
    const data = { Number: num };
    return fetch('requestLoanInfo', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token
            },
            body: JSON.stringify(data)
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//request info about safe deposit boxes for logged user
function requestSafeDepositInfo() {
    return fetch('requestSafeDepositInfo', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//Returns History for logged user
function request_history() {
    return fetch('requestHistory', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//Returns Transactions made by logged user account
function request_transactions(num) {
    const data = { Number: num };
    return fetch('requestTransactions', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token
            },
            body: JSON.stringify(data)
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//Request for bancomat balance
function RequestNewCardModal() {
    return fetch('RequestNewCardModal', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//Returns logged user profile info
function requestAccountData() {
    return fetch('requestAccountData', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//returns loading circle view
function requestLoading() {
    return fetch('requestLoading', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//EXTERNAL API REQUESTS

//call php script to request data from coinbase.com (Exchange Rates)
function requestExchangeRates() {
    return fetch('RequestExchangeRates', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}

//call php script to request data from coinbase.com (Exchange Rates)
function requestStock() {
    return fetch('RequestStock', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        })
        .then(onResponse)
        .then((json) => {
            return json;
        });
}