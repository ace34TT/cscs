<?php $title = "Overview"; ?>

<?php ob_start(); ?>

<!-- Events -->
<div class="row mt-2">
    <h1 class="col-md-4 offset-4 mt-4"> Event form</h1>
    <!-- ======= Services Section ======= -->
    <section id="Apply" class="Apply">
        <div class="container">
            <div class="row">
                <form class="row g-3 needs-validation" enctype="multipart/form-data" method="POST" action="index.php?apply" autocomplete="on">
                    <div class="col-md-6">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" name="author" readonly class="form-control" value="  <?= $_SESSION['admin'][0]['names'] ?>" id="author">
                    </div>
                    <!-- Firstname / Lastname -->
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Firstname</label>
                        <input type="text" name="firstname" class="form-control" required id="validationCustom01">
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Lastname</label>
                        <input type="text" name="lastname" class="form-control" required id="validationCustom02">
                    </div>

                    <!-- Gender / Date of birth -->
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Gender</label>
                        <select class="form-select" name="gender" aria-label="Default select example" id="validationCustom03">
                            <option selected>Select your gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Date of birth</label>
                        <input type="date" name="date_of_birth" class="form-control" required id="validationCustom04">
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Procince</label>
                        <select class="form-select" name="province" aria-label="Default select example" id="validationCustom05">
                            <option selected>Select your province</option>
                            <option value="Antananarivo">Antananarivo</option>
                            <option value="Antsiranana">Antsiranana</option>
                            <option value="Fianarantsoa">Fianarantsoa</option>
                            <option value="Mahajanga">Mahajanga</option>
                            <option value="Toamasina">Toamasina</option>
                            <option value="Toliara">Toliara</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="inputPassword6" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="inputPassword6" placeholder="1234 Main St">
                    </div>

                    <!-- Contacts -->
                    <div class="col-md-6">
                        <label for="inputPassword7" class="form-label">Phone</label>
                        <input type="input" name="phone" max="13" min="10" class="form-control" required id="inputPassword7">
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom08" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required id="validationCustom08">
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">Post</label>
                        <select class="form-select" name="post" aria-label="Default select example" id="validationCustom05">
                            <option selected>Apply as </option>
                            <option value="Housekeeper">Housekeeper</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">Resume</label>
                        <div id="file-js-example" class="file has-name">
                            <label class="file-label">
                                <input class="file-input" type="file" name="resume">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Choose a file…
                                    </span>
                                </span>
                                <span class="file-name">
                                    No file uploaded
                                </span>
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="col-12 d-flex flex-column-reverse bd-highlight ">
                        <button type="submit" id="btn-apply" class="btn p-2 bd-highlight">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- End Services Section -->
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>