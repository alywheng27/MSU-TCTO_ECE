<?php
	include 'connect.inc.php';

	if(isset($_POST['search_profile'])){
		$search_profile = $_POST['search_profile'];
		$id_number = $_GET['id_number'];
		session_start();

		$query = "SELECT id_number FROM accounts WHERE id_number = '$search_profile' AND role != 'Administrator' AND role != 'Parent' ";
		$query_run = mysql_query($query);

		if(isset($_GET['changes']) and mysql_num_rows($query_run) != 1){
			header("Location: index.php?profile=true&changes=true&exist_mark=true");
		}else if(mysql_num_rows($query_run) == 1){
			$search_id = mysql_result($query_run, 0, 'id_number');
			if($search_id != $id_number){
				$_SESSION['search_id_number'] = $search_profile;
				$_SESSION['profile'] = 'true';
				header("Location: index.php?profile=true");
			}else{
				header("Location: index.php?profile=true&myProfile=true");
			}
		}else{
			header("Location: index.php?profile=true&exist_mark=true");
		}

		
	}
?>