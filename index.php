<?php
	ob_start();
	session_start();
	
	require 'connect.inc.php';
	
	
	if(isset($_SESSION['name']) and !empty($_SESSION['name'])){
		$name = $_SESSION['name'];
		$role = $_SESSION['role'];
		
		if(isset($_SESSION['profile'])){
			$searched_id_number = $_SESSION['search_id_number'];
			$id_number = $_SESSION['id_number'];
		}else{
			$id_number = $_SESSION['id_number'];
		}
		
		if(isset($_GET['administrator_student'])){
			unset($_SESSION['search_id_number']);
			include 'student_home.php';
		}else if(isset($_GET['profile']) or isset($_SESSION['profile'])){
			if(isset($_GET['search_id_number'])){
				$searched_id_number = $_GET['search_id_number'];
			}
			if(isset($_GET['myProfile'])){
				unset($_SESSION['search_id_number']);
			}else if(isset($_SESSION['search_id_number'])){
				$searched_id_number = $_SESSION['search_id_number'];
			}
			unset($_SESSION['profile']);
			unset($_SESSION['search_id_number']);

			if(isset($_GET['role']) and ($_GET['role'] == 'Parent' or $_GET['role'] == 'Administrator')){
				include 'profile_parent_admin.php';
			}else if(isset($_GET['profile_educational_background'])){
				include 'profile_edit.php';
				include 'profile_educational_background.php';
			}else if(isset($_GET['profile_place_you_lived'])){
				include 'profile_edit.php';
				include 'profile_place_you_lived.php';
			}else if(isset($_GET['profile_contact_basicinfo'])){
				include 'profile_edit.php';
				include 'profile_contact_basicinfo.php';
			}else if(isset($_GET['profile_family_and_relationship'])){
				include 'profile_edit.php';
				include 'profile_family_and_relationship.php';
			}else if(isset($_GET['profile_details_about'])){
				include 'profile_edit.php';
				include 'profile_details_about.php';
			}else if(isset($_GET['changes'])){
				include 'profile_change.php';
			}else{
				include 'profile_block.php';
				include 'profile_overview.php';
			}
		}else if(isset($_GET['semester']) and isset($_GET['year'])){
			unset($_SESSION['search_id_number']);
			if(isset($_GET['scores'])){
				include 'scores.php';
			}else{
				include 'grades.php';
			}
		}else if(isset($_GET['subject_enrolled'])){
			unset($_SESSION['search_id_number']);
			if(isset($_GET['classmates_list'])){
				include 'classmates_list.php';
			}else{
				include 'subject_enrolled.php';
			}
		}else if(isset($_GET['curriculum'])){
			unset($_SESSION['search_id_number']);
			$college = $_SESSION['college'];
			$course = $_SESSION['course'];
			include 'curriculum.php';
		}else if(isset($_GET['billing_accounts'])){
			unset($_SESSION['search_id_number']);
			include 'billing_accounts.php';
		}else if(isset($_GET['subject'])){
			unset($_SESSION['search_id_number']);
			$subject = $_GET['subject'];
			include 'chat_func.php';
			include 'chat.php';
		}else if(isset($_GET['change_password'])){
			include 'change_password_func.php';
			include 'change_password.php';
		}else if(isset($_GET['submit_grade_subject'])){
			unset($_SESSION['search_id_number']);
			include 'submit_grade_func.php';

			$query = "SELECT subject, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
			$query_run = mysql_query($query);

			if(isset($_GET['set_percentage']) or (isset($_GET['id_number']) and isset($_GET['first_name']) and isset($_GET['last_name']) and mysql_num_rows($query_run) == 0)){
				include 'set_percentage.php';
			}else if(@isset($_GET['id_number']) and isset($_GET['first_name']) and isset($_GET['last_name']) and $semester = mysql_result($query_run, 0, 'semester') and $year = mysql_result($query_run, 0, 'year')){
				include 'enter_scores.php';
			}else if(@isset($_GET['id_number']) and isset($_GET['first_name']) and isset($_GET['last_name'])){
				$sem_year_mark = 'true';
				include 'submit_grade.php';
			}
			else{
				include 'submit_grade.php';
			}
		}else if(isset($_GET['teaching_load'])){
			unset($_SESSION['search_id_number']);
			if(isset($_GET['master_list'])){
				include 'master_list.php';
			}else{
				include 'teaching_load.php';
			}
		}else if($role === 'Student' or $role === 'Parent' or (isset($_GET['student']) and isset($_GET['post']))){
			unset($_SESSION['search_id_number']);
			if(!isset($_GET['student']) and !isset($_GET['post'])){
				$_GET['student'] = 'true';
				$_GET['post'] = 'Administrator';
			}
			include 'student_home_func.php';
			if(isset($_GET['add_photo'])){
				include 'add_photo.php';
			}else if(isset($_GET['enter_edit'])){
				include 'edit_post.php';
			}else if(isset($_GET['edit_comment'])){
				include 'edit_comment.php';
			}else{
				include 'student_home.php';
			}
			
		}else if($role === 'Instructor' or (isset($_GET['instructor']) and isset($_GET['post']))){
			unset($_SESSION['search_id_number']);
			if(!isset($_GET['instructor']) and !isset($_GET['post'])){
				$_GET['instructor'] = 'true';
				$_GET['post'] = 'Administrator';
			}
			include 'student_home_func.php';
			if(isset($_GET['add_photo'])){
				include 'add_photo.php';
			}else if(isset($_GET['enter_edit'])){
				include 'edit_post.php';
			}else{
				include 'student_home.php';
			}
		}else if(isset($_GET['change'])){
			unset($_SESSION['search_id_number']);
			include 'profile_change.php';
		}else if(isset($_GET['add_user'])){
			unset($_SESSION['search_id_number']);
			include 'add_user_func.php';
			include 'add_user.php';
		}else if($role === 'Administrator' or (isset($_GET['administrator']) and isset($_GET['post']))){
			unset($_SESSION['search_id_number']);
			if(!isset($_GET['administrator']) and !isset($_GET['post'])){
				$_GET['administrator'] = 'true';
				$_GET['post'] = 'Administrator';
			}
			include 'student_home_func.php';
			if(isset($_GET['add_photo'])){
				include 'add_photo.php';
			}else if(isset($_GET['enter_edit'])){
				include 'edit_post.php';
			}else{
				include 'student_home.php';
			}
		}
	}else{
        include 'login.php';
		include 'login_interface.php';
	}
?>