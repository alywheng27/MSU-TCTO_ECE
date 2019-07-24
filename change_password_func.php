<?php
	if(isset($_POST['current_password']) and isset($_POST['new_password']) and isset($_POST['confirm_password'])){

		$current_password = $_POST['current_password'];
		$new_password = $_POST['new_password'];
		$confirm_password = $_POST['confirm_password'];

		if($role == 'Student'){
			$query = "SELECT password FROM accounts WHERE id_number = '$id_number' AND role = 'Student'";
			$query_run = mysql_query($query);

			if(mysql_result($query_run, 0, 'password') == $current_password){
				if($new_password == $confirm_password){
					$query = "UPDATE accounts SET password = '$new_password' WHERE id_number = '$id_number'  AND role = 'Student'";
					$query_run = mysql_query($query);

					$mark2 = 'true';
				}else{
					$mark1 = 'true';
				}
			}else{
				$mark = 'true';
			}
		}else if($role == 'Parent'){
			$query = "SELECT password FROM accounts WHERE id_number = '$id_number' AND role = 'Parent'";
			$query_run = mysql_query($query);

			if(mysql_result($query_run, 0, 'password') == $current_password){
				if($new_password == $confirm_password){
					$query = "UPDATE accounts SET password = '$new_password' WHERE id_number = '$id_number'  AND role = 'Parent'";
					$query_run = mysql_query($query);

					$mark2 = 'true';
				}else{
					$mark1 = 'true';
				}
			}else{
				$mark = 'true';
			}
		}else{
			$query = "SELECT password FROM accounts WHERE id_number = '$id_number'";
			$query_run = mysql_query($query);

			if(mysql_result($query_run, 0, 'password') == $current_password){
				if($new_password == $confirm_password){
					$query = "UPDATE accounts SET password = '$new_password' WHERE id_number = '$id_number'";
					$query_run = mysql_query($query);

					$mark2 = 'true';
				}else{
					$mark1 = 'true';
				}
			}else{
				$mark = 'true';
			}
		}
		
	}
	

?>