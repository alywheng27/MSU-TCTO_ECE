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
			<h3> Add Photo </h3><br><br>
			
			<div class="row">
				<div class="col-md-12">
					<form action="index.php?post=<?php echo $_GET['post'];?>&add_photo=true" method="post">
						<div class="row">
							<div class="col-md-2 col-md-offset-2">
								Number of Photos:
							</div>
							<div class="col-md-2">
								<input type="number" name="photo_number" class="form-control" required/>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-block btn-warning" >Enter</button>
							</div>
						</div>
					</form>
					<hr>
				</div>
				<form action="index.php?post=<?php echo $_GET['post']; ?>&photo_number=<?php if(isset($_POST['photo_number'])){echo $_POST['photo_number'];}else{echo 0;} ?>" method="post" enctype="multipart/form-data">
					<div class="col-md-12">
						<?php
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
									<div class="col-md-6 col-md-offset-2">
										<textarea  name="post_text_photo" class="form-control" placeholder="What\'s on your mind:" rows="3" required></textarea>
									</div>
								</div><br>
								';
							}
						?>
						
						<hr>
						<br>
						<div class="row">
							<div class="col-md-6 col-md-offset-2">
								<button type="submit" name="photo_submit" class="btn btn-block btn-info">Post</button>
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
