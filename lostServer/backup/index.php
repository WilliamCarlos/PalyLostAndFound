<?php
session_start();
include "utils.php";
echoHeadings();

// Number of entries to display in each page
$pageLength = 20;

?>
<title>Paly Lost and Found: Current Items</title>
<body>
  <!--zoom.js plugin-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="js/zoom.js"></script>

<div><center>
  <?php  echoTopImg("CurrentItems.jpg"); ?>
  <form method="GET" action="index.php">
  <div><center>
  <input class="inputSearch" type="search" placeholder="Search, e.g., cellphone" id="search" name="search"></div>
  </form>

  <?php
     //assign contents in the search textfield to a keyword variable
     if(isset($_GET['search'])) {
         $keyword = $_GET['search'];
     }
  /*$_GET['search']*/
  ?>
  <table align="center">
    <tr>
      <!--<th>id</th>-->
      <th>Image</th>
      <th>Article Description</th>
      <th>Claim Item</th>
    </tr>

<?php
    $conn = mySqlConn();
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    } 

    // get page number to display
    $page = getRequestedPageNum();
    $startFrom = ($page-1) * $pageLength;

    if(!isset($_GET['search'])) {
        $dataQry = "SELECT * FROM items ORDER BY dateCreated DESC LIMIT $startFrom, $pageLength";
        $dataResult = $conn->query($dataQry);
        while($row = mysqli_fetch_array($dataResult)) {
            echo "<tr>";
            echo "<td>" . "<img height='100' width='100' src='images/current/" . $row['lastname'] . "' data-action='zoom'> " . "</td>";
            echo "<td width='680px'><b>type</b>: " . $row['articleType'];
            echo "<br><b>color</b>: " . $row['articleColor'];
            echo "<br><b>submitter</b>: " . $row['firstname'];
            echo "<br><b>date found</b>: " . $row['dateCreated'];
            echo "<br><b>owner's name</b>: " . $row['ownerFirstName'] . " " . $row['ownerLastName'];
            echo "<br><b>additional info</b>: " . $row['additionalDetails'];
            echo "<td><form action='claim_handler.php' method='post'> <input type='submit' value='claim'> <input type='hidden' name='itemId' value=" . $row['id'] . "></td></form>";
            echo "</tr>";
        }
    } else {
        $dataQry = "SELECT * FROM items WHERE ownerFirstName LIKE '%$keyword%' OR ownerLastName LIKE '%$keyword%' OR firstname LIKE '%$keyword%' OR articleType LIKE '%$keyword%' OR articleColor LIKE '%$keyword%' OR additionalDetails LIKE '%$keyword%' LIMIT $startFrom, $pageLength";
        $dataResult = $conn->query($dataQry);
        //echo "query step 2";
        $imgQry="SELECT * FROM images ORDER BY dateCreated DESC";
        $imageResult = $conn->query($imgQry);
        while($row = mysqli_fetch_array($dataResult)) {
           echo "<tr>";
           echo "<td>" . "<img height='100' width='100' src='images/current/" . $row['lastname'] . "' data-action='zoom'> " . "</td>";
            echo "<td width='680px'><b>type</b>: " . $row['articleType'];
            echo "<br><b>color</b>: " . $row['articleColor'];
            echo "<br><b>submitter</b>: " . $row['firstname'];
            echo "<br><b>date found</b>: " . $row['dateCreated'];
            echo "<br><b>owner's name</b>: " . $row['ownerFirstName'] . " " . $row['ownerLastName'];
            echo "<br><b>additional info</b>: " . $row['additionalDetails'];
            echo "<td><form action='claim_handler.php' method='post'> <input type='submit' value='claim'> <input type='hidden' name='itemId' value=" . $row['id'] . "></td></form>";
           echo "</tr>";
       }
    }
    echo "</table>";

    // pagnation
    if(!isset($_GET['search'])) {
        $dataQry = "SELECT * FROM items";
    } else {
        $dataQry = "SELECT * FROM items WHERE ownerFirstName LIKE '%$keyword%' OR ownerLastName LIKE '%$keyword%' OR firstname LIKE '%$keyword%' OR articleType LIKE '%$keyword%' OR articleColor LIKE '%$keyword%' OR additionalDetails LIKE '%$keyword%'";          
    }
    echoMorePages($conn, $dataQry, "index.php", $page, $pageLength);
?>
</body>
</div>
</HTML>















