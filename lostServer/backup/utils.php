<?php
function echoHeadings() {
$var1 = <<<HTML
<!DOCTYPE HTML> 
<html lang="en-US"> <!--if blank display all -->
<header>
  <link rel="stylesheet" type="text/css" href="css/foundation.css">
  <div><center>
  <nav class="top-bar">
    <ul class="title-area">
      <li class="name">
	<h1><a href="/lost/index.php"><b>Palo Alto High School Lost and Found</b></a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a>
      </li>
    </ul>
    <section class="top-bar-section">
      <ul class="right">
	<li class="divider"></li>
	<li><a href="/lost/index.php">Current Items</a></li>
	<li class="divider"></li>
	<li><a href="/lost/addItem.php">Add Items</a></li>
	<li class="divider"></li>
	<li><a href="/lost/claimed.php">Items You Claimed</a></li>
	<li class="divider"></li>
	<li><a href="/lost/contactUs.php">Contact Us</a></li>
	<li class="divider"></li>
HTML;

   if(isset($_SESSION["firstName"])) { 
      $logInOut = "<li><a href='logout.php'>Log Out</a></li>";
   } else {
      $logInOut = "<li><a href='login.php'>Log In</a></li>";
   }
	
$var2 = <<<HTML
    </section></ul>
  </nav>
</div>
</header>
<br>
HTML;

   echo $var1;
   echo $logInOut;
   echo $var2;        
   }

function echoTopImg($imgName) {
  echo "<div><center>";
  echo "<div class='logoPos'><a href='/lost/img/PalyLostFoundLogoBig.jpg'><img src='/lost/img/PalyLostFoundLogo.jpg'></a></div>";
  echo "<div class='palyLogoPos'><a href='/lost/index.php'><img src='/lost/img/PalyLogo.png'></a></div>";
  echo "<dir class='pageTitle'><img src='/lost/img/" . $imgName . "'></td></div>";
  echo getWelcomeMsg();
  echo "</div>";
}

Global $conn;
function mySqlConn() {
    $servername = "localhost";
    $username = "William";
    $password = "YES";
    $dbname = "item";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function getWelcomeMsg() {
    $welcomeMsg = "<center>Welcome ";
    if (isset($_SESSION["firstName"])) { 
        $welcomeMsg .= "<b><i>".$_SESSION["firstName"]."</i></b>";
    } else {
       $welcomeMsg .= "<b><i>guest</i></b>";
    }
    $welcomeMsg .= ". Today is " . date('l, F jS, Y') . "</center><br>";
    return $welcomeMsg;
}

function resizeImage($fileName, $newWidth)
{
    list($width, $height, $type, $attr) = getimagesize($fileName);
    $extension = image_type_to_extension($type);

    $imagePath = "images/current/";
    list($usec, $sec) = explode(" ", microtime());
    $utime = ((float)$usec + (float)$sec);
    $imageFile = $utime . $extension;
    $imagePathFile = $imagePath . $imageFile;

    if ($width < $newWidth) {
        // copy the file
        move_uploaded_file($fileName, $imagePathFile);
        return $imageFile;
    }

    if ($extension == '.jpg' || $extension == '.jpeg') {
        $src = imagecreatefromjpeg($fileName);
    } else if ($extension == '.png') {
        $src = imagecreatefrompng($fileName);
    } else if ($extension == '.gif') {
        $src = imagecreatefromgif($fileName);
    } else {
        echoHeadings();
        echo("<center>image file name must ends with one of followings: .jpeg, .jpg, .png, .gif</center>");
        return "";
    }
    
    $newHeight = ($height/$width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    imagejpeg($tmp, $imagePathFile, 100);

    imagedestroy($src);
    imagedestroy($tmp);
    return $imageFile;
}

function getRequestedPageNum() {
    if (isset($_GET['page'])) {
       $page = $_GET['page'];
    } else {
       $page = 1;
    }
    return $page;
}

function echoMorePages($conn, $dataQry, $hrefPage, $currPage, $pageLength) {
    $dataResult = $conn->query($dataQry);
    $totalEnts = $dataResult->num_rows;
    $totalPages = ceil($totalEnts / $pageLength);
    if ($totalPages <= 1) {
       return;
    }
    echo "<b>More Pages:</b> ";
    for ($idx=1; $idx<=$totalPages; $idx++) {
       if($idx == $currPage) {
          $pageHyperLink = "<i><b>$idx</b></i>";
       } else {
          $pageHyperLink = $idx;
       }
       echo "<a href='$hrefPage?page=" . $idx . "'>" . $pageHyperLink . " </a> ";
    }
}

function genRandomString() {
    $length = 57;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }
 
    return $string;
}

function sendWelcomeEmail($userId, $firstName, $verifyUrl) {
    $subject = "Welcome to Paly Lost and Found!";
    $message = "Hello " . $firstName . ",\r\nPlease complete the registration by visiting the link below.\r\n";
    $message .= $verifyUrl;
    $message .= "\r\nThanks.\r\n Paly Lost and Found Team\r\n";

    $headers = "From: webmaster@paly.net\r\nReply-To: webmaster@paly.net\r\nX-Mailer: PHP/" . phpversion();
    //    mail($userId, $subject, $message, $header);
}

function sendPasswdEmail($userId, $firstName, $verifyUrl) {
    $subject = "Reset Password for Paly Lost and Found!";
    $message = "Hello " . $firstName . ",\r\nPlease change your password by visiting the link below.\r\n";
    $message .= $verifyUrl;
    $message .= "\r\nThanks.\r\n Paly Lost and Found Team\r\n";

    $headers = "From: webmaster@paly.net\r\nReply-To: webmaster@paly.net\r\nX-Mailer: PHP/" . phpversion();
    echo $message;
    //    mail($userId, $subject, $message, $header);
}
?>