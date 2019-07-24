<?php
	include 'connect.inc.php';
	if(!isset($_SESSION['name']) and empty($_SESSION['name'])){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Background - MSU-TCTO S-ECE</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />
    
</head>
<body>
	<div id="wrapper">
		
        <!--    navbar         -->
			<?php include 'navbars.php'; ?>
		<!--    navbar         -->
		
		<form method="POST" action="search_profile.php?id_number=<?php echo $id_number; ?>">
		<div style="display: -webkit-box; -webkit-box-orient: horizontal; width: 22%; position: relative; left: 68%;">
			<input type="text" class="form-control" placeholder="Search by ID Number" name="search_profile" style="margin-top: 3px;"/>
			<button type="submit" class="btn btn-primary glyphicon glyphicon-search" style="margin-left: 5px;"></button>
		</div><br>
		</form>
		
		<div id="page-wrapper" style="display: -webkit-box; -webkit-box-orient: horizontal; width: 90%; margin-left: 5%; border-top: 1px solid #767676;">
			<div style="border-right: 1px solid #767676;">
				<?php
					if(!empty($searched_id_number)){
						$_SESSION['search_id_number'] = $searched_id_number;
					}
				?>
				<a href="?profile=true" style="padding-right: 20px; font-size: 15px;">Overview</a><br><br>
				<a href="?profile_educational_background=true&profile=true" style="padding-right: 20px; font-size: 15px; border-left: 3px solid blue; padding-left: 10px;">Educational Background</a><br><br>
				<a href="?profile_place_you_lived=true&profile=true" style="padding-right: 20px; font-size: 15px;">Current City and Hometown</a><br><br>
				<a href="?profile_contact_basicinfo=true&profile=true" style="padding-right: 20px; font-size: 15px;">Contact and Basic Info</a><br><br>
				<a href="?profile_family_and_relationship=true&profile=true" style="padding-right: 20px; font-size: 15px;">Family and Relationship</a><br><br>
				<a href="?profile_details_about=true&profile=true" style="padding-right: 20px; font-size: 15px;">Other Details</a><br><br>
			</div>
			
			<style type="text/css">
				a {color: #909090;}
				a:hover {color: black;
						text-decoration: none;
				}

				
			</style>
			
			<?php
				if(!empty($searched_id_number)){
					$query = "SELECT accounts_info.college, course, major, high_school, elementary_school, scholarship FROM accounts
							JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$searched_id_number' AND role != 'Parent' AND college != ''";
				}else{
					$query = "SELECT accounts_info.college, course, major, high_school, elementary_school, scholarship FROM accounts
							JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$id_number' AND role != 'Parent' AND college != ''";
				}
				$query_run = mysql_query($query);
					while($query_row = mysql_fetch_assoc($query_run)){
						echo '	<div style="width: 60%; padding-left: 3%;">
									<h3>COLLEGE</h3><hr>
									<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
										<img src="MSU TCTO SEAL.png" class="img-circle" />
										<label style="font-weight: normal; text-indent: 5px; font-size: 16px;">MSU Tawi-Tawi College of Technology and Oceanography</label><hr style="border-width: 1px">
									</div>
									<hr>
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">College: </label><label style="font-weight: normal; text-indent: 49px; width: 85%;"> ';

									if(!empty($query_row['college'])){
										echo $query_row['college'];
									}else{
										echo 'None';
									}

									if($role == 'Administrator'){
										echo '<label id="college_edit" style="float: right; font-size: 13px;"><a id="btn_college" style="float: right"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="college_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_educational_background=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													College/Department: 
												</div>
												<div class="col-md-5">
													<select class="form-control" name="college_name">
														<option value="IICT">IICT</option>
														<option value="COED">COED</option>
														<option value="CAS">CAS</option>
														<option value="CIAS">CIAS</option>
														<option value="COF">COF</option>
														<option value="IOES">IOES</option>
													</select>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_college" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Course: </label><label style="font-weight: normal; text-indent: 50px; width: 85.5%;"> ';

									if(!empty($query_row['course'])){
										echo $query_row['course'];
									}else{
										echo 'None';
									}

									if($role == 'Administrator'){
										echo '<label id="course_edit" style="float: right; font-size: 13px;"><a id="btn_course" style="float: right"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="course_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_educational_background=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Course: 
												</div>
												<div class="col-md-7">
													<select class="form-control" name="course_name">';
													$query1 = "SELECT courses.course FROM courses JOIN accounts_info ON accounts_info.college = courses.college WHERE id_number = '$searched_id_number'";
													$query_run1 = mysql_query($query1);
													while($query_row1 = mysql_fetch_assoc($query_run1)){
														echo '<option value="'.$query_row1['course'].'">'.$query_row1['course'].'</option>';
													}
													echo '</select>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_course" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Major: </label><label style="font-weight: normal; text-indent: 59px; width: 87.5%;"> ';

									if(!empty($query_row['major'])){
										echo $query_row['major'];
									}else{
										echo 'None';
									}

									if($role == 'Administrator'){
										echo '<label id="major_edit" style="float: right; font-size: 13px;"><a id="btn_major" style="float: right"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="major_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_educational_background=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Major: 
												</div>
												<div class="col-md-7">
													<select class="form-control" name="major_name">';
													$query1 = "SELECT majors.major FROM majors JOIN accounts_info ON accounts_info.course = majors.course WHERE id_number = '$searched_id_number'";
													$query_run1 = mysql_query($query1);
													while($query_row1 = mysql_fetch_assoc($query_run1)){
														echo '<option value="'.$query_row1['major'].'">'.$query_row1['major'].'</option>';
													}
													echo '</select>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_major" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Scholarship: </label><label style="font-weight: normal; margin-left: 20px; width: 77%;"> ';

									if(!empty($query_row['scholarship'])){
										echo $query_row['scholarship'];
									}else{
										echo 'None';
									}

									if($role == 'Administrator'){
										echo '<label id="scholarship_edit" style="float: right; font-size: 13px;"><a id="btn_scholarship" style="float: right"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="scholarship_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_educational_background=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Scholarship: 
												</div>
												<div class="col-md-5">
													<select class="form-control" name="scholarship_name">
														<option value="ESGP-PA">ESGP-PA</option>
														<option value="Academic Scholar">Academic Scholar</option>
														<option value="Tambuli">Tambuli</option>
														<option value="SSST">SSST</option>
														<option value="Athlette">Athlette</option>
														<option value="Dependent">Dependent</option>
														<option value="None">None</option>
													</select>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_scholarship" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">';

									echo '<h3>HIGH SCHOOL</h3><hr>
									<span class="glyphicon glyphicon-education" style="font-size: 28px;" ></span><label style="font-weight: normal; margin-left: 15px; font-size: 16px; position: relative; bottom: 9px; width: 88%;"> ';

									if(!empty($query_row['high_school'])){
										echo $query_row['high_school'];
									}else{
										echo 'None';
									}

									if($role == 'Administrator'){
										echo '<label id="high_edit" style="float: right; font-size: 13px;"><a id="btn_high" style="float: right"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="high_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_educational_background=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													High School: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="high_school_name" value="'.$query_row['high_school'].'" />
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_high" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">

									<h3>ELEMENTARY SCHOOL</h3><hr>
									<span class="glyphicon glyphicon-education" style="font-size: 28px;" ></span><label style="font-weight: normal; margin-left: 15px; font-size: 16px; position: relative; bottom: 9px; width: 88%;"> ';

									if(!empty($query_row['elementary_school'])){
										echo $query_row['elementary_school'];
									}else{
										echo 'None';
									}

									if($role == 'Administrator'){
										echo '<label id="elementary_edit" style="float: right; font-size: 13px;"><a id="btn_elementary" style="float: right"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="elementary_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_educational_background=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Elementary School: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="elementary_school_name" value="'.$query_row['elementary_school'].'" />
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button  type="button" id="in_btn_elementary" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</div>
										</form>
									<hr style="border-width: 1px">

								</div>
						';
					}
			?>
		</div>

		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<script type="text/javascript">

			$(document).ready(function(){
				$("#btn_college").click(function(){
					$("#college_edit_now").toggle();
				});

				$("#in_btn_college").click(function(){
					$("#college_edit_now").toggle();
				});

				$("#btn_course").click(function(){
					$("#course_edit_now").toggle();
				});

				$("#in_btn_course").click(function(){
					$("#course_edit_now").toggle();
				});

				$("#btn_major").click(function(){
					$("#major_edit_now").toggle();
				});

				$("#in_btn_major").click(function(){
					$("#major_edit_now").toggle();
				});
				
				$("#btn_scholarship").click(function(){
					$("#scholarship_edit_now").toggle();
				});

				$("#in_btn_scholarship").click(function(){
					$("#scholarship_edit_now").toggle();
				});
				
				$("#btn_high").click(function(){
					$("#high_edit_now").toggle();
				});

				$("#in_btn_high").click(function(){
					$("#high_edit_now").toggle();
				});

				$("#btn_elementary").click(function(){
					$("#elementary_edit_now").toggle();
				});

				$("#in_btn_elementary").click(function(){
					$("#elementary_edit_now").toggle();
				});
			});

		</script>
		


</body>
</html>
