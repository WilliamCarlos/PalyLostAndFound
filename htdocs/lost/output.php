<!DOCTYPE html>

<HTML>
<header> <link rel="stylesheet" type="text/css" href="tableStyle.css"> </header>
<title> Output page </title>
<h1> First Names </h1>

<body>
<?php

//Swith to postgreSQL?
//ini_set('display_errors', 1);
$servername = "localhost";
$username = "William";
$password = "password";
$dbname = "namesTest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Assign contents of names into the $sql variable
$sql = "SELECT * FROM names";
$result = $conn->query($sql);

echo "<table id = 'displayTable'>
<tr>
<th>id</th>
<th>Volunteer's First Name</th>
<th>Volunteer's Last Name</th>
<th>Owner's First Name</th>
<th>Owner's Last Name</th>
<th>Article Type</th>
<th>Article Color</th>
<th>Additional Details</th>


</tr>";

while($row = mysqli_fetch_array($result))
{

	//articleType | articleColor | ownerFirstName | ownerLastName | additionalDetails 
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['firstname'] . "</td>";
echo "<td>" . $row['lastname'] . "</td>";
echo "<td>" . $row['ownerFirstName'] . "</td>";
echo "<td>" . $row['ownerLastName'] . "</td>";
echo "<td>" . $row['articleType'] . "</td>";
echo "<td>" . $row['articleColor'] . "</td>";
echo "<td>" . $row['additionalDetails'] . "</td>";
echo "</tr>";
}
echo "<table>";


$conn->close();
?>
</body>
</HTML>
