<?php
	if(isset($_POST['college_name'])){
		$college_name = $_POST['college_name'];
		$query = "UPDATE accounts_info SET college = '$college_name' WHERE id_number = '$searched_id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['course_name'])){
		$course_name = $_POST['course_name'];
		$query = "UPDATE accounts_info SET course = '$course_name' WHERE id_number = '$searched_id_number' ";
		$query_run = mysql_query($query);

	}
	
	if(isset($_POST['major_name'])){
		$major_name = $_POST['major_name'];
		$query = "UPDATE accounts_info SET major = '$major_name' WHERE id_number = '$searched_id_number' ";
		$query_run = mysql_query($query);

	}
	
	if(isset($_POST['scholarship_name'])){
		$scholarship_name = $_POST['scholarship_name'];
		$query = "UPDATE accounts_info SET scholarship = '$scholarship_name' WHERE id_number = '$searched_id_number' ";
		$query_run = mysql_query($query);

	}
	
	if(isset($_POST['high_school_name'])){
		$high_school_name = $_POST['high_school_name'];
		$query = "UPDATE accounts_info SET high_school = '$high_school_name' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['elementary_school_name'])){
		$elementary_school_name = $_POST['elementary_school_name'];
		$query = "UPDATE accounts_info SET elementary_school = '$elementary_school_name' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['current_street'])){
		$current_street = $_POST['current_street'];
		$query = "UPDATE accounts_info SET current_street = '$current_street' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['current_barangay'])){
		$current_barangay = $_POST['current_barangay'];
		$query = "UPDATE accounts_info SET current_barangay = '$current_barangay' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['street'])){
		$street = $_POST['street'];
		$query = "UPDATE accounts_info SET hometown_street = '$street' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['barangay'])){
		$barangay = $_POST['barangay'];
		$query = "UPDATE accounts_info SET hometown_barangay = '$barangay' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['city'])){
		$city = $_POST['city'];
		$query = "UPDATE accounts_info SET hometown_city = '$city' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['province'])){
		$province = $_POST['province'];
		$query = "UPDATE accounts_info SET hometown_province = '$province' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST["submit"])){
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false){
			$image = $_FILES['image']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));
			
			$dbHost     = 'localhost';
			$dbUsername = 'root';
			$dbPassword = '';
			$dbName     = 's-ece database';

			$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

			if($db->connect_error){
				die("Connection failed: " . $db->connect_error);
			}

			$insert = $db->query("UPDATE accounts SET profile_photo = '$imgContent' WHERE id_number = '$searched_id_number' AND (role = 'Student' or role = 'Instructor') ");
			
		}
	}

	if(isset($_POST["submit_parent"])){
		$check = getimagesize($_FILES["parent_image"]["tmp_name"]);
		if($check !== false){
			$parent_image = $_FILES['parent_image']['tmp_name'];
			$imgContent = addslashes(file_get_contents($parent_image));
			
			$dbHost     = 'localhost';
			$dbUsername = 'root';
			$dbPassword = '';
			$dbName     = 's-ece database';

			$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

			if($db->connect_error){
				die("Connection failed: " . $db->connect_error);
			}

			$insert = $db->query("UPDATE accounts SET profile_photo = '$imgContent' WHERE id_number = '$id_number' AND role = 'Parent' ");
			
		}
	}

	if(isset($_POST['first_name']) and isset($_POST['middle_name']) and isset($_POST['last_name'])){
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$query = "UPDATE accounts SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name' WHERE id_number = '$searched_id_number' AND role = 'Student' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['parent_first_name']) and isset($_POST['parent_middle_name']) and isset($_POST['parent_last_name'])){
		$parent_first_name = $_POST['parent_first_name'];
		$parent_middle_name = $_POST['parent_middle_name'];
		$parent_last_name = $_POST['parent_last_name'];
		$query = "UPDATE accounts SET first_name = '$parent_first_name', middle_name = '$parent_middle_name', last_name = '$parent_last_name' WHERE id_number = '$id_number' AND role = 'Parent' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['role1'])){
		$role1 = $_POST['role1'];
		$query = "UPDATE accounts SET role = '$role1' WHERE id_number = '$searched_id_number' AND role = 'Student'";
		$query_run = mysql_query($query);

	}
	
	if(isset($_POST['month']) and isset($_POST['day']) and isset($_POST['year'])){
		$month = $_POST['month'];
		$day = $_POST['day'];
		$year = $_POST['year'];
		$query = "UPDATE accounts_info SET born = '$month $day, $year' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['religious_view'])){
		$religious_view = $_POST['religious_view'];
		$query = "UPDATE accounts_info SET religious_view = '$religious_view' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['number'])){
		$number = $_POST['number'];

		$query = "SELECT * FROM accounts_info WHERE contact_number = '$number' or parent_contact_number = '$number' ";
		$query_run = mysql_query($query);

		if(mysql_num_rows($query_run) == 0){
			$query = "UPDATE accounts_info SET contact_number = '$number' WHERE id_number = '$id_number' ";
			$query_run = mysql_query($query);
		}else{
			$exist_number = 'true';
		}
		

	}

	if(isset($_POST['parent_number'])){
		$parent_number = $_POST['parent_number'];

		$query = "SELECT * FROM accounts_info WHERE contact_number = '$parent_number' or parent_contact_number = '$parent_number' ";
		$query_run = mysql_query($query);

		if(mysql_num_rows($query_run) == 0){
			$query = "UPDATE accounts_info SET parent_contact_number = '$parent_number' WHERE id_number = '$id_number' ";
			$query_run = mysql_query($query);
		}else{
			$exist_parent_number = 'true';
		}

	}

	if(isset($_POST['email'])){
		$email = $_POST['email'];

		$query = "SELECT * FROM accounts_info WHERE email_address = '$email' or parent_email_address = '$email' ";
		$query_run = mysql_query($query);

		if(mysql_num_rows($query_run) == 0){
			$query = "UPDATE accounts_info SET email_address = '$email' WHERE id_number = '$id_number' ";
			$query_run = mysql_query($query);
		}else{
			$exist_email = 'true';
		}

	}

	if(isset($_POST['parent_email'])){
		$parent_email = $_POST['parent_email'];

		$query = "SELECT * FROM accounts_info WHERE email_address = '$parent_email' or parent_email_address = '$parent_email' ";
		$query_run = mysql_query($query);

		if(mysql_num_rows($query_run) == 0){
			$query = "UPDATE accounts_info SET parent_email_address = '$parent_email' WHERE id_number = '$id_number' ";
			$query_run = mysql_query($query);
		}else{
			$exist_parent_email = 'true';
		}

	}

	$query = "SELECT relationship_request FROM accounts WHERE id_number = '$id_number' ";
	$query_run = mysql_query($query);
	if(@$receive_mark = mysql_result($query_run, 0, 'relationship_request')){}

	$query = "SELECT relationship_request FROM accounts WHERE relationship_request = '$id_number' AND role != 'Parent' ";
	$query_run = mysql_query($query);
	if(@$sent_mark = mysql_result($query_run, 0, 'relationship_request')){

	}else if(isset($_POST['relation_id_number'])){
		$relation_id_number = $_POST['relation_id_number'];

		$query = "SELECT role FROM accounts WHERE id_number = '$relation_id_number' ";
		$query_run = mysql_query($query);

		if(@$role2 = mysql_result($query_run, 0, 'role')){}

		if(mysql_num_rows($query_run) == 0){
			$exist_mark = 'true';
		}else if($relation_id_number == $id_number or (($role == 'Student' and $role2 == 'Instructor') or ($role == 'Instructor' and $role2 == 'Student'))){
			$relation_mark = 'true';
		}else{
			$query = "SELECT relationship_id_number FROM accounts WHERE id_number = '$relation_id_number' AND role != 'Parent' ";
			$query_run = mysql_query($query);
			$relationship_id_number = mysql_result($query_run, 0, 'relationship_id_number');
			if(empty($relationship_id_number)){
				$query = "SELECT relationship_request FROM accounts WHERE id_number = '$relation_id_number' AND role != 'Parent' ";
				$query_run = mysql_query($query);
				$relationship_request = mysql_result($query_run, 0, 'relationship_request');
				if(empty($relationship_request)){
					$query = "UPDATE accounts SET relationship_request = '$id_number' WHERE id_number = '$relation_id_number' AND role != 'Parent'";
					$query_run = mysql_query($query);

					$query = "SELECT relationship_request FROM accounts WHERE relationship_request = '$id_number' AND role != 'Parent' ";
					$query_run = mysql_query($query);
					$sent_mark = mysql_result($query_run, 0, 'relationship_request');
				}else{
					$requested_mark = 'true';
				}
				
			}else{
				$taken_mark = 'true';
			}
		}
		

	}

	if(isset($_GET['cancel_request'])){
		$query = "UPDATE accounts SET relationship_request = '' WHERE relationship_request = '$id_number' ";
		$query_run = mysql_query($query);

		$query = "SELECT relationship_request FROM accounts WHERE relationship_request = '$id_number' AND role != 'Parent' ";
		$query_run = mysql_query($query);
		if(@$sent_mark = mysql_result($query_run, 0, 'relationship_request')){}
	}

	if(isset($_GET['accept_request'])){
		$accept_request = $_GET['accept_request'];
		$query = "UPDATE accounts SET relationship_id_number = '$accept_request', relationship_request = '' WHERE id_number = '$id_number' and role != 'Parent' ";
		$query_run = mysql_query($query);
		$query = "UPDATE accounts SET relationship_id_number = '$id_number', relationship_request = '' WHERE id_number = '$accept_request' and role != 'Parent' ";
		$query_run = mysql_query($query);
		$receive_mark = '';
	}

	if(isset($_GET['decline_request'])){
		$query = "UPDATE accounts SET relationship_request = '' WHERE id_number = '$id_number' and role != 'Parent' ";
		$query_run = mysql_query($query);
		$receive_mark = '';
	}

	if(isset($_GET['break'])){
		$break = $_GET['break'];
		$query = "UPDATE accounts SET relationship_id_number = '' WHERE id_number = '$id_number' and (role = 'Student' or role = 'Instructor')";
		$query_run = mysql_query($query);
		$query = "UPDATE accounts SET relationship_id_number = '' WHERE id_number = '$break' and (role = 'Student' or role = 'Instructor')";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['family_id_number'])){
		$family_id_number = $_POST['family_id_number'];

		$query = "SELECT * FROM accounts WHERE id_number = '$family_id_number' ";
		$query_run = mysql_query($query);

		if(mysql_num_rows($query_run) > 0){
			if($family_id_number != $id_number){

				$query = "SELECT * FROM family_members WHERE id_number = '$id_number' AND family_id_number = '$family_id_number' ";
				$query_run = mysql_query($query);

				if(mysql_num_rows($query_run) == 0){
					$query = "SELECT * FROM family_members WHERE id_number = '$id_number' AND family_id_number_request = '$family_id_number' ";
					$query_run = mysql_query($query);

					if(mysql_num_rows($query_run) == 0){
						$query = "SELECT id_number FROM family_members WHERE id_number = '$family_id_number' AND family_id_number_request = '$id_number' ";
						$query_run = mysql_query($query);

						if(mysql_num_rows($query_run) == 0){
							$query = "INSERT INTO family_members (id_number, family_id_number_request) VALUES ('$id_number', '$family_id_number') ";
							$query_run = mysql_query($query);
						}else{
							$someone_requested = mysql_result($query_run, 0, 'id_number');
						}
					}else{
						$family_requested = 'true';
					}
				}else{
					$already_family = 'true';
				}

				
					
			}else{
				$double_mark = 'true';
			}
		}else{
			$family_id_number_exist = 'true';
		}
	}

	if(isset($_GET['cancel_family'])){
		$family_id_number_request = $_GET['cancel_family'];
		$query = "DELETE FROM family_members WHERE id_number = '$id_number' AND family_id_number_request = '$family_id_number_request' ";
		$query_run = mysql_query($query);
	}

	if(isset($_GET['accept_family'])){
		$family_id_number_request = $_GET['accept_family'];

		$query = "UPDATE family_members SET family_id_number = '$id_number', family_id_number_request = '' WHERE id_number = '$family_id_number_request' AND family_id_number_request = '$id_number' ";
		$query_run = mysql_query($query);

		$query = "INSERT INTO family_members (id_number, family_id_number) VALUES ('$id_number', '$family_id_number_request') ";
		$query_run = mysql_query($query);
	}

	if(isset($_GET['decline_family'])){
		$family_id_number_request = $_GET['decline_family'];
		$query = "DELETE FROM family_members WHERE id_number = '$family_id_number_request' AND family_id_number_request = '$id_number' ";
		$query_run = mysql_query($query);
	}

	if(isset($_GET['remove'])){
		$remove = $_GET['remove'];

		$query = "DELETE FROM family_members WHERE id_number = '$id_number' AND family_id_number = '$remove' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM family_members WHERE id_number = '$remove' AND family_id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['about'])){
		$about = $_POST['about'];
		$query = "UPDATE accounts_info SET about = '$about' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['nickname'])){
		$nickname = $_POST['nickname'];
		$query = "UPDATE accounts_info SET nickname = '".mysql_real_escape_string($nickname)."' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	if(isset($_POST['quotes'])){
		$quotes = $_POST['quotes'];
		$query = "UPDATE accounts_info SET favorite_quotes = '".mysql_real_escape_string($quotes)."' WHERE id_number = '$id_number' ";
		$query_run = mysql_query($query);

	}

	

?>