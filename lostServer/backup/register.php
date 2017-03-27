<?php
session_start();
include_once "utils.php";
echoHeadings();
?>
  <title>User Registeration</title>
  <body>
  <?php echoTopImg("Registration.jpg"); ?>
    <form name="regForm" method="post" action="register_process.php", enctype="multipart/form-data">
      <table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
        <tr class="tablerow">
          <td align="right">Username</td>
          <td><input type="text" name="userName" value="email@paly.net" onclick="this.value=''"></td>
        </tr>
        <tr class="tablerow">
          <td align="right">Password</td>
          <td><input type="password" name="passWord"></td>
        <tr class="tablerow">
          <td align="right">First Name</td>
          <td><input type="text" name="firstName" value="*required" onclick="this.value=''"></td>
        </tr>
        <tr class="tablerow">
          <td align="right">Last Name</td>
          <td><input type="text" name="lastName" value="*required" onclick="this.value=''"></td>
        </tr>
        <tr class="tableheader">
          <td></td>
          <td align="center"><input type="submit" name="submit" value="Register"></td>
        </tr>
      </table>
      <div align="center" style="color:red"><b><?php if (isset($_GET["errMsg"])) { echo $_GET["errMsg"]; } ?></b></div>
    </form>
  </body>
  </html>
