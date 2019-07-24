<?php
	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
	
	include 'connect.inc.php';
	
	$id_number = $_GET['id_number'];

	$query = "SELECT id_number FROM accounts WHERE id_number = '$id_number'";
	if($query_run = mysql_query($query)){
		if(mysql_num_rows($query_run) > 0)
			echo '<span style="color: lime;">Correct ID Number</span>';
		else if($id_number == '')
			echo '';
		else
			echo '<span style="color: lightgrey;">Incorrect ID Number</span>';
		
	}
		
?>