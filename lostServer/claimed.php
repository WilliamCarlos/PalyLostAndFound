<?php
session_start();
include "utils.php";
echoHeadings();

if(!isset($_SESSION['user'])) {
   echoTopImg("ClaimedItems.jpg");
   echo "<h4><center>Please <a href='login.php'>login</a> to see your previously claimed items</center></h4>";
   return;
}
?>
<title> Paly Lost and Found Claimed Items </title>
<body>
<div><center>
  <?php echoTopImg("ClaimedItems.jpg"); ?>

  <!--zoom.js plugin-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="js/zoom.js"></script>
  <table align="center">
    <tr>
      <th width='100px' >Image</th>
      <th width='440px''>Article Description</th>
      <th width='240px'>Dates</th>
      <th width='80px'>Undo Claim</th>
    </tr>
<?php

    $conn = mySqlConn();
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    } 
    $user = $_SESSION['user'];

    // get page number to display
    $pageLength = 20;
    $page = getRequestedPageNum();
    $startFrom = ($page-1) * $pageLength;

    $dataQry = "SELECT * FROM founditems WHERE name='$user' ORDER BY dateCreated DESC LIMIT $startFrom, $pageLength";
    $dataResult = $conn->query($dataQry);
    while($row = mysqli_fetch_array($dataResult)) {
        echo "<tr>";
        echo "<td>" . "<img height='100' img width='100px' src='images/current/" . $row['imgName'] . "' data-action='zoom'> " . "</td>";
        echo "<td><b>type</b>: " . $row['articleType'];
        echo "<br><b>color</b>: " . $row['articleColor'];
        echo "<br><b>additional info</b>: " . $row['additionalDetails'];
	echo "<br><b>submitter</b>: " . $row['submitter'] . "</td>";
        echo "<td><b>found</b>: " . $row['dateCreated'];
	echo "<br><b>claimed</b>: " . $row['dateClaimed'] . "</td></td>";
	echo "<td><form action='unclaim_handler.php' method='post'> <input type='image' src='img/Unclaim.jpg' width='66px' alt='Submit Form'> <input type='hidden' name='imgId' value=" . $row['imgName'] . "></td></form>";
        echo "</tr>";
    }
    echo "</table>";

    // pagnation
    $dataQry = "SELECT * FROM founditems WHERE name='$user'";
    echoMorePages($conn, $dataQry, "claimed.php", $page, $pageLength);
?>

</body>
</HTML>
