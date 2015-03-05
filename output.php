<!DOCTYPE html>

<HTML>
<header> 
<link rel="stylesheet" type="text/css" href="tableStyle.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css"/>
<nav id="main-menu" class="pure-menu pure-menu-open pure-menu-horizontal" text-align:"center">
   <a href="#" class="pure-menu-heading pure-menu-link">Palo Alto High School Lost and Found</a>
  <div class="pure-menu pure-menu-horizontal">
    <ul class="pure-menu-list">
        <li class="pure-menu-item pure-menu-selected"><a href="/lost/output.php" class="pure-menu-link">Current Items</a></li>
        <li class="pure-menu-item pure-menu-selected"><a href="/lost/database_test.html" class="pure-menu-link">Add an Item</a></li>
        <li class="pure-menu-item pure-menu-selected"><a href="#" class="pure-menu-link">Contact Us</a></li>
         <li class="pure-menu-item pure-menu-selected"><a href="#" class="pure-menu-link">Log In</a></li>
    </ul>
</div>
</nav>
</nav> </header>
<title> Paly Lost and Found: Current Items </title>
<h1> Current Items at the Lost and Found </h1>

<body>
<?php

//Swith to postgreSQL?
//ini_set('display_errors', 1);
$servername = "localhost";
$username = "William";
$password = "password";
$dbname = "item";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Assign contents of items into the $sql variable
$sql = "SELECT * FROM items ORDER BY dateCreated DESC";
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
<th>Date found</th>
</tr>";

//ADD TIMESTAMP FUNCTIONALITY TO SORT

while($row = mysqli_fetch_array($result))
{

echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['firstname'] . "</td>";
echo "<td>" . $row['lastname'] . "</td>";
echo "<td>" . $row['ownerFirstName'] . "</td>";
echo "<td>" . $row['ownerLastName'] . "</td>";
echo "<td>" . $row['articleType'] . "</td>";
echo "<td>" . $row['articleColor'] . "</td>";
echo "<td>" . $row['additionalDetails'] . "</td>";
echo "<td>" . $row['dateCreated'] . "</td>";
echo "</tr>";
}
echo "<table>";


$conn->close();
?>
</body>
</HTML>
