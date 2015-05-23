<? ob_start(); ?>
<HTML>
    <title> Output page </title>
</HTML>
<?php
$servername = "localhost";
$username = "William";
$password = "password";
$dbname = "item";

//uploaded file variable
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit']))
{
    /* if getimagesize fails, print error message. Otherwise, run the else block */
    if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
    {
        echo "Please select an image.";
    }
    else
    {
        $image= addslashes($_FILES['image']['tmp_name']);
        $name= addslashes($_FILES['image']['name']);
        $image= file_get_contents($image);
        $image= base64_encode($image);
        saveimage($name,$image);
    }
}
function saveimage($name,$image)
{
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

    $qry="INSERT into images (name,image) VALUES ('$name','$image')";
    $result = $conn->query($qry);
    saveinfo();
}

function saveinfo()
{
// first name, last name, article type, color, owner first name, owner last name, Additional details, password?, upload file, (date found)
    $firstname_input = $_POST['firstname_input'];
    $lastname_input = $_POST['lastname_input'];
    $articleType = $_POST['articleType'];
    $articleColor = $_POST['articleColor'];
    $ownerFirstName = $_POST['ownerFirstName'];
    $ownerLastName = $_POST['ownerLastName'];
    $additionalDetails = $_POST['additionalDetails'];
    $pwd = $_POST['pwd'];
    
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

    $sql = "INSERT INTO items (firstname, lastname, articleType, articleColor, ownerFirstName, ownerLastName, additionalDetails)   
    VALUES ('$firstname_input', '$lastname_input', '$articleType', '$articleColor', '$ownerFirstName', '$ownerLastName', '$additionalDetails');";
        //include all information in additionalDetails col of sql databsase to make a regex search easier. 
        //VALUES ('$firstname_input');";
        //VALUES('".$firstname."','".$lastname."','".$email."')";
    if ($conn->query($sql) === TRUE) {
        echo "header called";
        header("Location: http://localhost:8888/lost/itemAdded.html");
        /* Redirect browser */
    //http://localhost:8888/lost/itemAdded.html
    //echo "New record created successfully";
    } else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}




?>
<? ob_flush(); ?>