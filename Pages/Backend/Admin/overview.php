<?php $title = "Overview"; ?>

<?php ob_start(); ?>

<!-- Events -->
<div class="row mt-2">
    <h1 class="col-md-12 mt-4">Events</h1>
    <div class="container-fluid">
        <div class="row justify-content-evenly mt-3">
            <div class="col-md-4 position-relative gx-5 overview " id="incoming">
                <div class=" col-md-12 mt-3 mb-3">
                    <a href="" class="stretched-link" style=" font-size: 40px;"> Incoming events</a>
                </div>
            </div>
            <div class="col-md-4 position-relative gx-5 overview " id="lastest">
                <div class=" col-md-12 mt-3 mb-3">
                    <a href="" class="stretched-link" style=" font-size: 40px;"> 5 lastest events </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Transactions -->
<div class="row mt-3">
    <h1 class="col-md-12 mt-4">Transactions</h1>
    <div class="container-fluid">
        <div class="row justify-content-evenly mt-3">
            <div class="col-11 overview" id="pending">
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
            <div class="col-11 overview" id="total">
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