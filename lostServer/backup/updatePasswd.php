<?php
session_start();
include "utils.php";

if (!isset($_GET['random'])) {
   return;
}
$random = $_GET['random'];

$conn = mySqlConn();

// check user and its random number to match what we generated
$qry = "SELECT * FROM userRegistration WHERE rnd='$random'";
$result = mysqli_query($conn, $qry);
if ($result != TRUE) {
   echo "Err: " . mysqli_error($conn);
   return;
}
$row = mysqli_fetch_array($result);
if(!is_array($row)) {
    header("Location: http:/lost/emailVerifFailed.php");
    return;                    
}
$userId = $row['name'];
$_SESSION['user'] = $userId;
echoHeadings();

// delete the user to random num entry
$qry = "DELETE from userRegistration WHERE name='$userId'";
$result = mysqli_query($conn, $qry);

?>

  <title>Paly Lost and Found: Update Password</title>
  <body>
    <br>
    <form name="frmUser" method="post" action="update_passwd.php">
      <table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
        <tr class="tableheader">
          <td align="center" colspan="2"><h4>Enter New Password</h4></td>
        </tr>
        <tr class="tablerow">
          <td align="right">Username</td>
          <td><?php echo $userId ?><input type="hidden" name="userId" value="<?php echo $userId ?>"></td>
        </tr>
        <tr class="tablerow">
          <td align="right">Password</td>
          <td><input type="password" name="passWord"></td>
        </tr>
        <tr class="tableheader">
          <td></td>
          <td><input type="submit" name="submit" value="Sign In"></td>
        </tr>
      </table>
    </form>
  </body>
</html>
