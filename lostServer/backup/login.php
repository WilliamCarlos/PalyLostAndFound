<?php
session_start();
include "utils.php";
echoHeadings();
if(isset($_GET['login'])) {
   $loginId = $_GET['login'];
} else {
   $loginId = "email@paly.net";
}

?>
  <title>Paly Lost and Found: User Login</title>
  <?php echoTopImg("Login.jpg"); ?>
    <form name="frmUser" method="post" action="login_process.php">
      <table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
        <tr class="tablerow">
          <td align="right">Username</td>
          <td><input type="text" name="userName" value="<?php echo $loginId ?>" onclick="this.value=''"></td>
        </tr>
        <tr class="tablerow">
          <td align="right">Password</td>
          <td><input type="password" name="passWord"></td>
        </tr>
        <tr class="tableheader">
          <td></td>
          <td><input type="submit" name="submit" value="Sign In"></td>
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

