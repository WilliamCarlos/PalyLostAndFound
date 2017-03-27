<?php
session_start();
include_once "utils.php";
echoHeadings();
?>
  <title>User Registeration</title>
  <body>
  <?php echoTopImg("Registration.jpg"); ?>
    <form name="regForm" method="post" action="register_process.php", enctype="multipart/form-data">
      <table border="0" cellpadding="5" cellspacing="1" align="center">
        <tr class="tablerow">
          <td width="150px" align="right">Username</td>
          <td width="300px"><input size=30 type="text" name="userName" value="your-email@pausd.us" onclick="this.value=''"></td>
        </tr>
        <tr class="tablerow">
          <td align="right">Password</td>
          <td><input size=30 type="password" name="passWord"></td>
        <tr class="tablerow">
          <td align="right">First Name</td>
          <td><input size=30 type="text" name="firstName" value="*required" onclick="this.value=''"></td>
        </tr>
        <tr class="tablerow">
          <td align="right">Last Name</td>
          <td><input size=30 type="text" name="lastName" value="*required" onclick="this.value=''"></td>
        </tr>
        <tr class="tableheader">
	  <td></td>
    <td align="center"><input type="image" src="img/Register.jpg" alt="Submit Form" width="80px" name="submit"></td>
        </tr>
      </table>
      <div align="center" style="color:red"><b><?php if (isset($_GET["errMsg"])) { echo $_GET["errMsg"]; } ?></b></div>
    </form>
  </body>
  </html>
