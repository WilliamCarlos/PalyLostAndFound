<? ob_start(); ?>
<HTML>
    <title> Output page </title>
</HTML>
<?php

$servername = "localhost";
$username = "William";
$password = "password";
$dbname = "item";
// first name, last name, article type, color, owner first name, owner last name, Additional details, password?, upload file, (date found)
$firstname_input = $_GET['firstname_input'];
$lastname_input = $_GET['lastname_input'];
$articleType = $_GET['articleType'];
$articleColor = $_GET['articleColor'];
$ownerFirstName = $_GET['ownerFirstName'];
$ownerLastName = $_GET['ownerLastName'];
$additionalDetails = $_GET['additionalDetails'];
$pwd = $_GET['pwd'];
//uploaded file variable
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    /*** check if a file was submitted ***/

    /*upload an image*/
    /* make sure userImage is not null and upload once verified */
    if(!isset($_FILES['userfile']))
    {
        echo '<p>Please select a file</p>';
    } else {
        try    {
            upload();
            /*** give praise and thanks to the php gods ***/
            echo '<p>Thank you for submitting</p>';
        }
        catch(Exception $e)
        {
            echo '<h4>'.$e->getMessage().'</h4>';
        }
    }

//IF PASSWORD EQUALS _____
//MySQL databases columns -> var name
//ADD IMAGE URL LINK.. hm.. 
    $sql = "INSERT INTO items (firstname, lastname, articleType, articleColor, ownerFirstName, ownerLastName, additionalDetails)   
    VALUES ('$firstname_input', '$lastname_input', '$articleType', '$articleColor', '$ownerFirstName', '$ownerLastName', '$additionalDetails');";
    	//include all information in additionalDetails col of sql databsase to make a regex search easier. 
        //VALUES ('$firstname_input');";
        //VALUES('".$firstname."','".$lastname."','".$email."')";
    if ($conn->multi_query($sql) === TRUE) {
        header("Location: http://localhost:8888/lost/itemAdded.html");
        /* Redirect browser */

	//http://localhost:8888/lost/itemAdded.html
    //echo "New record created successfully";
    } else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
    }
//$conn->close();
/**
 *
 * the upload function
 * 
 * @access public
 *
 * @return void
 *
 */
function upload(){
    /*** check if a file was uploaded ***/
    if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
    {
        /***  get the image info. ***/
        $size = getimagesize($_FILES['userfile']['tmp_name']);
        /*** assign our variables ***/
        $type = $size['mime'];
        $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
        $size = $size[3];
        $name = $_FILES['userfile']['name'];
        $maxsize = 99999999;


        /***  check the file is less than the maximum file size ***/
        if($_FILES['userfile']['size'] < $maxsize )
        {
            /*** connect to db ***/
            $dbh = new PDO("mysql:host=localhost;dbname=item", 'William', 'password');

            /*** set the error mode ***/
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*** our sql query ***/
            $stmt = $dbh->prepare("INSERT INTO images (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)");

            /*** bind the params ***/
            $stmt->bindParam(1, $type);
            $stmt->bindParam(2, $imgfp, PDO::PARAM_LOB);
            $stmt->bindParam(3, $size);
            $stmt->bindParam(4, $name);

            /*** execute the query ***/
            $stmt->execute();
        }
        else
        {
            /*** throw an exception is image is not of type ***/
            throw new Exception("File Size Error");
        }
    }
    else
    {
    // if the file is not less than the maximum allowed, print an error
        throw new Exception("Unsupported Image Format!");
    }
}
?>
<? ob_flush(); ?>