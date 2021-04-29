<?php $title = "Test scheduling"; ?>

<?php ob_start(); ?>

<?php $link = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container-fluid mt-4 border">
    <div class="row">
        <div class="row text-center mt-4">
            <h1>Today's event(s)</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date time </th>
                            <th scope="col">Place</th>
                            <th scope="col">Province</th>
                            <th scope="col">Type</th>
                            <th scope="col">Method</th>
                            <th scope="col">Contact</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($current_event)) { ?>
                        <tbody>
                            <?php
                            foreach ($current_event as $event) { ?>
                                <tr onclick="window.location='index.php?candidate=event_card&amp;event=<?= $event['id'] ?>';">
                                    <th scope="row"><?= $event['id'] ?></th>
                                    <td><?= $event['dates'] . ' / ' . $event['schedule'] ?></td>
                                    <td><?= $event['province'] ?></td>
                                    <td><?= $event['place'] ?></td>
                                    <td><?= $event['events'] ?></td>
                                    <td><?= $event['method'] ?></td>
                                    <td><?= $event['responsible'] . ' / ' . $event['contact'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row text-center mt-4">
            <h1>Coming events</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date time </th>
                            <th scope="col">Place</th>
                            <th scope="col">Province</th>
                            <th scope="col">Type</th>
                            <th scope="col">Method</th>
                            <th scope="col">Contact</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($coming_events)) { ?>
                        <tbody>
                            <?php
                            foreach ($coming_events as $event) { ?>
                                <tr onclick="window.location='index.php?candidate=event_card&amp;event=<?= $event['id'] ?>';">
                                    <th scope="row"><?= $event['id'] ?></th>
                                    <td><?= $event['dates'] . ' / ' . $event['schedule'] ?></td>
                                    <td><?= $event['province'] ?></td>
                                    <td><?= $event['place'] ?></td>
                                    <td><?= $event['events'] ?></td>
                                    <td><?= $event['method'] ?></td>
                                    <td><?= $event['responsible'] . ' / ' . $event['contact'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row text-center mt-4">
            <h1>5 Last events</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date time </th>
                            <th scope="col">Place</th>
                            <th scope="col">Province</th>
                            <th scope="col">Type</th>
                            <th scope="col">Method</th>
                            <th scope="col">Contact</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($last_events)) { ?>
                        <tbody>
                            <?php
                            foreach ($last_events as $event) { ?>
                                <tr onclick="window.location='index.php?candidate=event_card&amp;event=<?= $event['id'] ?>';">
                                    <th scope="row"><?= $event['id'] ?></th>
                                    <td><?= $event['dates'] . ' / ' . $event['schedule'] ?></td>
                                    <td><?= $event['province'] ?></td>
                                    <td><?= $event['place'] ?></td>
                                    <td><?= $event['events'] ?></td>
                                    <td><?= $event['method'] ?></td>
                                    <td><?= $event['responsible'] . ' / ' . $event['contact'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>


<?php ob_start(); ?>

<?php $script = ob_get_clean(); ?>

<?php require('template.php'); ?>