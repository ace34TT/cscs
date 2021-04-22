<?php $title = "Test scheduling"; ?>

<?php ob_start(); ?>
<link rel="stylesheet" type="text/css" href="Assets/Vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="Assets/Vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="Assets/Vendor/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" href="Assets/Styles/table.css">
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
            <div class="col-md-3 offset-md-2">
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

<div class="row mt-2 border">
    <h1 class="col-md-12 mt-4" style="margin-left: 40px;">Assigned candidates</h1>
    <div class="container shadow-sm mt-3" style="font-size: 20px;">
        <div class="table100 ver1 m-b-110">
            <div class="table100-head">
                <table>
                    <thead>
                        <tr class="row100 head">
                            <th class="cell100 column1">ID</th>
                            <th class="cell100 column2">Name</th>
                            <th class="cell100 column3">Email</th>
                            <th class="cell100 column4">Province</th>
                            <th class="cell100 column5">Post</th>
                            <th class="cell100 column6">Select</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="table100-body js-pscroll">
                <table>
                    <tbody>
                        <?php
                        foreach ($pending_cnadidates as $candidate) { ?>
                            <tr class="row100 body">
                                <td class="cell100 column1"><?= $candidate['id'] ?> </td>
                                <td class="cell100 column2"><?= $candidate['lastname'] . ' ' . $candidate['firstname'] ?></td>
                                <td class="cell100 column3"><?= $candidate['email'] ?> </td>
                                <td class="cell100 column4"> <?= $candidate['province'] ?> </td>
                                <td class="cell100 column5"><?= $candidate['post'] ?> </td>
                                <td class="cell100 column6"> <input type="checkbox" name="" id=""> </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2 border">
    <h1 class="col-md-12 mt-4" style="margin-left: 40px;">Pending candidates</h1>
    <div class="container shadow-sm mt-3" style="font-size: 20px;">
        <div class="table100 ver1 m-b-110">
            <div class="table100-head">
                <table>
                    <thead>
                        <tr class="row100 head">
                            <th class="cell100 column1">ID</th>
                            <th class="cell100 column2">Name</th>
                            <th class="cell100 column3">Email</th>
                            <th class="cell100 column4">Province</th>
                            <th class="cell100 column5">Post</th>
                            <th class="cell100 column6">Select</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="table100-body js-pscroll">
                <table>
                    <tbody>
                        <?php
                        foreach ($pending_cnadidates as $candidate) { ?>
                            <tr class="row100 body">
                                <td class="cell100 column1"><?= $candidate['id'] ?> </td>
                                <td class="cell100 column2"><?= $candidate['lastname'] . ' ' . $candidate['firstname'] ?></td>
                                <td class="cell100 column3"><?= $candidate['email'] ?> </td>
                                <td class="cell100 column4"> <?= $candidate['province'] ?> </td>
                                <td class="cell100 column5"><?= $candidate['post'] ?> </td>
                                <td class="cell100 column6"> <input type="checkbox" name="" id=""> </td>
                            </tr>
                        <?php
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
<script src="js/main.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require('template.php'); ?>