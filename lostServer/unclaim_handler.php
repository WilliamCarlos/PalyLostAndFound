<?php
session_start();
include "utils.php";

if(!isset($_SESSION['user'])) {
    echoHeadings();
    echo "<h4><center>Please <a href='login.php'>login</a> to undo claim</center></h4>";
    return;
}

if (isset($_POST['imgId'])) {
    $conn = mySqlConn();
    $imgId = $_POST['imgId'];

    // update items table
    $qry = "UPDATE items SET claimed=0 WHERE imageId='$imgId'";
    $result = mysqli_query($conn, $qry);
    if ($result != TRUE) {
       echo $qry;
        echo "update claimed failure " . mysqli_error($conn);
	header("Location: http://lostandfound.paly.net/lost/index.php");
	return;
    }

    // delete an entry to founditems
    $qry = "DELETE FROM founditems WHERE imgName='$imgId'";
    $result = mysqli_query($conn, $qry);
    if ($result != TRUE) {
           echo $qry;
       echo "delete failure " . mysqli_error($conn);
       return;
    } else {
        header("Location: http://lostandfound.paly.net/lost/unclaimedSuccess.php");
    }
    $conn->close();
}