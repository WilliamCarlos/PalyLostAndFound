
<?php
/*** Check the $_GET variable ***/
if(filter_has_var(INPUT_GET, "image_id") !== false && filter_input(INPUT_GET, 'image_id', FILTER_VALIDATE_INT) !== false)
{
  /*** set the image_id variable ***/
  $image_id = filter_input(INPUT_GET, "image_id", FILTER_SANITIZE_NUMBER_INT);
  try    {

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
    /*** The sql statement ***/
    $sql = "SELECT image_type, image_size, image_name FROM images WHERE image_id=".$image_id;

    /*** prepare the sql ***/
    $sst = $conn->prepare($sql);

    /*** exceute the query ***/
    $stmt->execute(); 

    /*** set the header for the image ***/
    $array = $stmt->fetch();

    /*** the size of the array should be 3 (1 for each field) ***/
    if(sizeof($array) === 3)
    {
      echo '<p>This is '.$array['image_name'].' from the database</p>';
      echo '<img '.$array['image_size'].' src="showfile.php?image_id='.$image_id.'">';
    }
    else
    {
      throw new Exception("Error while retrieving images from array: Out of bounds");
    }
  }
  catch(PDOException $e)
  {
    echo $e->getMessage();
  }
  catch(Exception $e)
  {
    echo $e->getMessage();
  }
}
else
{
  echo 'image_id number is not valid';
}
?>
