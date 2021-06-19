const CC_TEMPLATE = (card) => `
<div class="cc" data-active="false" data-number="${card.Number}">
    <img class="pattern" src="${card.src}" alt="Pattern">
    <div class="overlay "></div>
    <div class="row ">
        <img src="images/icons/logo_card.svg " alt="Bank Logo ">
        <img src="images/icons/${card.Vendor}.svg " alt="Vendor Logo ">
    </div>
    <div class="row number "><span class="asterisk ">**** </span><span class="asterisk ">**** </span>****  ${card.Number}</span>
    </div>
    <div class="row date ">${card.Month}/${card.Year}</div>
    <div class="row type ">${card.Type}</div>
</div>
`;

const TRANSACTION_TEMPLATE = (transaction) => `
<div class="activity-row" data-close = "true" data-active="false" data-number=${transaction.Number}>
    <div class="transaction-header">
        <div class="transaction-agent">
            <img src="images/icons/money-${transaction.InOut}.svg" alt="Money">
            <div class="transaction-info">
                <h1 class="agent">${transaction.Agent}</h1>
                <h3>${transaction.Type}</h3>
            </div>
        </div>
        <div class="value">
            <span class="${transaction.InOut}-value">${transaction.Amount}</span>
            <span><strong>EUR</strong></span>
            <img id="expand" src="images/icons/expand_more.svg" alt="expand">
        </div>
    </div>
    <div class="transaction-details">
        <div class="details-row">
            <h2>Date</h2>
            <h3>${transaction.Date}</h3>
        </div>
        <div class="details-row card">
            <h2>Card</h2>
            <h3>**** ${transaction.Number}</h3>
        </div>
        <div class="details-row">
            <h2>Amount</h2>
            <h3 class="${transaction.InOut}-value">${transaction.Amount} <strong>EUR</strong></h3>
        </div>
    </div>
</div>`;

const HISTORY_TEMPLATE = (history) => `
<div class="info-row">
    <span>${history.Month}/${history.Year}</span>
    <span>+ ${history.Balance}</span>
</div>
`;

const CARD_INFO_TEMPLATE = (card) => `
<div data-active='false' data-number='${card.Number}'>
    <div class="info-row" >
        <span>Status</span>
        <span>${card.Status}</span>
    </div>
    <div class="info-row" >
        <span>Type</span>
        <span>${card.Type}</span>
    </div>
    <div class="info-row" data-type="${card.Type}">
        <span>Balance</span>
        <span>${card.Balance} EUR</span>
    </div>
    <div class="info-row">
        <span>Daily limit</span>
        <span>${card.Daily_Max} EUR</span>
    </div>
    <div class="info-row">
        <span>Monthly limit</span>
        <span>${card.Monthly_Max} EUR</span>
    </div>
    <div class="info-row">
        <span>Activation date</span>
        <span>${card.ActivationDate}</span>
    </div>
    <div class='button' data-num=${card.Number} data-active="${card.Favorite}">Set as favorite</div>
</div>
`;

const CARDS_FILTER_TEMPLATE = (filter) => `
<div class="filter-card" data-active="false" data-number="${filter.Number}">
    <span>${filter.Number}</span>
    <div class="v-line"></div>
    <img src="images/icons/${filter.Vendor}.svg" alt="CC Logo">
</div>`;

const LOANS_TEMPLATE = (loan) => `
<div data-active="false" data-number="${loan.Loan_ID}"class="cc loan">
    <span data-type="number">No. ${loan.Loan_ID}</span>
    <span>${loan.Amount} EUR </span>
</div>
`;

const LOANS_INFO_TEMPLATE = (loan) => `
<div data-active='false' data-number='${loan.Loan_ID}'>
    <div class="info-row">
        <span>Start date</span>
        <span class="primary">${loan.StartDate}</span>
    </div>
    <div class="info-row">
        <span>Amount</span>
        <span class="primary">${loan.Amount} EUR</span>
    </div>
    <div class="info-row">
        <span>Tax</span>
        <span class="primary">${loan.Tax}%</span>
    </div>
    <div class="info-row">
        <span>Returned</span>
        <span class="primary">${loan.Returned} EUR</span>
    </div>
    <div class="info-row">
        <span>To be returned</span>
        <span class="primary">${loan.Total} EUR</span>
    </div>
    <div class="info-row">
        <span>Monthly payment</span>
        <span class="primary">${loan.Fee} EUR</span>
    </div>
</div>`;
const BRANCH_TEMPLATE = (safeBox) => `
<div class="branch-card">
    <div class="branch-card-row">
        <div>
            <h2>Branch</h2>
        </div>
        <div>
            <h1>${safeBox.Address} - ${safeBox.City}</h1>
            <div class="images-container">
                <img src="images/icons/directions.svg" alt="Direction Icon">
                <img src="images/icons/phone.svg" alt="Phone Icon">
            </div>
        </div>
    </div>
    <div class="branch-card-row">
        <div>
            <h2>Number-Sec. Level</h2>
        </div>
        <div>
            <h1>${safeBox.Sector} - ${safeBox.Level}</h1>
        </div>
    </div>
    <div class="branch-card-row">
        <div>
            <h2>Start date</h2>
            <h2>Monthly fee</h2>
        </div>
        <div>
            <h1>${safeBox.StartDate}</h1>
            <h1>${safeBox.Fee} EUR</h1>
        </div>
    </div>
</div>`;

const PROFILE_INFO_TEMPLATE = (profile) => `
<div class="personal-info-row">
    <h3>Account type</h3>
    <h1>${profile.Type}</h1>
</div>
<div class="personal-info-row">
    <h3>C.F.</h3>
    <h1>${profile.CF}</h1>
</div>
<div class="personal-info-row">
    <h3>E-Mail</h3>
    <h1>${profile.Email}</h1>
</div>
<div class="personal-info-row">
    <h3>Name</h3>
    <h1>${profile.Name}</h1>
</div>
<div class="personal-info-row">
    <h3>Surname</h3>
    <h1>${profile.Surname}</h1>
</div>
<div class="personal-info-row">
    <h3>Phone</h3>
    <h1>${profile.Phone}</h1>
</div>
<div class="personal-info-row">
    <h3>Residence</h3>
    <h1>${profile.Residence}</h1>
</div>
<div class="personal-info-row">
    <h3>Date of birth</h3>
    <h1>${profile.Dob}</h1>
</div>
<div class="personal-info-row">
    <h3>Client since</h3>
    <h1>${profile.StartDate}</h1>
</div>
<div class="personal-info-row">
    <h3>Monthly fee</h3>
    <h1>${profile.Fee} EUR</h1>
</div>`;

const CURRENCY_BLOCK_TEMPLATE = (base, curr, value) => `
<div class="currency-card">
    <div class="info">
        <h2>${base}/${curr}</h2>
        <h3>${value}</h3>
    </div>
<img src="images/chart.svg" alt="chart">
</div>
`;

const STOCK_CARD_TEMPLATE = (stock_info) => `
<div class="stock-card" data-link=${stock_info.symbol} data-active=${stock_info.favorite}>
    <div class="stock-title">
        <h2>${stock_info.name} (${stock_info.symbol})</h2>
        <h3>${stock_info.price}</h3>
    </div>
    <div class="value" data-trend = ${stock_info.trend}>
        <span>${stock_info.change} (${stock_info.changePercent} %)</span>
        <img src="images/icons/trending_${stock_info.trend}.svg" alt="Trending icon">
    </div>
</div>
`;
const STOCK_INFO_TEMPLATE = (stock_info) => `
<div data-active = "${stock_info.favorite}" data-stock='${stock_info.symbol}'>
    <div class="stock-title">
        <h1>${stock_info.name} (${stock_info.symbol})</h1>
        <div class="stock-title-value">
            <h3>${stock_info.price}</h3>
            <h3 data-trend = ${stock_info.trend}>${stock_info.change}</h3>
        </div>
    </div>
    <div class="chart-container">
        <div class="chart">
            <img src="images/big_chart.svg" alt="Chart">
        </div>
        <div class="stock-info">
            <div class="info">
                <h2>Max</h2>
                <h3>${stock_info.high}</h3>
            </div>
            <div class="info">
                <h2>Min</h2>
                <h3>${stock_info.low}</h3>
            </div>
            <div class="info">
                <h2>Min 52W</h2>
                <h3>${stock_info.week52Low}</h3>
            </div>
            <div class="info">
                <h2>Max 52W</h2>
                <h3>${stock_info.week52High}</h3>
            </div>
            <div class="info">
                <h2>P/E<h2>
                <h3>${stock_info.pe}</h3>
            </div>
            <div class="info">
                <h2>Volume</h2>
                <h3>${stock_info.volume}</h3>
            </div>
            <div class="info">
                <h2>Cap.</h2>
                <h3>${stock_info.cap}</h3>
            </div>
        </div>
    </div>
</div>`;

const LOADING_TEMPLATE = () => `
<div class="loading-container" id="loading">
    <div class="lds-roller">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <span>LOADING...</span>
</div>`;

const TOP_BAR_BALANCE_TEMPLATE = (info) => `
<div class="balance-container">
    <h2>Balance</h2>
    <h3>€ ${info.balance}</h3>
</div>
`;
const TOP_BAR_PROFILE_INFO_TEMPLATE = (info) => `
<div class="profile-info-container">
    <div class="name-container"><span>Hello,</span> <span id="profile-name">${info.name} ${info.surname}</span></div>
    <img id='profile-image' src="images/${info.src}" alt="Profile Image">
</div>`;

const MOBILE_PROFILE_INFO_TEMPLATE = (info) => `
<div class="mobile-profile-bar">
    <div><span>Hello,</span> <span id="profile-name">${info.name} ${info.surname}</span></div>
    <img id='profile-image' src="images/${info.src}" alt="Profile Image">
</div>`;

const ADD_CARD_MODAL_TEMPLATE = (info) => `
<div class="modal-container">
<div class="new-card-modal">
    <div class="title">
        <h1>Create new debit card</h1>
        <img id="close" src="images/icons/clear.svg" alt="clear">
    </div>
    <form>
        <div class="form-element">
            <h2>Available funds</h2>
            <div class="form-box">
                <img class="form-icon" src="images/icons/funds.svg" alt="icon">
                <span>${info}</span>
                <h3>EUR</h3>
            </div>
        </div>
        <div class="form-element">
            <h2>Add balance (Max 1500 EUR)</h2>
            <div class="form-box">
                <img class="form-icon" src="images/icons/funds.svg" alt="icon">
                <input name='Value' type="text" placeholder="Enter a value">
                <h3>EUR</h3>
            </div>
        </div>
        <input type="submit" class='button' value="Request new card">
    </form>
</div>
</div>`;

const CC_SUCCESS = (card) => `
<div>
    <div class="title">
        <h1>Card created successfully</h1>
        <img id="close" src="images/icons/clear.svg" alt="clear">
    </div>
    <div class="form-element">
        <h2>Number</h2>
        <div class="form-box">
            <span>${card.Number}</span>
        </div>
    </div>
    <div class="form-element">
        <h2>Expiry Date</h2>
        <div class="form-box">
            <span>${card.Month}/${card.Year}</span>
        </div>
    </div>
    <div class="form-element">
        <h2>CVV</h2>
        <div class="form-box">
            <span>${card.CVV}</span>
        </div>
    </div>
    <div class="form-element">
        <h2>PIN</h2>
        <div class="form-box">
            <span>${card.Pin}</span>
        </div>
    </div>
    <div class="form-element">
        <h2>Try to not forget these data!</h2>
    </div>
</div>`;

const ERROR_TEMPLATE = (error_text) => `
<div class="form-error"><img src="images/icons/error.svg" alt="Error"><span>${error_text}</span></div>
`;

const CHECKMARK_TEMPLATE = () => `
<div class="checkmark-container">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
        <circle class="path circle" fill="none" stroke="#2BC56B" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
        <polyline class="path check" fill="none" stroke="#2BC56B" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
        </svg>
    <div class="text-container">
        <h1>Thanks for being awesome!</h1>
        <h2>You are now registered to Easy Bank. </h2>
    </div>
    <span>Your browser should redirect you to login page soon. If anything happen click the button below </span>
    <div class="form-button">Go to login</div>
</div>
`;