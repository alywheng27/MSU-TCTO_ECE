<?php
	if(isset($_POST['semester']) and isset($_POST['year'])){
		$year = $_POST['year'];
		$semester = $_POST['semester'];

		$subject = $_GET['submit_grade_subject'];





		$query0 = "SELECT semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."' ";
		$query_run0 = mysql_query($query0);

		$query = "DELETE FROM grades WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM quizzes WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM assignments WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM lab_exercises WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM attendances WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM exams WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);







		$query = "SELECT subject FROM subjects_percentage WHERE subject = '$subject'";
		$query_run = mysql_query($query);

		if(mysql_num_rows($query_run) > 0){
			$query = "UPDATE subjects_percentage SET year = '$year', semester = '$semester' WHERE subject = '$subject' ";
			$query_run = mysql_query($query);

			$mark_semyear = 'true';
		}else{
			$query = "INSERT INTO subjects_percentage (year, semester) VALUES ('$year', '$semester') ";
			$query_run = mysql_query($query);

			$mark_semyear = 'true';
		}
	}

	if(isset($_POST['prelim_final']) and isset($_POST['midterm_final']) and isset($_POST['final_final'])){
		$prelim_final = $_POST['prelim_final'];
		$midterm_final = $_POST['midterm_final'];
		$final_final = $_POST['final_final'];

		$subject = $_GET['submit_grade_subject'];

		$output_term = $prelim_final + $midterm_final + $final_final;





		$query0 = "SELECT semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."' ";
		$query_run0 = mysql_query($query0);

		$query = "DELETE FROM grades WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM quizzes WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM assignments WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM lab_exercises WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM attendances WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM exams WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);






		if($output_term == 100){
			$query = "SELECT subject FROM subjects_percentage WHERE subject = '$subject'";
			$query_run = mysql_query($query);

			if(mysql_num_rows($query_run) > 0){
				$query = "UPDATE subjects_percentage SET prelim = '$prelim_final', midterm = '$midterm_final', final = '$final_final' WHERE subject = '$subject'";
				$query_run = mysql_query($query);
			}else{
				$query = "INSERT INTO subjects_percentage (subject, prelim, midterm, final) VALUES ('$subject', '$prelim_final', '$midterm_final', '$final_final')";
				$query_run = mysql_query($query);
			}
		}else{
			$mark_terms = 'true';
		}
	}

	if(isset($_POST['quiz']) and isset($_POST['assignment']) and isset($_POST['activity']) and isset($_POST['attendance']) and isset($_POST['exam']) and isset($_POST['quiz_number']) and isset($_POST['assignment_number']) and isset($_POST['activity_number']) and isset($_POST['attendance_number'])){

		$quiz = $_POST['quiz'];
		$assignment = $_POST['assignment'];
		$activity = $_POST['activity'];
		$attendance = $_POST['attendance'];
		$exam = $_POST['exam'];

		$quiz_number = $_POST['quiz_number'];
		$assignment_number = $_POST['assignment_number'];
		$activity_number = $_POST['activity_number'];
		$attendance_number = $_POST['attendance_number'];


		$subject = $_GET['submit_grade_subject'];






		$query0 = "SELECT semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."' ";
		$query_run0 = mysql_query($query0);

		$query = "DELETE FROM grades WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM quizzes WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM assignments WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM lab_exercises WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM attendances WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM exams WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);







		$output_score = $quiz + $assignment + $activity + $attendance + $exam;

		if($output_score == 100){
			$query = "SELECT subject FROM subjects_percentage WHERE subject = '$subject'";
			$query_run = mysql_query($query);

			if(mysql_num_rows($query_run) > 0){
				$query = "UPDATE subjects_percentage SET prelim_quizzes = '$quiz', prelim_assignments = '$assignment', prelim_lab_exercises = '$activity', prelim_attendances = '$attendance', prelim_exams = '$exam', prelim_quizzes_number = '$quiz_number', prelim_assignments_number = '$assignment_number', prelim_lab_exercises_number = '$activity_number', prelim_attendances_number = '$attendance_number' WHERE subject = '$subject'";
				$query_run = mysql_query($query);
			}else{
				$query = "INSERT INTO subjects_percentage (subject, prelim_quizzes, prelim_assignments, prelim_lab_exercises, prelim_attendances, prelim_exams, prelim_quizzes_number, prelim_assignments_number, prelim_lab_exercises_number, prelim_attendances_number) VALUES ('$subject', '$quiz', '$assignment', '$activity', '$attendance', '$exam', '$quiz_number', '$assignment_number', '$activity_number', '$attendance_number')";
				$query_run = mysql_query($query);
			}
		}else{
			$mark_scores = 'true';
		}
	}

	if(isset($_POST['midterm_quiz']) and isset($_POST['midterm_assignment']) and isset($_POST['midterm_activity']) and isset($_POST['midterm_attendance']) and isset($_POST['midterm_exam']) and isset($_POST['midterm_quiz_number']) and isset($_POST['midterm_assignment_number']) and isset($_POST['midterm_activity_number']) and isset($_POST['midterm_attendance_number'])){

		$midterm_quiz = $_POST['midterm_quiz'];
		$midterm_assignment = $_POST['midterm_assignment'];
		$midterm_activity = $_POST['midterm_activity'];
		$midterm_attendance = $_POST['midterm_attendance'];
		$midterm_exam = $_POST['midterm_exam'];

		$midterm_quiz_number = $_POST['midterm_quiz_number'];
		$midterm_assignment_number = $_POST['midterm_assignment_number'];
		$midterm_activity_number = $_POST['midterm_activity_number'];
		$midterm_attendance_number = $_POST['midterm_attendance_number'];

		$subject = $_GET['submit_grade_subject'];






		$query0 = "SELECT semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."' ";
		$query_run0 = mysql_query($query0);

		$query = "DELETE FROM grades WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM quizzes WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM assignments WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM lab_exercises WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM attendances WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM exams WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);






		$output_score = $midterm_quiz + $midterm_assignment + $midterm_activity + $midterm_attendance + $midterm_exam;

		if($output_score == 100){
			$query = "SELECT subject FROM subjects_percentage WHERE subject = '$subject'";
			$query_run = mysql_query($query);

			if(mysql_num_rows($query_run) > 0){
				$query = "UPDATE subjects_percentage SET midterm_quizzes = '$midterm_quiz', midterm_assignments = '$midterm_assignment', midterm_lab_exercises = '$midterm_activity', midterm_attendances = '$midterm_attendance', midterm_exams = '$midterm_exam', midterm_quizzes_number = '$midterm_quiz_number', midterm_assignments_number = '$midterm_assignment_number', midterm_lab_exercises_number = '$midterm_activity_number', midterm_attendances_number = '$midterm_attendance_number' WHERE subject = '$subject'";
				$query_run = mysql_query($query);
			}else{
				$query = "INSERT INTO subjects_percentage (subject, midterm_quizzes, midterm_assignments, midterm_lab_exercises, midterm_attendances, midterm_exams, midterm_quizzes_number, midterm_assignments_number, midterm_lab_exercises_number, midterm_attendances_number) VALUES ('$subject', '$midterm_quiz', '$midterm_assignment', '$midterm_activity', '$midterm_attendance', '$midterm_exam', '$midterm_quiz_number', '$midterm_assignment_number', '$midterm_activity_number', '$midterm_attendance_number')";
				$query_run = mysql_query($query);
			}
		}else{
			$mark_scores = 'true';
		}
	}

	if(isset($_POST['final_quiz']) and isset($_POST['final_assignment']) and isset($_POST['final_activity']) and isset($_POST['final_attendance']) and isset($_POST['final_exam']) and isset($_POST['final_quiz_number']) and isset($_POST['final_assignment_number']) and isset($_POST['final_activity_number']) and isset($_POST['final_attendance_number'])){

		$final_quiz = $_POST['final_quiz'];
		$final_assignment = $_POST['final_assignment'];
		$final_activity = $_POST['final_activity'];
		$final_attendance = $_POST['final_attendance'];
		$final_exam = $_POST['final_exam'];

		$final_quiz_number = $_POST['final_quiz_number'];
		$final_assignment_number = $_POST['final_assignment_number'];
		$final_activity_number = $_POST['final_activity_number'];
		$final_attendance_number = $_POST['final_attendance_number'];


		$subject = $_GET['submit_grade_subject'];






		$query0 = "SELECT semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."' ";
		$query_run0 = mysql_query($query0);

		$query = "DELETE FROM grades WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM quizzes WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM assignments WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM lab_exercises WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM attendances WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$query = "DELETE FROM exams WHERE subject = '$subject' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);





		

		$output_score = $final_quiz + $final_assignment + $final_activity + $final_attendance + $final_exam;

		if($output_score == 100){
			$query = "SELECT subject FROM subjects_percentage WHERE subject = '$subject'";
			$query_run = mysql_query($query);

			if(mysql_num_rows($query_run) > 0){
				$query = "UPDATE subjects_percentage SET final_quizzes = '$final_quiz', final_assignments = '$final_assignment', final_lab_exercises = '$final_activity', final_attendances = '$final_attendance', final_exams = '$final_exam', final_quizzes_number = '$final_quiz_number', final_assignments_number = '$final_assignment_number', final_lab_exercises_number = '$final_activity_number', final_attendances_number = '$final_attendance_number' WHERE subject = '$subject'";
				$query_run = mysql_query($query);
			}else{
				$query = "INSERT INTO subjects_percentage (subject, final_quizzes, final_assignments, final_lab_exercises, final_attendances, final_exams, final_quizzes_number, final_assignments_number, final_lab_exercises_number, final_attendances_number) VALUES ('$subject', '$final_quiz', '$final_assignment', '$final_activity', '$final_attendance', '$final_exam', '$final_quiz_number', '$final_assignment_number', '$final_activity_number', '$final_attendance_number')";
				$query_run = mysql_query($query);
			}
		}else{
			$mark_scores = 'true';
		}

	}

	if(isset($_POST['submit_scores'])){
		$query = "SELECT prelim_quizzes_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'prelim_quizzes_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO quizzes (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Prelim', '".$_POST['prelim_quiz_score'.$i.'']."', '".$_POST['prelim_quiz_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT prelim_assignments_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'prelim_assignments_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO assignments (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Prelim', '".$_POST['prelim_assignment_score'.$i.'']."', '".$_POST['prelim_assignment_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT prelim_lab_exercises_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'prelim_lab_exercises_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO lab_exercises (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Prelim', '".$_POST['prelim_lab_exercise_score'.$i.'']."', '".$_POST['prelim_lab_exercise_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT prelim_attendances_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'prelim_attendances_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO attendances (id_number, subject, term, date, presence, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Prelim', '".$_POST['prelim_attendance_date'.$i.'']."', '".$_POST['prelim_attendance_presence'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}


		$query1 = "INSERT INTO exams (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Prelim', '".$_POST['prelim_exam_score']."', '".$_POST['prelim_exam_overall']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
		$query_run1 = mysql_query($query1);




		$query = "SELECT midterm_quizzes_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'midterm_quizzes_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO quizzes (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Midterm', '".$_POST['midterm_quiz_score'.$i.'']."', '".$_POST['midterm_quiz_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT midterm_assignments_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'midterm_assignments_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO assignments (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Midterm', '".$_POST['midterm_assignment_score'.$i.'']."', '".$_POST['midterm_assignment_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT midterm_lab_exercises_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'midterm_lab_exercises_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO lab_exercises (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Midterm', '".$_POST['midterm_lab_exercise_score'.$i.'']."', '".$_POST['midterm_lab_exercise_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT midterm_attendances_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'midterm_attendances_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO attendances (id_number, subject, term, date, presence, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Midterm', '".$_POST['midterm_attendance_date'.$i.'']."', '".$_POST['midterm_attendance_presence'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}


		$query1 = "INSERT INTO exams (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Midterm', '".$_POST['midterm_exam_score']."', '".$_POST['midterm_exam_overall']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
		$query_run1 = mysql_query($query1);





		$query = "SELECT final_quizzes_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'final_quizzes_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO quizzes (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Final', '".$_POST['final_quiz_score'.$i.'']."', '".$_POST['final_quiz_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT final_assignments_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'final_assignments_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO assignments (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Final', '".$_POST['final_assignment_score'.$i.'']."', '".$_POST['final_assignment_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT final_lab_exercises_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'final_lab_exercises_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO lab_exercises (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Final', '".$_POST['final_lab_exercise_score'.$i.'']."', '".$_POST['final_lab_exercise_overall'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query = "SELECT final_attendances_number, semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$loop_number = mysql_result($query_run, 0, 'final_attendances_number');

		for ($i=0; $i < $loop_number; $i++) { 
			$query1 = "INSERT INTO attendances (id_number, subject, term, date, presence, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Final', '".$_POST['final_attendance_date'.$i.'']."', '".$_POST['final_attendance_presence'.$i.'']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
			$query_run1 = mysql_query($query1);
		}

		$query1 = "INSERT INTO exams (id_number, subject, term, score, overall, semester, year) VALUES ('".$_GET['id_number']."', '".$_GET['submit_grade_subject']."', 'Final', '".$_POST['final_exam_score']."', '".$_POST['final_exam_overall']."', '".mysql_result($query_run, 0, 'semester')."', '".mysql_result($query_run, 0, 'year')."')";
		$query_run1 = mysql_query($query1);





		/************************** Calculate Grade ***************************************/


		$query0 = "SELECT semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run0 = mysql_query($query0);

		$query = "SELECT score, overall FROM quizzes WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Prelim' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$prelim_quiz_score = 0;
		$prelim_quiz_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$prelim_quiz_score += $query_row['score'];
			$prelim_quiz_overall += $query_row['overall'];
		}

		if($prelim_quiz_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $prelim_quiz_score / $prelim_quiz_overall * 100;
		}
		

		if($grade < 50)
			$prelim_quiz_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$prelim_quiz_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$prelim_quiz_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$prelim_quiz_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$prelim_quiz_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$prelim_quiz_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$prelim_quiz_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$prelim_quiz_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$prelim_quiz_grade = '1.25';
		else if($grade >= 95)
			$prelim_quiz_grade = '1.00';


		$query = "SELECT score, overall FROM assignments WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Prelim'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$prelim_assignment_score = 0;
		$prelim_assignment_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$prelim_assignment_score += $query_row['score'];
			$prelim_assignment_overall += $query_row['overall'];
		}

		if($prelim_assignment_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $prelim_assignment_score / $prelim_assignment_overall * 100;
		}
		
		if($grade < 50)
			$prelim_assignment_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$prelim_assignment_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$prelim_assignment_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$prelim_assignment_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$prelim_assignment_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$prelim_assignment_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$prelim_assignment_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$prelim_assignment_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$prelim_assignment_grade = '1.25';
		else if($grade >= 95)
			$prelim_assignment_grade = '1.00';


		$query = "SELECT score, overall FROM lab_exercises WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Prelim'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$prelim_lab_exercise_score = 0;
		$prelim_lab_exercise_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$prelim_lab_exercise_score += $query_row['score'];
			$prelim_lab_exercise_overall += $query_row['overall'];
		}

		if($prelim_lab_exercise_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $prelim_lab_exercise_score / $prelim_lab_exercise_overall * 100;
		}
		
		if($grade < 50)
			$prelim_lab_exercise_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$prelim_lab_exercise_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$prelim_lab_exercise_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$prelim_lab_exercise_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$prelim_lab_exercise_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$prelim_lab_exercise_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$prelim_lab_exercise_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$prelim_lab_exercise_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$prelim_lab_exercise_grade = '1.25';
		else if($grade >= 95)
			$prelim_lab_exercise_grade = '1.00';


		$query = "SELECT presence FROM attendances WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Prelim'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$prelim_attendace_score = 0;
		$prelim_attendance_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			if($query_row['presence'] == 'Present'){
				$prelim_attendace_score += 1;
			}else if($query_row['presence'] == 'Late'){
				$prelim_attendace_score += 0.5;
			}
			$prelim_attendance_overall++;
		}

		if($prelim_attendance_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $prelim_attendace_score / $prelim_attendance_overall * 100;
		}
		
		if($grade < 50)
			$prelim_attendance_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$prelim_attendance_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$prelim_attendance_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$prelim_attendance_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$prelim_attendance_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$prelim_attendance_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$prelim_attendance_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$prelim_attendance_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$prelim_attendance_grade = '1.25';
		else if($grade >= 95)
			$prelim_attendance_grade = '1.00';



		$query = "SELECT score, overall FROM exams WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Prelim'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$prelim_exam_score = mysql_result($query_run, 0, 'score');
		$prelim_exam_overall = mysql_result($query_run, 0, 'overall');

		if($prelim_exam_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $prelim_exam_score / $prelim_exam_overall * 100;
		}
		
		if($grade < 50)
			$prelim_exam_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$prelim_exam_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$prelim_exam_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$prelim_exam_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$prelim_exam_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$prelim_exam_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$prelim_exam_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$prelim_exam_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$prelim_exam_grade = '1.25';
		else if($grade >= 95)
			$prelim_exam_grade = '1.00';


		/********************************* 	midterm 	**************************************************/


		$query = "SELECT score, overall FROM quizzes WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Midterm' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$midterm_quiz_score = 0;
		$midterm_quiz_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$midterm_quiz_score += $query_row['score'];
			$midterm_quiz_overall += $query_row['overall'];
		}

		if($midterm_quiz_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $midterm_quiz_score / $midterm_quiz_overall * 100;
		}
		
		if($grade < 50)
			$midterm_quiz_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$midterm_quiz_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$midterm_quiz_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$midterm_quiz_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$midterm_quiz_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$midterm_quiz_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$midterm_quiz_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$midterm_quiz_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$midterm_quiz_grade = '1.25';
		else if($grade >= 95)
			$midterm_quiz_grade = '1.00';


		$query = "SELECT score, overall FROM assignments WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Midterm'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$midterm_assignment_score = 0;
		$midterm_assignment_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$midterm_assignment_score += $query_row['score'];
			$midterm_assignment_overall += $query_row['overall'];
		}

		if($midterm_assignment_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $midterm_assignment_score / $midterm_assignment_overall * 100;
		}
		
		if($grade < 50)
			$midterm_assignment_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$midterm_assignment_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$midterm_assignment_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$midterm_assignment_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$midterm_assignment_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$midterm_assignment_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$midterm_assignment_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$midterm_assignment_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$midterm_assignment_grade = '1.25';
		else if($grade >= 95)
			$midterm_assignment_grade = '1.00';


		$query = "SELECT score, overall FROM lab_exercises WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Midterm'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$midterm_lab_exercise_score = 0;
		$midterm_lab_exercise_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$midterm_lab_exercise_score += $query_row['score'];
			$midterm_lab_exercise_overall += $query_row['overall'];
		}

		if($midterm_lab_exercise_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $midterm_lab_exercise_score / $midterm_lab_exercise_overall * 100;
		}
		
		if($grade < 50)
			$midterm_lab_exercise_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$midterm_lab_exercise_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$midterm_lab_exercise_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$midterm_lab_exercise_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$midterm_lab_exercise_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$midterm_lab_exercise_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$midterm_lab_exercise_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$midterm_lab_exercise_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$midterm_lab_exercise_grade = '1.25';
		else if($grade >= 95)
			$midterm_lab_exercise_grade = '1.00';


		$query = "SELECT presence FROM attendances WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Midterm'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$midterm_attendace_score = 0;
		$midterm_attendance_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			if($query_row['presence'] == 'Present'){
				$midterm_attendace_score += 1;
			}else if($query_row['presence'] == 'Late'){
				$midterm_attendace_score += 0.5;
			}
			$midterm_attendance_overall++;
		}

		if($midterm_attendance_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $midterm_attendace_score / $midterm_attendance_overall * 100;
		}
		
		if($grade < 50)
			$midterm_attendance_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$midterm_attendance_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$midterm_attendance_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$midterm_attendance_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$midterm_attendance_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$midterm_attendance_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$midterm_attendance_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$midterm_attendance_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$midterm_attendance_grade = '1.25';
		else if($grade >= 95)
			$midterm_attendance_grade = '1.00';



		$query = "SELECT score, overall FROM exams WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Midterm'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$midterm_exam_score = mysql_result($query_run, 0, 'score');
		$midterm_exam_overall = mysql_result($query_run, 0, 'overall');

		if($midterm_exam_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $midterm_exam_score / $midterm_exam_overall * 100;
		}
		
		if($grade < 50)
			$midterm_exam_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$midterm_exam_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$midterm_exam_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$midterm_exam_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$midterm_exam_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$midterm_exam_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$midterm_exam_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$midterm_exam_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$midterm_exam_grade = '1.25';
		else if($grade >= 95)
			$midterm_exam_grade = '1.00';


		/********************************* 	Final 	**************************************************/


		$query = "SELECT score, overall FROM quizzes WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Final' AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$final_quiz_score = 0;
		$final_quiz_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$final_quiz_score += $query_row['score'];
			$final_quiz_overall += $query_row['overall'];
		}

		if($final_quiz_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $final_quiz_score / $final_quiz_overall * 100;
		}
		
		if($grade < 50)
			$final_quiz_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$final_quiz_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$final_quiz_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$final_quiz_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$final_quiz_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$final_quiz_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$final_quiz_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$final_quiz_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$final_quiz_grade = '1.25';
		else if($grade >= 95)
			$final_quiz_grade = '1.00';


		$query = "SELECT score, overall FROM assignments WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Final'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$final_assignment_score = 0;
		$final_assignment_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$final_assignment_score += $query_row['score'];
			$final_assignment_overall += $query_row['overall'];
		}

		if($final_assignment_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $final_assignment_score / $final_assignment_overall * 100;
		}
		
		if($grade < 50)
			$final_assignment_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$final_assignment_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$final_assignment_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$final_assignment_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$final_assignment_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$final_assignment_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$final_assignment_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$final_assignment_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$final_assignment_grade = '1.25';
		else if($grade >= 95)
			$final_assignment_grade = '1.00';


		$query = "SELECT score, overall FROM lab_exercises WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Final'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$final_lab_exercise_score = 0;
		$final_lab_exercise_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$final_lab_exercise_score += $query_row['score'];
			$final_lab_exercise_overall += $query_row['overall'];
		}

		if($final_lab_exercise_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $final_lab_exercise_score / $final_lab_exercise_overall * 100;
		}
		
		if($grade < 50)
			$final_lab_exercise_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$final_lab_exercise_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$final_lab_exercise_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$final_lab_exercise_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$final_lab_exercise_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$final_lab_exercise_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$final_lab_exercise_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$final_lab_exercise_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$final_lab_exercise_grade = '1.25';
		else if($grade >= 95)
			$final_lab_exercise_grade = '1.00';


		$query = "SELECT presence FROM attendances WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Final'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$final_attendace_score = 0;
		$final_attendance_overall = 0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			if($query_row['presence'] == 'Present'){
				$final_attendace_score += 1;
			}else if($query_row['presence'] == 'Late'){
				$final_attendace_score += 0.5;
			}
			$final_attendance_overall++;
		}

		if($final_attendance_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $final_attendace_score / $final_attendance_overall * 100;
		}
		
		if($grade < 50)
			$final_attendance_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$final_attendance_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$final_attendance_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$final_attendance_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$final_attendance_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$final_attendance_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$final_attendance_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$final_attendance_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$final_attendance_grade = '1.25';
		else if($grade >= 95)
			$final_attendance_grade = '1.00';



		$query = "SELECT score, overall FROM exams WHERE id_number = '".$_GET['id_number']."' AND subject = '".$_GET['submit_grade_subject']."' AND term = 'Final'  AND semester = '".mysql_result($query_run0, 0, 'semester')."' AND year = '".mysql_result($query_run0, 0, 'year')."' ";
		$query_run = mysql_query($query);

		$final_exam_score = mysql_result($query_run, 0, 'score');
		$final_exam_overall = mysql_result($query_run, 0, 'overall');

		if($final_exam_overall == 0){
			$grade = 1 / 1 * 100;
		}else{
			$grade = $final_exam_score / $final_exam_overall * 100;
		}
		
		if($grade < 50)
			$final_exam_grade = '5.00';
		else if($grade >= 50 and $grade < 56)
			$final_exam_grade = '3.00';
		else if($grade >= 56 and $grade < 62)
			$final_exam_grade = '2.75';
		else if($grade >= 62 and $grade < 67)
			$final_exam_grade = '2.50';
		else if($grade >= 67 and $grade < 73)
			$final_exam_grade = '2.25';
		else if($grade >= 73 and $grade < 78)
			$final_exam_grade = '2.00';
		else if($grade >= 78 and $grade < 84)
			$final_exam_grade = '1.75';
		else if($grade >= 84 and $grade < 89)
			$final_exam_grade = '1.50';
		else if($grade >= 89 and $grade < 95)
			$final_exam_grade = '1.25';
		else if($grade >= 95)
			$final_exam_grade = '1.00';



		/* ***************************** 	Compute Average Grade 	*************************************/


		$query = "SELECT * FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."'";
		$query_run = mysql_query($query);

		$prelim_quiz_percent = mysql_result($query_run, 0, 'prelim_quizzes');
		$prelim_assignment_percent = mysql_result($query_run, 0, 'prelim_assignments');
		$prelim_lab_exercise_percent = mysql_result($query_run, 0, 'prelim_lab_exercises');
		$prelim_attendance_percent = mysql_result($query_run, 0, 'prelim_attendances');
		$prelim_exam_percent = mysql_result($query_run, 0, 'prelim_exams');

		$midterm_quiz_percent = mysql_result($query_run, 0, 'midterm_quizzes');
		$midterm_assignment_percent = mysql_result($query_run, 0, 'midterm_assignments');
		$midterm_lab_exercise_percent = mysql_result($query_run, 0, 'midterm_lab_exercises');
		$midterm_attendance_percent = mysql_result($query_run, 0, 'midterm_attendances');
		$midterm_exam_percent = mysql_result($query_run, 0, 'midterm_exams');

		$final_quiz_percent = mysql_result($query_run, 0, 'final_quizzes');
		$final_assignment_percent = mysql_result($query_run, 0, 'final_assignments');
		$final_lab_exercise_percent = mysql_result($query_run, 0, 'final_lab_exercises');
		$final_attendance_percent = mysql_result($query_run, 0, 'final_attendances');
		$final_exam_percent = mysql_result($query_run, 0, 'final_exams');

		$prelim_percent = mysql_result($query_run, 0, 'prelim');
		$midterm_percent = mysql_result($query_run, 0, 'midterm');
		$final_percent = mysql_result($query_run, 0, 'final');


		$prelim_grade = (($prelim_quiz_grade * $prelim_quiz_percent)+($prelim_assignment_grade * $prelim_assignment_percent)+($prelim_lab_exercise_grade * $prelim_lab_exercise_percent)+($prelim_attendance_grade * $prelim_attendance_percent)+($prelim_exam_grade * $prelim_exam_percent)) / 100;

		$midterm_grade = (($midterm_quiz_grade * $midterm_quiz_percent)+($midterm_assignment_grade * $midterm_assignment_percent)+($midterm_lab_exercise_grade * $midterm_lab_exercise_percent)+($midterm_attendance_grade * $midterm_attendance_percent)+($midterm_exam_grade * $midterm_exam_percent)) / 100;

		$final_grade = (($final_quiz_grade * $final_quiz_percent)+($final_assignment_grade * $final_assignment_percent)+($final_lab_exercise_grade * $final_lab_exercise_percent)+($final_attendance_grade * $final_attendance_percent)+($final_exam_grade * $final_exam_percent)) / 100;


		$raw_grade = (($prelim_grade * $prelim_percent)+($midterm_grade * $midterm_percent)+($final_grade * $final_percent)) / 100;

		if($raw_grade == 1){
			$raw_grade = '1.00';
		}else if($raw_grade == 2){
			$raw_grade = '2.00';
		}else if($raw_grade == 3){
			$raw_grade = '3.00';
		}else if($raw_grade == 4){
			$raw_grade = '4.00';
		}else if($raw_grade == 5){
			$raw_grade = '5.00';
		}

		$query = "INSERT INTO grades (id_number, raw_grade, subject, semester, year) VALUES ('".$_GET['id_number']."', '$raw_grade', '".$_GET['submit_grade_subject']."', '".mysql_result($query_run0, 0, 'semester')."', '".mysql_result($query_run0, 0, 'year')."') ";
		$query_run = mysql_query($query);
	}

	if(isset($_POST['grade_enter'])){
		$grade_enter = $_POST['grade_enter'];
		$submit_grade_subject = $_GET['submit_grade_subject'];
		$grade_id = $_GET['grade_id'];

		$query = "UPDATE grades SET grade = '$grade_enter' WHERE id_number = '$grade_id' AND subject = '$submit_grade_subject' ";
		$query_run = mysql_query($query);
	}
?>