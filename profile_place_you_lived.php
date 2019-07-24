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
    <title>Current City and Hometown - MSU-TCTO S-ECE</title>

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
				<a href="?profile_place_you_lived=true&profile=true" style="padding-right: 20px; font-size: 15px; border-left: 3px solid blue; padding-left: 10px;">Current City and Hometown</a><br><br>
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
					$query = "SELECT current_street, current_barangay, hometown_street, hometown_barangay, hometown_city, hometown_province FROM accounts_info WHERE id_number = '$searched_id_number' AND college != ''";
				}else{
					$query = "SELECT current_street, current_barangay, hometown_street, hometown_barangay, hometown_city, hometown_province FROM accounts_info WHERE id_number = '$id_number' AND college != ''";
				}
				$query_run = mysql_query($query);
					while($query_row = mysql_fetch_assoc($query_run)){
						echo '	<div style="width: 60%; padding-left: 3%;">
									<h3>CURRENT CITY</h3><hr>
									<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
										<img src="bongao.png" class="img-circle" />
										<div width: 100px;">
										<p style="font-weight: normal; text-indent: 5px; font-size: 16px; margin: 1px; line-height: 18px; color: skyblue;">Bongao</p>
										<p style="font-weight: normal; text-indent: 5px; font-size: 13px; margin: 1px; color: grey;">Current City</p>
										</div>
										<hr style="border-width: 1px">
									</div>
									<hr>
									<label style="color: #03d3db; font-weight: normal;">Address: </label><label style="font-weight: normal; text-indent: 20px; width: 88%;"> '.$query_row['current_street'].' '.$query_row['current_barangay'].' Bongao Tawi-Tawi';

									if(empty($searched_id_number) AND $role != 'Parent'){
										echo '<label id="current_address_edit" style="float: right; font-size: 13px;"><a id="btn_current_address" style="float: right; font-size: 11px;"><span class="glyphicon glyphicon-pencil"> </span> Edit</a></label>';
									}

									echo '</label>

									<div id="current_address_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_place_you_lived=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Street: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="current_street" value="'.$query_row['current_street'].'" />
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Barangay: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="current_barangay" value="'.$query_row['current_barangay'].'" />
												</div>
											</div>
											<br>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_current_address" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

									<hr style="border-width: 1px">


									<h3>HOMETOWN</h3><hr>
									<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
										<span class="glyphicon glyphicon-map-marker" style="font-size: 28px;" ></span>
										<div width: 100px;">
										<p style="font-weight: normal; text-indent: 13px; font-size: 16px; margin: 1px; line-height: 18px; color: skyblue;">';

										if(!empty($query_row['hometown_city'])){
											echo $query_row['hometown_city'];
										}else{
											echo 'City is not Specified';
										}

										echo '</p>
										<p style="font-weight: normal; text-indent: 13px; font-size: 13px; margin: 1px; color: grey;">Hometown</p>
										</div>
										<hr style="border-width: 1px">
									</div>
									<hr>
									<label style="color: #03d3db; font-weight: normal;">Address: </label><label style="font-weight: normal; text-indent: 20px; width: 88%;"> ';

									if(empty($query_row['hometown_street']) and empty($query_row['hometown_barangay']) and empty($query_row['hometown_city']) and empty($query_row['hometown_province'])){
										echo 'Not Specified';
									}else{
										echo $query_row['hometown_street'] . ' ' . $query_row['hometown_barangay'] . ' ' . $query_row['hometown_city'] . ' ' . $query_row['hometown_province'];
									}

									if(empty($searched_id_number) AND $role != 'Parent'){
										echo '<label id="hometown_address_edit" style="float: right; font-size: 13px;"><a id="btn_address" style="float: right; font-size: 11px;"><span class="glyphicon glyphicon-pencil"> </span> Edit</a></label>';
									}

									echo '</label>

									<div id="address_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_place_you_lived=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Street: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="street" value="'.$query_row['hometown_street'].'" />
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Barangay: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="barangay" value="'.$query_row['hometown_barangay'].'" />
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													City: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="city" value="'.$query_row['hometown_city'].'" />
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Province: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="province" value="'.$query_row['hometown_province'].'" />
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_address" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>

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
				$("#btn_address").click(function(){
					$("#address_edit_now").toggle();
				});

				$("#in_btn_address").click(function(){
					$("#address_edit_now").toggle();
				});

				$("#btn_current_address").click(function(){
					$("#current_address_edit_now").toggle();
				});

				$("#in_btn_current_address").click(function(){
					$("#current_address_edit_now").toggle();
				});

			});

		</script>
		


</body>
</html>
