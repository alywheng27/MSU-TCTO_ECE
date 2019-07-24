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
    <title>Profile Overview - MSU-TCTO S-ECE</title>

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
				<a href="?profile=true" style="padding-right: 20px; font-size: 15px; border-left: 3px solid blue; padding-left: 10px;">Overview</a><br><br>
				<a href="?profile_educational_background=true&profile=true" style="padding-right: 20px; font-size: 15px;">Educational Background</a><br><br>
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
					$query = "SELECT accounts.id_number, first_name, middle_name, last_name, role, course, major, scholarship, contact_number, email_address, hometown_city, high_school, elementary_school, born FROM accounts
							JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '".mysql_real_escape_string($searched_id_number)."' AND role != 'Parent' AND college != ''";
				}else{
					$query = "SELECT accounts.id_number, first_name, middle_name, last_name, role, course, major, scholarship, contact_number, email_address, hometown_city, high_school, elementary_school, born FROM accounts
							JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$id_number' AND role != 'Parent' AND college != ''";
				}
				$query_run = mysql_query($query);
					while($query_row = mysql_fetch_assoc($query_run)){
						echo '	<div style="width: 40%; padding-left: 3%;">
									
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">ID Number: </label><label style="font-weight: normal; margin-left: 10px;"> '.$query_row['id_number'].'</label><hr style="border-width: 1px">
									<label style="color: #03d3db; text-indent: 10px; font-weight: normal;">Name: </label><label style="font-weight: normal; margin-left: 10px;"> '.$query_row['first_name'].' '.$query_row['middle_name'].' '.$query_row['last_name'].'</label><hr style="border-width: 1px">
									<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
										<img src="MSU TCTO SEAL.png" class="img-circle" />
										<div>
											<label style="font-weight: normal; margin-left: 10px;"><span style="color: #03d3db;">';
											if($query_row['role'] == 'Instructor'){
												echo 'Working';
											}else{
												echo 'Studies';
											}
											
											echo '</span> '.$query_row['course'].' <span style="color: #03d3db;">at</span> MSU Tawi-Tawi College of Technology and Oceanography</label><br>
											<label style="font-weight: normal; margin-left: 10px; font-size: 13px;"><span style="color: #cacaca;">';
											if(!empty($query_row['high_school']) and !empty($query_row['elementary_school'])){
												echo 'Past:</span> '.$query_row['high_school'].' <span style="color: #cacaca;">and</span> '.$query_row['elementary_school'].'</label><br>';
											}
											

										echo '</div>
									</div>
									<hr style="border-width: 1px">
									<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
										<img src="bongao.png" class="img-circle" />
										<div>
											<label style="font-weight: normal; margin-left: 10px;"><span style="color: #03d3db;">Lives in </span>Bongao</label><br>
											<label style="font-weight: normal; margin-left: 10px; font-size: 13px;"><span style="color: #cacaca;">';

											if(!empty($query_row['hometown_city'])){
												echo 'From:</span> '.$query_row['hometown_city'].'</label><br>';
											}
											
										echo '</div>
									</div>
									<hr>

								</div>
								<div style="width: 40%; padding-left: 3%;">';

									if(!empty($query_row['contact_number'])){
										echo '<label style="color: #03d3db; text-indent: 10px; font-weight: normal;"><span class="glyphicon glyphicon-phone"></span> </label></label><label style="font-weight: normal; margin-left: 10px;"> +63'.$query_row['contact_number'].'</label><br><br>';
									}
									
									if(!empty($query_row['email_address'])){
										echo '<label style="color: #03d3db; text-indent: 10px; font-weight: normal;"><span class="glyphicon glyphicon-envelope"></span> </label></label><label style="font-weight: normal; margin-left: 10px;"> '.$query_row['email_address'].'</label><br><br>';
									}
									
									if(!empty($query_row['born'])){
										echo '<label style="color: #03d3db; text-indent: 10px; font-weight: normal;"><span class="glyphicon glyphicon-gift"></span> </label></label><label style="font-weight: normal; margin-left: 10px;"> '.$query_row['born'].'</label><br><br><br><br><br>';
									}
									

									if($role == 'Administrator'){
										$query1 = "SELECT blocked FROM accounts WHERE id_number = '$searched_id_number' AND role != 'Parent'";
										$query_run1 = mysql_query($query1);

										if(mysql_result($query_run1, 0, 'blocked') == '0'){

											echo '	<form action="index.php?profile=true" method="post" enctype="multipart/form-data">
														<center><button type="submit" name="block" class="btn btn-danger" style="padding-left: 30px; padding-right: 30px;">Block</button></center>
													</form>';
											
										}else{
											echo '	<form action="index.php?profile=true" method="post" enctype="multipart/form-data">
														<center><button type="submit" name="unblock" class="btn btn-warning" style="padding-left: 30px; padding-right: 30px;">Unblock</button></center>
													</form>';
											
										}
										echo '<br><br>';
										if(isset($block_mark)){
											echo '<center style="color: coral;">Block Successfully</center>';
										}else if(isset($unblock_mark)){
											echo '<center style="color: lime;">Unblock Successfully</center>';
										}
										
									}

									if(isset($_GET['exist_mark'])){
										echo '<center style="color: coral;">ID Number doesn\'t exist</center>';
									}
									
								echo '</div> ';
					}
					
			?>
			
		</div>
		


</body>
</html>
