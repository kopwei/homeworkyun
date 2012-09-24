<?php
?>
<html>
<head>
<title>调查结果</title>
<meta http-equiv="Content-Type"
	content="text/html; charset=utf8>


</head>

<body>
	<?php
	 	require_once 'dbc.php';
	 	
	 	$query_rs = mysql_query("SELECT * from questions");
	 	

	?>
</body>
</html>


