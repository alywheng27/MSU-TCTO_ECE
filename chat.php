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
    <title>Chat - MSU-TCTO S-ECE</title>

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
			<div class="row">
				<div class="col-md-6">
					<h3> <?php echo $subject;?> <br><span style="font-size: 16px; color: lightgrey;">CHAT ROOM</span></h3><br><br>
					<div class="row">
						<div class="col-md-10">
							<?php
								$query = "SELECT accounts.id_number, first_name, last_name, profile_photo FROM accounts JOIN subjects ON accounts.id_number = subjects.id_number WHERE subject = '".$_GET['subject']."' AND role != 'Parent'";
								$query_run = mysql_query($query);
								while($query_row = mysql_fetch_assoc($query_run)){
									echo '<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
												<img src="data:image/jpeg;base64,'.base64_encode($query_row['profile_photo']).'" class="img-circle" style="width: 45px; height: 40px; margin-left: 35px;"/>
												<div style="width: 90%;">
												<p style="	font-weight: normal; text-indent: 5px; font-size: 15px; margin: 1px; color: skyblue; line-height: 34px;">'.$query_row['first_name'].' '.$query_row['last_name'].'';

												if($query_row['id_number'] == $id_number)
												{ 
													echo '<a style="float: right; font-size: 12px; margin: 1px; color: lime; line-height: 35px; text-decoration: none;">ONLINE</a>'; 
												}else{
													echo '<a style="float: right; font-size: 12px; margin: 1px; color: grey; line-height: 35px; text-decoration: none;">OFFLINE</a>';
												}

												echo '</p>
												</div>
											</div><br>';
								}
							?>
						</div>
					</div>
					
				</div>
				<div class="col-md-6" style="background: lightgrey; height: 550px;">
					<div class="row" style="height: 450px; margin-top: 25px; border-left: 2px solid lightgrey; overflow-y: scroll; overflow-x: hidden; background: white;">
						<br>
						<?php
							$query = "SELECT accounts.id_number, first_name, profile_photo, subject, message, message_change FROM accounts JOIN chat ON accounts.id_number = chat.id_number AND role != 'Parent'";
							$query_run = mysql_query($query);
							while ($query_row = mysql_fetch_assoc($query_run)) {
								if($query_row['subject'] == $subject){
									if($query_row['id_number'] == $id_number){
										if(!empty($query_row['message_change'])){
											echo '
												<p style="margin-left: 10px; background: #fcf8e3; color: #8a6d3b; border-color: #faebcc; padding: 10px; border-radius: 10px; text-decoration: none; float: right; margin-right: 35px;" ">
													<span class="glyphicon glyphicon-warning-sign"></span> <b><i>Warning! Foul Word has been used.</i></b><br><br>
													'.$query_row['message_change'].'
												</p>
												<br><br><br><br><br>

											';
										}else{
											echo '
												<p style="margin-left: 10px; background: #d9edf7; color: #31708f; padding: 10px; border-radius: 10px; text-decoration: none; float: right; margin-right: 35px;" ">
													'.$query_row['message'].'
												</p>
												<br><br><br>

											';
										}
									}else{
										if(!empty($query_row['message_change'])){
											echo '
												<div class="row">
													<div class="col-md-1">
														<img src="data:image/jpeg;base64,'.base64_encode($query_row['profile_photo']).'" class="img-circle" style="width: 45px; height: 40px; margin-left: 35px;" />
													</div>
													<div class="col-md-5 col-md-offset-1">
														<span style="font-size: 13px; color: lightgrey; margin-left: 10px;">'.$query_row['first_name'].'</span><br>
														<p style=" background: #fcf8e3; color: #8a6d3b; border-color: #faebcc; max-width: 350px; padding: 10px; border-radius: 10px; text-decoration: none; font-size: 15px; font-family: sans-serif; float: left;"><span class="glyphicon glyphicon-warning-sign"></span> <b><i>Warning! Foul Word has been used.</i></b><br><br>
														'.$query_row['message_change'].'
														</p>
													</div>
												</div>
												<br>
											';
										}else{
											echo '
												<div class="row">
													<div class="col-md-1">
														<img src="data:image/jpeg;base64,'.base64_encode($query_row['profile_photo']).'" class="img-circle" style="width: 45px; height: 40px; margin-left: 35px;" />
													</div>
													<div class="col-md-5 col-md-offset-1">
														<span style="font-size: 13px; color: lightgrey; margin-left: 10px;">'.$query_row['first_name'].'</span><br>
														<p style="background: #f5f5f5; max-width: 350px; border: 1px solid #e3e3e3; color: #31708f; padding: 10px; border-radius: 10px; text-decoration: none; font-size: 15px; font-family: sans-serif; float: left;">
														'.$query_row['message'].'
														</p>
													</div>
												</div>
												<br>
											';
										}
									}
								}
							}
						?>

						<br>
					</div>
					<div class="row" style="background: #eaeaea; padding-top: 15px; padding-bottom: 15px; border: 2px solid lightgrey; border-top: 0;">
						<form action="index.php?subject=<?php echo $subject?> " method="post">
							<div class="col-md-10">
								<textarea class="form-control" name="chat" placeholder="Send message" rows="2" style="margin-top: 1.5px;"></textarea>
							</div>
							<div class="col-md-2" style="margin-top: 10px;">
								<button type="submit" class="btn btn-info">Send</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
		</div>
		


</body>
</html>
