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
    <title>Change Password - MSU-TCTO S-ECE</title>

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
		
		<div id="page-wrapper">
			<h3> Change Password </h3><br><br>
			
			<div class="row">
				<form action="index.php?change_password=true" method="post">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-3 col-md-offset-1">
								<label style="color: #03d3db; font-weight: normal;">Current Password:</label> 
							</div>
							<div class="col-md-6">
								<input type="Password" name="current_password" class="form-control" required>
								<?php
									if(isset($mark)){
										echo '<center style="color: coral;">Incorrect Password</center>';
									}
								?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3 col-md-offset-1">
								<label style="color: #03d3db; font-weight: normal;">New Password:</label> 
							</div>
							<div class="col-md-6">
								<input type="Password" name="new_password" class="form-control" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{10,}" title="Give atleast 1 number, 1 uppercase and lowercase, and atleast 10 or more characters" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3 col-md-offset-1">
								<label style="color: #03d3db; font-weight: normal;">Confirm Password:</label> 
							</div>
							<div class="col-md-6">
								<input type="Password" name="confirm_password" class="form-control" required>
								<?php
									if(isset($mark1)){
										echo '<center style="color: coral;">Password Do Not Match</center>';
									}
								?>
							</div>
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-block btn-success">Save Changes</button>
							</div>
						</div>
						<br>
						<br>
						<br>
						<div class="row">
							<div class="col-md-6 col-md-offset-4">
								<?php
									if(isset($mark2)){
										echo '<center style="color: lime;">Password Changed</center>';
									}
								?>
							</div>
						</div>
					</div>
				</form>
			</div>
				
		</div>
		


</body>
</html>
