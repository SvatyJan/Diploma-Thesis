<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

if ($_SESSION["rank"] == 2) {
    $file = $_FILES['file'];
//print_r($file);

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $fileName = $fileExt[0];

    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            //50mb
            if ($fileSize <= 5000000) {
                //$fileNameNew = uniqid('', true);
                //databáze je nějaká buglá :/
                //$doesImgNameExist = Select("SELECT * FROM image WHERE source = ? LIMIT 1",$fileName,$conn);
                $doesImgNameExist = mysqli_query($conn, "SELECT * FROM image WHERE source = '$fileName'");
                if (mysqli_num_rows($doesImgNameExist) > 0) {
                    //echo $imagesrc;
                    echo "Name of this file already exists";
                    //echo "<br>".print_r($doesImgNameExist);
                } else {
                    $fileNameNew = $fileName . "." . $fileActualExt;
                    echo $fileNameNew;
                    //teď uploadnu file
                    $fileDestination = '../' . 'icons/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo "success";
                    //ještě přidej do databáze
                    $addImageToDatabase = mysqli_query($conn, "INSERT INTO image (source, alt) VALUES ('$fileNameNew','$fileNameNew')");
                    Header("Location:../index.php?pages=admin&adminpage=admingeneral");
                }
            } else {
                echo "File is too big.";
            }
        } else {
            echo "There is an error with uploading your file.";
        }
    } else {
        echo "This file type cannot be uploaded.";
    }
} else {
    Header("Location:../index.php?pages=main");
}
?>
