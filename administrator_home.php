<?php
	if(!isset($_SESSION['name']) and empty($_SESSION['name'])){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - MSU-TCTO S-ECE</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

   
    
</head>
<body >
	<div id="wrapper" >
        
    	<!--    navbar         -->
			<?php include 'navbars.php'; ?>
		<!--    navbar         -->
		<div id="page-wrapper" style="width: 80%; margin-left: 10%; border-left: 2px solid #dddddd;">
			<?php
				if(($role == 'Administrator' and $_GET['post'] == 'Administrator') or ($role == 'Student' and $_GET['post'] != 'Administrator') or ($role == 'Instructor' and $_GET['post'] != 'Administrator')){
					echo '<div class="well " style="border: 0px; background: white;"> 
						<form action="index.php?student=true&post='.$_GET['post'].'" method="POST">
							<div style="display: -webkit-box; -webkit-box-orient: horizontal;">';
								
									$query = "SELECT profile_photo FROM accounts WHERE id_number = '$id_number'";
									$query_run = mysql_query($query);

									echo '<img src="data:image/jpeg;base64,'.base64_encode(mysql_result($query_run, 0, 'profile_photo')).'" class="img-circle img-responsive"/ style="width: 80px; height: 75px; margin-right: 10px;">
								
								
								<textarea name="post_text" class="form-control" placeholder="What\'s on your mind:" rows="3" style="border-radius: 1px; width: 88%;" ></textarea>
							</div><br>
							<button type="submit" class="btn btn-info" style="padding-left: 20px; padding-right: 20px; margin-left: 12%;">Post</button>
							<button type="submit" class="btn btn-danger" style="padding-left: 8px; padding-right: 8px; float: right; margin-right: 2%;"><i class="glyphicon glyphicon-camera"></i> Photo</button>
						</form>
					</div>
					<hr style="border-bottom: 1px solid;">
					';
				}
			?>

			<!-- --------------------------    Posts   -------------------------- -->

			<?php
				$query = "SELECT first_name, middle_name, last_name, profile_photo, post, post_id, date FROM posts JOIN accounts ON accounts.id_number = posts.id_number WHERE admin_subject = '".$_GET['post']."' AND role != 'Parent' ORDER BY post_id DESC";
				$query_run = mysql_query($query);

				while($query_row = mysql_fetch_assoc($query_run)){
					echo '<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
					<div style="width: 60px; margin-right: 10px;">
						<img src="data:image/jpeg;base64,'.base64_encode($query_row['profile_photo']).'" style="width: 100%;"/>
					</div>
					<div style="width: 85%; position: relative;">
						<div style="color: blue;">'.$query_row['first_name'].' '.$query_row['middle_name'].' '.$query_row['last_name'].'</div>
						<div >';
							
						echo '<p style="font-size: 12px; color: #bbbbbb;">'.$query_row['date']/*date('M d, Y' @ h:i, strtotime('-1 day'))*/.'</p>';


			
echo "<pre style='font-family: verdana; font-size: 16px; background-color: transparent; padding-left: 0px; border: 0px;'>
".$query_row['post']."
</pre>";
						
						$query2 = "SELECT photo FROM posts_photos WHERE post_id = '".$query_row['post_id']."'";
						$query_run2 = mysql_query($query2);

						echo '<div class="row">';
						while($query_row2 = mysql_fetch_assoc($query_run2)){
							echo '	
										<div class="col-md-6">
											<img src="data:image/jpeg;base64,'.base64_encode($query_row2['photo']).'" style="width: 100%; margin-top: 10px;" />
										</div>
									';
							
						}
						echo '</div>';							
							

						echo '</div>
						<br>
						
					</div>
				</div>
				<div>
					<div style="display: -webkit-box; -webkit-box-orient: horizontal;">';
						if($role != 'Parent'){
							echo '<div style="width: 40px; margin-right: 5px; margin-top: 25px;">
							<img src="data:image/jpeg;base64,'.base64_encode($query_row['profile_photo']).'" style="width: 100%;" />
							</div>';
							
						}
						echo '<div style="width: 90%;">';

							$query1 = "SELECT comment, id_number_comment, first_name, middle_name, last_name, profile_photo FROM comments JOIN accounts ON accounts.id_number = comments.id_number_comment WHERE admin_subject_comment = '".$_GET['post']."' AND post_id = '".$query_row['post_id']."' AND role != 'Parent'";
							$query_run1 = mysql_query($query1);

							echo '<div style="background: black; color: white; position: relative; width: 100%; margin-bottom: 5px;">'.mysql_num_rows($query_run1).' Comment</div>';
							
							if($role != 'Parent'){
								
								echo '<form action="index.php?student=true&post='.$_GET['post'].'&post_id='.$query_row['post_id'].'" method="post">
									<div class="row">
										<div class="col-md-10">
											<textarea class="form-control" name="comment_text" placeholder="Write a comment"></textarea>
										</div>
										<div class="col-md-1" style="margin-top: 8px;">
											<button type="submit" class="btn" >Comment</button>
										</div>
									</div>
								</form>';
							}

							while($query_row1 = mysql_fetch_assoc($query_run1)){
								echo '<div class="row">
									<div class="col-md-1">
										<img src="data:image/jpeg;base64,'.base64_encode($query_row1['profile_photo']).'" class="img-circle" style="width: 45px; height: 40px; margin-top: 10px;" />
									</div>
									<div class="col-md-11">
										<p style="background: #f5f5f5; border: 1px solid #e3e3e3; color: #31708f; padding: 10px; border-radius: 10px; text-decoration: none; font-size: 15px; font-family: sans-serif; float: left; margin-top: 10px;"><span style="color: skyblue;"><b>'.$query_row1['first_name'].' '.$query_row1['middle_name'].' '.$query_row1['last_name'].'</b></span>: 
										'.$query_row1['comment'].'
										</p>
									</div>
								</div>';
							}
							

						echo '</div>
					</div>
				</div>
				<hr>';
				}

			?>
			
			<!-- --------------------------    End Posts   -------------------------- -->


		</div>
	</div>
		


</body>
</html>
