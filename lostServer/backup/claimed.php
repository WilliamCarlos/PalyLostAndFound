<?php
session_start();
include "utils.php";
echoHeadings();

if(!isset($_SESSION['user'])) {
   echoTopImg("ClaimedItems.jpg");
   echo "<h3><center>Please <a href='login.php'>login</a> to see your previously claimed items</center></h3>";
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
      <th>Image</th>
      <th>Article Type</th>
      <th>Article Color</th>
      <th>Additional Details</th>
      <th>Submitter</th>
      <th>Date Found</th>
      <th>Date Claimed</th>
    </tr>
<?php

    $conn = mySqlConn();
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    } 
    $user = $_SESSION['user'];

    // get page number to display
    $pageLength = 2;
    $page = getRequestedPageNum();
    $startFrom = ($page-1) * $pageLength;

    $dataQry = "SELECT * FROM founditems WHERE name='$user' ORDER BY dateCreated DESC LIMIT $startFrom, $pageLength";
    $dataResult = $conn->query($dataQry);
    while($row = mysqli_fetch_array($dataResult)) {
        echo "<tr>";
        echo "<td>" . "<img height='100' width='100' src='images/current/" . $row['imgName'] . "' data-action='zoom'> " . "</td>";
        echo "<td>" . $row['articleType'] . "</td>";
        echo "<td>" . $row['articleColor'] . "</td>";
        echo "<td>" . $row['additionalDetails'] . "</td>";
        echo "<td>" . $row['submitter'] . "</td>";
        echo "<td>" . $row['dateCreated'] . "</td>";
        echo "<td>" . $row['dateClaimed'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // pagnation
    $dataQry = "SELECT * FROM founditems WHERE name='$user'";
    echoMorePages($conn, $dataQry, "claimed.php", $page, $pageLength);
?>

</body>
</HTML>
