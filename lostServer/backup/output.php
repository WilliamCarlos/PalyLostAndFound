<?php
session_start();
include "utils.php";
echoHeadings();
?>

<title> Paly Lost and Found: Current Items </title>
<!--<h1> Current Items at the Lost and Found </h1>-->
<body>
  <img src="/lost/img/currentItems.png"> 
  <!--zoom.js plugin-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="js/zoom.js"></script>
  <form method="GET" action="output.php">
    <input type="search" placeholder="Search For an Item " id="search" name="search">
  </form>
  <?php
     //assign contents in the search textfield to a keyword variable
     if(isset($_GET['search'])) {
         $keyword = $_GET['search'];
     }
  
  /*$_GET['search']*/
  ?>
  <table>
    <tr>
      <!--<th>id</th>-->
      <th>Image</th>
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
    $conn = mySqlConn();
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    } 
    if(!isset($_GET['search'])) {
        $dataQry = "SELECT * FROM items ORDER BY dateCreated DESC";
        $dataResult = $conn->query($dataQry);
        $imgQry="SELECT * FROM images ORDER BY dateCreated DESC";
        $imageResult = $conn->query($imgQry);
        while($row = mysqli_fetch_array($dataResult)) {
            echo "<tr>";
            $rowImg = mysqli_fetch_array($imageResult);
            echo "<td>" . '<img height="100" width="100"  src="data:image;base64,'.$rowImg[2].' "data-action="zoom"> ' . "</td>";
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
        while($row = mysqli_fetch_array($imageResult)) {
            echo '<img height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
        }
    } else {
        $dataQry = "SELECT * FROM items WHERE ownerFirstName LIKE '%$keyword%' OR ownerLastName LIKE '%$keyword%' OR firstname LIKE '%$keyword%' OR lastname LIKE '%$keyword%' OR articleType LIKE '%$keyword%'  OR articleColor LIKE '%$keyword%'  OR additionalDetails LIKE '%$keyword%'";
    $dataResult = $conn->query($dataQry);
    //echo "query step 2";
    $imgQry="SELECT * FROM images ORDER BY dateCreated DESC";
    $imageResult = $conn->query($imgQry);
    while($row = mysqli_fetch_array($dataResult)) 
    {
    //implement images into search
    //echo '<img height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
    //echo "loop";
    echo "<tr>";
      //echo "<td>" . $row['id'] . "</td>";
      $rowImg = mysqli_fetch_array($imageResult);
      echo "<td>" . '<img height="100" width="100" src="data:image;base64,'.$rowImg[2].' "data-action="zoom"> ' . "</td>";
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
    ?>
</body>
</HTML>















