<?php
	if(isset($_POST['submit'])){

		$id_number_add = $_POST['id_number_add'];
		$password_add = $_POST['password_add'];
		$first_name_add = $_POST['first_name_add'];
		$middle_name_add = $_POST['middle_name_add'];
		$last_name_add = $_POST['last_name_add'];
		$role_add = $_POST['role_add'];
		$number_add = $_POST['number_add'];
		$email_add = $_POST['email_add'];

		$check = getimagesize($_FILES["profile_picture_add"]["tmp_name"]);
		if($check !== false){
			$image = $_FILES['profile_picture_add']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));
			
			$dbHost     = 'localhost';
			$dbUsername = 'root';
			$dbPassword = '';
			$dbName     = 's-ece database';

			$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

			if($db->connect_error){
				die("Connection failed: " . $db->connect_error);
			}

			$insert1 = $db->query("INSERT INTO accounts (id_number, password, first_name, middle_name, last_name, profile_photo, role) VALUES ('$id_number_add', '$password_add', '$first_name_add', '$middle_name_add', '$last_name_add', '$imgContent', '$role_add')");

			$insert2 = $db->query("INSERT INTO accounts_info (id_number, contact_number, email_address) VALUES ('$id_number_add', '$number_add', '$email_add')");

			$mark = 'true';
			
		}
	}
?>