<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="Assets/Vendor/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="Assets/Vendor/bootstrap/css/bootstrap-min.css"> -->
    <?php
    echo isset($link) ? $link : null;
    ?>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">CSCS Mada</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll d-flex" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?candidate=events">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Posts</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?= $content ?>

    <?php
    echo isset($script) ? $script : null;
    ?>
</body>



</html>