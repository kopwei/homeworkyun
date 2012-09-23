<?php
?>

<html>
<head>
<title>答题</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">

<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
require_once 'dbc.php';
$rs_questions = mysql_query("select * from questions") or die(mysql_error());
echo "<form name=form1 method=post action=result.php>";
while (list($id,$title,$op1,$op2,$op3,$op4,$op1_sum,$op2_sum,$op3_sum, $op4_sum)
		=mysql_fetch_row($rs_questions))
{
	echo $title;
	echo "<br>";
	echo "<input type=radio name=op$id value=sum1 checked>$op1<p>";
	echo "<input type=radio name=op$id value=sum2>$op2<p>";
	if (null != $op3)
	{
		echo "<input type=radio name=op$id value=sum2>$op3<p>";
		if (null != $op4)
		{
			echo "<input type=radio name=op$id value=sum2>$op4<p>";
		}
	}

}
echo "<input type=submit name=Submit value=提交>";
?>

</body>
</html>
