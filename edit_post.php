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
		
		<div id="page-wrapper">
			<h3> Edit Post </h3><br><br>
			
			<div class="row">
				<div class="col-md-12">
					<form action="index.php?post=<?php echo $_GET['post'];?>&edit_post=<?php echo $_GET['edit_post'];?>&enter_edit=true" method="post">
						<div class="row">
							<div class="col-md-2 col-md-offset-2">
								Number of Photos:
							</div>
							<div class="col-md-2">
								<input type="number" name="photo_number" class="form-control" required/>
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-block btn-warning">Enter</button>
							</div>
						</div>
					</form>
					<hr>
				</div>
				<form action="index.php?post=<?php echo $_GET['post']; ?>&photo_number=<?php if(isset($_POST['photo_number'])){echo $_POST['photo_number'];}else{echo 0;} ?>&edit_post=<?php echo $_GET['edit_post'];?>&enter_edit=true" method="post" enctype="multipart/form-data">
					<div class="col-md-12">
						<?php



							$query = "SELECT accounts.id_number, first_name, middle_name, last_name, profile_photo, post, post_id, date FROM posts JOIN accounts ON accounts.id_number = posts.id_number WHERE admin_subject = '".$_GET['post']."' AND role != 'Parent' AND post_id = '".$_GET['edit_post']."' ORDER BY post_id DESC";
				$query_run = mysql_query($query);

				while($query_row = mysql_fetch_assoc($query_run)){
					echo '<div style="display: -webkit-box; -webkit-box-orient: horizontal;">
					<div style="width: 60px; margin-right: 10px;">
						
					</div>
					<div style="width: 85%; position: relative;">
						<div style="color: blue;">'.$query_row['first_name'].' '.$query_row['middle_name'].' '.$query_row['last_name'].'</div>
						<div >';

						echo '<p style="font-size: 12px; color: #bbbbbb;">'.$query_row['date']/*date('M d, Y' @ h:i, strtotime('-1 day'))*/.'</p>';


if(!empty($query_row['post'])){
echo "<pre style='font-family: verdana; font-size: 16px; background-color: transparent; padding-left: 0px; border: 0px;'>
".$query_row['post']."
</pre>";
}	

						
						$query2 = "SELECT photo FROM posts_photos WHERE post_id = '".$query_row['post_id']."'";
						$query_run2 = mysql_query($query2);

						echo '<div class="row">';
						$num_rows = mysql_num_rows($query_run2);

						if($num_rows % 2 == 0){
							while($query_row2 = mysql_fetch_assoc($query_run2)){
								echo '	
											<div class="col-md-6">
												<img src="data:image/jpeg;base64,'.base64_encode($query_row2['photo']).'" style="width: 100%; margin-top: 10px;" />
											</div>
										';
								
							}
						}else{
							$odd_photo_mark = true;
							while($query_row2 = mysql_fetch_assoc($query_run2)){
								if($odd_photo_mark == true){
									echo '	
												<div class="col-md-12">
													<img src="data:image/jpeg;base64,'.base64_encode($query_row2['photo']).'" style="width: 100%; margin-top: 10px;" />
												</div>
											';
									$odd_photo_mark = false;
								}else{
									echo '	
											<div class="col-md-6">
												<img src="data:image/jpeg;base64,'.base64_encode($query_row2['photo']).'" style="width: 100%; margin-top: 10px;" />
											</div>
										';
								}
							}
						}
						
						echo '</div><hr>';
					






							if(isset($_POST['photo_number'])){
								$photo_number = $_POST['photo_number'];

								for ($i=0; $i < $photo_number; $i++) { 
									echo '	<div class="row">
												<div class="col-md-6 col-md-offset-2">
													<input type="file" name="post_photo'.$i.'" class="btn btn-block btn-danger" required>
												</div>
											</div><br>
									';
								}
								if($photo_number > 0){
									echo '
									<div class="row">
										<div class="col-md-6 col-md-offset-2">
											<textarea  name="post_text_photo" class="form-control" placeholder="What\'s on your mind:" rows="3"></textarea>
										</div>
									</div><br>
									';
								}else{
									echo '
									<div class="row">
										<div class="col-md-6 col-md-offset-2">
											<textarea  name="post_text_photo" class="form-control" placeholder="What\'s on your mind:" rows="3" required></textarea>
										</div>
									</div><br>
									';
								}
								
							}else{
								echo '
								<div class="row">
									<div class="col-md-8 col-md-offset-2">
										<textarea  name="post_text_photo" class="form-control" placeholder="What\'s on your mind:" rows="3" required>'.$query_row['post'].'</textarea>
									</div>
								</div><br>
								';
							}
						}
						?>
						
						<hr>
						<br>
						<div class="row">
							<div class="col-md-6 col-md-offset-2">
								<button type="submit" name="post_edit" class="btn btn-block btn-info">Save Post</button>
							</div>
							<div class="col-md-2">
								<a href="?post=<?php echo $_GET['post']; ?>&photo_number=<?php if(isset($_POST['photo_number'])){echo $_POST['photo_number'];}else{echo 0;} ?>&edit_post=<?php echo $_GET['edit_post'];?>&enter_delete=true" class="btn btn-block btn-danger">Delete Post</a>
							</div>
						</div>
						<br>
						<br>
						<br>
					</div>
				</form>
			</div>
				
		</div>
		


</body>
</html>
