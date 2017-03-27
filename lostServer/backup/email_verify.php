<?php
session_start();
include "utils.php";

if (!isset($_GET['random'])) {
   return;
}
$random = $_GET['random'];

$conn = mySqlConn();

// check user and its random number to match what we generated
$qry = "SELECT * FROM userRegistration WHERE rnd='$random'";
$result = mysqli_query($conn, $qry);
if ($result != TRUE) {
   echo "Err: " . mysqli_error($conn);
   return;
}
$row = mysqli_fetch_array($result);
if(!is_array($row)) {
    header("Location: http:/lost/emailVerifFailed.php");
    return;                    
}
$applicant = $row['name'];

// set the emailverified flag in loginInfo 
$qry = "UPDATE loginInfo SET emailverified=1 WHERE name='$applicant'";
$result = mysqli_query($conn, $qry);
if ($result != TRUE) {
   echo "Err: " . mysqli_error($conn);
   return;
}

// delete the user to random num entry
$qry = "DELETE from userRegistration WHERE name='$applicant'";
$result = mysqli_query($conn, $qry);

header("Location: http:/lost/login.php?login=".$applicant);
?>
