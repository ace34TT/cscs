<?php $title = "Test scheduling"; ?>

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
        <h1 class="col-md-6 mt-3" style="margin-left: 40px;">Pending candidates</h1>
        <input class="col-md-5 mt-3" type="text" id="pending_id_input" onkeyup="pending_search()" placeholder="Search for ID..">
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
                                        <th class="cell100 column4">Email</th>
                                        <th class="cell100 column5">Phone</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table100-body js-pscroll" id="assigned_candidates">
                            <table id="pending">
                                <tbody>
                                    <?php
                                    if (isset($pretest_pending_candidates)) {
                                        foreach ($pretest_pending_candidates as $candidate) { ?>
                                            <tr class="row100 body">
                                                <td class="cell100 column1"><?= $candidate['users'] ?> </td>
                                                <td class="cell100 column2"> <a style="text-decoration: none;" href="index.php?admin=candidate_card&amp;candidate=<?= $candidate['users'] ?>"><?= $candidate['lastname'] . ' ' . $candidate['firstname'] ?></a> </td>
                                                <td class="cell100 column3"> <?= $candidate['province'] ?> </td>
                                                <td class="cell100 column4"> <?= $candidate['email'] ?> </td>
                                                <td class="cell100 column5"><?= $candidate['phone'] ?> </td>
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

<div class="row mt-2 mb-3 border">
    <div class="row">
        <h1 class="col-md-6 mt-3" style="margin-left: 40px;">Failed</h1>
        <input class="col-md-5 mt-3" type="text" id="result_id_input" onkeyup="result_search()" placeholder="Search for ID..">
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
                                        <th class="cell100 column4">Phone</th>
                                        <th class="cell100 column5"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table100-body js-pscroll" id="assigned_candidates">
                            <table id="result">
                                <tbody>
                                    <?php
                                    if (isset($declined_candidates)) {
                                        foreach ($declined_candidates as $candidate) { ?>
                                            <tr class="row100 body">
                                                <td class="cell100 column1"><?= $candidate['users'] ?> </td>
                                                <td class="cell100 column2"> <a style="text-decoration: none;" href="index.php?admin=candidate_card&amp;candidate=<?= $candidate['users'] ?>"><?= $candidate['lastname'] . ' ' . $candidate['firstname'] ?></a> </td>
                                                <td class="cell100 column3"> <?= $candidate['province'] ?> </td>
                                                <td class="cell100 column4"> <?= $candidate['phone'] ?> </td>
                                                <td class="cell100 column5"><a href="index.php?admin=insert_pretest&amp;email=<?= $candidate['email'] ?>&amp;result= <?= $candidate['verdict'] ?>"> <span class="fa fa-redo"></span> </a> </td>
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
<script type="text/javascript">
    $(function() {
        //Assign Click event to Button.
        $("#notify-btn").hover(function() {
            var ids = "";
            //Loop through all checked CheckBoxes in GridView.
            $("#assigned_candidates input[type=checkbox]:checked").each(function() {
                var row = $(this).closest("tr")[0];
                ids += row.cells[0].innerHTML;
                ids += ",";
            });
            document.getElementById("unotified_candidates").value = ids;
        });
        //Assign Click event to Button.
        $("#assign-btn").hover(function() {
            var ids = "";
            //Loop through all checked CheckBoxes in GridView.
            $("#pending_candidates input[type=checkbox]:checked").each(function() {
                var row = $(this).closest("tr")[0];
                ids += row.cells[0].innerHTML;
                ids += ",";
            });
            document.getElementById("selected_candidates").value = ids;
        });
    });
</script>
<script src="Assets/JavaScripts/table.js"></script>

<script>
    function pending_search() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("pending_id_input");
        filter = input.value.toUpperCase();
        table = document.getElementById("pending");
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
<script>
    function assigned_search() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("assigned_id_input");
        filter = input.value.toUpperCase();
        table = document.getElementById("assigned");
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