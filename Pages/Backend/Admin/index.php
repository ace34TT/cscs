<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin-Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link href="Assets/Images/Logo.png" rel="icon">
    <link href="Assets/Images/apple-touch-icon.png" rel="apple-touch-icon">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Assets/Vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Assets/Vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Assets/Vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Assets/Vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Assets/Vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Assets/Vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="Assets/Styles/util.css">
    <link rel="stylesheet" type="text/css" href="Assets/Styles/login.css">
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(Assets/Images/cruises-cruise-ship-holidays-2019-crew-code-1042151.jpg);">
                    <span class="login100-form-title-1">
                        Sign In
                    </span>
                </div>

                <form class="login100-form validate-form" method="post" action="index.php?admin=access">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Enter username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="m-b-18">
                        <p style="color: #f85a5a;"> <?php echo (isset($error) ? $error : null) ?> </p>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="index.php" class=" txt1">
                                go to homepage
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="Assets/Vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="Assets/Vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="Assets/Vendor/bootstrap/js/popper.js"></script>
    <script src="Assets/Vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="Assets/Vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="Assets/Vendor/daterangepicker/moment.min.js"></script>
    <script src="Assets/Vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="Assets/Vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="Assets/JavaScripts/login.js"></script>

</body>

</html>