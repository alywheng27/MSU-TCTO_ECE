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
    <title>Profile - MSU-TCTO S-ECE</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

   
    
</head>
<body>
	<div id="wrapper">
        
    	<!--    navbar         -->
			<?php include 'navbars.php'; ?>
		<!--    navbar         -->
		
		<form method="GET" action="search_profile.php">
		<div style="display: -webkit-box; -webkit-box-orient: horizontal; width: 22%; position: relative; left: 68%;">
			<input type="text" class="form-control" placeholder="Search by ID Number" name="search_profile" style="margin-top: 3px;"/>
			<button type="submit" class="btn btn-primary glyphicon glyphicon-search" style="margin-left: 5px;"></button>
		</div><br>
		</form>
		
		<div id="page-wrapper" style="width: 90%; margin-left: 5%; border-top: 1px solid #767676;">

			<div class="row">
				<form action="index.php?add_user=true" method="post" enctype="multipart/form-data">
					<div class="col-md-5" style="margin-left: 20px;">
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">ID Number:</label>
							</div>
							<div class="col-md-7">
								<input list="id_number" name="id_number_add" class="form-control" required>
								<datalist id="id_number">
								<?php
									$query1 = "SELECT id_number FROM accounts WHERE role = 'Student'";
									$query_run1 = mysql_query($query1);

									while($query_row1 = mysql_fetch_assoc($query_run1)){
										echo '<option value="'.$query_row1['id_number'].'"></option>';
									}
								?>
								</datalist>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">Password:</label>
							</div>
							<div class="col-md-7">
								<input type="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{10,}" name="password_add" class="form-control" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">First Name:</label>
							</div>
							<div class="col-md-7">
								<input type="text" name="first_name_add" class="form-control" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">Middle Name:</label>
							</div>
							<div class="col-md-7">
								<input type="text" name="middle_name_add" class="form-control" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">Last Name:</label>
							</div>
							<div class="col-md-7">
								<input type="text" name="last_name_add" class="form-control" required>
							</div>
						</div>
						
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">Profile Picture:</label>
							</div>
							<div class="col-md-6">
								<input type="file" name="profile_picture_add" class="form-control" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">Role:</label>
							</div>
							<div class="col-md-6">
								<select name="role_add" class="form-control">
									<option value="Parent">Parent</option>
									<option value="Administrator">Administrator</option>
								</select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">Contact Number:</label>
							</div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-1" style="margin-top: 7.5px;">
										+63
									</div>
									<div class="col-md-7">
										<input type="text" pattern="[0-9].{9,9}" title="Enter 10 digits" class="form-control" name="number_add" required/>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label style="color: #03d3db; font-weight: normal;">Email Address:</label>
							</div>
							<div class="col-md-6">
								<input type="email" name="email_add" class="form-control" required>
							</div>
						</div>
						<br>
						<br>
						<br>
						<br>
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<button type="submit" name="submit" class="btn btn-block btn-success">Add User</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			
		</div>
	</div>
		


</body>
</html>
