<?php $title = "Overview"; ?>

<?php ob_start(); ?>
<div class="row mt-2">
    <h1 class="col-md-12">Transaction</h1>
    <div class="container-fluid">
        <div class="row" id="pending">
            <div class=" col-md-4 mt-3">
                <h1>New</h1>
            </div>
            <div class="col-md-4 mt-3">
                <h1>Pending</h1>
            </div>
            <div class="col-md-4 mt-3">
                <h1>Pending</h1>
            </div>
        </div>
    </div>

</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>