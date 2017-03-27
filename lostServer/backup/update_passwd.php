<?php
session_start();
include "utils.php";

if (!isset($_POST['userId']) || !isset($_POST['passWord'])) {
   echo "userId, passwd not set";
   return;
}
$userId = $_POST['userId'];
$passWord = crypt($_POST['passWord']);

// set the emailverified flag in loginInfo 
$conn = mySqlConn();
$qry = "UPDATE loginInfo SET passwd='$passWord' WHERE name='$userId'";
$result = mysqli_query($conn, $qry);
if ($result != TRUE) {
   echo "Password update Err: " . mysqli_error($conn);
   return;
}

header("Location: http:/lost/updatePasswdSuccess.php");
?>