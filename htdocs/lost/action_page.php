<!DOCTYPE html>

<HTML>
<title> Output page </title>


<?php
$servername = "localhost";
$username = "William";
$password = "password";
$dbname = "namesTest";
$first_name = $_GET['firstname_input'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "INSERT INTO Names (firstname)
VALUES ('$first_name');";


if ($conn->multi_query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//$conn->close();
?>


</HTML>

<!--
<p>Hi 
echo htmlspecialchars($_GET['firstname']); 
echo " ";
echo htmlspecialchars($_GET['lastname']);?>
<br>

echo htmlspecialchars($_GET['color']);?> </p>
<br>
 echo "your password is: ";
echo htmlspecialchars($_GET['password']); ?>
<br>
-->
