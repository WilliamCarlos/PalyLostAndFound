<!DOCTYPE html>

<HTML>
<title> Output page </title>


<?php
$servername = "localhost";
$username = "William";
$password = "password";
$dbname = "item";
// first name, last name, article type, color, owner first name, owner last name, Additional details, password?, upload file, (date found)
$firstname_input = $_GET['firstname_input'];
$lastname_input = $_GET['lastname_input'];
$articleType = $_GET['articleType'];
$articleColor = $_GET['articleColor'];
$ownerFirstName = $_GET['ownerFirstName'];
$ownerLastName = $_GET['ownerLastName'];
$additionalDetails = $_GET['additionalDetails'];
$pwd = $_GET['pwd'];
//uploaded file variable

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//TRUNCATE TABLE names; will reset the names. 
$sql = "INSERT INTO items (firstname)
VALUES ('$firstname_input');";

//IF PASSWORD EQUALS _____
//MySQL databases columns -> var name
//ADD TIMESTAMP IN ORDER TO IMPLEMENT SORT FUNCTIONALITY
$sql = "INSERT INTO items (firstname, lastname, articleType, articleColor, ownerFirstName, ownerLastName, additionalDetails)   
        VALUES ('$firstname_input', '$lastname_input', '$articleType', '$articleColor', '$ownerFirstName', '$ownerLastName', '$additionalDetails');";
    	//include all information in additionalDetails col of sql databsase to make a regex search easier. 
        //VALUES ('$firstname_input');";
        //VALUES('".$firstname."','".$lastname."','".$email."')";


if ($conn->multi_query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//$conn->close();
?>


</HTML>


