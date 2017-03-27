<?php
session_start();
include "utils.php";

if (isset($_POST['submit'])) {
    $imageName = addslashes($_FILES['image']['tmp_name']);
    $name = addslashes($_FILES['image']['name']);
    $resizedImageName = getResizedImageName($name, $imageName);
    saveinfo($resizedImageName);
}

function getResizedImageName($name, $imageName)
{

    list($width, $height, $type, $attr) = getimagesize($imageName);
    if($width == 0) {
        echoHeadings();
        echo "<center>Please go back and upload an image.</center>";
        return;
    } 

    $newWidth = 300;
    return resizeImage($imageName, $newWidth);
}

function saveinfo($imageName)
{
    $conn = mySqlConn();
    // first name, last name, article type, color, owner first name, owner last name, Additional details, upload file, (date found)
    $userName = $_SESSION["user"];
    $articleType = $_POST['articleType'];
    $articleColor = $_POST['articleColor'];
    $ownerFirstName = $_POST['ownerFirstName'];
    $ownerLastName = $_POST['ownerLastName'];
    $additionalDetails = $_POST['additionalDetails'];

    // change lastname to imagename!!!
    $qry = "INSERT INTO items (firstname, lastname, articleType, articleColor, ownerFirstName, ownerLastName, additionalDetails)   
    VALUES ('$userName', '$imageName', '$articleType', '$articleColor', '$ownerFirstName', '$ownerLastName', '$additionalDetails');";

    if ($conn->query($qry) == TRUE) {
        header("Location: http:/lost/itemAdded.php");
    } else {
        header("Location: http:/lost/itemNotAdded.php");
    }
    $conn->close();
}
?>
