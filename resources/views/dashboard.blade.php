<html>

<head>
    <title>EB Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="js/requests.js" defer></script>
    <script src="js/utils.js" defer></script>
    <script src="js/dashboard_main.js" defer></script>
    <script src="js/templates.js" defer></script>
    <script src="js/dash_eventListeners.js" defer></script>

    <link rel="apple-touch-icon" sizes="180x180" href="images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicons/favicon-16x16.png">
    <link rel="manifest" href="images/favicons/site.webmanifest">
    <link rel="mask-icon" href="images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="images/favicons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Easy Bank">
    <meta name="application-name" content="Easy Bank">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <div class="full-size-container">
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
        </div>
        <div class="menu">
            <img class="logo" src="images/logo.svg" alt="Logo">
            <div class="menu-items-container">
                <div data-link="Overview" data-active="true" class="menu-item">
                    <img src="images/icons/home.svg" alt="Home">
                    <span>Overview</span>
                </div>
                <div data-link="Cards" data-active="false" class="menu-item">
                    <img src="images/icons/credit_card.svg" alt="Cards">
                    <span>Cards</span>
                </div>
                <div data-link="Activity" data-active="false" class="menu-item">
                    <img src="images/icons/activity.svg" alt="Activity">
                    <span>Activity</span>
                </div>
                <div data-link="Services" data-active="false" class="menu-item">
                    <img src="images/icons/services.svg" alt="Services">
                    <span>Services</span>
                </div>
                <div data-link="Market" data-active="false" class="menu-item">
                    <img src="images/icons/market.svg" alt="Market">
                    <span>Stock market</span>
                </div>
            </div>
            <div class="menu-items-container bottom">
                <div data-link="Account" data-active="false" class="menu-item">
                    <img src="images/icons/account.svg" alt="Account">
                    <span>Account</span>
                </div>
                <div id="logout" class="menu-item">
                    <img src="images/icons/logout.svg" alt="Logout">
                    <span>Logout</span>
                </div>
            </div>
        </div>

        <div class="mobile-menu" data-active="false">
            <div class="line"></div>
            <div class="mobile-menu-items-container">
                <div class="mobile-menu-item" data-link="Overview" data-active="true">
                    <span>Overview</span>
                    <img src="images/icons/home.svg" alt="Home Icon">
                </div>
                <div class="mobile-menu-item" data-link="Cards" data-active="false">
                    <span>Cards</span>
                    <img src="images/icons/credit_card.svg" alt="CC Icon">
                </div>
                <div class="mobile-menu-item" data-link="Activity" data-active="false">
                    <span>Activity</span>
                    <img src="images/icons/activity.svg" alt="Activity Icon">
                </div>
                <div class="mobile-menu-item" data-link="Services" data-active="false">
                    <span>Services</span>
                    <img src="images/icons/services.svg" alt="Services Icon">
                </div>
                <div class="mobile-menu-item" data-link="Market" data-active="false">
                    <span>Stock market</span>
                    <img src="images/icons/market.svg" alt="Market Icon">
                </div>
            </div>
            <div class="mobile-menu-items-container bottom">
                <div class="mobile-menu-item" data-link="Account" data-active="false">
                    <span>Account</span>
                    <img src="images/icons/account.svg" alt="Account Icon">
                </div>
                <div class="mobile-menu-item" data-active="false" id="logout">
                    <span>Logout</span>
                    <img src="images/icons/logout.svg" alt="Logout Icon">
                </div>
            </div>
        </div>
        <header>
            <div class="top-bar"></div>
            <div class="mobile-top-bar">
                <img class="mobile-logo" src="images/mobile-logo.svg" alt="Logo">
                <img id="mobile-menu-burger" data-img="open" class="burger-menu" src="images/icons/burger.svg" alt="Burger Icon">
            </div>
            <section data-gen="true" data-opened="true" id="overview">
                <div class="half-horizontal">
                    <div class="half-vertical">
                        <div class="title">
                            <h1>Your cards</h1>
                            <h3 data-link="Cards">Show all</h3>
                        </div>
                        <div class="cards-container">
                        </div>
                    </div>
                    <div class="half-vertical">
                        <div class="title">
                            <h1>Recent activity</h1>
                            <h3 data-link="Activity">Show all</h3>
                        </div>
                        <div class="activity-container">
                        </div>
                    </div>
                </div>
                <div class="half-horizontal">
                    <div class="full-container">
                        <div class="title">
                            <h1>History information</h1>
                            <h3 data-link="Activity">Show all</h3>
                        </div>
                        <div class="title">
                            <h4>Month-Year</h4>
                            <h4>Balance</h4>
                        </div>
                        <div class="info-container">
                        </div>
                    </div>
                </div>
            </section>
            <section data-gen="false" data-opened="false" id="cards" class="two-columns">
                <div class="half-vertical">
                    <div class="title">
                        <h1>My Cards</h1>
                        <img id="add" src="images/icons/add.svg" alt="Add Icon">
                    </div>
                    <div class="cards-container">
                    </div>
                </div>
                <div class="half-vertical">
                    <div class="title">
                        <h1>Card information</h1>
                    </div>
                    <div class="info-container">
                    </div>
                </div>
            </section>
            <section data-gen="false" data-opened="false" id="activity">
                <div class="half-horizontal">
                    <div class="full-container">
                        <div class="title s">
                            <h1>Activity</h1>
                            <div class="search-container">
                                <div> <img src="images/icons/search.svg" alt="Search Icon"><input type="text" id="#search" placeholder="Search"> </div>
                                <img id="clear" src="images/icons/clear.svg" alt="Clear Icon">
                            </div>
                        </div>
                        <div class="filter-container" data-visible="visible">
                            <img id="remove" src="images/icons/cancel.svg" alt="Cancel Icon">
                        </div>
                        <div id="filter-cards" data-visible="visible" class="activity-container"></div>
                        <div id="filter-search" data-visible="hidden" class="activity-container"></div>
                    </div>
                </div>
                <div class="half-horizontal">
                    <div class="full-container">
                        <div class="title">
                            <h1>History information</h1>
                        </div>
                        <!--
                        <div class="favorite-container" data-active="false">
                            <div class="title">
                                <h1>Favorites</h1>
                            </div>
                            <div class="title">
                                <h4>Month-Year</h4>
                                <h4>Balance</h4>
                            </div>
                            
                            <div class="favorite-elements-container">
                            </div>
                            
                    </div>
                    <div class="title">
                        <h1>List</h1>
                    </div>
                    -->
                        <div class="title">
                            <h4>Month-Year</h4>
                            <h4>Balance</h4>
                        </div>
                        <div class="info-container">
                        </div>
                    </div>
                </div>
            </section>
            <section data-gen="false" data-opened="false" id="services">
                <div class="half-horizontal">
                    <div class="half-vertical">
                        <div class="title">
                            <h1>My loans</h1>
                        </div>
                        <div class="cards-container">
                        </div>
                    </div>
                    <div class="half-vertical">
                        <div class="title">
                            <h1>Loan information</h1>
                        </div>
                        <div class="info-container">
                        </div>
                    </div>
                </div>
                <div class="half-horizontal">
                    <div class="half-vertical">
                        <div class="title">
                            <h1>My safe deposit box</h1>
                        </div>
                        <div id="branch" class="cards-container"></div>
                    </div>
                    <div class="half-vertical">
                        <div id="contact" class="title"><img src="images/icons/phone.svg" alt="Phone Icon">
                            <h3>Contact an agent for a new loan or a new deposit box</h3>
                        </div>
                    </div>
                </div>
            </section>
            <section data-gen="false" data-opened="false" id="market">
                <div class="half-horizontal">
                    <div class="full-container">
                        <div class="title">
                            <h1>Currency exchange rates</h1>
                            <img data-settings="currency" src="images/icons/settings.svg" alt="Settings Icon">
                        </div>
                        <div class="scroll-container" data-set="currency">
                        </div>
                    </div>
                </div>
                <div class="half-horizontal">
                    <div class="full-container" id="stock-market">
                        <div class="title">
                            <h1>Stock market</h1>
                            <img data-settings="market" src="images/icons/settings.svg" alt="Settings Icon">
                        </div>
                        <div class="scroll-container" data-set="stock">
                        </div>
                        <div class="stock-info-container">
                        </div>
                    </div>
                </div>
            </section>
            <section data-gen="false" data-opened="false" id="account" class="two-columns">
                <div class="half-vertical">
                    <div class="title">
                        <h1>Personal information</h1>
                    </div>
                    <div class="profile-image-container">
                    </div>
                    <div class="personal-info-container">
                    </div>
                </div>
                <div class="half-vertical">
                    <div class="title">
                        <h1>Actions</h1>
                    </div>
                    <div class="info-container profile">
                        <div class="info-row">
                            <img src="images/icons/lock.svg" alt="Lock Icon">
                            <span>Change password</span>
                        </div>
                        <div class="info-row">
                            <img src="images/icons/rescue.svg" alt="Rescue Icon">
                            <span>Contact support</span>
                        </div>
                        <div class="info-row">
                            <img src="images/icons/phone.svg" alt="Phone Icon">
                            <span>Change phone number</span>
                        </div>
                        <div class="info-row" id="access_logs">
                            <img src="images/icons/summary.svg" alt="Summary Icon">
                            <span>Show access logs</span>
                        </div>
                    </div>
                </div>
            </section>
        </header>
    </div>

</body>

</html>