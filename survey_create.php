<?php
require_once 'dbc.php';
page_protect();

// Single select questions
$single_select_array = array();

$total_question_number = 0;

$result = mysql_query("select id from single_selective_q order by id");
if (!$result)
{
	echo 'error!';
}
$single_q_id_array = array();
while ($row = mysql_fetch_row($result))
{
	$single_q_id_array[] = $row[0];
}

mysql_free_result($result);
$total_question_number = count($single_q_id_array);  

$i = 0;
// Avoid infinite loop
while (count($single_select_array) < 3 && $i < 5000)
{
	$i++;
	//mt_srand();
	$select_qid =  mt_rand(1, $single_q_id_array[$total_question_number - 1]);
	if (!in_array($select_qid, $single_select_array) && in_array($select_qid, $single_q_id_array))
	{
		$single_select_array[] = $select_qid;
	}
}

foreach ($single_select_array as $id)
{
	//echo ("$id<br>");
}

// Multiple select questions
$result = mysql_query("select id from multi_selective_q order by id");
if (!$result)
{
	echo 'error!';
}
 
$multi_q_id_array = array();
while ($row = mysql_fetch_row($result))
{
	$multi_q_id_array[] = $row[0];
}

mysql_free_result($result);
$total_question_number = count($multi_q_id_array);  

$multi_q_id = 0;
$i = 0; 
// Avoid infinite loop
while ($multi_q_id == 0 && $i < 5000)
{
	$i++;
	$select_qid = mt_rand($multi_q_id_array[0], $multi_q_id_array[$total_question_number - 1]);
	if (in_array($select_qid, $multi_q_id_array))
	{
		$multi_q_id = $select_qid;
		break;
	}
} 

//echo "Multi qid number is $multi_q_id<br>";

// Open questions
$result = mysql_query("select id from open_q order by id");
if (!$result)
{
	echo 'error!';
}
 
$open_q_id_array = array();
while ($row = mysql_fetch_row($result))
{
	$open_q_id_array[] = $row[0];
}

mysql_free_result($result);
$total_question_number = count($open_q_id_array);  

$open_q_id = 0;
$i = 0; 
// Avoid infinite loop
while ($open_q_id == 0 && $i < 5000)
{
	$i++;
	$select_qid = mt_rand($open_q_id_array[0], $open_q_id_array[$total_question_number - 1]);
	if (in_array($select_qid, $open_q_id_array))
	{
		$open_q_id = $select_qid;
		break;
	}
} 

//echo "Open qid number is $open_q_id</br>";

// Number questions
$result = mysql_query("select id from number_q order by id");
if (!$result)
{
	echo 'error!';
}
 
$number_q_id_array = array();
while ($row = mysql_fetch_row($result))
{
	$number_q_id_array[] = $row[0];
}

mysql_free_result($result);
$total_question_number = count($number_q_id_array);  

$number_q_id = 0;
$i = 0; 
// Avoid infinite loop
while ($number_q_id == 0 && $i < 5000)
{
	$i++;
	$select_qid = mt_rand($number_q_id_array[0], $number_q_id_array[$total_question_number - 1]);
	if (in_array($select_qid, $number_q_id_array))
	{
		$number_q_id = $select_qid;
		break;
	}
} 

//echo "Number qid number is $number_q_id</br>";
?>

<html>
<head>
<title>我的账号</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">

<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="5"
		class="main">
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="160" valign="top">
			<?php 
			/*********************** MYACCOUNT MENU ****************************
			 This code shows my account menu only to logged in users.
			Copy this code till END and place it in a new html or php where
			you want to show myaccount options. This is only visible to logged in users
			*******************************************************************/
			if (isset($_SESSION['user_id'])) {
			?>
				<div class="myaccount">
					<p>
						<strong>我的帐号</strong>
					</p>
					<a href="myaccount.php">我的帐号</a><br> 
					<a href="mysettings.php">设置</a><br>
					<a href="survey_create.php">创建问卷</a><br>
					<a href="logout.php">登出 </a>
				</div> 
			<?php }
  			?>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</td>
			<td width="732" valign="top">
				<h3 class="titlehdr">创建问卷</h3>
				 <p> </p>

				<form action="survey_create.php" method="post" name="myform" id="myform">
					<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
						<tr>
							<td>
								<h4>以下题目都是从题库数据库中随机选出</h4>
								<p> </p>
							</td>
						</tr>
					</table>
					<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
						<tr>
							<td>
								<h4>单选题</h4>
							</td>
						</tr>
					
					<?php
						$i = 0;
						foreach ($single_select_array as $q_id)
						{
							$i++;
							$res = mysql_query("select title, op1, op2, op3, op4 from single_selective_q where id = $q_id");
							$select_q = mysql_fetch_assoc($res);
							mysql_free_result($res);
					
							echo '<tr>';
							echo	'<td>'; 
							echo		$i . '. ' . $select_q['title']; 
							echo	'</td>';
							echo	'<td>'; 
							echo		'A ' . $select_q['op1']; 
							echo	'</td>';
							echo	'<td>'; 
							echo		'B ' . $select_q['op2']; 
							echo	'</td>';
							
							if ($select_q['op3'])
							{
								echo	'<td>'; 
								echo		'C ' . $select_q['op3']; 
								echo	'</td>';
							}
							if ($select_q['op4'])
							{
								echo	'<td>'; 
								echo		'D ' . $select_q['op4']; 
								echo	'</td>';
							}
							echo '</tr>';
						}
					?>
					</table>

					<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
						<tr>
							<td>
								<h4>多选题</h4>
							</td>					
						</tr>
						<tr>
							
							<?php
							$res = mysql_query("select title, op1, op2, op3, op4 from multi_selective_q where id = $multi_q_id");
							$multi_q = mysql_fetch_assoc($res);
							mysql_free_result($res);
							echo '<td>';
								echo 4 . '. ' . $multi_q['title'];
							echo '</td>';
							echo	'<td>'; 
							echo		'A ' . $multi_q['op1']; 
							echo	'</td>';
							echo	'<td>'; 
							echo		'B ' . $multi_q['op2']; 
							echo	'</td>';
							
							if ($multi_q['op3'])
							{
								echo	'<td>'; 
								echo		'C ' . $multi_q['op3']; 
								echo	'</td>';
							}
							if ($multi_q['op4'])
							{
								echo	'<td>'; 
								echo		'D ' . $multi_q['op4']; 
								echo	'</td>';
							}

							?>
						</tr>

					</table>
					<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
						<tr>
							<td>
								<h4>问答题</h4>
							</td>					
						</tr>
						<tr>
							<?php
							$res = mysql_query("select title from open_q where id = $open_q_id");
							$open_q = mysql_fetch_assoc($res);
							mysql_free_result($res);
							echo '<td>';
								echo 5 . '. ' . $open_q['title'];
							echo '</td>';
							?>
						</tr>
					</table>
					<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
						<tr>
							<td>
								<h4>填数字</h4>
							</td>					
						</tr>
						<tr>
							<?php
							$res = mysql_query("select title, num1, num2, num3, num4 from number_q where id = $number_q_id");
							$number_q = mysql_fetch_assoc($res);
							mysql_free_result($res);
							echo '<td>';
								echo 6 . '. ' . $number_q['title'];
							echo '</td>';
							echo '<td>';
								echo 'a. ' . $number_q['num1'];
							echo '</td>';
							echo '<td>';
								echo 'b . ' . $number_q['num2'];
							echo '</td>';
							echo '<td>';
								echo 'c . ' . $number_q['num3'];
							echo '</td>';
							echo '<td>';
								echo 'd . ' . $number_q['num4'];
							echo '</td>';
							?>
						</tr>
					</table>

					<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
						<tr>
							<td>
								请输入试卷标题
							</td>
							<td>
								<input name="paper title" type="text" id="paper_title" value=""/>
							</td>

						</tr>
						<tr>
							<td colspan="2">
								<div align="center">
									<p>
										<input name="save_paper" type="submit" id="save_button" value="存储问卷"/>
									</p>
									<p>
										<input name="regen_paper" type="submit" id="regen_button" value="重新生成"/>	
									</p>
								</div>
							</td>
						</tr>
					</table>
				</form>
			</td>

		</tr>
	</table>

</body>
</html>

