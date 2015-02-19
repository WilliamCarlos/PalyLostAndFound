<!DOCTYPE html>

<HTML>
<header> <link rel="stylesheet" type="text/css" href="tableStyle.css"> </header>
<title> Output page </title>
<h1> First Names </h1>

<body>
<?php
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
<th>Firstname</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['firstname'] . "</td>";
echo "</tr>";
}
echo "<table>";

//echo '<table class="someClass">';
//.someClass{
//top: 15px;
//left: 10px;
//}


$conn->close();
?>
</body>
</HTML>
