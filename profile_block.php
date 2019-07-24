<?php
	if(isset($_POST['block'])){
		$query2 = "UPDATE accounts SET blocked = '1' WHERE id_number = '$searched_id_number' AND role != 'Parent' ";
		$query_run2 = mysql_query($query2);

		$block_mark = 'true';
	}else if(isset($_POST['unblock'])){
		$query2 = "UPDATE accounts SET blocked = '0' WHERE id_number = '$searched_id_number' AND role != 'Parent' ";
		$query_run2 = mysql_query($query2);

		$unblock_mark = 'true';
	}
?>