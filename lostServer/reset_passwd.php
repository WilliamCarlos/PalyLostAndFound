<?php
session_start();
include "utils.php";

if(!isset($_POST['userId'])) {
    header("Location: http://lostandfound.paly.net/lost/resetPasswd.php");
    return;    
}

$userId = $_POST['userId'];

$conn = mySqlConn();
$result = mysqli_query($conn, "SELECT * FROM loginInfo WHERE name='$userId'");
if ($result != TRUE) {
   header("Location: http://lostandfound.paly.net/lost/resetPasswd.php");
   return;
}
$row = mysqli_fetch_array($result, 1);
if(!is_array($row)) {
   header("Location: http://lostandfound.paly.net/lost/resetPasswd.php");
   return;
}

$rnd = genRandomString();
$qry = "INSERT INTO userRegistration (name,rnd) VALUES('$userId', '$rnd')";
$result = mysqli_query($conn, $qry);
if ($result != TRUE) {
    echo "Err:" . mysqli_error($conn);
    return;
}

$firstName = $row['firstname'];
$changePasswdUrl = "http://lostandfound.paly.net/lost/updatePasswd.php?random=" . $rnd;
sendPasswdEmail($userId, $firstName, $changePasswdUrl);

header("Location: http://lostandfound.paly.net/lost/resetPasswdSent.php");
?>