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
    <title>Submit Scores - MSU-TCTO S-ECE</title>

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
			<?php
			echo '<form action="index.php?submit_grade_subject='.$_GET['submit_grade_subject'].'&id_number='.$_GET['id_number'].'" method="post" enctype="multipart/form-data">';
			?>
			
			<h3> <?php echo $_GET['first_name'] . ' ' . $_GET['last_name']; ?> <br><span style="font-size: 16px; color: lightgrey;">SUBMIT SCORES</span> </h3><br><br>

			<?php
				$query = "SELECT prelim_quizzes_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$quizzes_number = mysql_result($query_run, 0, 'prelim_quizzes_number');
				if($quizzes_number > 0){
					echo '<h4>Prelim Quizzes</h4><br>

							<div class="row">
								<div class="col-md-12">
									Score
								</div>';

					for ($i=0; $i < $quizzes_number; $i++) { 
						echo '	<div class="col-md-1" style="margin-top: 10px;">
									<input type="number" style="width: 75px;" name="prelim_quiz_score'.$i.'" />	
								</div>';
					}

					echo '</div>
								<div class="row" style="margin-top: 10px;">
								<div class="col-md-12">
									Overall
								</div>';
				}
			?>

			<?php
				if($quizzes_number > 0){
					for ($i=0; $i < $quizzes_number; $i++) { 
						echo '	<div class="col-md-1" style="margin-top: 10px;">
									<input type="number" style="width: 75px;" name="prelim_quiz_overall'.$i.'" required />	
								</div>';
					}
					echo '</div>
					<hr>';
				}
			?>
			

			

			<?php
				$query = "SELECT prelim_assignments_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$assignments_number = mysql_result($query_run, 0, 'prelim_assignments_number');

				if($assignments_number > 0){
					echo '<h4>Prelim Assignments</h4><br>

							<div class="row">
								<div class="col-md-12">
									Score
								</div>';
					for ($i=0; $i < $assignments_number; $i++) { 
						echo '	<div class="col-md-1" style="margin-top: 10px;">
									<input type="number" style="width: 75px;" name="prelim_assignment_score'.$i.'" />	
								</div>';
					}

					echo '</div>
								<div class="row" style="margin-top: 10px;">
								<div class="col-md-12">
									Overall
								</div>';
				}

			?>

			

			<?php
				if($assignments_number > 0){
					for ($i=0; $i < $assignments_number; $i++) { 
						echo '	<div class="col-md-1" style="margin-top: 10px;">
									<input type="number" style="width: 75px;" name="prelim_assignment_overall'.$i.'" required />	
								</div>';
					}

					echo '</div>
				<hr>';
				}
				
			?>
			
			
			

			<?php
				$query = "SELECT prelim_lab_exercises_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$activities_number = mysql_result($query_run, 0, 'prelim_lab_exercises_number');

				if($activities_number > 0){
					echo '<h4>Prelim Lab Exercises</h4><br>

						<div class="row">
							<div class="col-md-12">
								Score
							</div>';

				for ($i=0; $i < $activities_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="prelim_lab_exercise_score'.$i.'" />	
							</div>';
				}

				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>';
				}

			?>

			

			<?php
			if($activities_number > 0){
				for ($i=0; $i < $activities_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="prelim_lab_exercise_overall'.$i.'" required />	
							</div>';
				}

				echo '</div>
			<hr>';
			}
				
			?>
			

			

			<?php
				$query = "SELECT prelim_attendances_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$attendances_number = mysql_result($query_run, 0, 'prelim_attendances_number');

				if($attendances_number > 0){
					echo '<h4>Prelim Attendances</h4><br>

			<div class="row">
				<div class="col-md-12">
					Date
				</div>';
				for ($i=0; $i < $attendances_number; $i++) { 
					echo '	<div class="col-md-2" style="margin-top: 10px;">
								<input type="date" class="form-control" name="prelim_attendance_date'.$i.'" required/>	
							</div>';
				}

				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Presence
				</div>';
				}

			?>

			

			<?php
				if($attendances_number > 0){
					for ($i=0; $i < $attendances_number; $i++) { 
					echo '	<div class="col-md-2" style="margin-top: 10px;">
								<select class="form-control" name="prelim_attendance_presence'.$i.'">
									<option value="Present">Present</option>
									<option value="Absent">Absent</option>
									<option value="Late">Late</option>
									<option value="Excused">Excused</option>
								</select>
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			

			<h4>Prelim Exams</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>
				<div class="col-md-1" style="margin-top: 10px;">
					<input type="number" style="width: 75px;" name="prelim_exam_score" />	
				</div>
			</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>
				<div class="col-md-1" style="margin-top: 10px;">
					<input type="number" style="width: 75px;" name="prelim_exam_overall" required />	
				</div>
			</div>
			<hr>

			<!-- **********************		Midterm		*******************************-->

			

			<?php
				$query = "SELECT Midterm_quizzes_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$quizzes_number = mysql_result($query_run, 0, 'midterm_quizzes_number');

				if($quizzes_number > 0){
					echo '<h4>Midterm Quizzes</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>';

				for ($i=0; $i < $quizzes_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="midterm_quiz_score'.$i.'" />	
							</div>';
				}

				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>';
				}
			?>

			

			<?php
				if($quizzes_number > 0){
					for ($i=0; $i < $quizzes_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="midterm_quiz_overall'.$i.'" required />	
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			

			

			<?php
				$query = "SELECT Midterm_assignments_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$assignments_number = mysql_result($query_run, 0, 'Midterm_assignments_number');

				if($assignments_number > 0){
					echo '<h4>Midterm Assignments</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>';

				for ($i=0; $i < $assignments_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="midterm_assignment_score'.$i.'" />	
							</div>';
				}
				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>';
				}


			?>

			

			<?php
				if($assignments_number > 0){
					for ($i=0; $i < $assignments_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="midterm_assignment_overall'.$i.'" required />	
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			
			
			

			<?php
				$query = "SELECT Midterm_lab_exercises_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$activities_number = mysql_result($query_run, 0, 'Midterm_lab_exercises_number');

				if($activities_number > 0){
					echo '<h4>Midterm Lab Exercises</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>';

				for ($i=0; $i < $activities_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="midterm_lab_exercise_score'.$i.'" />	
							</div>';
				}

				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>';
				}


			?>

			

			<?php
				if($activities_number > 0){
					for ($i=0; $i < $activities_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="midterm_lab_exercise_overall'.$i.'" required />	
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			

			

			<?php
				$query = "SELECT Midterm_attendances_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$attendances_number = mysql_result($query_run, 0, 'Midterm_attendances_number');

				if($attendances_number > 0){
					echo '<h4>Midterm Attendances</h4><br>

			<div class="row">
				<div class="col-md-12">
					Date
				</div>';

				for ($i=0; $i < $attendances_number; $i++) { 
					echo '	<div class="col-md-2" style="margin-top: 10px;">
								<input type="date" class="form-control" name="midterm_attendance_date'.$i.'" required />	
							</div>';
				}

				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Attendance
				</div>';
				}


			?>

			

			<?php
				if($attendances_number > 0){
					for ($i=0; $i < $attendances_number; $i++) { 
					echo '	<div class="col-md-2" style="margin-top: 10px;">
								<select class="form-control" name="midterm_attendance_presence'.$i.'">
									<option value="Present">Present</option>
									<option value="Absent">Absent</option>
									<option value="Late">Late</option>
									<option value="Excused">Excused</option>
								</select>
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			

			<h4>Midterm Exams</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>
				<div class="col-md-1" style="margin-top: 10px;">
					<input type="number" style="width: 75px;" name="midterm_exam_score" />	
				</div>
			</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>
				<div class="col-md-1" style="margin-top: 10px;">
					<input type="number" style="width: 75px;" name="midterm_exam_overall" required />	
				</div>
			</div>
			<hr>


			<!-- **********************		FINAL		*******************************-->

			

			<?php
				$query = "SELECT Final_quizzes_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$quizzes_number = mysql_result($query_run, 0, 'Final_quizzes_number');

				if($quizzes_number > 0){
					echo '<h4>Final Quizzes</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>';

				for ($i=0; $i < $quizzes_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="final_quiz_score'.$i.'" />	
							</div>';
				}

				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>';
				}
			?>

			

			<?php
				if($quizzes_number > 0){
					for ($i=0; $i < $quizzes_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="final_quiz_overall'.$i.'" required />	
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			

			

			<?php
				$query = "SELECT Final_assignments_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$assignments_number = mysql_result($query_run, 0, 'Final_assignments_number');

				if($assignments_number > 0){
					echo '<h4>Final Assignments</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>';

				for ($i=0; $i < $assignments_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="final_assignment_score'.$i.'" />	
							</div>';
				}
				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>';
				}


			?>

			

			<?php
				if($assignments_number > 0){
					for ($i=0; $i < $assignments_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="final_assignment_overall'.$i.'" required />	
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			
			
			

			<?php
				$query = "SELECT Final_lab_exercises_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$activities_number = mysql_result($query_run, 0, 'Final_lab_exercises_number');

				if($activities_number > 0){
					echo '<h4>Final Lab Exercises</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>';

				for ($i=0; $i < $activities_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="final_lab_exercise_score'.$i.'" />	
							</div>';
				}

				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>';
				}


			?>

			

			<?php
				if($activities_number > 0){
					for ($i=0; $i < $activities_number; $i++) { 
					echo '	<div class="col-md-1" style="margin-top: 10px;">
								<input type="number" style="width: 75px;" name="final_lab_exercise_overall'.$i.'" required />	
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			

			

			<?php
				$query = "SELECT Final_attendances_number FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
				$query_run = mysql_query($query);

				$attendances_number = mysql_result($query_run, 0, 'Final_attendances_number');

				if($attendances_number > 0){
					echo '<h4>Final Attendances</h4><br>

			<div class="row">
				<div class="col-md-12">
					Date
				</div>';

				for ($i=0; $i < $attendances_number; $i++) { 
					echo '	<div class="col-md-2" style="margin-top: 10px;">
								<input type="date" class="form-control" name="final_attendance_date'.$i.'" required />	
							</div>';
				}

				echo '</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Attendance
				</div>';
				}


			?>

			

			<?php
				if($attendances_number > 0){
					for ($i=0; $i < $attendances_number; $i++) { 
					echo '	<div class="col-md-2" style="margin-top: 10px;">
								<select class="form-control" name="final_attendance_presence'.$i.'">
									<option value="Present">Present</option>
									<option value="Absent">Absent</option>
									<option value="Late">Late</option>
									<option value="Excused">Excused</option>
								</select>
							</div>';
				}

				echo '</div>
			<hr>';
				}
				
			?>
			

			<h4>Final Exams</h4><br>

			<div class="row">
				<div class="col-md-12">
					Score
				</div>
				<div class="col-md-1" style="margin-top: 10px;">
					<input type="number" style="width: 75px;" name="final_exam_score" />	
				</div>
			</div>
				<div class="row" style="margin-top: 10px;">
				<div class="col-md-12">
					Overall
				</div>
				<div class="col-md-1" style="margin-top: 10px;">
					<input type="number" style="width: 75px;" name="final_exam_overall" required />	
				</div>
			</div>
			<hr>
			<br>
			<br>

			<center>
				<button type="submit" name="submit_scores" class="btn btn-success" style="padding-left: 10%; padding-right: 10%;">Submit</button>
			</center>

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</form>
		</div>
	</div>

</body>
</html>
