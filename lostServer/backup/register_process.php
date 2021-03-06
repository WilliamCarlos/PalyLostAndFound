<?php
session_start();
include_once "utils.php";
$errMsg = NULL;
if(count($_POST)>0) {
    if (!isset($_POST['userName']) ||
        !isset($_POST['passWord']) ||
        !isset($_POST['firstName']) ||
        !isset($_POST['lastName'])) {
        $errMsg = "All fields are required";
        header("Location: http:/lost/register.php?errMsg=" . $errMsg);
        return;
    }                    
    $userId = $_POST['userName'];
    $passWord = $_POST['passWord'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    if($userId == "") {
        $errMsg = "User name cannot be empty";
        header("Location: http:/lost/register.php?errMsg=" . $errMsg);
        return;
    }
    if(preg_match('/\s/',$userId)) {
        $errMsg = "User name cannot contain white spaces";
        header("Location: http:/lost/register.php?errMsg=" . $errMsg);
        return;
    }
    if (!filter_var($userId, FILTER_VALIDATE_EMAIL) || ($userId == "email@paly.net")) {
        $errMsg = "Invalid email address";
        header("Location: http:/lost/register.php?errMsg=" . $errMsg);
        return;
    }   
    $pos = strpos($userId, "@");
    if ($pos === false) {
        $errMsg = "Invalid email address";
        header("Location: http:/lost/register.php?errMsg=" . $errMsg);
        return;
    }
    if($passWord == "") {
        $errMsg = "Invalid password";
        header("Location: http:/lost/register.php?errMsg=" . $errMsg);
        return;
    }
    if(!preg_match('/^[a-zA-Z]+$/', $firstName)) {
        $errMsg = "Invalid first name";
        header("Location: http:/lost/register.php?errMsg=" . $errMsg);
        return;
    }
    if(!preg_match('/^[a-zA-Z]+$/', $lastName)) {
        $errMsg = "Invalid last name";
        header("Location: http:/lost/register.php?errMsg=" . $errMsg);
        return;
    }

    $conn = mySqlConn();
    $result = mysqli_query($conn, "SELECT * FROM loginInfo WHERE name='$userId'");
    if ($result != TRUE) {
       echo "Err:" . mysqli_error($conn);
       return;
    }
    $row = mysqli_fetch_array($result, 1);
    if(is_array($row)) {
        if (!hash_equals($row['passwd'], crypt($passWord, $row['passwd']))) {
            $errMsg = "User name exists already. Please select another user name";
            header("Location: http:/lost/register.php?errMsg=" . $errMsg);
            return;
        }
    } else {
        // store the md5 hash of password
        $cryptoPasswd = crypt($passWord);
        $qry = "INSERT INTO loginInfo (name,passwd,firstname,lastname,emailverified) VALUES('$userId', '$cryptoPasswd', '$firstName', '$lastName', 0)";
        $result = mysqli_query($conn, $qry);
        if ($result != TRUE) {
            echo "Err:" . mysqli_error($conn);
            return;
        }
    }

    $rnd = genRandomString();
    $qry = "INSERT INTO userRegistration (name,rnd) VALUES('$userId', '$rnd')";
    $result = mysqli_query($conn, $qry);
    if ($result != TRUE) {
        echo "Err:" . mysqli_error($conn);
        return;
    }
        
    $verifyUrl = "http:/email_verify.php?random=" . $rnd;
    sendWelcomeEmail($userId, $firstName, $verifyUrl);

    header("Location: http:/lost/registerSuccess.php");
}
?>