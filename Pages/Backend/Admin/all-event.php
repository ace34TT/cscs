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
<div class="row mt-2 mb-3 border">
    <div class="row">
        <h1 class="col-md-6 mt-3" style="margin-left: 40px;">All events </h1>
        <input class="col-md-5 mt-3" type="text" id="event_name_input" onkeyup="search_event()" placeholder="Search for ID..">
    </div>
    <div class="container ">
        <div class="row mt-3">
            <div class="col-10">
                <table class="table table-hover" id="event">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Type</th>
                            <th scope="col">Method</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($events)) {
                            foreach ($events as $event) {
                        ?>
                                <tr onclick="window.location='index.php?admin=<?php echo ($event['events'] == 'pretest' ? 'pretest_overview' : 'final_test_overview'); ?>&amp;event=<?= $event['id'] ?>';">
                                    <td scope="row"><?= $event['id'] ?></td>
                                    <td><?= $event['names'] ?></td>
                                    <td><?= $event['author'] ?> </td>
                                    <td> <?php
                                            if ($event['events'] == 'pretest') {
                                                echo 'Pretest';
                                            }
                                            if ($event['events'] == 'final_test') {
                                                echo 'Final test';
                                            }
                                            if ($event['events'] == 'meeting') {
                                                echo 'Meeting';
                                            }
                                            ?> </td>
                                    <td><?= $event['method'] ?> </td>
                                    <td><?= $event['dates'] ?> </td>
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
    function search_event() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("event_name_input");
        filter = input.value.toUpperCase();
        table = document.getElementById("event");
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