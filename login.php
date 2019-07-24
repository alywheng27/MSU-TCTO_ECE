<?php
	if(isset($_POST['id_number']) and $_POST['password']){
		$id_number = $_POST['id_number'];
		$password = $_POST['password'];
		
		$query = "SELECT accounts.id_number, first_name, middle_name, last_name, role, course, college, blocked, notification_sent FROM accounts JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number='".mysql_real_escape_string($id_number)."' and password='".mysql_real_escape_string($password)."'";
		if($query_run = mysql_query($query)){
			if(@mysql_result($query_run, 0, 'blocked') == '1'){
				$block_mark = 'true';
			}
			else if(mysql_num_rows($query_run) > 0){
				$name = mysql_result($query_run, 0, 'first_name');
				$name2 = mysql_result($query_run, 0, 'middle_name');
				$name3 = mysql_result($query_run, 0, 'last_name');
				$role = mysql_result($query_run, 0, 'role');
				$id_number = mysql_result($query_run, 0, 'id_number');
				$college = mysql_result($query_run, 0, 'college');
				$course = mysql_result($query_run, 0, 'course');

				$notification_sent = mysql_result($query_run, 0, 'notification_sent');

				$_SESSION['name'] = $name;
				$_SESSION['name2'] = $name2;
				$_SESSION['name3'] = $name3;

				$_SESSION['role'] = $role;
				$_SESSION['id_number'] = $id_number;
				$_SESSION['college'] = $college;
				$_SESSION['course'] = $course;

				if($notification_sent == 0){
					include 'notification.php';
				}
				

                header("Location: index.php");
			}else{
					header("Location: index.php?mark=true&id_number=".$id_number."");
				}
		}
	}
?>