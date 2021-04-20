<?php $title = "Event form"; ?>

<?php ob_start(); ?>

<!-- Events -->
<div class="row mt-2 mb-3">
    <h1 class="col-md-4 offset-4 mt-4"> Event form</h1>
    <!-- ======= Services Section ======= -->
    <section id="Apply" class="Apply">
        <div class="container">
            <?php
            if (isset($checker)) { ?>
                <p class="mt-2" style="color: rgb(255, 208, 0);font-size : 20px;">
                    <span class="fa fa-check"></span>
                    Event upload successfully
                </p>
            <?php
            }
            ?>

            <div class="row">
                <form class="row g-3 needs-validation" enctype="multipart/form-data" method="POST" action="index.php?admin=event_upload" autocomplete="on">
                    <!-- Author/Responsable -->
                    <div class="col-md-4">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" name="author" readonly class="form-control" value="  <?= $_SESSION['admin'][0]['names'] ?>" id="author">
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Respensible</label>
                        <input type="text" name="responsible" class="form-control" value="  <?= $_SESSION['admin'][0]['names'] ?>" id="validationCustom01">
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Contact</label>
                        <input type="text" name="contact" class="form-control" id="validationCustom01">
                    </div>

                    <!-- Event Inf -->
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required id="validationCustom02">
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">Event</label>
                        <select class="form-select" name="event" aria-label="Default select example" id="validationCustom03">
                            <option selected>Select</option>
                            <option value="Meeting">Meeting</option>
                            <option value="pretest">Pretest</option>
                            <option value="final_test">Final test</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Procince</label>
                        <select class="form-select" name="province" aria-label="Default select example" id="validationCustom04">
                            <option selected>Select your province</option>
                            <option value="Antananarivo">Antananarivo</option>
                            <option value="Antsiranana">Antsiranana</option>
                            <option value="Fianarantsoa">Fianarantsoa</option>
                            <option value="Mahajanga">Mahajanga</option>
                            <option value="Toamasina">Toamasina</option>
                            <option value="Toliara">Toliara</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom05" class="form-label">Place</label>
                        <input type="text" name="place" class="form-control" required id="validationCustom05">
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustom06" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required id="validationCustom06">
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom06" class="form-label">Time</label>
                        <input type="time" name="schedule" class="form-control" required id="validationCustom06">
                    </div>

                    <div class="col-12">
                        <label for="inputPassword6" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="inputPassword6" rows="3"></textarea>
                    </div>

                    <br>
                    <div class="col-12 d-flex flex-column-reverse bd-highlight ">
                        <button type="submit" class="btn btn-outline-warning">Warning</button>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- End Services Section -->
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>