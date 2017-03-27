<?php
session_start();
include "utils.php";
echoHeadings();
?>
<title>Paly Lost and Found: Reset Password</title>
  <body>
    <br>
    <form name="frmUser" method="post" action="reset_passwd.php">
      <table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
        <tr>
          <td colspan="3" align="center"><h4>Request Reset Password</h4></td>
        </tr>
        <tr>
          <td  colspan="3" align="left">Enter your user ID and a link to reset your password will be sent</td>
        </tr>
        <tr>
          <td><center>Username:</center></td><td><input type="text" name="userId" value="your-email@pausd.us" onclick="this.value=''"></td>
          <td colspan="2"><input type="image" src="img/Submit.jpg" width="66px" alt="Submit Form"></td>
        </tr>
      </table>
    </form>
  </body>
</html>