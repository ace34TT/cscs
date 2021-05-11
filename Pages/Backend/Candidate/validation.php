<?php
// 127.0.0.1/cscs_v2.1/Pages/Backend/Candidate/validation.php?validation=657f215c06ebf0a5edd6bbb5bc38fe457ae3e693

require_once(dirname(__FILE__) . ' /../../../Inc/Controller/Personnal_information_Controller.php');

$inf_controller = new Personnal_information_Controller;

$info = $inf_controller->check_validation($_GET['validation']);

$uri = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Validation form</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../../Assets/Images/Logo.png" rel="icon">
    <link href="../../../Assets/Images/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../../Assets/Vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../Assets/Vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../../../Assets/Vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="Assets/Vendor/bulma/css/bulma.min.css"> -->

    <!-- awesomefont-->
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> -->

    <!-- Template Main CSS File -->
    <link href="../../../Assets/Styles/index.css" rel="stylesheet">
    <link href="../../../Assets/Styles/validation.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Baker - v4.1.0
  * Template URL: https://bootstrapmade.com/baker-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>

<body>

    <form action="#">

    </form>



    <?php

    if ($info != false) {
        if ($info[0]['code_status'] == 'used') {
            header('Location: expired.php');
        } else {
    ?>
            <!-- ======= Apply Section ======= -->
            <section id="Apply" class="Apply" style="margin-top: -30px; margin-bottom: 0px;">
                <div class="container">
                    <div class="section-title">
                        <h2>Personnal information validation</h2>
                        <p>Please , make sure every informations are correcte , you won't be able to make any change after you submmited this form</p>
                    </div>

                    <div class="row">
                        <form onSubmit="return checkPassword(this)" class="row g-3 needs-validation" enctype="multipart/form-data" method="POST" action="../../../index.php?validation=true&amp;personnal_information=<?= $info[0]['id'] ?>&amp;url=<?= $uri ?> ">
                            <!-- Firstname / Lastname -->
                            <div class="col-md-4">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text" readonly value=" <?= $info[0]['firstname'] ?> " name="firstname" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" readonly value=" <?= $info[0]['lastname'] ?> " name="lastname" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" readonly value=" <?= $info[0]['email'] ?> " name="email" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required id="validationCustom01">
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom02" class="form-label">Confirm password</label>
                                <input type="password" name="confirm" id="confirm-password" class="form-control" required id="validationCustom02">
                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom02" class="form-label">Resume</label>
                                <div class="input-file-container">
                                    <input class="input-file" id="my-file" type="file" name="resume" required>
                                    <label tabindex="0" for="my-file" class="input-file-trigger"> <span class="fa fa-tv"></span> Select a file...</label>
                                </div>
                                <p class="file-return"></p>
                            </div>
                            <?php
                            if (isset($_GET['status'])) {
                            ?>
                                <div class="col-md-6">
                                    <p style="color: #f85a5a;"> <?= $_GET['status'] ?></p>
                                </div>
                            <?php
                            }
                            ?>
                            <br>
                            <div class="col-12 d-flex flex-column-reverse bd-highlight ">
                                <button type="submit" id="btn-apply" class="btn p-2 bd-highlight">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section><!-- End Apply Section -->
    <?php
        }
    } else {
        header('Location: 404.php');
    }
    ?>

    <script>
        document.querySelector("html").classList.add('js');

        var fileInput = document.querySelector(".input-file"),
            button = document.querySelector(".input-file-trigger"),
            the_return = document.querySelector(".file-return");

        button.addEventListener("keydown", function(event) {
            if (event.keyCode == 13 || event.keyCode == 32) {
                fileInput.focus();
            }
        });
        button.addEventListener("click", function(event) {
            fileInput.focus();
            return false;
        });
        fileInput.addEventListener("change", function(event) {
            the_return.innerHTML = this.value;
        });
    </script>

    <script>
        // Function to check Whether both passwords
        // is same or not.
        function checkPassword(form) {
            password1 = form.password.value;
            password2 = form.confirm.value;

            // If Not same return False.    
            if (password1 != password2) {
                alert("\nPassword did not match: Please try again...")
                return false;
            }
            // If same return True.
            else {
                return true;
            }
        }
    </script>

</body>

</html>