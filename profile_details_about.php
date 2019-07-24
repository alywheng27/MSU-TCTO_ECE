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
    <title>Details - MSU-TCTO S-ECE</title>

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
				<a href="?profile_family_and_relationship=true&profile=true" style="padding-right: 20px; font-size: 15px;">Family and Relationship</a><br><br>
				<a href="?profile_details_about=true&profile=true" style="padding-right: 20px; font-size: 15px; border-left: 3px solid blue; padding-left: 10px;">Other Details</a><br><br>
			</div>
			
			<style type="text/css">
				a {color: #909090;}
				a:hover {color: black;
						text-decoration: none;
				}

				
			</style>
			
			<?php
				if(!empty($searched_id_number)){
					$query = "SELECT about, nickname, favorite_quotes FROM accounts
							JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$searched_id_number' AND role != 'Parent' AND college != ''";
				}else{
					$query = "SELECT about, nickname, favorite_quotes FROM accounts
							JOIN accounts_info ON accounts.id_number = accounts_info.id_number WHERE accounts.id_number = '$id_number' AND role != 'Parent' AND college != ''";
				}
				$query_run = mysql_query($query);
					while($query_row = mysql_fetch_assoc($query_run)){
						echo '	<div style="width: 60%; padding-left: 3%;">
									<h3>ABOUT YOU</h3><hr>
									<label style="font-weight: normal; margin-left: 20px;"> ';

									if(!empty($query_row['about'])){
										echo $query_row['about'];
									}else{
										echo 'None';
									}

									echo '</label>';
									
									if(empty($searched_id_number) AND $role != 'Parent'){
											echo '<label id="about_you_edit" style="float: right; font-size: 13px; width: 100%;"><a id="btn_about_you" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label><br>';
									}

									echo '<br><div id="about_you_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_details_about=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													About: 
												</div>
												<div class="col-md-7">
													<textarea class="form-control" rows="4" name="about">'.$query_row['about'].'</textarea>
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_about_you" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>';

									echo '<hr style="border-width: 1px">

									<h3>OTHER NAMES</h3><hr>
									<label style="font-weight: normal; margin-left: 20px;"> ';

									if(!empty($query_row['nickname'])){
										echo $query_row['nickname'];
									}else{
										echo 'None';
									}

									echo '</label>';

									if(empty($searched_id_number) AND $role != 'Parent'){
											echo '<label id="nickname_edit" style="float: right; font-size: 13px;"><a id="btn_nickname" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label><br>';
										}

									echo '<div id="nickname_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_details_about=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Nickname: 
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" name="nickname" value="'.$query_row['nickname'].'" />
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_nickname" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>';

									echo '<hr style="border-width: 1px">

									<h3>Favorite Quotes</h3><hr>
									<label style="font-weight: normal; margin-left: 20px;"> ';

									if(!empty($query_row['favorite_quotes'])){
										echo $query_row['favorite_quotes'];
									}else{
										echo 'None';
									}

									echo '</label>';
									
									if(empty($searched_id_number) AND $role != 'Parent'){
											echo '<label id="quotes_edit" style="float: right; font-size: 13px; width: 100%;"><a id="btn_quotes" style="float: right;"><span class="glyphicon glyphicon-pencil"> Edit</a></label><br>';
									}

									echo '<br><div id="quotes_edit_now" style="display: none; background-color: #f2f2f2; padding: 10px; border-top: 1px solid dimgrey; margin-top: 10px;">
										<form action="index.php?profile_details_about=true&profile=true" method="POST">
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
													Quote: 
												</div>
												<div class="col-md-7">
													<textarea class="form-control" rows="4" name="quotes">'.$query_row['favorite_quotes'].'</textarea>
												</div>
											</div>
											
											<hr>
											<div class="row">
												<div class="col-md-3 col-md-offset-1">
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn-sm btn-info">Save Changes</button>
													<button type="button" id="in_btn_quotes" class="btn-sm btn-warning">Cancel</button>
												</div>
											</div>
										</form>
									</div>';

									echo '<hr style="border-width: 1px">

								</div>
								
							';
					}
			?>
		</div>
		
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<script type="text/javascript">

			$(document).ready(function(){
				$("#btn_about_you").click(function(){
					$("#about_you_edit_now").toggle();
				});

				$("#in_btn_about_you").click(function(){
					$("#about_you_edit_now").toggle();
				});

				$("#btn_nickname").click(function(){
					$("#nickname_edit_now").toggle();
				});

				$("#in_btn_nickname").click(function(){
					$("#nickname_edit_now").toggle();
				});

				$("#btn_quotes").click(function(){
					$("#quotes_edit_now").toggle();
				});

				$("#in_btn_quotes").click(function(){
					$("#quotes_edit_now").toggle();
				});

			});

		</script>

</body>
</html>
