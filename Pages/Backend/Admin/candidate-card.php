<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/Vendor/bootstrap/css/bootstrap.min.css">
    <link href="Assets/Images/Logo.png" rel="icon">
    <title>Prest-From- <?= $candidate['lastname'] . ' ' . $candidate['firstname']  ?> </title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    </style>
</head>

<body>
    <div class="container-fluid ml-1 mr-1 mt-4 mb-4 shadow-lg border">
        <div class="row text-center">
            <h1 class="mt-4 mb-4 " style="font-family: 'Arvo', serif;font-family: 'Oswald', sans-serif;">Pretest form</h1>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="container border" style="font-size: 25px;">
                    <div class="row text-center mt-2">
                        <h2 style="font-family: 'Oswald', sans-serif;"> Personnal informations</h2>
                    </div>
                    <div class="row">
                        <p> <B>ID :</B> <?= $candidate['users'] ?> </p>
                    </div>
                    <div class="row">
                        <p> <B>Fullname :</B> <?= $candidate['lastname'] . ' ' . $candidate['firstname']  ?></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p> <B>Gender :</B> <?= $candidate['gender'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p> <B>Age :</B> <?= date("Y") - explode('-', $candidate['date_of_birth'])[0] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <p> <B>Province :</B> <?= $candidate['province'] ?></p>
                    </div>
                    <div class="row">
                        <p> <B>Post :</B> <?= $candidate['post'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 border shadow-sm">
                <embed src="Assets/Resumes/<?= $candidate['email'] ?>.pdf" type="application/pdf" width="100%" height="665px" />
            </div>
        </div>
        <div class="mb-4">
        </div>
    </div>


</body>

</html>