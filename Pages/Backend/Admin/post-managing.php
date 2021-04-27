<?php $title = "Post management"; ?>

<?php ob_start(); ?>
<link rel="stylesheet" type="text/css" href="Assets/Vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="Assets/Vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="Assets/Vendor/perfect-scrollbar/perfect-scrollbar.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="Assets/Styles/table.css">

<style>
    .active-dot {
        height: 10px;
        width: 10px;
        background-color: #87f75b;
        border-radius: 50%;
        display: inline-block;
    }

    .inactive-dot {
        height: 10px;
        width: 10px;
        background-color: #9ab5ce;
        border-radius: 50%;
        display: inline-block;
    }
</style>
<?php $links = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- <div class="row mt-2 mb-3 border">
    <div class="row">
        <h1 class="col-md-6 mt-3" style="margin-left: 40px;">Assigned candidates</h1>
        <input class="col-md-5 mt-3" type="text" id="assigned_id_input" onkeyup="assigned_search()" placeholder="Search for ID..">
    </div>
    <div class="container shadow-sm mt-3" style="font-size: 20px;">
        <div class="limiter">
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100 border ver1 m-b-110">
                        <div class="table100-head">
                            <table>
                                <thead>
                                    <tr class="row100 head">
                                        <th class="cell100 column1">ID</th>
                                        <th class="cell100 column2">Name</th>
                                        <th class="cell100 column3">Province</th>
                                        <th class="cell100 column4">Post</th>
                                        <th class="cell100 column5">Notified</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table100-body js-pscroll" id="assigned_candidates">
                            <table id="assigned">
                                <tbody>
                                    <?php
                                    if (isset($assignet_curr_event)) {
                                        foreach ($assignet_curr_event as $candidate) { ?>
                                            <tr class="row100 body">
                                                <td class="cell100 column1"><?= $candidate['users'] ?> </td>
                                                <td class="cell100 column2"> <a style="text-decoration: none;" href="index.php?admin=test_form&amp;candidate=<?= $candidate['users'] ?>&amp;event=<?= $event['id'] ?>"><?= $candidate['lastname'] . ' ' . $candidate['firstname'] ?></a> </td>
                                                <td class="cell100 column3"> <?= $candidate['province'] ?> </td>
                                                <td class="cell100 column4"><?= $candidate['post'] ?> </td>
                                                <td class="cell100 column5 text-center"><span class="
                                    <?php
                                            echo $candidate['notified'] == true ? 'active-dot' : 'inactive-dot';
                                    ?> "></span>
                                                    <input hidden type="checkbox" <?php
                                                                                    echo $candidate['notified'] == true ? '' : 'checked';
                                                                                    ?>>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row mt-2 mb-3 border">
    <div class="row">
        <h1 class="col-md-6 mt-3" style="margin-left: 40px;">All post </h1>
        <input class="col-md-5 mt-3" type="text" id="post_name_input" onkeyup="search_post()" placeholder="Search for ID..">
    </div>
    <div class="container shadow-sm mt-3" style="font-size: 20px;">
        <div class="limiter">
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100 border ver1 m-b-110">
                        <div class="table100-head">
                            <table>
                                <thead>
                                    <tr class="row100 head">
                                        <th class="cell100 column1-1">Name</th>
                                        <th class="cell100 column2-1">category</th>
                                        <th class="cell100 column3-1">Quota</th>
                                        <th class="cell100 column4-1"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table100-body js-pscroll" id="assigned_candidates">
                            <table id="post">
                                <tbody>
                                    <?php
                                    if (isset($posts)) {
                                        foreach ($posts as $post) { ?>
                                            <tr class="row100 body">
                                                <td class="cell100 column1-1"><?= $post['name'] ?> </td>
                                                <td class="cell100 column2-1"> <?= $post['category'] ?> </td>
                                                <td class="cell100 column3-1"><?= $post['quota'] ?> </td>
                                                <td class="cell100 column4-1" id="remove">
                                                    <span onclick="window.location='index.php?admin=delete_post&amp;post=<?= $post['id'] ?>';" class="fa fa-trash-alt"></span>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>


<?php ob_start(); ?>
<script src="Assets/Vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="Assets/Vendor/bootstrap/js/popper.js"></script>
<script src="Assets/Vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="Assets/Vendor/select2/select2.min.js"></script>
<script src="Assets/Vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function() {
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="Assets/JavaScripts/table.js"></script>
<script>
    function search_post() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("post_name_input");
        filter = input.value.toUpperCase();
        table = document.getElementById("post");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<?php $scripts = ob_get_clean(); ?>


<?php require('template.php'); ?>