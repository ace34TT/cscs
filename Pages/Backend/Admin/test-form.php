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
                    <div class="row text-center">
                        <h2 style="font-family: 'Oswald', sans-serif;"> Deliberation</h2>
                    </div>
                    <div class="row">
                        <form method="POST" action="index.php?admin=upload_result&amp;event=<?= $event ?>&amp;candidate=<?= $candidate['users'] ?>">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><B>Assigned post</B> :</label>
                                <select class="form-select" name="post" aria-label="Default select example">
                                    <option selected value=" <?= $candidate['post'] ?>"> <?= $candidate['post'] ?> </option>
                                    <?php
                                    foreach ($all_post as $post) {
                                    ?>
                                        <option value="<?= $post['name'] ?> "> <?= $post['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><B>Comment</B> :</label>
                                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3" hidden>
                                <label for="result" class="form-label"><B>Result</B> :</label>
                                <input type="text" id="result" value="" name="result">
                            </div>
                            <div class="row ">
                                <div class="mb-3 col-md-6 ">
                                    <button type="submit" id="success" class="offset-4 btn btn-success">Success</button>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <button type="submit" id="fail" class="offset-2 btn btn-danger">Fail</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 border shadow-sm">
                <embed src="Assets/Resumes/<?= $candidate['email'] ?>.pdf" type="application/pdf" width="100%" height="665px" />
            </div>

        </div>
        <div class="row text-center">
            <h1 class="mt-4 mb-4 " style="font-family: 'Arvo', serif;font-family: 'Oswald', sans-serif;">Comments</h1>
        </div>
        <div class="container">
            <div class="row ">
                <?php
                if (isset($comments)) {
                    foreach ($comments as $comment) {
                ?>
                        <div class="card">
                            <div class="card-header">
                                <?= $comment['author'] ?>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p><?= $comment['content'] ?> </p>
                                    <footer class="blockquote-footer"> <?= $comment['created_date'] ?> / event : <cite title="Source Title"> <a href="" style="text-decoration: none;"><?= $comment['events'] ?></a></cite></footer>
                                </blockquote>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        var succes = document.getElementById('success');
        var fail = document.getElementById('fail');
        var result = document.getElementById('result');
        succes.addEventListener('click', function() {
            result.value = 'success'
        });
        fail.addEventListener('click', function() {
            result.value = 'fail'
        });
    </script>
</body>

</html>