<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <form class="w-50 border-1  border-secondary  border p-4 mx-auto mt-5" action="gestion.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom: </label>
                <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prenom: </label>
                <input type="text" class="form-control" id="prenom" name="prenom">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image: </label>
                <input class="form-control" type="file" id="formFile" accept="image/*" name="image">
            </div>


            <label for="" class="form-label">Langages: </label>
            
            <input class="form-check-input" type="checkbox" value="php" name="langages[]">
            <label class="form-check-label ps-2" for="flexCheckDefault">
                PHP
            </label>
            <input class="form-check-input" type="checkbox" value="javascript" name="langages[]">
            <label class="form-check-label ps-2" for="flexCheckDefault">
                JAVASCRIPT
            </label>
            <input class="form-check-input" type="checkbox" value="java" name="langages[]">
            <label class="form-check-label ps-2" for="flexCheckDefault">
                JAVA
            </label>
            <input class="form-check-input" type="checkbox" value="python" name="langages[]">
            <label class="form-check-label ps-2" for="flexCheckDefault">
                PYTHON
            </label>
            <input class="form-check-input" type="checkbox" value="c++" name="langages[]">
            <label class="form-check-label ps-2" for="flexCheckDefault">
                C++
            </label>


            <div class="mt-3"> <button type="submit" class="btn btn-primary">Submit</button></div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>