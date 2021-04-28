<?php $title = "Overview"; ?>

<?php ob_start(); ?>
<link rel="stylesheet" href="Assets/Styles/overview.css">
<?php $links = ob_get_clean(); ?>

<?php ob_start(); ?>

<!-- Events -->
<div class="row mt-2">
    <h1 class="col-md-12 mt-4">Events</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt mt-2 position-relative gx-5 overview " id="todays-events">
                <div class=" col-md-12 mt-3 mb-3">
                    <div class="row" style=" font-size: 40px;">
                        <a href="index.php?admin=current_event" class="stretched-link col-11"> <span class="fa fa-calendar-alt"></span> Incoming events</a>
                        <a href="" class="col-1">
                            <?php
                            echo $curr_event == null ? '0' : $curr_event;
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-evenly mt-3">
            <div class="col-md-4 mt mt-2 position-relative gx-5 overview " id="incoming">
                <div class=" col-md-12 mt-3 mb-3">
                    <a href="index.php?admin=organize_test" class="stretched-link" style=" font-size: 40px;"> Incoming events</a>
                </div>
            </div>
            <div class="col-md-4 mt-2 position-relative gx-5 overview " id="lastest">
                <div class=" col-md-12 mt-3 mb-3">
                    <a href="index.php?admin=all_events" class="stretched-link" style=" font-size: 40px;"> 5 lastest events </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Transactions -->
<div class="row mt-3 mb-3">
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
                        <h1>Pending pretest</h1>
                        <p class="text-center" style="font-size: 75px;">1564</p>
                    </div>
                    <div class="col-md-4 mt-3 border-start border-bottom">
                        <h1>Pending final test</h1>
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
                        <p class="text-center" style="font-size: 75px;"> <?php
                                                                            if (isset($total_candidates)) {
                                                                                echo $total_candidates['COUNT(*)'];
                                                                            } else {
                                                                                echo ('0');
                                                                            }
                                                                            ?></p>
                    </div>
                    <div class="col-md-6 mt-3 border-start border-bottom">
                        <h1>Received</h1>
                        <p class="text-center" style="font-size: 75px;"><?php
                                                                        if (isset($total_received)) {
                                                                            echo $total_received['COUNT(*)'];
                                                                        } else {
                                                                            echo ('0');
                                                                        }
                                                                        ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>