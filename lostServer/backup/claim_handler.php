<?php
session_start();
include "utils.php";

if(!isset($_SESSION['user'])) {
    echoHeadings();
    echo "<h2><center>Please <a href='login.php'>login</a> to claim an item</center></h2>";
    return;
}

if (isset($_POST['itemId'])) {
    $itemId = $_POST['itemId'];
    $user = $_SESSION['user'];

    $conn = mySqlConn();
    $qry = "SELECT * FROM items WHERE id=$itemId";
    $result = mysqli_query($conn, $qry);
    if ($result != TRUE) {
       mysqli_error($conn);
       return;
    }
    $row = mysqli_fetch_array($result);
    if(!is_array($row)) {
        echo("Error: item not found"); 
        return;
    }

    $imgName = $row['lastname'];
    $articleType = $row['articleType'];
    $articleColor = $row['articleColor'];
    $additionalDetails = $row['additionalDetails'];
    $submitter = $row['firstname'];
    $dateCreated = $row['dateCreated'];

    // insert an entry to founditems
    $qry = "INSERT INTO founditems (name,imgName,articleType,articleColor,additionalDetails,submitter,dateCreated) ";
    $qry .= "VALUES('$user', '$imgName', '$articleType', '$articleColor', '$additionalDetails', '$submitter', '$dateCreated')";

    $result = mysqli_query($conn, $qry);
    if ($result != TRUE) {
       echo "insert failure " . mysqli_error($conn);
       return;
    }

    // delete from items table
    $qry = "DELETE FROM items WHERE id=$itemId";
    $result = mysqli_query($conn, $qry);
    if ($result != TRUE) {
        echo "delete failure " . mysqli_error($conn);
        header("Location: http:/lost/index.php");
    } else {
        header("Location: http:/lost/claimedSuccess.php");
    }
    $conn->close();
}