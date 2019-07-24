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
    <title>Family and Relationship - MSU-TCTO S-ECE</title>

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
				<a href="?profile_contact_basicinfo=true&profile=true" style="padding-right: 20px; font-size: 15px;">Contact and Basic Info</a><br><br>
				<a href="?profile_family_and_relationship=true&profile=true" style="padding-right: 20px; font-size: 15px;  border-left: 3px solid blue; padding-left: 10px;">Family and Relationship</a><br><br>
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
					$query1 = "SELECT relationship_id_number FROM accounts WHERE id_number = '$searched_id_number' AND role != 'Parent'";
				}else{
					$query1 = "SELECT relationship_id_number FROM accounts WHERE id_number = '$id_number' AND role != 'Parent'";
				}
				$query_run1 = mysql_query($query1);
				$relationship_id_number = mysql_result($query_run1, 0, 'relationship_id_number');

				$query2 = "SELECT first_name, last_name, profile_photo FROM accounts WHERE id_number = '$relationship_id_number' AND role != 'Parent'";
				$query_run2 = mysql_query($query2);

				echo '<div style="width: 60%; padding-left: 3%;">';
				if(!empty($relationship_id_number)){
					while($query_row = mysql_fetch_assoc($query_run2)){
						echo '	
									<h3>RELATIONSHIP</h3><hr>
									<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
										<img src="data:image/jpeg;base64,'.base64_encode($query_row['profile_photo']).'" class="img-circle" style="width: 45px; height: 40px;"/>
										<div style="width: 90%;">
										<p style="font-weight: normal; text-indent: 5px; font-size: 16px; margin: 1px; line-height: 18px; color: skyblue;">'.$query_row['first_name'].' '.$query_row['last_name'].'';

										if(empty($searched_id_number) AND $role != 'Parent' AND empty($sent_mark) AND empty($receive_mark)){
											echo '<label style="float: right; font-size: 13px; margin-top: 7px;"><a href="?profile_family_and_relationship=true&profile=true&break='.$relationship_id_number.'" style="padding: 8px;" class="btn-sm btn-danger">Break Up</a></label>';
										}

										echo '</p>
										<p style="font-weight: normal; text-indent: 5px; font-size: 13px; margin: 1px; color: grey;">In a Relationship with</p>

										</div>
										<hr style="border-width: 1px">
									</div>
									<hr>	
						';
					}
				}else{
						echo '	
									<h3>RELATIONSHIP</h3><hr>
									<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
										<span class="glyphicon glyphicon-heart" style="font-size: 40px; width: 45px; height: 40px;"></span>
										<div style="width: 90%;">
										<p style="font-weight: normal; text-indent: 5px; font-size: 20px; margin: 10px; line-height: 18px; color: skyblue;"> No Relationship';

										if(empty($searched_id_number) AND $role != 'Parent' AND empty($sent_mark) AND empty($receive_mark)){
											echo '<label id="relationship_edit" style="float: right; font-size: 13px;"><a  id="btn_relationship" style="float: right;"><span class="glyphicon glyphicon-pencil"> Add</a></label>';
										}

										echo '
										</div>
										<hr style="border-width: 1px">
									</div>
									<div id="relationship_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_family_and_relationship=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													ID Number: 
												</div>
												<div class="col-md-5">
													<input list="id_number" name="relation_id_number" value="'.$relationship_id_number.'" class="form-control" required>
													<datalist id="id_number">';
														$query2 = "SELECT id_number FROM accounts WHERE (role = 'Student' or role = 'Instructor') and id_number != '$id_number' ";
														$query_run2 = mysql_query($query2);

														while($query_row2 = mysql_fetch_assoc($query_run2)){
															echo '<option value="'.$query_row2['id_number'].'"></option>';
														}
													echo '</datalist>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Send Request</button>
													<button type="button" id="in_btn_relationship" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>';

									$query3 = "SELECT first_name, last_name FROM accounts WHERE id_number = '$receive_mark' AND role != 'Parent' ";
									$query_run3 = mysql_query($query3);
									if(@$first_name_mark = mysql_result($query_run3, 0, 'first_name')){}
									if(@$last_name_mark = mysql_result($query_run3, 0, 'last_name')){}

									if(isset($exist_mark)){
										echo '<br><br><center style="color: coral;">ID Number does not exist</center>';
									}else if(!empty($sent_mark) AND $role != 'Parent' and $role != 'Administrator'){
										echo '<br><br><center style="color: skyblue; font-size: 16px;"><span style="color: red; font-size: 20px;" class="glyphicon glyphicon-heart"></span> You sent a Request. . . <a href="?profile_family_and_relationship=true&profile=true&cancel_request=true" class="btn btn-danger" style="margin-left: 20px; padding: 5px; padding-left: 10px; padding-right: 10px;" >Cancel</a></center>';
									}else if(!empty($receive_mark)){
										echo '<br><br><center style="color: skyblue; font-size: 16px;"><span style="color: red; font-size: 20px;" class="glyphicon glyphicon-heart"></span> '.$first_name_mark.' '.$last_name_mark.' sent a Request<a href="?profile_family_and_relationship=true&profile=true&accept_request='.$receive_mark.'" class="btn btn-success" style="margin-left: 20px; padding: 5px; padding-left: 10px; padding-right: 10px;" >Accept</a> <a href="?profile_family_and_relationship=true&profile=true&decline_request=true" class="btn btn-danger" style="margin-left: 20px; padding: 5px; padding-left: 10px; padding-right: 10px;" >Decline</a></center>';
									}else if(isset($relation_mark)){
										echo '<br><br><center style="color: coral;">Invalid ID Number</center>';
									}else if(isset($taken_mark)){
										echo '<br><br><center style="color: coral;">Already in a Relationship</center>';
									}else if(isset($requested_mark)){
										echo '<br><br><center style="color: coral;">Already Requested</center>';
									}

									echo '<hr>
						';
				}
				echo '<h3>FAMILY MEMBERS</h3><hr>';
				if(!empty($searched_id_number)){
					$query = "SELECT family_id_number FROM family_members WHERE id_number = '$searched_id_number' ";
					$query_run = mysql_query($query);
				}else{
					$query = "SELECT family_id_number FROM family_members WHERE id_number = '$id_number' ";
					$query_run = mysql_query($query);
				}
				

				if(mysql_num_rows($query_run) > 0){
					while($query_row = mysql_fetch_assoc($query_run)){
						$query1 = "SELECT first_name, last_name, profile_photo FROM accounts WHERE id_number = '".$query_row['family_id_number']."' ";
						$query_run1 = mysql_query($query1);

						if(mysql_num_rows($query_run1) > 0){
							echo '<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
										<img src="data:image/jpeg;base64,'.base64_encode(mysql_result($query_run1, 0, 'profile_photo')).'" class="img-circle" style="width: 45px; height: 40px;"/>
										<div style="width: 90%;">
										<p style="font-weight: normal; text-indent: 5px; font-size: 16px; margin: 1px; line-height: 18px; color: skyblue;">'.mysql_result($query_run1, 0, 'first_name').' '.mysql_result($query_run1, 0, 'last_name').'';

										if(empty($searched_id_number) AND $role != 'Parent'){
											echo '<label style="float: right; font-size: 13px; margin-top: 7px;"><a href="?profile_family_and_relationship=true&profile=true&remove='.$query_row['family_id_number'].'" style="padding: 8px;" class="btn-sm btn-danger">Remove</a></label>';
										}

										echo '</p>
										<p style="font-weight: normal; text-indent: 5px; font-size: 13px; margin: 1px; color: grey;"> Family Member </p>

										</div>
										<hr style="border-width: 1px">
									</div>
									<hr>	
						';
						}
					}
				}
				

				echo '<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
						<span class="glyphicon glyphicon-user" style="font-size: 40px; width: 45px; height: 40px;"></span>
						<div style="width: 90%;">
						<p style="font-weight: normal; text-indent: 5px; font-size: 20px; margin: 10px; line-height: 18px; color: skyblue;"> Add Family Members';

						if(empty($searched_id_number) AND $role != 'Parent'){
							echo '<label id="family_edit" style="float: right; font-size: 13px;"><a  id="btn_family" style="float: right;"><span class="glyphicon glyphicon-pencil"> Add</a></label>';
						}

						echo '
						</div>
						<hr style="border-width: 1px">
					</div>
					<div id="family_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
						<form action="index.php?profile_family_and_relationship=true&profile=true" method="POST">
							<div class="row">
								<div class="col-md-3 col-md-offset-1">
									ID Number: 
								</div>
								<div class="col-md-5">
									<input list="id_number" name="family_id_number" class="form-control" required>
									<datalist id="id_number">';
										$query2 = "SELECT id_number FROM accounts WHERE (role = 'Student' or role = 'Instructor') and id_number != '$id_number' ";
										$query_run2 = mysql_query($query2);

										while($query_row2 = mysql_fetch_assoc($query_run2)){
											echo '<option value="'.$query_row2['id_number'].'"></option>';
										}
									echo '</datalist>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-3 col-md-offset-1">
								</div>
								<div class="col-md-5">
									<button type="submit" class="btn-sm btn-info">Send Request</button>
									<button type="button" id="in_btn_family" class="btn-sm btn-warning">Cancel</button>
								</div>
							</div>
						</form>
					</div>';

					$query = "SELECT family_id_number_request FROM family_members WHERE id_number = '$id_number' ";
					$query_run = mysql_query($query);

					while($query_row = mysql_fetch_assoc($query_run)){
						if(!empty($query_row['family_id_number_request'])){
							$query1 = "SELECT first_name, last_name, profile_photo FROM accounts WHERE id_number = '".$query_row['family_id_number_request']."' ";
							$query_run1 = mysql_query($query1);
							echo '<br><br><center style="color: skyblue; font-size: 16px;"><span style="color: dimgrey; font-size: 20px;" class="glyphicon glyphicon-user"></span> You sent a request to '.mysql_result($query_run1, 0, 'first_name').' '.mysql_result($query_run1, 0, 'last_name').' <a href="?profile_family_and_relationship=true&profile=true&cancel_family='.$query_row['family_id_number_request'].'" class="btn btn-danger" style="margin-left: 20px; padding: 5px; padding-left: 10px; padding-right: 10px;" >Cancel</a></center>';
						}
					}

					$query = "SELECT id_number FROM family_members WHERE family_id_number_request = '$id_number' ";
					$query_run = mysql_query($query);

					while($query_row = mysql_fetch_assoc($query_run)){
						$query1 = "SELECT first_name, last_name, profile_photo FROM accounts WHERE id_number = '".$query_row['id_number']."' ";
						$query_run1 = mysql_query($query1);
						echo '<br><br><center style="color: skyblue; font-size: 16px;"><span style="color: dimgrey; font-size: 20px;" class="glyphicon glyphicon-user"></span> '.mysql_result($query_run1, 0, 'first_name').' '.mysql_result($query_run1, 0, 'last_name').' sent a Request <a href="?profile_family_and_relationship=true&profile=true&accept_family='.$query_row['id_number'].'" class="btn btn-success" style="margin-left: 20px; padding: 5px; padding-left: 10px; padding-right: 10px;" >Accept</a> <a href="?profile_family_and_relationship=true&profile=true&decline_family='.$query_row['id_number'].'" class="btn btn-danger" style="margin-left: 20px; padding: 5px; padding-left: 10px; padding-right: 10px;" >Decline</a></center>';
					}

					echo '<hr>';

					$query = "SELECT ";
					if(isset($family_id_number_exist)){
						echo '<br><br><center style="color: coral;">ID Number does not exist</center>';
					}else if(isset($double_mark)){
						echo '<br><br><center style="color: coral;">Invalid ID Number</center>';
					}else if(isset($already_family)){
						echo '<br><br><center style="color: coral;">Already your Family Member</center>';
					}else if(isset($family_requested)){
						echo '<br><br><center style="color: coral;">Already Requested</center>';
					}else if(isset($someone_requested)){
						$query = "SELECT first_name, last_name FROM accounts WHERE id_number = '$someone_requested' AND role != 'Parent'";
						$query_run = mysql_query($query);
						echo '<br><br><center style="color: coral;">'.mysql_result($query_run, 0, 'first_name').' '.mysql_result($query_run, 0, 'last_name').' already Requested</center>';
					}

				echo '</div>';

			?>
				
		</div>
		
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<script type="text/javascript">

			$(document).ready(function(){
				$("#btn_relationship").click(function(){
					$("#relationship_edit_now").toggle();
				});

				$("#in_btn_relationship").click(function(){
					$("#relationship_edit_now").toggle();
				});

				$("#btn_family").click(function(){
					$("#family_edit_now").toggle();
				});

				$("#in_btn_family").click(function(){
					$("#family_edit_now").toggle();
				});


			});

		</script>

</body>
</html>
