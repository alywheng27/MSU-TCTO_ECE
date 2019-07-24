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
			<h3> <?php echo $_GET['scores'];?>  <br><span style="font-size: 16px; color: lightgrey;">SCORES</span></h3><br><br>

				<center><h3>Prelim</h3></center><br>

				<!-- ------------------------------------------ Start Quiz ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM quizzes WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Prelim' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Quizzes</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';						
					}
				?>

				<!-- ------------------------------------------ End Quiz ---------------------------------------------- -->

				

				<!-- ------------------------------------------ Start Assignment ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM assignments WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Prelim' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Assignments</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px;">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Assignment ---------------------------------------------- -->

				

				<!-- ------------------------------------------ Start Lab Exercise ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM lab_exercises WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Prelim' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Lab Exercises</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px;">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Lab Exercise ---------------------------------------------- -->

				

				<!-- ------------------------------------------ Start Attendances ---------------------------------------------- -->

				<?php
					$query = "SELECT date, presence FROM attendances WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Prelim' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Attendances</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-2" style="margin-bottom: 30px;">
								<center>'.$query_row['date'] .'<hr style="margin: 5px;">'.$query_row['presence'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Attendances ---------------------------------------------- -->

				

				<!-- ------------------------------------------ Start Exam ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM exams WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Prelim' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Exam</h4><br>
						<div class="row">
						';

						echo '
						<div class="col-md-1" style="margin-bottom: 30px;">
							<center>'.mysql_result($query_run, 0, 'score') .'<hr style="margin: 5px;">'.mysql_result($query_run, 0, 'overall').'</center>
						</div>
						';
						
						echo '
						</div>
						';
					}
				?>
				<hr>
				<!-- ------------------------------------------ End Exam ---------------------------------------------- -->

				<br><br><br><center><h3>Midterm</h3></center><br>

				<!-- ------------------------------------------ Start Mid Quiz ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM quizzes WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Midterm' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);
					$query_run1 = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Quizzes</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px;">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Mid Quiz ---------------------------------------------- -->



				<!-- ------------------------------------------ Start Mid Assignment ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM assignments WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Midterm' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);
					$query_run1 = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Assignments</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px;">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Mid Assignment ---------------------------------------------- -->



				<!-- ------------------------------------------ Start Mid Lab Exercise ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM lab_exercises WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Midterm' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);
					$query_run1 = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Lab Exercises</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px;">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Mid Lab Exercise ---------------------------------------------- -->



				<!-- ------------------------------------------ Start Mid Attendance ---------------------------------------------- -->

				<?php
					$query = "SELECT date, presence FROM attendances WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Midterm' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);
					$query_run1 = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Attendances</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-2" style="margin-bottom: 30px;">
								<center>'.$query_row['date'] .'<hr style="margin: 5px;">'.$query_row['presence'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Mid Attendance ---------------------------------------------- -->

				

				<!-- ------------------------------------------ Start Mid Exam ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM exams WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Midterm' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Exam</h4><br>
						<div class="row">
						';

						echo '
						<div class="col-md-1" style="margin-bottom: 30px;">
							<center>'.mysql_result($query_run, 0, 'score') .'<hr style="margin: 5px;">'.mysql_result($query_run, 0, 'overall').'</center>
						</div>
						';
						
						echo '
						</div>
						';
					}
				?>
				<hr>
				<!-- ------------------------------------------ End Mid Exam ---------------------------------------------- -->

				<br><br><br><center><h3>Final</h3></center><br>

				<!-- ------------------------------------------ Start Final Quiz ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM quizzes WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Final' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);
					$query_run1 = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Quizzes</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px;">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Final Quiz ---------------------------------------------- -->



				<!-- ------------------------------------------ Start Final Assignment ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM assignments WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Final' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);
					$query_run1 = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Assignments</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px;">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Final Assignment ---------------------------------------------- -->



				<!-- ------------------------------------------ Start Final Lab Exercise ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM lab_exercises WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Final' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);
					$query_run1 = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Lab Exercises</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-1" style="margin-bottom: 30px;">
								<center>'.$query_row['score'] .'<hr style="margin: 5px;">'.$query_row['overall'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Final Lab Exercise ---------------------------------------------- -->



				<!-- ------------------------------------------ Start Final Attendance ---------------------------------------------- -->

				<?php
					$query = "SELECT date, presence FROM attendances WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Final' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);
					$query_run1 = mysql_query($query);

					if(mysql_num_rows($query_run) > 0){
						echo '
						<hr><h4>Attendances</h4><br>
						<div class="row">
						';

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
							<div class="col-md-2" style="margin-bottom: 30px;">
								<center>'.$query_row['date'] .'<hr style="margin: 5px;">'.$query_row['presence'].'</center>
							</div>
							';
						}

						echo '
						</div>
						';
					}
				?>
				
				<!-- ------------------------------------------ End Final Attendance ---------------------------------------------- -->

				

				<!-- ------------------------------------------ Start Final Exam ---------------------------------------------- -->

				<?php
					$query = "SELECT score, overall FROM exams WHERE id_number = '$id_number' AND subject = '".$_GET['scores']."' AND term = 'Final' AND semester = '".$_GET['semester']."' AND year = '".$_GET['year']."' ";
					$query_run = mysql_query($query);if(mysql_num_rows($query_run) > 0){
						
						echo '
						<hr><h4>Exam</h4><br>
						<div class="row">
						';

						echo '
						<div class="col-md-1" style="margin-bottom: 30px;">
							<center>'.mysql_result($query_run, 0, 'score') .'<hr style="margin: 5px;">'.mysql_result($query_run, 0, 'overall').'</center>
						</div>
						';
						
						echo '
						</div>
						';
					}
				?>
				<hr>
				<!-- ------------------------------------------ End Final Exam ---------------------------------------------- -->
		</div>
		


</body>
</html>
