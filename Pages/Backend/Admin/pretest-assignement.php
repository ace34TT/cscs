<?php $title = "Test scheduling"; ?>

<?php ob_start(); ?>
<link rel="stylesheet" type="text/css" href="Assets/Vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="Assets/Vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="Assets/Vendor/perfect-scrollbar/perfect-scrollbar.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="Assets/Styles/table.css">

<style>
    .activ-dot {
        height: 10px;
        width: 10px;
        background-color: #87f75b;
        border-radius: 50%;
        display: inline-block;
    }

    .inactive-dot {
        height: 10px;
        width: 10px;
        background-color: #f75b5b;
        border-radius: 50%;
        display: inline-block;
    }
</style>
<?php $links = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="row mt-2 border">
    <h1 class="col-md-12 mt-4" style="margin-left: 40px;">Event information</h1>
    <div class="container mb-5" style="font-size: 20px;">
        <div class="row mt-3">
            <div class="col-md-2 offset-md-1">
                <p> <B>ID</B> : <?= $event[0]['id'] ?></p>
            </div>
            <div class="col-md-5 ">
                <p> <B>Author</B> : <?= $event[0]['author'] ?></p>
            </div>
            <div class="col-md-2">
                <p> <B>Name</B> : <?= $event[0]['names'] ?></p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6 offset-md-1">
                <p> <B>Responsible</B> : <?= $event[0]['responsible'] ?></p>
            </div>
            <div class="col-md-3 offset-md-1 ">
                <p> <B>Contact</B> : <?= $event[0]['contact'] ?></p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-3 offset-md-1">
                <p> <B>Date</B> : <?= $event[0]['dates'] ?></p>
            </div>
            <div class="col-md-4">
                <p> <B>Schedule</B> : <?= $event[0]['schedule'] ?></p>
            </div>
            <div class="col-md-2">
                <p> <B>Place</B> : <?= $event[0]['place'] ?></p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 offset-md-1">
                <p> <B>Province</B> : <?= $event[0]['province'] ?></p>
            </div>
            <div class="col-md-3 offset-md-3">
                <p> <B>Event</B> : <?= $event[0]['events'] ?></p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-11 offset-md-1">
                <p> <B>Description</B> : <?= $event[0]['descriptions'] ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2 mb-3 border">
    <h1 class="col-md-12 mt-3" style="margin-left: 40px;">Assigned candidates</h1>
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
                                        <th class="cell100 column3">Email</th>
                                        <th class="cell100 column4">Province</th>
                                        <th class="cell100 column5">Post</th>
                                        <th class="cell100 column6">Notified</th>
                                        <th class="cell100 column6 ">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table100-body js-pscroll">
                            <table>
                                <tbody>
                                    <?php
                                    if (isset($assignet_curr_event)) {
                                        foreach ($assignet_curr_event as $candidate) { ?>
                                            <tr class="row100 body">
                                                <td class="cell100 column1"><?= $candidate['users'] ?> </td>
                                                <td class="cell100 column2"> <a style="text-decoration: none;" href="index.php?admin=candidate_card&amp;candidate=<?= $candidate['users'] ?>"><?= $candidate['lastname'] . ' ' . $candidate['firstname'] ?></a> </td>
                                                <td class="cell100 column3"><?= $candidate['email'] ?> </td>
                                                <td class="cell100 column4"> <?= $candidate['province'] ?> </td>
                                                <td class="cell100 column5"><?= $candidate['post'] ?> </td>
                                                <td class="cell100 column5 text-center"><span class="
                                    <?php
                                            echo $candidate['notified'] == true ? 'active-dote' : 'inactive-dot';
                                    ?> "></span>
                                                </td>
                                                <td class="cell100 column5">
                                                    <svg class="bi" width="32" height="32" fill="currentColor">
                                                        <use xlink:href="bootstrap-icons.svg#heart-fill" />
                                                    </svg>
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


<div class="row mt-2 mb-3 border">
    <h1 class="col-md-12 mt-3" style="margin-left: 40px;">Assigned candidates</h1>
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
                                        <th class="cell100 column3">Email</th>
                                        <th class="cell100 column4">Province</th>
                                        <th class="cell100 column5">Post</th>
                                        <th class="cell100 column5-1">Select</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table100-body js-pscroll" id="table">
                            <table>
                                <tbody>
                                    <?php
                                    if (isset($pending_cnadidates)) {
                                        foreach ($pending_cnadidates as $candidate) { ?>
                                            <tr class="row100 body">
                                                <td class="cell100 column1"><?= $candidate['users'] ?> </td>
                                                <td class="cell100 column2"> <a style="text-decoration: none;" href="index.php?admin=candidate_card&amp;candidate=<?= $candidate['users'] ?>"><?= $candidate['lastname'] . ' ' . $candidate['firstname'] ?></a> </td>
                                                <td class="cell100 column3"><?= $candidate['email'] ?> </td>
                                                <td class="cell100 column4"> <?= $candidate['province'] ?> </td>
                                                <td class="cell100 column5"><?= $candidate['post'] ?> </td>
                                                <td class="cell100 column5-1"> <input style="margin-left:25px;" type="checkbox" name="" id=""> </td>
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
        <form <?php
                if (!isset($pending_cnadidates)) {
                    echo 'id=0';
                }
                ?> action="index.php?admin=pretest_assignement_validation&amp;event=<?= $_GET['event'] ?>" method="POST">
            <input type="text" hidden name="selected_candidates" value="" id="selected_candidates">
            <input type="submit" id="assign-btn" value="Assign selected candidates" style="height: 50px;" class="col-md-4 offset-7 mt-3 mb-3 btn">
        </form>
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
        $("#assign-btn").hover(function() {
            var ids = "";
            //Loop through all checked CheckBoxes in GridView.
            $("#table input[type=checkbox]:checked").each(function() {
                var row = $(this).closest("tr")[0];
                ids += row.cells[0].innerHTML;
                ids += ",";
            });
            document.getElementById("selected_candidates").value = ids;
        });
    });
</script>

<script src="Assets/JavaScripts/table.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require('template.php'); ?>