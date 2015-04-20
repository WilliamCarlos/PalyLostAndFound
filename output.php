<!DOCTYPE HTML> 
<html lang="en-US">
<header>
	<link rel="stylesheet" type="text/css" href="css/foundation.css">
	<nav class="top-bar" data-topbar role="navigation"style="top:15px">
		<ul class="title-area">
			<li class="name">
				<h1><a href="#">Palo Alto High School Lost and Found</a></h1>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a>
			</li>
		</ul>
		<section class="top-bar-section">
			<ul class="right">
				<li class="divider"></li>
				<li><a href="/lost/output.php">Current Items</a></li>
				<li class="divider"></li>
				<li><a href="/lost/database_test.html">Add an Item</a></li>
				<li class="divider"></li>
				<li><a href="#">Contact Us</a></li>
				<li class="divider"></li>
				<li><a href="#">Log In</a></li>
			</section></ul>
		</nav>
	</header>
</br> </br>
<style type="text/css">
	h1 {
		font-weight: normal;
		font-size: 30px;
		text-align: center;
	}
	body {
		max-width: 1000px;
		margin:auto auto;
		background-color: white;
	}
	table {
		width:100%
	} th {

	} td {
		padding:5px;
		/* border: 1px solid black; */
	}
		/*	input {
				width:100%;
				height: 24px;
				font-size: 18px;
				padding:2px;
				border:0;
			}*/
			table#displayTable tr:nth-child(even) {
				background-color: #eee;
			}

			table#displayTable tr:nth-child(odd) {
				background-color:#fff;

			}
			.top-bar-section li:not(.has-form) a:not(.button):hover {
				background: #777;
			}
		</style>
		<title> Paly Lost and Found: Current Items </title>
		<h1> Current Items at the Lost and Found </h1>
		<body>
			<form method="GET" action="output.php">
				<input type="search" placeholder="Search For an Item " id="search" name="search">
			</form>
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
	//assign contents in the search textfield to a keyword variable
			if(isset($_GET['search'])){$keyword = $_GET['search'];}

			/*$_GET['search']*/
			?>
			<table>
				<tr>
					<!--<th>id</th>-->
					<th>Volunteer's First Name</th>
					<th>Volunteer's Last Name</th>
					<th>Owner's First Name</th>
					<th>Owner's Last Name</th>
					<th>Article Type</th>
					<th>Article Color</th>
					<th>Additional Details</th>
					<th>Date found</th>
				</tr>
				<?php

				if(!isset($_GET['search'])) {
			//echo "keyword is empty";
					$sql = "SELECT * FROM items ORDER BY dateCreated DESC";
					$result = $conn->query($sql);
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
				//echo "<td>" . $row['id'] . "</td>";
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
				} else {
			//echo "keyword is not empty";
//IN(firstname, lastname, articleType, articleColor, ownerFirstName, ownerLastName, additionalDetails);
					$sql = "SELECT * FROM items WHERE ownerFirstName LIKE '%$keyword%' OR ownerLastName LIKE '%$keyword%' OR firstname LIKE '%$keyword%' OR lastname LIKE '%$keyword%' OR articleType LIKE '%$keyword%'  OR articleColor LIKE '%$keyword%'  OR additionalDetails LIKE '%$keyword%'";
					/* add filters to prevent SQL injection*/
			//echo "query step 1";
					$result = $conn->query($sql);
			//echo "query step 2";
					while($row = mysqli_fetch_array($result)) 
					{
				//echo "loop";
						echo "<tr>";
				//echo "<td>" . $row['id'] . "</td>";
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
			//echo "passed loop";
					echo "<table>";
				}
				$conn->close();
				?>


			</body>
		</HTML>

















