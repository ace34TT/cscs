<?php $title = "Overview"; ?>

<?php ob_start(); ?>
<div class="row mt-2">
    <h1 class="col-md-12 mt-4">Transaction</h1>
    <div class="container-fluid">
        <div class="row justify-content-evenly">
            <div class="col-11" id="pending">
                <div class="row">
                    <div class=" col-md-4 mt-3 border-start border-bottom">
                        <h1>New</h1>
                        <p class="text-center" style="font-size: 75px;">1564</p>
                    </div>
                    <div class="col-md-4 mt-3 border-start border-bottom">
                        <h1>Pending</h1>
                        <p class="text-center" style="font-size: 75px;">1564</p>
                    </div>
                    <div class="col-md-4 mt-3 border-start border-bottom">
                        <h1>Pending</h1>
                        <p class="text-center" style="font-size: 75px;">1564</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-evenly mt-3">
            <div class="col-11" id="total">
                <div class="row">
                    <div class=" col-md-6 mt-3 border-start border-bottom">
                        <h1>Total</h1>
                        <p class="text-center" style="font-size: 75px;">1564</p>
                    </div>
                    <div class="col-md-6 mt-3 border-start border-bottom">
                        <h1>Received</h1>
                        <p class="text-center" style="font-size: 75px;">1564</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>