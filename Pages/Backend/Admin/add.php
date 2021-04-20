<?php $title = "Accueil"; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-md-12" style="background-color: yeellow;">
        <h1>hello</h1>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>