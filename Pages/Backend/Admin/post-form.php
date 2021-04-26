<?php $title = "Event form"; ?>

<?php ob_start(); ?>

<!-- Events -->
<div class="row mt-2 mb-3">
    <h1 class="col-md-4 offset-4 mt-4">Post form</h1>
    <!-- ======= Services Section ======= -->
    <section id="Apply" class="Apply">
        <div class="container">
            <?php
            if (isset($checker)) { ?>
                <p class="mt-2" style="color: rgb(255, 208, 0);font-size : 20px;">
                    <span class="fa fa-check"></span>
                    Post uploaded successfully
                </p>
            <?php
            }
            ?>
            <div class="row">
                <form class="row g-3 needs-validation" enctype="multipart/form-data" method="POST" action="index.php?admin=post_upload" autocomplete="on">
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required id="validationCustom01">
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom02" class="form-label">Category</label>
                        <select class="form-select" name="category" aria-label="Default select example" id="validationCustom02">
                            <option selected>Select</option>
                            <option value="culinary">Culinary</option>
                            <option value="housekeeping">Housekeeping</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom03" class="form-label">Quota</label>
                        <input type="number" step="5" name="quota" class="form-control" required id="validationCustom03">
                    </div>
                    <br>
                    <div class="col-12 d-flex flex-column-reverse bd-highlight ">
                        <button type="submit" class="btn btn-outline-warning">Create post</button>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- End Services Section -->
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>