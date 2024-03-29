<?php
session_start();

if (isset($_POST["nom"])) {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $langages = $_POST["langages"];
    $file = $_FILES["image"];
    //Getting the file name of the uploaded file
    $fileName = $_FILES['image']['name'];
    //Getting the Temporary file name of the uploaded file
    $fileTempName = $_FILES['image']['tmp_name'];
    //Getting the file size of the uploaded file
    $fileSize = $_FILES['image']['size'];
    //getting the no. of error in uploading the file
    $fileError = $_FILES['image']['error'];
    //Getting the file type of the uploaded file
    $fileType = $_FILES['image']['type'];

    //Getting the file ext
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //Array of Allowed file type
    $allowedExt = array("jpg", "jpeg", "png");

    //Checking, Is file extentation is in allowed extentation array
    if (in_array($fileActualExt, $allowedExt)) {
        //Checking, Is there any file error
        if ($fileError == 0) {
            //Checking,The file size is bellow than the allowed file size
            if ($fileSize < 10000000) {
                //Creating a unique name for file
                $fileNemeNew = uniqid('', true) . "." . $fileActualExt;
                //File destination
                $fileDestination = 'assets/images/' . $fileNemeNew;
                //function to move temp location to permanent location
                move_uploaded_file($fileTempName, $fileDestination);
                //Message after success
                echo "File Uploaded successfully";
                $_SESSION['_image'] = $fileDestination;
            } else {
                //Message,If file size greater than allowed size
                echo "File Size Limit beyond acceptance";
            }
        } else {
            //Message, If there is some error
            echo "Something Went Wrong Please try again!";
        }
    } else {
        //Message,If this is not a valid file type
        echo "You can't upload this extention of file";
    }

    $_SESSION['_nom'] = $nom;
    $_SESSION['_prenom'] = $prenom;
    $_SESSION['_langages'] = $langages;
    header("Location:profile.php");
} else {
    header("Location:form.php");
}
