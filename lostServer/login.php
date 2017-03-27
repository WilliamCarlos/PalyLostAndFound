<?php
session_start();
include "utils.php";
echoHeadings();
if(isset($_GET['login'])) {
   $loginId = $_GET['login'];
} else {
   $loginId = "your-email@pausd.us";
}

?>
  <title>Paly Lost and Found: User Login</title>
  <?php echoTopImg("Login.jpg"); ?>
    <form name="frmUser" method="post" action="login_process.php">
      <table border="0" cellpadding="1" cellspacing="1" align="center">
        <tr class="tablerow">
          <td width="150px" align="right">Username</td>
          <td width="300px"><input size=30 type="text" name="userName" value="<?php echo $loginId ?>" onclick="this.value=''"></td>
        </tr>
        <tr class="tablerow">
          <td align="right">Password</td>
          <td><input size=30 type="password" name="passWord"></td>
        </tr>
        <tr class="tableheader">
          <td></td>
          <td><input type="image" src="img/SignIn.jpg" alt="Submit Form" width="80px" name="submit"></td>
        </tr>
        <tr class="tableheader">
          <td></td>
          <td><?php if (isset($_GET['errMsg'])) { echo $_GET['errMsg'] . " Please try again"; }?></td>
        </tr>
        <tr><td>Not a member? <a href="./register.php">Register</a></li></td>
            <td><a href="./resetPasswd.php">Forgot your password?</a></td>
        </tr>
      </table>
    </form>
  </body>
</html>

