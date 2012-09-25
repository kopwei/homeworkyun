<?php 
/*************** PHP LOGIN SCRIPT V 2.0*********************
 ***************** Auto Approve Version**********************
(c) Balakrishnan 2009. All Rights Reserved

Usage: This script can be used FREE of charge for any commercial or personal projects.

Limitations:
- This script cannot be sold.
- This script may not be provided for download except on its original site.

For further usage, please contact me.

***********************************************************/


include 'dbc.php';

$err = array();

if($_POST['doRegister'] == '注册')
{
	/******************* Filtering/Sanitizing Input *****************************
	 This code filters harmful script code and escapes data of all POST data
	from the user submitted form.
	*****************************************************************/
	foreach($_POST as $key => $value) {
		$data[$key] = filter($value);
	}

	/************************ SERVER SIDE VALIDATION **************************************/
	/********** This validation is useful if javascript is disabled in the browswer ***/

	// Validate User Name
	if (!isUserID($data['user_name'])) {
		$err[] = "错误！ - 用户名只能包含字母，数字和下划线";
		//header("Location: register.php?msg=$err");
		//exit();
	}
	// Check User Passwords
	if (!checkPwd($data['pwd'],$data['pwd2'])) {
		$err[] = "错误！ - 密码不符合要求或者不匹配，请输入至少5个字符";
		//header("Location: register.php?msg=$err");
		//exit();
	}
	 
	$user_ip = $_SERVER['REMOTE_ADDR'];

	// stores sha1 of password
	$sha1pass = PwdHash($data['pwd']);

	// Automatically collects the hostname or domain  like example.com)
	$host  = $_SERVER['HTTP_HOST'];
	$host_upper = strtoupper($host);
	$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	$user_name = $data['user_name'];
	$gender = $data['gender'];

	/************ USER EMAIL CHECK ************************************
	 This code does a second check on the server side if the email already exists. It
	queries the database and if it has any existing email it throws user email already exists
	*******************************************************************/

	$rs_duplicate = mysql_query("select count(*) as total from users where user_name='$user_name'") or die(mysql_error());
	list($total) = mysql_fetch_row($rs_duplicate);

	if ($total > 0)
	{
		$err[] = "错误！- 该用户名已经存在";
		//header("Location: register.php?msg=$err");
		//exit();
	}
	/***************************************************************************/

	if(empty($err)) {

		$sql_insert = "INSERT into `users`
		(`pwd`,`user_name`, `gender`)
		VALUES
		('$sha1pass','$user_name', $gender)";
			
		mysql_query($sql_insert,$link) or die("数据插入失败:" . mysql_error());
		$user_id = mysql_insert_id($link);
		$md5_id = md5($user_id);
		mysql_query("update users set md5_id='$md5_id' where id='$user_id'");
		header("Location: thankyou.php");
		exit();

	}
}

?>
<html>
<head>
<title>用户注册</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<script language="JavaScript" type="text/javascript"
	src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript"
	src="js/jquery.validate.js"></script>

<script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "用户名只能包含字母，数字和下划线");

    $("#regForm").validate();
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
			<td width="732" valign="top">
				<p>
					<?php 
	 if (isset($_GET['done'])) { ?>
				
				<h2>谢谢</h2> 您的注册已经成功，可以点击以下链接登录<a href="login.php">登录</a>"; <?php exit();
	 }
	 ?>
				</p>
				<h3 class="titlehdr">用户注册</h3>
				<p>请正确的填入用户信息 所有都需要填</p> <?php	
				if(!empty($err))  {
					echo "<div class=\"msg\">";
					foreach ($err as $e) {
						echo "* $e <br>";
	    }
	    echo "</div>";
	   }
	   ?> <br>
				<form action="register.php" method="post" name="regForm"
					id="regForm">
					<table width="95%" border="0" cellpadding="3" cellspacing="3"
						class="forms">
						<tr>
							<td>用户名<span class="required"><font color="#CC0000">*</font> </span>
							</td>
							<td><input name="user_name" type="text" id="user_name"
								class="required username" minlength="5"> <input
								name="btnAvailable" type="button" id="btnAvailable"
								onclick='$("#checkid").html("Please wait..."); $.get("checkuser.php",{ cmd: "check", user: $("#user_name").val() } ,function(data){  $("#checkid").html(data); });'
								value="检查是否可用"> <span
								style="color: red; font: bold 12px verdana;" id="checkid"></span>
							</td>
						</tr>
						<tr>
							<td>性别<font color="#CC0000">*</font></span>
							</td>
							<td><select name="gender" class="required" id="select8">
									<option value="1" selected>男</option>
									<option value="2">女</option>
									<option value="0">未知</option>
							
							</td>
						
						
						<tr>
							<td>密码<span class="required"><font color="#CC0000">*</font> </span>
							</td>
							<td><input name="pwd" type="password" class="required password"
								minlength="5" id="pwd"> <span class="example">** 最少5个字符..</span>
							</td>
						</tr>
						<tr>
							<td>再次输入密码<span class="required"><font color="#CC0000">*</font> </span>
							</td>
							<td><input name="pwd2" id="pwd2" class="required password"
								type="password" minlength="5" equalto="#pwd"></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
					</table>
					<p align="center">
						<input name="doRegister" type="submit" id="doRegister" value="注册">
					</p>
				</form>
				<p align="right">
					<span style="font: normal 9px verdana">Powered by <a
						href="http://php-login-script.com">PHP Login Script v2.0</a>
					</span>
				</p>
			</td>
			<td width="196" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>

</body>
</html>
