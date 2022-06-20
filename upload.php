<?php

if(isset($_POST['submit'])) {
    $file = $_FILES["file"];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed)) {
        if($fileError === 0) {
            if ($fileSize < 1000000){
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("location: index.php?uploadsuccess");
            } else {
                echo "You file is too big.";
            }
        } else {
            echo "There was some error try again later.";
        }
    } else {
        echo "You cannot upload ['". $fileActualExt ."'] files";
    }
}