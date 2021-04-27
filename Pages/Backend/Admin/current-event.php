<?php $title = "Current-event"; ?>

<?php ob_start(); ?>
<div class="row mt-2">
    <h1 class="col-md-12 mt-4">Current events</h1>

    <div class="container ">
        <div class="row mt-3">
            <div class="col-10">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Schedule</th>
                            <th scope="col">Province</th>
                            <th scope="col">Responsible</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($current_events)) {
                            foreach ($current_events as $event) {
                        ?>
                                <tr onclick="window.location='index.php?admin=<?php echo ($event['events'] == 'pretest' ? 'pretest_overview' : 'final_test_overview'); ?>&amp;event=<?= $event['id'] ?>';">
                                    <th scope="row"><?= $event['names'] ?></th>
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
                                    <td><?= $event['schedule'] ?> </td>
                                    <td><?= $event['province'] ?> </td>
                                    <td><?= $event['responsible'] ?> </td>
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
<script>

</script>
<?php $scripts = ob_get_clean(); ?>

<?php require('template.php'); ?>