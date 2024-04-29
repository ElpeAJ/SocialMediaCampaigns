 <?php


$conn = mysqli_connect("localhost", "root", "", "smcampaigns") or die("Connection Error: " . mysqli_error($conn));
require_once('setup.php');

session_start();


$conn = mysqli_connect("localhost", "root", "", "smcampaigns") or die("Connection Error: " . mysqli_error($conn));
require_once('setup.php');

if (count($_POST) > 0) {
  //$username = mysqli_real_escape_string($conn, $_POST['username']); // Escape username to prevent SQL injection
  $sql = "SELECT * FROM signup WHERE username='" . $username . "'";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $username); // Bind username parameter
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_array($result);

  if ($row && password_verify($_POST["currentPassword"], $row["password"])) { // Use password_verify for secure comparison
    $newPassword = password_hash($_POST["newPassword"], PASSWORD_DEFAULT); // Hash new password securely
    $sql = "UPDATE signup SET password='" . $newPassword . "' WHERE username='" . $username . "'";
    mysqli_query($conn, $sql);
    $message = "Password Changed";
  } else {
    $message = "Current Password is not correct";
  }
  mysqli_stmt_close($stmt);
}
 ?> 



?>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script>
function validatePassword() {
//var currentPassword,newPassword,confirmPassword,output = true;
var username,newPassword,confirmPassword,output = true;

username = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!username.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
} 	
return output;
}
</script>
</head>
<body>
    <form name="frmChange" method="post" action=""
        onSubmit="return validatePassword()">
        <div style="width: 500px;">
            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
            <table border="0" cellpadding="10" cellspacing="0"
                width="500" align="center" class="tblSaveForm">
                <tr class="tableheader">
                    <td colspan="2">Change Password</td>
                </tr>
                <tr>
                    <td width="40%"><label>Current Password</label></td>
                    <td width="60%"><input type="text"
                        name="username" class="txtField" /><span
                        id="currentPassword" class="required"></span></td>
                </tr>
                <tr>
                    <td><label>New Password</label></td>
                    <td><input type="password" name="newPassword"
                        class="txtField" /><span id="newPassword"
                        class="required"></span></td>
                </tr>
                <td><label>Confirm Password</label></td>
                <td><input type="password" name="confirmPassword"
                    class="txtField" /><span id="confirmPassword"
                    class="required"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit"
                        value="Submit" class="btnSubmit"></td>
                </tr>
            </table>
        </div>
    </form>
</body>
