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
    <title>Setting - MSU-TCTO S-ECE</title>

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
			<h3> <?php echo $_GET['submit_grade_subject'];?> <br><span style="font-size: 16px; color: lightgrey;">SETTING</span> </h3><br><br>
			
			<div class="row">
				<div class="col-md-5">
					<h4>Terms</h4><br>
					<div class="row">
						<form action="index.php?submit_grade_subject=<?php echo $_GET['submit_grade_subject'];?>&set_percentage=true" method="post" oninput="total.value=parseInt(prelim_final.value)+parseInt(midterm_final.value)+parseInt(final_final.value)">
							<div class="col-md-6">
								Prelim<br><br>
								<?php
									$query = "SELECT prelim, midterm, final FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
									$query_run = mysql_query($query);

									if(mysql_num_rows($query_run) > 0){
										echo '<input type="range" name="prelim_final" value="'.mysql_result($query_run, 0, 'prelim').'" oninput="prelim.value=this.value">
											<br>';
										echo 'Midterm<br><br>
											<input type="range" name="midterm_final" value="'.mysql_result($query_run, 0, 'midterm').'" oninput="midterm.value=this.value">
											<br>';
										echo 'Final<br><br>
											<input type="range" name="final_final" value="'.mysql_result($query_run, 0, 'final').'" oninput="final.value=this.value">
											<br><br>';
									}else{
										echo '<input type="range" name="prelim_final" value="25" oninput="prelim.value=this.value">
											<br>';
										echo 'Midterm<br><br>
											<input type="range" name="midterm_final" value="25" oninput="midterm.value=this.value">
											<br>';
										echo 'Final<br><br>
											<input type="range" name="final_final" value="50" oninput="final.value=this.value">
											<br><br>';
									}
								

								echo '<b>Total</b><br><br>
							</div>
							<div class="row">
								<div class="col-md-3" style="padding-top: 30px;">';
									if(mysql_num_rows($query_run) > 0){
										echo '<div class="col-md-1">
										<output id="prelim">'.mysql_result($query_run, 0, 'prelim').'</output>
									</div>
									<div class="col-md-1" style="margin-top: 7px;">
										%
									</div>
									<br><br><br><br>
									<div class="col-md-1">
										<output id="midterm">'.mysql_result($query_run, 0, 'midterm').'</output>
									</div>
									<div class="col-md-1" style="margin-top: 7px;">
										%
									</div>
									<br><br><br><br>
									<div class="col-md-1">
										<output id="final">'.mysql_result($query_run, 0, 'final').'</output>
									</div>
									<div class="col-md-1" style="margin-top: 7px;">
										%
									</div>
									<br><br><br>
									<div class="col-md-1" style="margin-top: 4px;">';

									$query1 = "SELECT prelim, midterm, final FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
									$query_run1 = mysql_query($query1);

									if(mysql_num_rows($query_run1) > 0){
										if(mysql_result($query_run1, 0, 'prelim') == '0' and mysql_result($query_run1, 0, 'midterm') == '0' and mysql_result($query_run1, 0, 'final') == '0'){
											echo '<output name="total">0</output>';
										}else{
											echo '<output name="total">100</output>';
										}
									}

									echo '</div>
									<div class="col-md-1" style="margin-top: 11px;">
										%
									</div>
								</div>
							</div>';
									}else{
										echo '<div class="col-md-1">
										<output id="prelim">25</output>
									</div>
									<div class="col-md-1" style="margin-top: 7px;">
										%
									</div>
									<br><br><br><br>
									<div class="col-md-1">
										<output id="midterm">25</output>
									</div>
									<div class="col-md-1" style="margin-top: 7px;">
										%
									</div>
									<br><br><br><br>
									<div class="col-md-1">
										<output id="final">50</output>
									</div>
									<div class="col-md-1" style="margin-top: 7px;">
										%
									</div>
									<br><br><br>
									<div class="col-md-1" style="margin-top: 4px;">
										<output name="total">100</output>
									</div>
									<div class="col-md-1" style="margin-top: 11px;">
										%
									</div>
								</div>
							</div>';
									}
									
							?>
							
							<div class="row">
								<div class="col-md-5 col-md-offset-2">
									<br><br><br>
									<button type="submit" class="btn btn-block btn-success">SET</button>
								</div>
							</div>
						</form>
					</div>

				</div>

				
				<div class="col-md-7">
					<h4>Prelim Score Percentage</h4><br>
					<form action="index.php?submit_grade_subject=<?php echo $_GET['submit_grade_subject'];?>&set_percentage=true" method="post" oninput="scores_total.value=parseInt(quiz.value)+parseInt(assignment.value)+parseInt(activity.value)+parseInt(attendance.value)+parseInt(exam.value)">
					<div class="row">
						<div class="col-md-5 col-md-offset-3">
							Percentage of
						</div>
						<div class="col-md-4">
							Number of
						</div>
					</div><br>
					<div class="row">
						<?php
							$query = "SELECT * FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
							$query_run = mysql_query($query);

							if(mysql_num_rows($query_run) > 0){
								echo '<div class="col-md-3">
							<b>Quizzes</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="quiz" value="'.mysql_result($query_run, 0, 'prelim_quizzes').'" oninput="quiz_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="quiz_result">'.mysql_result($query_run, 0, 'prelim_quizzes').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="quiz_number" value="'.mysql_result($query_run, 0, 'prelim_quizzes_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Assignments</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="assignment" value="'.mysql_result($query_run, 0, 'prelim_assignments').'" oninput="assignment_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="assignment_result">'.mysql_result($query_run, 0, 'prelim_assignments').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="assignment_number" value="'.mysql_result($query_run, 0, 'prelim_assignments_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Lab Exercises</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="activity" value="'.mysql_result($query_run, 0, 'prelim_lab_exercises').'" oninput="activity_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="activity_result">'.mysql_result($query_run, 0, 'prelim_lab_exercises').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="activity_number" value="'.mysql_result($query_run, 0, 'prelim_lab_exercises_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Attendances</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="attendance" value="'.mysql_result($query_run, 0, 'prelim_attendances').'" oninput="attendance_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="attendance_result">'.mysql_result($query_run, 0, 'prelim_attendances').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="attendance_number" value="'.mysql_result($query_run, 0, 'prelim_attendances_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Exams</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="exam" value="'.mysql_result($query_run, 0, 'prelim_exams').'" oninput="exam_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="exam_result">'.mysql_result($query_run, 0, 'prelim_exams').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
						</div>
					</div><br><br>';
							}else{
								echo '<div class="col-md-3">
							<b>Quizzes</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="quiz" value="20" oninput="quiz_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="quiz_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="quiz_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Assignments</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="assignment" value="20" oninput="assignment_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="assignment_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="assignment_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Lab Exercises</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="activity" value="20" oninput="activity_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="activity_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="activity_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Attendances</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="attendance" value="20" oninput="attendance_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="attendance_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="attendance_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Exams</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="exam" value="20" oninput="exam_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="exam_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
						</div>
					</div><br><br>';
							}

						?>
					<div class="row">
						<div class="col-md-3" style="margin-top: 8px;">
							<b>Total</b>
						</div>
						<div class="col-md-5">
							<div class="row">
								<div class="col-md-1">
									<?php
										$query1 = "SELECT prelim_quizzes, prelim_assignments, prelim_lab_exercises, prelim_attendances, prelim_exams FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
										$query_run1 = mysql_query($query1);

										if(mysql_num_rows($query_run1) > 0){
											if(mysql_result($query_run1, 0, 'prelim_quizzes') == '0' and mysql_result($query_run1, 0, 'prelim_assignments') == '0' and mysql_result($query_run1, 0, 'prelim_lab_exercises') == '0' and mysql_result($query_run1, 0, 'prelim_attendances') == '0' and mysql_result($query_run1, 0, 'prelim_exams') == '0'){
												echo '<output id="scores_total">0</output>';
											}else{
												echo '<output id="scores_total">100</output>';
											}
										}else{
											echo '<output id="scores_total">100</output>';
										}
									?>
									
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-block btn-success">SET</button>
						</div>
					</div>

				</form>
				</div>
			</div>

			<br><br><br>

			<div class="row">
				<div class="col-md-5">
					<h4>Midterm Score Percentage</h4><br>
					<form action="index.php?submit_grade_subject=<?php echo $_GET['submit_grade_subject'];?>&set_percentage=true" method="post" oninput="scores_total.value=parseInt(midterm_quiz.value)+parseInt(midterm_assignment.value)+parseInt(midterm_activity.value)+parseInt(midterm_attendance.value)+parseInt(midterm_exam.value)">
					<div class="row">
						<div class="col-md-5 col-md-offset-3">
							Percentage of
						</div>
						<div class="col-md-4">
							Number of
						</div>
					</div><br>
					<div class="row">
						<?php
							$query = "SELECT * FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
							$query_run = mysql_query($query);

							if(mysql_num_rows($query_run) > 0){
								echo '<div class="col-md-3">
							<b>Quizzes</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="midterm_quiz" value="'.mysql_result($query_run, 0, 'midterm_quizzes').'" oninput="quiz_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="quiz_result">'.mysql_result($query_run, 0, 'midterm_quizzes').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="midterm_quiz_number" value="'.mysql_result($query_run, 0, 'midterm_quizzes_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Assignments</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="midterm_assignment" value="'.mysql_result($query_run, 0, 'midterm_assignments').'" oninput="assignment_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="assignment_result">'.mysql_result($query_run, 0, 'midterm_assignments').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="midterm_assignment_number" value="'.mysql_result($query_run, 0, 'midterm_assignments_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Lab Exercises</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="midterm_activity" value="'.mysql_result($query_run, 0, 'midterm_lab_exercises').'" oninput="activity_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="activity_result">'.mysql_result($query_run, 0, 'midterm_lab_exercises').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="midterm_activity_number" value="'.mysql_result($query_run, 0, 'midterm_lab_exercises_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Attendances</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="midterm_attendance" value="'.mysql_result($query_run, 0, 'midterm_attendances').'" oninput="attendance_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="attendance_result">'.mysql_result($query_run, 0, 'midterm_attendances').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="midterm_attendance_number" value="'.mysql_result($query_run, 0, 'midterm_attendances_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Exams</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="midterm_exam" value="'.mysql_result($query_run, 0, 'midterm_exams').'" oninput="exam_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="exam_result">'.mysql_result($query_run, 0, 'midterm_exams').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
						</div>
					</div><br><br>';
							}else{
								echo '<div class="col-md-3">
							<b>Quizzes</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="quiz" value="20" oninput="quiz_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="quiz_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="quiz_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Assignments</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="assignment" value="20" oninput="assignment_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="assignment_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="assignment_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Lab Exercises</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="activity" value="20" oninput="activity_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="activity_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="activity_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Attendances</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="attendance" value="20" oninput="attendance_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="attendance_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="attendance_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Exams</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="exam" value="20" oninput="exam_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="exam_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
						</div>
					</div><br><br>';
							}

						?>
					<div class="row">
						<div class="col-md-3" style="margin-top: 8px;">
							<b>Total</b>
						</div>
						<div class="col-md-5">
							<div class="row">
								<div class="col-md-1">
									<?php
										$query1 = "SELECT prelim_quizzes, prelim_assignments, prelim_lab_exercises, prelim_attendances, prelim_exams FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
										$query_run1 = mysql_query($query1);

										if(mysql_num_rows($query_run1) > 0){
											if(mysql_result($query_run1, 0, 'prelim_quizzes') == '0' and mysql_result($query_run1, 0, 'prelim_assignments') == '0' and mysql_result($query_run1, 0, 'prelim_lab_exercises') == '0' and mysql_result($query_run1, 0, 'prelim_attendances') == '0' and mysql_result($query_run1, 0, 'prelim_exams') == '0'){
												echo '<output id="scores_total">0</output>';
											}else{
												echo '<output id="scores_total">100</output>';
											}
										}else{
											echo '<output id="scores_total">100</output>';
										}
									?>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-block btn-success">SET</button>
						</div>
					</div>

				</form>
				</div>

				<div class="col-md-6 col-md-offset-1">
					<h4>Final Score Percentage</h4><br>
					<form action="index.php?submit_grade_subject=<?php echo $_GET['submit_grade_subject'];?>&set_percentage=true" method="post" oninput="scores_total.value=parseInt(final_quiz.value)+parseInt(final_assignment.value)+parseInt(final_activity.value)+parseInt(final_attendance.value)+parseInt(final_exam.value)">
					<div class="row">
						<div class="col-md-5 col-md-offset-3">
							Percentage of
						</div>
						<div class="col-md-4">
							Number of
						</div>
					</div><br>
					<div class="row">
						<?php
							$query = "SELECT * FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
							$query_run = mysql_query($query);

							if(mysql_num_rows($query_run) > 0){
								echo '<div class="col-md-3">
							<b>Quizzes</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="final_quiz" value="'.mysql_result($query_run, 0, 'final_quizzes').'" oninput="quiz_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="quiz_result">'.mysql_result($query_run, 0, 'final_quizzes').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="final_quiz_number" value="'.mysql_result($query_run, 0, 'final_quizzes_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Assignments</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="final_assignment" value="'.mysql_result($query_run, 0, 'final_assignments').'" oninput="assignment_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="assignment_result">'.mysql_result($query_run, 0, 'final_assignments').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="final_assignment_number" value="'.mysql_result($query_run, 0, 'final_assignments_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Lab Exercises</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="final_activity" value="'.mysql_result($query_run, 0, 'final_lab_exercises').'" oninput="activity_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="activity_result">'.mysql_result($query_run, 0, 'final_lab_exercises').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="final_activity_number" value="'.mysql_result($query_run, 0, 'final_lab_exercises_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Attendances</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="final_attendance" value="'.mysql_result($query_run, 0, 'final_attendances').'" oninput="attendance_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="attendance_result">'.mysql_result($query_run, 0, 'final_attendances').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="final_attendance_number" value="'.mysql_result($query_run, 0, 'final_attendances_number').'">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Exams</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="final_exam" value="'.mysql_result($query_run, 0, 'final_exams').'" oninput="exam_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="exam_result">'.mysql_result($query_run, 0, 'final_exams').'</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
						</div>
					</div><br><br>';
							}else{
								echo '<div class="col-md-3">
							<b>Quizzes</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="quiz" value="20" oninput="quiz_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="quiz_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="quiz_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Assignments</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="assignment" value="20" oninput="assignment_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="assignment_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="assignment_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Lab Exercises</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="activity" value="20" oninput="activity_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="activity_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="activity_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Attendances</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="attendance" value="20" oninput="attendance_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="attendance_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<input type="number" name="attendance_number">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<b>Exams</b>
						</div>
						<div class="col-md-5">
							<input type="range" name="exam" value="20" oninput="exam_result.value=this.value" />
							<div class="row">
								<div class="col-md-1">
									<output id="exam_result">20</output>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
						</div>
					</div><br><br>';
							}

						?>
					<div class="row">
						<div class="col-md-3" style="margin-top: 8px;">
							<b>Total</b>
						</div>
						<div class="col-md-5">
							<div class="row">
								<div class="col-md-1">
									<?php
										$query1 = "SELECT prelim_quizzes, prelim_assignments, prelim_lab_exercises, prelim_attendances, prelim_exams FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
										$query_run1 = mysql_query($query1);

										if(mysql_num_rows($query_run1) > 0){
											if(mysql_result($query_run1, 0, 'prelim_quizzes') == '0' and mysql_result($query_run1, 0, 'prelim_assignments') == '0' and mysql_result($query_run1, 0, 'prelim_lab_exercises') == '0' and mysql_result($query_run1, 0, 'prelim_attendances') == '0' and mysql_result($query_run1, 0, 'prelim_exams') == '0'){
												echo '<output id="scores_total">0</output>';
											}else{
												echo '<output id="scores_total">100</output>';
											}
										}else{
											echo '<output id="scores_total">100</output>';
										}
									?>
								</div>
								<div class="col-md-1" style="margin-top: 7px;">
									%
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-block btn-success">SET</button>
						</div>
					</div>

				</form>
				</div>
			</div>
			
			<br><br>

			<div class="row">
				<div class="col-md-5 col-md-offset-4">
					<div style="color: coral;">
						<?php
							if(isset($mark_terms)){
								echo 'The Total of Terms Percentage needs to be exactly 100%';
							}else if(isset($mark_scores)){
								echo 'The Total of Scores Percentage needs to be exactly 100%';
							}
						?>
					</div>
				</div>
			</div>

		</div>
		

<br><br><br><br>
</body>
</html>
