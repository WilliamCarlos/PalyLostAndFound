<?php
session_start();
include "utils.php";
if(count($_POST)>0) {
    $conn = mySqlConn();

    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];
    $errorMsg = "Unknown user";

    $result = mysqli_query($conn, "SELECT * FROM loginInfo WHERE name='$userName'");
    $row = mysqli_fetch_array($result, 1);
    if(is_array($row)) {
        if ($row['emailverified'] == 0) {
            $errorMsg = "Email address not verified";
        } elseif (hash_equals($row['passwd'], crypt($passWord, $row['passwd']))) {
            $_SESSION["user"] = $userName;
            $_SESSION["firstName"] = $row['firstname'];
            header("Location: http:/lost/index.php");
            return;
        } else {
           $errorMsg = "Password incorrect";
        }
    } 

    header("Location: http:/lost/login.php?errMsg=" . $errorMsg);
}
?>