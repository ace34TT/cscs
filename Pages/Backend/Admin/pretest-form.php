<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/Vendor/bootstrap/css/bootstrap.min.css">
    <link href="Assets/Images/Logo.png" rel="icon">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4 mb-4 shadow-lg border">
        <div class="row text-center">
            <h1 class="mt-4 mb-4">Pretest form</h1>
        </div>
        <div class="row ">
            <div class="col-md-3">
            </div>
            <div class="col-md-8 border shadow-sm">
                <!-- <object width="400" height="500" type="application/pdf" data="Assets/Resumes/tafinasoa35@gmail.com.pdf">
                    <p>Insert your error message here, if the PDF cannot be displayed.</p>
                </object> -->
                <!-- <iframe src="Assets/Resumes/tafinasoa35@gmail.com.pdf" style="width:718px; height:700px;" frameborder="0"></iframe> -->
                <!-- <iframe frameborder="0" scrolling="no" width="640" height="480" src="Assets/Resumes/tafinasoa35@gmail.com.pdf">
                </iframe> -->
                <embed src="Assets/Resumes/<?= $candidate['email'] ?>.pdf" type="application/pdf" width="100%" height="665px" />
            </div>
        </div>
        <div class="mb-4">
        </div>
    </div>
</body>

</html>