<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">

    <link href="Assets/Images/Logo.png" rel="icon">

    <title> <?= $title ?> </title>
    <link href="Assets/Vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="Assets/Vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="Assets/Styles/sidebars.css">
    <!-- -->
    <?php
    if (isset($links)) {
        echo $links;
    }
    ?>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .search:hover,
        :focus {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="Assets/Styles/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 border-bottom">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">CSCS MADA</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="input-group">
            <input type="text" class="form-control search" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button type="button" class="btn btn-dark">Search</button>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="p-3 bg-white col-12">
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                                Home
                            </button>
                            <div class="collapse show" id="home-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="index.php?admin=overview" class="link-dark rounded">Overview</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#event-collapse" aria-expanded="false">
                                Event
                            </button>
                            <div class="collapse show" id="event-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="index.php?admin=event_form" class="link-dark rounded">Create</a></li>
                                    <li><a href="index.php?admin=current_event" class="link-dark rounded">Today's event</a></li>
                                    <li><a href="index.php?admin=organize_test" class="link-dark rounded">Organize test</a></li>
                                    <li><a href="index.php?admin=all_events" class="link-dark rounded">All events</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#post-collapse" aria-expanded="false">
                                Post
                            </button>
                            <div class="collapse show" id="post-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="index.php?admin=post_form" class="link-dark rounded">Create</a></li>
                                    <li><a href="index.php?admin=manage_post" class="link-dark rounded">Manage</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#candidate-collapse" aria-expanded="false">
                                Candidates
                            </button>
                            <div class="collapse show" id="candidate-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="index.php?admin=pretest_candidate_overview" class="link-dark rounded">Prestest</a></li>
                                    <li><a href="index.php?admin=final_test_candidate_overview" class="link-dark rounded">Final test</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="border-top my-3"></li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                                Account
                            </button>
                            <div class="collapse" id="account-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="index.php?admin=logout" class="link-dark rounded">Sign out</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 border-start">
                <?= $content ?>
            </main>
        </div>
    </div>
    <script src="Assets/Vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="Assets/JavaScripts/dashboard.js"></script>
    <script src="Assets/JavaScripts/sidebars.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <?php
    if (isset($scripts)) {
        echo $scripts;
    }
    ?>
</body>

</html>