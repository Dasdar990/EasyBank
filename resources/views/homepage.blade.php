<html>

<head>
    <title>Easy Bank</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="css/homePage.css">
    <link rel="stylesheet" href="css/index_animations.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="js/index.js" defer></script>

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
    <nav>
        <img id="logo" src="images/logo.svg" alt="Website Logo">
        <img id="mobile-logo" src="images/mobile-logo.svg" alt="Website Logo">
        <div class="navigation">
            <img id="menu-button" src="images/icons/burger.svg" alt="Mobile menu icon">
            <a href="#home" data-active='true'>Home</a>
            <a href="#pricing" data-active='false'>Products</a>
            <a href="#cards" data-active='false'>Cards</a>
            <a href="#services" data-active='false'>Services</a>
            <div data-send="login" class="button">Login</div>
        </div>
    </nav>
    <div class="mobile-menu" data-active="false">
        <div class="mobile-menu-items">
            <a href="#home" data-active='true'>Home</a>
            <a href="#pricing" data-active='false'>Products</a>
            <a href="#cards" data-active='false'>Cards</a>
            <a href="#services" data-active='false'>Services</a>
        </div>
        <div class="button" data-send="login">Login</div>
    </div>
    <header id="home">
        <div class="h-container">
            <div>
                <h1>Control your finance easily!</h1>
                <div id="discover" class="button" href="#pricing">Discover now</div>
            </div>
            <div class="mockup-container">
                <img class="content-img" src="images/iPhoneMockup.png" alt="Mockup">
                <div class="cc">
                    <img class="pattern" src="images/pattern2.png" alt="Pattern">
                    <div class="overlay"></div>
                    <div class="row">
                        <img src="images/icons/logo_card.svg" alt="Bank logo">
                        <img src="images/icons/Visa.svg" alt="Bank logo">
                    </div>
                    <div class="row number">
                        <span>**** **** **** 1234</span>
                    </div>
                    <div class="row">
                        <span>01/25</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="wave-container">
            <img id="wave" src="images/wave.svg" alt="wave">
        </div>
    </header>


    <section class="snd-back" id="pricing">
        <div class="content">
            <div class="plans-main-text"><span class="active">Simple </span><span>Plans</span></div>
            <div class="plans-secondary-text"><span>Choose a plan that works best for you and your needs</span></div>
            <div class="container">
                <div class="plans-card">
                    <div class="card-header">
                        <p>Basic</p> <img src="images/triangle.svg" alt="Triangle">
                    </div>
                    <div class="price"><span class="tiny">€</span><span>3.50</span><span class="tiny">/month</span></div>
                    <ul>
                        <li><img src="images/icons/check.svg" alt="Check">Credit card (fixed tax)</li>
                        <li><img src="images/icons/check.svg" alt="Check">Up to 2 debit cards</li>
                    </ul>
                    <div class="button" data-send="register">Choose plan <img src="images/icons/arrow.svg" alt="Arrow"></div>
                </div>
                <div class="plans-card">
                    <div class="card-header">
                        <p>Pro</p> <img src="images/triangle.svg" alt="Triangle">
                    </div>
                    <div class="price"><span class="tiny">€</span><span>7.50</span><span class="tiny">/month</span></div>
                    <ul>
                        <li><img src="images/icons/check.svg" alt="Check">Credit card (flexible tax)</li>
                        <li><img src="images/icons/check.svg" alt="Check">Unlimited debit cards</li>
                        <li><img src="images/icons/check.svg" alt="Check">Can rent a safe deposit box</li>
                    </ul>
                    <div class="button" data-send="register">Choose plan <img src="images/icons/arrow.svg" alt="Arrow"></div>
                </div>
            </div>
        </div>
    </section>
    <section id="cards">
        <div class="content">
            <div class="title-text">
                <span class="active">Cards</span><span> choice</span>
            </div>
            <div class="container">
                <div class="card-row">
                    <div class="cc" id="card1">
                        <img class="pattern" src="images/pattern1.png" alt="Pattern">
                        <div class="overlay"></div>
                        <div class="row">
                            <img src="images/icons/logo_card.svg" alt="Bank logo">
                            <img src="images/icons/Visa.svg" alt="Bank logo">
                        </div>
                        <div class="row number">
                            <span>**** **** **** 1234</span>
                        </div>
                        <div class="row">
                            <span>01/25</span>
                        </div>
                    </div>
                    <div class="text-container">
                        <h1>Easy Bancomat</h1>
                        <ul>
                            <li><img src="images/icons/check-s.svg" alt="Check">One card for every account owner</li>
                            <li><img src="images/icons/check-s.svg" alt="Check">Flexible daily and monthly spending amount</li>
                            <li><img src="images/icons/check-s.svg" alt="Check">Visa circuit</li>
                        </ul>
                    </div>
                </div>
                <div class="card-row">
                    <div class="cc">
                        <img class="pattern" src="images/pattern2.png" alt="Pattern">
                        <div class="overlay"></div>
                        <div class="row">
                            <img src="images/icons/logo_card.svg" alt="Bank logo">
                            <img src="images/icons/Mastercard.svg" alt="Bank logo">
                        </div>
                        <div class="row number">
                            <span>**** **** **** 1234</span>
                        </div>
                        <div class="row">
                            <span>01/25</span>
                        </div>
                    </div>
                    <div class="text-container">
                        <h1>Easy Credit</h1>
                        <ul>
                            <li><img src="images/icons/check-s.svg" alt="Check">You don’t ever have to worry for a payment</li>
                            <li><img src="images/icons/check-s.svg" alt="Check">Flexible tax (depending on account type)</li>
                            <li><img src="images/icons/check-s.svg" alt="Check">Mastercard circuit</li>
                            <li><img src="images/icons/check-s.svg" alt="Check">Pay by installments</li>
                        </ul>
                    </div>
                </div>
                <div class="card-row">
                    <div class="cc">
                        <img class="pattern" src="images/pattern3.png" alt="Pattern">
                        <div class="overlay"></div>
                        <div class="row">
                            <img src="images/icons/logo_card.svg" alt="Bank logo">
                            <img src="images/icons/Mastercard.svg" alt="Bank logo">
                        </div>
                        <div class="row number">
                            <span>**** **** **** 1234</span>
                        </div>
                        <div class="row">
                            <span>01/25</span>
                        </div>
                    </div>
                    <div class="text-container">
                        <h1>Easy Debit</h1>
                        <ul>
                            <li><img src="images/icons/check-s.svg" alt="Check">Charge it directly from your account</li>
                            <li><img src="images/icons/check-s.svg" alt="Check">You can delete it whenever you want</li>
                            <li><img src="images/icons/check-s.svg" alt="Check">Mastercard circuit</li>
                            <li><img src="images/icons/check-s.svg" alt="Check">Perfect for children</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="snd-back" id="services">
        <div class="content">
            <div class="title-text">
                <span class="active">Safe-deposit</span><span> boxes</span>
            </div>
            <div class="container">
                <img id="vault" class="content-img" src="images/undraw_vault_9cmw.svg" alt="Vault image">
                <div>
                    <h1>With a Pro account you can rent a safe-deposit box located in one of our branch</h1>
                    <ul class="content-list">
                        <li><img src="images/icons/check-s.svg" alt="Check">3 Different levels of security</li>
                        <li><img src="images/icons/check-s.svg" alt="Check">No time limit</li>
                        <li><img src="images/icons/check-s.svg" alt="Check">Leave it without warning</li>
                        <li><img src="images/icons/check-s.svg" alt="Check">Utmost Discretion </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="content">
            <div class="title-text">
                <span class="active">Fast and</span><span> easy loans</span>
            </div>
            <div class="container">
                <div>
                    <h1>Flexible interest loan with easy procedures</h1>
                    <ul class="content-list">
                        <li><img src="images/icons/check-s.svg" alt="Check">Personal consultant, always available </li>
                        <li><img src="images/icons/check-s.svg" alt="Check">Flexible interests</li>
                    </ul>
                </div>
                <img class="content-img" src="images/undraw_Meeting_re_i53h.svg" alt="Meeting image">
            </div>
        </div>
    </section>

    <footer id="about">
        <div>
            <a href="https://www.unict.it/"><img src="images/uniLogo.svg" alt="University Logo"></a>
        </div>
        <div class="footer-text">
            <h2>This is an university project made by</h2>
            <h3>Interlandi Emilio</h3>
            <h3>O46002209</h3>
            <div class="footer-icons">
                <a href="https://github.com/Dasdar990"><img src="images/icons/github.svg" alt="Github Icon"></a>
                <a href="mailto:emilio.interlandi@gmail.com"><img src="images/icons/mail.svg" alt="Mail Icon"></a>
                <a href="https://t.me/taf991"><img src="images/icons/telegram.svg" alt="Telegram Icon"></a>
                <a href="https://www.facebook.com/emilio.interlandi"><img src="images/icons/facebook.svg" alt="Facebook Icon"></a>
                <a href="https://www.instagram.com/emilioint/"><img src="images/icons/instagram.svg" alt="Instagram Icon"></a>
            </div>
        </div>
    </footer>

</body>

</html>