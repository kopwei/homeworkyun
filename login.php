<?php 
/*************** PHP LOGIN SCRIPT V 2.3*********************
 (c) Balakrishnan 2009. All Rights Reserved

Usage: This script can be used FREE of charge for any commercial or personal projects. Enjoy!

Limitations:
- This script cannot be sold.
- This script should have copyright notice intact. Dont remove it please...
- This script may not be provided for download except from its original site.

For further usage, please contact me.

***********************************************************/
include 'dbc.php';

$err = array();

foreach($_GET as $key => $value) {
	$get[$key] = filter($value); //get variables are filtered.
}

if ($_POST['doLogin']=='Login')
{

	foreach($_POST as $key => $value) {
		$data[$key] = filter($value); // post variables are filtered
	}


	$user_name = $data['usr_name'];
	$pass = $data['pwd'];

	$result = mysql_query("SELECT `id`,`pwd` FROM users WHERE
			user_name='$user_name'
			") or die (mysql_error());
	$num = mysql_num_rows($result);

	// Match row found with more than 1 results  - the user is authenticated.
	if ( $num > 0 ) {

		list($id, $pwd) = mysql_fetch_row($result);

		//check against salt
		if ($pwd === PwdHash($pass,substr($pwd,0,9))) {
			if(empty($err)){

				// this sets session and logs user in
				session_start();
	   session_regenerate_id (true); //prevent against session fixation attacks.

	   // this sets variables in the session
	   $_SESSION['user_id']= $id;
	   $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);

	   //update the timestamp and key for cookie
	   $stamp = time();
	   $ckey = GenKey();
	   mysql_query("update users set `ctime`='$stamp', `ckey` = '$ckey' where id='$id'") or die(mysql_error());

	   //set a cookie

	   if(isset($_POST['remember'])){
	   	setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*COOKIE_TIME_OUT, "/");
	   	setcookie("user_key", sha1($ckey), time()+60*60*24*COOKIE_TIME_OUT, "/");
	   	setcookie("user_name",$_SESSION['user_name'], time()+60*60*24*COOKIE_TIME_OUT, "/");
	   }
		  header("Location: myaccount.php");
		 }
		}
		else
		{
			//$msg = urlencode("Invalid Login. Please try again with correct user email and password. ");
			$err[] = "登录失败. 请用正确的用户名密码重新尝试.";
			//header("Location: login.php?msg=$msg");
		}
	} else {
		$err[] = "错误！- 登录失败. 该用户名并不存在";
	}
}



?>
<html>
<head>
<title>用户登录</title>
<meta http-equiv="Content-Type"
	content="text/html; charset=utf8>
<script   language="JavaScript"
	type="text/javascript" src="js/jquery-1.3.2.min.js">
</script>
<script language="JavaScript" type="text/javascript"
	src="js/jquery.validate.js"></script>
<script>
  $(document).ready(function(){
    $("#logForm").validate();
  });
  </script>
<link href="styles.css" rel="stylesheet" type="text/css">

</head>

<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="5"
		class="main">
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="160" valign="top"><p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p></td>
			<td width="732" valign="top"><p>&nbsp;</p>
				<h3 class="titlehdr">用户登录</h3>
				<p>
					<?php
					/******************** ERROR MESSAGES*************************************************
					 This code is to show error messages
					**************************************************************************/
					if(!empty($err))  {
						echo "<div class=\"msg\">";
						foreach ($err as $e) {
							echo "$e <br>";
						}
						echo "</div>";
					}
					/******************************* END ********************************/
					?>
				</p>
				<form action="login.php" method="post" name="logForm" id="logForm">
					<table width="65%" border="0" cellpadding="4" cellspacing="4"
						class="loginform">
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td width="28%">用户名</td>
							<td width="72%"><input name="usr_name" type="text"
								class="required" id="txtbox" size="25"></td>
						</tr>
						<tr>
							<td>密码</td>
							<td><input name="pwd" type="password" class="required password"
								id="txtbox" size="25"></td>
						</tr>
						<tr>
							<td colspan="2"><div align="center">
									<input name="remember" type="checkbox" id="remember" value="1">
									记住我
								</div></td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center">
									<p>
										<input name="doLogin" type="submit" id="doLogin3"
											value="Login">
									</p>
									<p>
										<a href="register.php">注册新账号</a><font color="#FF6600"> |</font>
										<a href="forgot.php">忘记密码</a> <font color="#FF6600"> </font>
									</p>
									<p>
										<span style="font: normal 9px verdana">Powered by <a
											href="http://php-login-script.com">PHP Login Script v2.3</a>
										</span>
									</p>
								</div>
							</td>
						</tr>
					</table>
					<div align="center"></div>
					<p align="center">&nbsp;</p>
				</form>
				<p>&nbsp;</p>
			</td>
			<td width="196" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>

</body>
</html>
