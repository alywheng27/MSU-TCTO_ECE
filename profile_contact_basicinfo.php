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
    <title>Contact and Basic Info  - MSU-TCTO S-ECE</title>

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
				<a href="?profile_educational_background=true&profile=true" style="padding-right: 20px; font-size: 15px;">Educational Background</a><br><br>
				<a href="?profile_place_you_lived=true&profile=true" style="padding-right: 20px; font-size: 15px;">Current City and Hometown</a><br><br>
				<a href="?profile_contact_basicinfo=true&profile=true" style="padding-right: 20px; font-size: 15px; border-left: 3px solid blue; padding-left: 10px;">Contact and Basic Info</a><br><br>
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
					$query = "SELECT accounts.id_number, first_name, middle_name, last_name, profile_photo, role, contact_number, parent_contact_number, email_address, parent_email_address, born, religious_view FROM accounts
							JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$searched_id_number' AND role != 'Parent'";
				}else{
					$query = "SELECT accounts.id_number, first_name, middle_name, last_name, profile_photo, role, contact_number, parent_contact_number, email_address, parent_email_address, born, religious_view FROM accounts
							JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$id_number' AND role != 'Parent'";
				}
				$query_run = mysql_query($query);
					while($query_row = mysql_fetch_assoc($query_run)){
						echo '	<div style="width: 60%; padding-left: 3%;">
									<h3>BASIC INFORMATION</h3><hr>
									<img src="data:image/jpeg;base64,'.base64_encode($query_row['profile_photo']).'" class="img-thumbnail" style="width: 280px"/><br>
									<label style="color: #03d3db; text-indent: 95px; font-weight: normal; margin-top: 10px; width: 95%;">Profile Picture';

									if($role == 'Administrator'){
										echo '<label id="pic_edit" style="float: right; font-size: 13px;"><a id="btn_pic" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="pic_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST"  enctype="multipart/form-data">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Profile Picture: 
												</div>
												<div class="col-md-6">
													<input type="file" class="form-control" name="image" />
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" name="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_pic" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">ID Number: </label><label style="font-weight: normal; margin-left: 49px;"> '.$query_row['id_number'].'</label><hr style="border-width: 1px">
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Name: </label><label style="font-weight: normal; margin-left: 80px; width: 72%;"> '.$query_row['first_name'].' '.$query_row['middle_name'].' '.$query_row['last_name'].'';

									if($role == 'Administrator'){
										echo '<label id="name_edit" style="float: right; font-size: 13px;"><a id="btn_name" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="name_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													First Name: 
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="first_name" value="'.$query_row['first_name'].'" />
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Middle Name: 
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="middle_name" value="'.$query_row['middle_name'].'" />
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Last Name: 
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="last_name" value="'.$query_row['last_name'].'" />
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_name" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Status: </label><label style="font-weight: normal; margin-left: 88px; width: 72%;"> '.$query_row['role'].'';

									if($role == 'Administrator'){
										echo '<label id="role_edit" style="float: right; font-size: 13px;"><a id="btn_role" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="role_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Status: 
												</div>
												<div class="col-md-6">
													<select class="form-control" name="role1">
														<option value="Student">Student</option>
														<option value="Instructor">Instructor</option>
													</select>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_role" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Born On: </label><label style="font-weight: normal; margin-left: 65px; width: 72%;"> ';

									if(!empty($query_row['born'])){
										echo $query_row['born'];
									}else{
										echo 'None';
									}

									if(empty($searched_id_number) AND $role != 'Parent'){
										echo '<label id="born_edit" style="float: right; font-size: 13px;"><a id="btn_born" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="born_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Month: 
												</div>
												<div class="col-md-5">
													<select class="form-control" name="month">
														<option value="January">January</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
													</select>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Day: 
												</div>
												<div class="col-md-5">
													<select class="form-control" name="day">
													';

														for ($i=1; $i <= 31; $i++) { 
															echo "<option value=".$i.">$i</option>";
														}

													echo '
													</select>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Year: 
												</div>
												<div class="col-md-5">
													<select class="form-control" name="year">
														';
														$date = date('Y') - 10;

														for ($i=$date; $i > $date - 30; $i--) { 
															echo "<option value=".$i.">$i</option>";
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
													<button type="button" id="in_btn_born" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">

									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Religious Views: </label><label style="font-weight: normal; margin-left: 19px; width: 72%;"> ';

									if(!empty($query_row['religious_view'])){
										echo $query_row['religious_view'];
									}else{
										echo 'None';
									}

									if(empty($searched_id_number) AND $role != 'Parent'){
										echo '<label id="religious_view_edit" style="float: right; font-size: 13px;"><a id="btn_religious_view" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}




									echo '</label>

									<div id="religius_view_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Religion: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="religious_view" value="'.$query_row['religious_view'].'" />
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_religious_view" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">

									<h3>CONTACT INFORMATION</h3><hr>
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;"></span>Mobile Phone: </label><label style="font-weight: normal; margin-left: 25px; width: 72%;"> ';

									if(!empty($query_row['contact_number'])){
										echo '+63' . $query_row['contact_number'];
									}else{
										echo 'None';
									}

									if(empty($searched_id_number) AND $role != 'Parent'){
										echo '<label id="number_edit" style="float: right; font-size: 13px;"><a id="btn_number" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="number_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Number: 
												</div>
												<div class="col-md-5">
													<div class="row">
														<div class="col-md-1" style="margin-top: 7.5px;">
															+63
														</div>
														<div class="col-md-10">
															<input type="text" pattern="[0-9].{9,9}" title="Enter 10 digits" class="form-control" name="number" value="'.$query_row['contact_number'].'" />
														</div>
													</div>
													
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_number" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>';

									if(isset($exist_number)){
										echo '<center style="color: coral;">Contact Number is already Used</center>';
									}
									echo '<hr style="border-width: 1px">

									<h3>EMAIL ADDRESS</h3><hr>
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Email Address: </label><label style="font-weight: normal; margin-left: 27px; width: 72%;"> ';

									if(!empty($query_row['email_address'])){
										echo $query_row['email_address'];
									}else{
										echo 'None';
									}

									if(empty($searched_id_number) AND $role != 'Parent'){
										echo '<label id="email_edit" style="float: right; font-size: 13px;"><a id="btn_email" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}


									echo '</label>

									<div id="email_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Email: 
												</div>
												<div class="col-md-5">
													<input type="email" class="form-control" name="email" value="'.$query_row['email_address'].'" />
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_email" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>';

									if(isset($exist_email)){
										echo '<center style="color: coral;">Email Address is already Used</center>';
									}
									echo '<hr style="border-width: 1px">';

									if(!empty($searched_id_number)){
										$query1 = "SELECT first_name, middle_name, last_name, profile_photo, role, parent_contact_number, parent_email_address FROM accounts
												JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$searched_id_number' AND role = 'Parent'";
									}else{
										$query1 = "SELECT first_name, middle_name, last_name, profile_photo, role, parent_contact_number, parent_email_address FROM accounts
												JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$id_number' AND role = 'Parent'";
									}
									$query_run1 = mysql_query($query1);

									while($query_row1 = mysql_fetch_assoc($query_run1)){
										echo '<h3>PARENT INFORMATION</h3><hr>
										<img src="data:image/jpeg;base64,'.base64_encode($query_row1['profile_photo']).'" class="img-thumbnail" style="width: 280px"/><br>
										<label style="color: #03d3db; text-indent: 95px; font-weight: normal; margin-top: 10px; width: 95%;">Profile Picture';
									

									if(empty($searched_id_number) AND $role == 'Parent'){
										echo '<label id="pic_edit" style="float: right; font-size: 13px;"><a id="btn_parent_pic" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="parent_pic_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST"  enctype="multipart/form-data">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Profile Picture: 
												</div>
												<div class="col-md-6">
													<input type="file" class="form-control" name="parent_image" />
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" name="submit_parent" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_parent_pic" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">

									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Name: </label><label style="font-weight: normal; margin-left: 80px; width: 71.5%;">';

									if(!empty($query_row1['first_name']) or !empty($query_row1['middle_name']) or !empty($query_row1['last_name'])){
										echo $query_row1['first_name'] . ' ' . $query_row1['middle_name'] . ' ' . $query_row1['last_name'];
									}else{
										echo 'Not Set';
									}

									if(empty($searched_id_number) AND $role == 'Parent'){
										echo '<label id="parent_name_edit" style="float: right; font-size: 13px;"><a id="btn_parent_name" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="parent_name_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													First Name: 
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="parent_first_name" value="'.$query_row1['first_name'].'" />
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Middle Name: 
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="parent_middle_name" value="'.$query_row1['middle_name'].'" />
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Last Name: 
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="parent_last_name" value="'.$query_row1['last_name'].'" />
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_parent_name" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">';

									echo '<label style="color: #03d3db; text-indent: 10px; font-weight: normal;"></span>Parent Phone:</label><label style="font-weight: normal; margin-left: 25px; width: 73%;"> ';

									if(!empty($query_row['parent_contact_number'])){
										echo '+63' . $query_row['parent_contact_number'];
									}else{
										echo 'None';
									}

									if(empty($searched_id_number) AND $role == 'Parent'){
										echo '<label id="number_edit" style="float: right; font-size: 13px;"><a id="btn_parent_number" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}

									echo '</label>

									<div id="parent_number_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Number: 
												</div>
												<div class="col-md-5">
													<div class="row">
														<div class="col-md-1" style="margin-top: 7.5px;">
															+63
														</div>
														<div class="col-md-10">
															<input type="text" pattern="[0-9].{9,9}" title="Enter 10 digits" class="form-control" name="parent_number" value="'.$query_row['parent_contact_number'].'" />
														</div>
													</div>
													
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_parent_number" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>';

									if(isset($exist_parent_number)){
										echo '<center style="color: coral;">Contact Number is already Used</center>';
									}
									echo '<hr style="border-width: 1px">

									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Parent Email: </label><label style="font-weight: normal; margin-left: 37px; width: 72%;"> ';

									if(!empty($query_row['parent_email_address'])){
										echo $query_row['parent_email_address'];
									}else{
										echo 'None';
									}

									if(empty($searched_id_number) AND $role == 'Parent'){
										echo '<label id="email_edit" style="float: right; font-size: 13px;"><a id="btn_parent_email" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label>';
									}


									echo '</label>

									<div id="parent_email_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_contact_basicinfo=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Email: 
												</div>
												<div class="col-md-5">
													<input type="email" class="form-control" name="parent_email" value="'.$query_row['parent_email_address'].'" />
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_parent_email" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>';

									if(isset($exist_parent_email)){
										echo '<center style="color: coral;">Email Address is already Used</center>';
									}
									echo '<hr style="border-width: 1px">';

									}
								echo '</div>
								
								</div>
								
							';
					}
			?>
		</div>

		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<script type="text/javascript">

			$(document).ready(function(){
				$("#btn_born").click(function(){
					$("#born_edit_now").toggle();
				});

				$("#in_btn_born").click(function(){
					$("#born_edit_now").toggle();
				});

				$("#btn_pic").click(function(){
					$("#pic_edit_now").toggle();
				});

				$("#in_btn_pic").click(function(){
					$("#pic_edit_now").toggle();
				});
				
				$("#btn_parent_pic").click(function(){
					$("#parent_pic_edit_now").toggle();
				});

				$("#in_btn_parent_pic").click(function(){
					$("#parent_pic_edit_now").toggle();
				});
				
				$("#btn_name").click(function(){
					$("#name_edit_now").toggle();
				});

				$("#in_btn_parent_name").click(function(){
					$("#name_edit_now").toggle();
				});
				
				$("#btn_parent_name").click(function(){
					$("#parent_name_edit_now").toggle();
				});

				$("#in_btn_parent_name").click(function(){
					$("#parent_name_edit_now").toggle();
				});
				
				$("#btn_role").click(function(){
					$("#role_edit_now").toggle();
				});

				$("#in_btn_role").click(function(){
					$("#role_edit_now").toggle();
				});
				
				$("#btn_religious_view").click(function(){
					$("#religius_view_edit_now").toggle();
				});

				$("#in_btn_religious_view").click(function(){
					$("#religius_view_edit_now").toggle();
				});

				$("#btn_number").click(function(){
					$("#number_edit_now").toggle();
				});

				$("#in_btn_number").click(function(){
					$("#number_edit_now").toggle();
				});

				$("#btn_parent_number").click(function(){
					$("#parent_number_edit_now").toggle();
				});

				$("#in_btn_parent_number").click(function(){
					$("#parent_number_edit_now").toggle();
				});
				
				$("#btn_email").click(function(){
					$("#email_edit_now").toggle();
				});

				$("#in_btn_email").click(function(){
					$("#email_edit_now").toggle();
				});

				$("#btn_parent_email").click(function(){
					$("#parent_email_edit_now").toggle();
				});

				$("#in_btn_parent_email").click(function(){
					$("#parent_email_edit_now").toggle();
				});

			});

		</script>
		


</body>
</html>
