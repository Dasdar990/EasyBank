<html>

<head>
    <title>Easy-Bank Login</title>
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@500&display=swap" rel="stylesheet">
    <script src="js/login.js" defer></script>
    <script src="js/utils.js" defer></script>
    <script src="js/templates.js" defer></script>



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
    <div class="navbar">
        <img class="logo" src="images/logo.svg" alt="Logo">
        <img class="mobile-logo" src="images/mobile-logo.svg" alt="Logo">
    </div>
    <div class="full-size-container">
        <div class="container">
            <div class="img-r">
                <img src="images/secure_login.svg" alt="Secure login">
            </div>
            <div class="sign-container">
                <div class="login-text" data-active="false" data-sign="login">
                    <h1>Let's sign you in</h1>
                    <h2>Welcome back.</h2>
                    <h2>You have been missed.</h2>
                </div>
                <div class="login-text" data-active="false" data-sign="register">
                    <h1>Get started here</h1>
                    <h2>It will be an awesome journey.</h2>
                    <h2>You won't regret it</h2>
                </div>
                <div class="login-text" data-active="false" data-sign="continue">
                    <h1>You're almost there!</h1>
                    <h2>We know it's boring.</h2>
                </div>
                <div class="sign-selector" data-active="true">
                    <span data-form='login' data-active="false">Sign in</span>
                    <span data-form='register' data-active="false">Sign up</span>
                </div>
                <div class="form-container">
                    <form id="sign-in" data-active="false" method="post">
                        <input type="hidden" name="_token" value='{{ $csrf_token }}'>
                        <div class="form-element">
                            <h2>E-Mail</h2>
                            <div class="form-box">
                                <img class="form-icon" src="images/icons/mail.svg" alt="icon">
                                <input name='Email' type="text" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-element">
                            <h2>Password</h2>
                            <div class="form-box">
                                <img class="form-icon" src="images/icons/password_icon.svg" alt="icon">
                                <input name="l-password" type="password" placeholder="Password">
                                <img class="form-icon" src="images/icons/visibility.svg" alt="icon" id="visibility" data-type="invisible">
                            </div>
                        </div>
                        <h3><a href="">Forgot password?</a></h3>
                        <input type="submit" class="form-button" data-sign="login" value="Sign in">
                    </form>
                    <form id="sign-up" data-active="false" action="post">
                        <input type="hidden" name="_token" value='{{ $csrf_token }}'>
                        <div class="form-element">
                            <h2>E-Mail</h2>
                            <div class="form-box">
                                <img class="form-icon" src="images/icons/mail.svg" alt="icon">
                                <input type="text" name="email" placeholder="Email">
                            </div>
                        </div>
                        <input type="submit" class="form-button" data-sign="continue" value="Continue">
                    </form>
                    <form id="sign-up-2" data-active="false" method="post">
                        <input type="hidden" name="_token" value='{{ $csrf_token }}'>
                        <div class="form-element" id="r-email">
                            <h2>E-Mail</h2>
                            <div class="form-box">
                                <img class="form-icon" src="images/icons/mail.svg" alt="icon">
                                <span></span>
                            </div>
                        </div>
                        <div class="form-element">
                            <h2>Codice Fiscale</h2>
                            <div class="form-box">
                                <img class="form-icon" src="images/icons/badge.svg" alt="icon">
                                <input autocomplete="one-time-code" name="cf" type="text" maxlength="16" placeholder="C.F">
                            </div>
                        </div>
                        <div class="form-element">
                            <h2>Password</h2>
                            <div class="form-box">
                                <img class="form-icon" src="images/icons/password_icon.svg" alt="icon">
                                <input id="r-password" autocomplete="new-password" name="r-password" type="password" placeholder="Password">
                                <img class="form-icon" src="images/icons/visibility.svg" alt="icon" id="visibility" data-type="invisible">
                            </div>
                        </div>
                        <div class="form-element">
                            <h2>Confirm password</h2>
                            <div class="form-box">
                                <img class="form-icon" src="images/icons/password_icon.svg" alt="icon">
                                <input id="confirm-password" name="c-password" type="password" placeholder="Confirm password">
                                <img class="form-icon" src="images/icons/visibility.svg" alt="icon" id="visibility" data-type="invisible">
                            </div>
                        </div>
                        <div class="double">
                            <div class="form-element">
                                <h2>Name</h2>
                                <div class="form-box">
                                    <img class="form-icon" src="images/icons/person.svg" alt="icon">
                                    <input type="text" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-element">
                                <h2>Surname</h2>
                                <div class="form-box">
                                    <img class="form-icon" src="images/icons/person.svg" alt="icon">
                                    <input type="text" name="surname" placeholder="Surname">
                                </div>
                            </div>
                        </div>
                        <div class="double">
                            <div class="form-element">
                                <h2>Phone</h2>
                                <div class="form-box">
                                    <img class="form-icon" src="images/icons/phone.svg" alt="icon">
                                    <input maxlength="20" name="phone" type="text" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="form-element">
                                <h2>Residence</h2>
                                <div class="form-box">
                                    <img class="form-icon" src="images/icons/building.svg" alt="icon">
                                    <input type="text" name="residence" placeholder="Residence">
                                </div>
                            </div>
                        </div>
                        <div class="double">
                            <div class="form-element">
                                <h2>Account type</h2>
                                <div class="type">
                                    <div class="checkbox">
                                        <input class="chk" name="type" type="radio" value="Basic" checked="checked">
                                        <label for="type">Basic</label>
                                    </div>
                                    <div class="checkbox">
                                        <input class="chk" name="type" type="radio" value="Pro">
                                        <label for="type">Pro</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-element">
                                <h2>Date of birth</h2>
                                <div class="form-box">
                                    <img class="form-icon" src="images/icons/date.svg" alt="icon">
                                    <input type="text" name="dob" placeholder="DOB">
                                </div>
                            </div>
                        </div>
                        <div class="button-container">
                            <div class="form-button back" data-sign="back">
                                <img src="images/icons/arrow_back.svg" alt="Icon">
                                <h2>Go back</h2>
                            </div>
                            <input type="submit" class="form-button" data-sign="register" value="Sign up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>