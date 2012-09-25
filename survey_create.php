<?php
require_once 'dbc.php';
page_protect();
const MAX_SINGLE_SELECT_Q = 3;
const MAX_MULTI_SELECT_Q = 1;
const MAX_OPEN_Q = 1;
const MAX_NUM_Q = 1;

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
	echo ("$id<br>");
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

echo "Multi qid number is $multi_q_id<br>";

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

echo "Open qid number is $open_q_id</br>";

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

echo "Number qid number is $number_q_id</br>";
?>

