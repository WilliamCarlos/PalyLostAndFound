<?php
session_start();
include "utils.php";
$_SESSION['firstName'] = NULL;
$_SESSION['user'] = NULL;
session_destroy();
echoHeadings();
?>
<title>User Logout</title>
<br>
<h3><center>Successfully logged out. Have a great day!</center></h2>
</html>

