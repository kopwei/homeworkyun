<?php

include 'dbc.php';

foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$user = mysql_real_escape_string($get['user']);

if(isset($get['cmd']) && $get['cmd'] == 'check') {

	if(!isUserID($user)) {
		echo "非法的用户名";
		exit();
	}

	if(empty($user) && strlen($user) <=3) {
		echo "请输入至少5个字符";
		exit();
	}



	$rs_duplicate = mysql_query("select count(*) as total from users where user_name='$user' ") or die(mysql_error());
	list($total) = mysql_fetch_row($rs_duplicate);

	if ($total > 0)
	{
		echo "该用户名不可用";
	} else {
		echo "该用户名可用";
	}
}

?>