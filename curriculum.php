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
    <title>Curriculum - MSU-TCTO S-ECE</title>

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
		
		
		<div id="page-wrapper" style="display: -webkit-box; -webkit-box-orient: horizontal;">
			<div style="-webkit-box-flex: 1; border-right: 3px solid #dddddd; margin-right: 3%; padding-right: 3%;">
				<?php 
					$query = "SELECT first_name, last_name, middle_name FROM accounts WHERE id_number = '$id_number' and role = 'Student' ";
					$query_run = mysql_query($query);

					echo '<h2 style="margin-bottom: 21%;"><b>'.mysql_result($query_run, 0, 'last_name').', '.mysql_result($query_run, 0, 'first_name').' '.mysql_result($query_run, 0, 'middle_name').'</b></h2>';
				?>
				<h2 style="margin-bottom: 15px;">Curriculum</h2>
				<h3>First Year, First Semester</h3><br><br>
				<table class="table table-condensed">
					<thead>
						<th>Subject</th>
						<th>Description</th>
						<th>Units</th>
					</thead>
					<tbody>
						<?php
							$query = "SELECT subject, description, units FROM curriculum WHERE (course_it = '$course' OR course_cs ='$course') AND semester_offered='first semester' AND year_offered='first year'";
							$query_run = mysql_query($query);

							$total = 0;
							$grand_total = 0;
							$earned_total = 0;

							while($query_row = mysql_fetch_assoc($query_run)){
								$query2 = "SELECT grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject WHERE grades.subject='".$query_row['subject']."' AND id_number = '$id_number' ";
								$query3 = "SELECT subject FROM subjects WHERE id_number = '$id_number' AND subject = '".$query_row['subject']."'";
								$query_run2 = mysql_query($query2);
								$query_run3 = mysql_query($query3);
								$query_row2 = mysql_fetch_assoc($query_run2);
								if(@$corrent_grade = mysql_result($query_run2, 0, 'grade')){}
								if($query_row2['grade'] == "INC"){
									echo '
										<tr>
											<td style="color: red;">'.$query_row['subject'].'</td>
											<td style="color: red;">'.$query_row['description'].'</td>
											<td style="color: red;">'.$query_row['units'].'</td>
										</tr>
									';
								}else if(mysql_num_rows($query_run2) > 0 and !empty($corrent_grade)){
									echo '
										<tr>
											<td style="color: #19e619;">'.$query_row['subject'].'</td>
											<td style="color: #19e619;">'.$query_row['description'].'</td>
											<td style="color: #19e619;">'.$query_row['units'].'</td>
										</tr>
									';
									$earned_total += $query_row['units'];
								}else if(mysql_num_rows($query_run3) > 0){
									echo '
										<tr>
											<td style="color: orange;">'.$query_row['subject'].'</td>
											<td style="color: orange;">'.$query_row['description'].'</td>
											<td style="color: orange;">'.$query_row['units'].'</td>
										</tr>
									';
								}else{
									echo '
										<tr>
											<td>'.$query_row['subject'].'</td>
											<td>'.$query_row['description'].'</td>
											<td>'.$query_row['units'].'</td>
										</tr>
									';
								}
								$grand_total += $query_row['units'];
								$total += $query_row['units'];
							}
						?>
										<tr>
											<td><b>Total</b></td>
											<td></td>
											<td><?php echo $total; ?></td>
										</tr>
					</tbody>
				</table><br><br>
				<h3>Second Year, First Semester</h3><br><br>
				<table class="table table-condensed">
					<thead>
						<th>Subject</th>
						<th>Description</th>
						<th>Units</th>
					</thead>
					<tbody>
						<?php
							$query = "SELECT subject, description, units FROM curriculum WHERE (course_it = '$course' OR course_cs ='$course') AND semester_offered='first semester' AND year_offered='second year'";
							$query_run = mysql_query($query);

							$total = 0;

							while($query_row = mysql_fetch_assoc($query_run)){
								$query2 = "SELECT grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject WHERE grades.subject='".$query_row['subject']."' AND id_number = '$id_number' ";
								$query3 = "SELECT subject FROM subjects WHERE id_number='$id_number' AND subject='".$query_row['subject']."'";
								$query_run2 = mysql_query($query2);
								$query_run3 = mysql_query($query3);
								$query_row2 = mysql_fetch_assoc($query_run2);
								if(@$corrent_grade = mysql_result($query_run2, 0, 'grade')){}
								if($query_row2['grade'] == "INC"){
									echo '
										<tr>
											<td style="color: red;">'.$query_row['subject'].'</td>
											<td style="color: red;">'.$query_row['description'].'</td>
											<td style="color: red;">'.$query_row['units'].'</td>
										</tr>
									';
								}else if(mysql_num_rows($query_run2) > 0 and !empty($corrent_grade)){
									echo '
										<tr>
											<td style="color: #19e619;">'.$query_row['subject'].'</td>
											<td style="color: #19e619;">'.$query_row['description'].'</td>
											<td style="color: #19e619;">'.$query_row['units'].'</td>
										</tr>
									';
									$earned_total += $query_row['units'];
								}else if(mysql_num_rows($query_run3) > 0){
									echo '
										<tr>
											<td style="color: orange;">'.$query_row['subject'].'</td>
											<td style="color: orange;">'.$query_row['description'].'</td>
											<td style="color: orange;">'.$query_row['units'].'</td>
										</tr>
									';
								}else{
									echo '
										<tr>
											<td>'.$query_row['subject'].'</td>
											<td>'.$query_row['description'].'</td>
											<td>'.$query_row['units'].'</td>
										</tr>
									';
								}
								$grand_total += $query_row['units'];
								$total += $query_row['units'];
							}
						?>
										<tr>
											<td><b>Total</b></td>
											<td></td>
											<td><?php echo $total; ?></td>
										</tr>
					</tbody>
				</table><br><br>
				<h3>Third Year, First Semester</h3><br><br>
				<table class="table table-condensed">
					<thead>
						<th>Subject</th>
						<th>Description</th>
						<th>Units</th>
					</thead>
					<tbody>
						<?php
							$query = "SELECT subject, description, units FROM curriculum WHERE (course_it = '$course' OR course_cs ='$course') AND semester_offered='first semester' AND year_offered='third year'";
							$query_run = mysql_query($query);

							$total = 0;

							while($query_row = mysql_fetch_assoc($query_run)){
								$query2 = "SELECT grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject WHERE grades.subject='".$query_row['subject']."' AND id_number = '$id_number' ";
								$query3 = "SELECT subject FROM subjects WHERE id_number='$id_number' AND subject='".$query_row['subject']."'";
								$query_run2 = mysql_query($query2);
								$query_run3 = mysql_query($query3);
								$query_row2 = mysql_fetch_assoc($query_run2);
								if(@$corrent_grade = mysql_result($query_run2, 0, 'grade')){}
								if($query_row2['grade'] == "INC"){
									echo '
										<tr>
											<td style="color: red;">'.$query_row['subject'].'</td>
											<td style="color: red;">'.$query_row['description'].'</td>
											<td style="color: red;">'.$query_row['units'].'</td>
										</tr>
									';
								}else if(mysql_num_rows($query_run2) > 0 and !empty($corrent_grade)){
									echo '
										<tr>
											<td style="color: #19e619;">'.$query_row['subject'].'</td>
											<td style="color: #19e619;">'.$query_row['description'].'</td>
											<td style="color: #19e619;">'.$query_row['units'].'</td>
										</tr>
									';
									$earned_total += $query_row['units'];
								}else if(mysql_num_rows($query_run3) > 0){
									echo '
										<tr>
											<td style="color: orange;">'.$query_row['subject'].'</td>
											<td style="color: orange;">'.$query_row['description'].'</td>
											<td style="color: orange;">'.$query_row['units'].'</td>
										</tr>
									';
								}else{
									echo '
										<tr>
											<td>'.$query_row['subject'].'</td>
											<td>'.$query_row['description'].'</td>
											<td>'.$query_row['units'].'</td>
										</tr>
									';
								}
								$grand_total += $query_row['units'];
								$total += $query_row['units'];
							}
						?>
										<tr>
											<td><b>Total</b></td>
											<td></td>
											<td><?php echo $total; ?></td>
										</tr>
					</tbody>
				</table><br><br>
				<h3>Fourth Year, First Semester</h3><br><br>
				<table class="table table-condensed">
					<thead>
						<th>Subject</th>
						<th>Description</th>
						<th>Units</th>
					</thead>
					<tbody>
						<?php
							$query = "SELECT subject, description, units FROM curriculum WHERE (course_it = '$course' OR course_cs ='$course') AND semester_offered='first semester' AND year_offered='fourth year'";
							$query_run = mysql_query($query);

							$total = 0;

							while($query_row = mysql_fetch_assoc($query_run)){
								$query2 = "SELECT grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject WHERE grades.subject='".$query_row['subject']."' AND id_number = '$id_number' ";
								$query3 = "SELECT subject FROM subjects WHERE id_number='$id_number' AND subject='".$query_row['subject']."'";
								$query_run2 = mysql_query($query2);
								$query_run3 = mysql_query($query3);
								$query_row2 = mysql_fetch_assoc($query_run2);
								if(@$corrent_grade = mysql_result($query_run2, 0, 'grade')){}
								if($query_row2['grade'] == "INC"){
									echo '
										<tr>
											<td style="color: red;">'.$query_row['subject'].'</td>
											<td style="color: red;">'.$query_row['description'].'</td>
											<td style="color: red;">'.$query_row['units'].'</td>
										</tr>
									';
								}else if(mysql_num_rows($query_run2) > 0 and !empty($corrent_grade)){
									echo '
										<tr>
											<td style="color: #19e619;">'.$query_row['subject'].'</td>
											<td style="color: #19e619;">'.$query_row['description'].'</td>
											<td style="color: #19e619;">'.$query_row['units'].'</td>
										</tr>
									';
									$earned_total += $query_row['units'];
								}else if(mysql_num_rows($query_run3) > 0){
									echo '
										<tr>
											<td style="color: orange;">'.$query_row['subject'].'</td>
											<td style="color: orange;">'.$query_row['description'].'</td>
											<td style="color: orange;">'.$query_row['units'].'</td>
										</tr>
									';
								}else{
									echo '
										<tr>
											<td>'.$query_row['subject'].'</td>
											<td>'.$query_row['description'].'</td>
											<td>'.$query_row['units'].'</td>
										</tr>
									';
								}
								$grand_total += $query_row['units'];
								$total += $query_row['units'];
							}
						?>
										<tr>
											<td><b>Total</b></td>
											<td></td>
											<td><?php echo $total; ?></td>
										</tr>
					</tbody>
				</table>
			</div>
			
			<div style="width: 50%;">
				<div class="row" style="border-bottom: 3px solid #dddddd; padding-bottom: 5%;">
					<h3 style="font-family: fantasy;">Color Coding</h3><br>
					<div class="col-md-4 col-md-offset-1">
						<span style="color: #19e619;"><i class="glyphicon glyphicon-cloud"></i> <b>Green</b> &nbsp;&nbsp;&nbsp;&nbsp;-----------------</span><br>
						<span style="color: orange;"><i class="glyphicon glyphicon-cloud"></i> <b>Orange</b> &nbsp;&nbsp;-----------------</span><br>
						<span style="color: red;"><i class="glyphicon glyphicon-cloud"></i> <b>Red</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----------------</span><br>
						<span ><i class="glyphicon glyphicon-cloud"></i> <b>Black</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----------------</span><br>
					</div>
					<div class="col-md-7">
						<span style="color: #19e619;">Subjects that have been Taken</span><br>
						<span style="color: orange;">Subjects that are Currently Taking</span><br>
						<span style="color: red;">Subjects with INC</span><br>
						<span >Subjects that have Not Taken Yet</span><br>
					</div>
				</div>
				<h3>First Year, Second Semester</h3><br><br>
				<table class="table table-condensed">
					<thead>
						<th>Subject</th>
						<th>Description</th>
						<th>Units</th>
					</thead>
					<tbody>
						<?php
							$query = "SELECT subject, description, units FROM curriculum WHERE (course_it = '$course' OR course_cs ='$course') AND semester_offered='second semester' AND year_offered='first year'";
							$query_run = mysql_query($query);

							$total = 0;

							while($query_row = mysql_fetch_assoc($query_run)){
								$query2 = "SELECT grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject WHERE grades.subject='".$query_row['subject']."' AND id_number = '$id_number' ";
								$query3 = "SELECT subject FROM subjects WHERE id_number='$id_number' AND subject='".$query_row['subject']."'";
								$query_run2 = mysql_query($query2);
								$query_run3 = mysql_query($query3);
								$query_row2 = mysql_fetch_assoc($query_run2);
								if(@$corrent_grade = mysql_result($query_run2, 0, 'grade')){}
								if($query_row2['grade'] == "INC"){
									echo '
										<tr>
											<td style="color: red;">'.$query_row['subject'].'</td>
											<td style="color: red;">'.$query_row['description'].'</td>
											<td style="color: red;">'.$query_row['units'].'</td>
										</tr>
									';
								}else if(mysql_num_rows($query_run2) > 0 and !empty($corrent_grade)){
									echo '
										<tr>
											<td style="color: #19e619;">'.$query_row['subject'].'</td>
											<td style="color: #19e619;">'.$query_row['description'].'</td>
											<td style="color: #19e619;">'.$query_row['units'].'</td>
										</tr>
									';
									$earned_total += $query_row['units'];
								}else if(mysql_num_rows($query_run3) > 0){
									echo '
										<tr>
											<td style="color: orange;">'.$query_row['subject'].'</td>
											<td style="color: orange;">'.$query_row['description'].'</td>
											<td style="color: orange;">'.$query_row['units'].'</td>
										</tr>
									';
								}else{
									echo '
										<tr>
											<td>'.$query_row['subject'].'</td>
											<td>'.$query_row['description'].'</td>
											<td>'.$query_row['units'].'</td>
										</tr>
									';
								}
								$grand_total += $query_row['units'];
								$total += $query_row['units'];
							}
						?>
										<tr>
											<td><b>Total</b></td>
											<td></td>
											<td><?php echo $total; ?></td>
										</tr>
					</tbody>
				</table><br><br>
				<h3>Second Year, Second Semester</h3><br><br>
				<table class="table table-condensed">
					<thead>
						<th>Subject</th>
						<th>Description</th>
						<th>Units</th>
					</thead>
					<tbody>
						<?php
							$query = "SELECT subject, description, units FROM curriculum WHERE (course_it = '$course' OR course_cs ='$course') AND semester_offered='second semester' AND year_offered='second year'";
							$query_run = mysql_query($query);

							$total = 0;

							while($query_row = mysql_fetch_assoc($query_run)){
								$query2 = "SELECT grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject WHERE grades.subject='".$query_row['subject']."' AND id_number = '$id_number' ";
								$query3 = "SELECT subject FROM subjects WHERE id_number='$id_number' AND subject='".$query_row['subject']."'";
								$query_run2 = mysql_query($query2);
								$query_run3 = mysql_query($query3);
								$query_row2 = mysql_fetch_assoc($query_run2);
								if(@$corrent_grade = mysql_result($query_run2, 0, 'grade')){}
								if($query_row2['grade'] == "INC"){
									echo '
										<tr>
											<td style="color: red;">'.$query_row['subject'].'</td>
											<td style="color: red;">'.$query_row['description'].'</td>
											<td style="color: red;">'.$query_row['units'].'</td>
										</tr>
									';
								}else if(mysql_num_rows($query_run2) > 0 and !empty($corrent_grade)){
									echo '
										<tr>
											<td style="color: #19e619;">'.$query_row['subject'].'</td>
											<td style="color: #19e619;">'.$query_row['description'].'</td>
											<td style="color: #19e619;">'.$query_row['units'].'</td>
										</tr>
									';
									$earned_total += $query_row['units'];
								}else if(mysql_num_rows($query_run3) > 0){
									echo '
										<tr>
											<td style="color: orange;">'.$query_row['subject'].'</td>
											<td style="color: orange;">'.$query_row['description'].'</td>
											<td style="color: orange;">'.$query_row['units'].'</td>
										</tr>
									';
								}else{
									echo '
										<tr>
											<td>'.$query_row['subject'].'</td>
											<td>'.$query_row['description'].'</td>
											<td>'.$query_row['units'].'</td>
										</tr>
									';
								}
								$grand_total += $query_row['units'];
								$total += $query_row['units'];
							}
						?>
										<tr>
											<td><b>Total</b></td>
											<td></td>
											<td><?php echo $total; ?></td>
										</tr>
					</tbody>
				</table><br><br>
				<h3>Third Year, Second Semester</h3><br><br>
				<table class="table table-condensed">
					<thead>
						<th>Subject</th>
						<th>Description</th>
						<th>Units</th>
					</thead>
					<tbody>
						<?php
							$query = "SELECT subject, description, units FROM curriculum WHERE (course_it = '$course' OR course_cs ='$course') AND semester_offered='second semester' AND year_offered='third year'";
							$query_run = mysql_query($query);

							$total = 0;

							while($query_row = mysql_fetch_assoc($query_run)){
								$query2 = "SELECT grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject WHERE grades.subject='".$query_row['subject']."' AND id_number = '$id_number' ";
								$query3 = "SELECT subject FROM subjects WHERE id_number='$id_number' AND subject='".$query_row['subject']."'";
								$query_run2 = mysql_query($query2);
								$query_run3 = mysql_query($query3);
								$query_row2 = mysql_fetch_assoc($query_run2);
								if(@$corrent_grade = mysql_result($query_run2, 0, 'grade')){}
								if($query_row2['grade'] == "INC"){
									echo '
										<tr>
											<td style="color: red;">'.$query_row['subject'].'</td>
											<td style="color: red;">'.$query_row['description'].'</td>
											<td style="color: red;">'.$query_row['units'].'</td>
										</tr>
									';
								}else if(mysql_num_rows($query_run2) > 0 and !empty($corrent_grade)){
									echo '
										<tr>
											<td style="color: #19e619;">'.$query_row['subject'].'</td>
											<td style="color: #19e619;">'.$query_row['description'].'</td>
											<td style="color: #19e619;">'.$query_row['units'].'</td>
										</tr>
									';
									$earned_total += $query_row['units'];
								}else if(mysql_num_rows($query_run3) > 0){
									echo '
										<tr>
											<td style="color: orange;">'.$query_row['subject'].'</td>
											<td style="color: orange;">'.$query_row['description'].'</td>
											<td style="color: orange;">'.$query_row['units'].'</td>
										</tr>
									';
								}else{
									echo '
										<tr>
											<td>'.$query_row['subject'].'</td>
											<td>'.$query_row['description'].'</td>
											<td>'.$query_row['units'].'</td>
										</tr>
									';
								}
								$grand_total += $query_row['units'];
								$total += $query_row['units'];
							}
						?>
										<tr>
											<td><b>Total</b></td>
											<td></td>
											<td><?php echo $total; ?></td>
										</tr>
					</tbody>
				</table><br><br>
				<h3>Fourth Year, Second Semester</h3><br><br>
				<table class="table table-condensed">
					<thead>
						<th>Subject</th>
						<th>Description</th>
						<th>Units</th>
					</thead>
					<tbody>
						<?php
							$query = "SELECT subject, description, units FROM curriculum WHERE (course_it = '$course' OR course_cs ='$course') AND semester_offered='second semester' AND year_offered='fourth year'";
							$query_run = mysql_query($query);

							$total = 0;

							while($query_row = mysql_fetch_assoc($query_run)){
								$query2 = "SELECT grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject WHERE grades.subject='".$query_row['subject']."' AND id_number = '$id_number' ";
								$query3 = "SELECT subject FROM subjects WHERE id_number='$id_number' AND subject='".$query_row['subject']."'";
								$query_run2 = mysql_query($query2);
								$query_run3 = mysql_query($query3);
								$query_row2 = mysql_fetch_assoc($query_run2);
								if(@$corrent_grade = mysql_result($query_run2, 0, 'grade')){}
								if($query_row2['grade'] == "INC"){
									echo '
										<tr>
											<td style="color: red;">'.$query_row['subject'].'</td>
											<td style="color: red;">'.$query_row['description'].'</td>
											<td style="color: red;">'.$query_row['units'].'</td>
										</tr>
									';
								}else if(mysql_num_rows($query_run2) > 0 and !empty($corrent_grade)){
									echo '
										<tr>
											<td style="color: #19e619;">'.$query_row['subject'].'</td>
											<td style="color: #19e619;">'.$query_row['description'].'</td>
											<td style="color: #19e619;">'.$query_row['units'].'</td>
										</tr>
									';
									$earned_total += $query_row['units'];
								}else if(mysql_num_rows($query_run3) > 0){
									echo '
										<tr>
											<td style="color: orange;">'.$query_row['subject'].'</td>
											<td style="color: orange;">'.$query_row['description'].'</td>
											<td style="color: orange;">'.$query_row['units'].'</td>
										</tr>
									';
								}else{
									echo '
										<tr>
											<td>'.$query_row['subject'].'</td>
											<td>'.$query_row['description'].'</td>
											<td>'.$query_row['units'].'</td>
										</tr>
									';
								}
								$grand_total += $query_row['units'];
								$total += $query_row['units'];
							}
						?>
										<tr>
											<td><b>Total</b></td>
											<td></td>
											<td><?php echo $total; ?></td>
										</tr>
					</tbody>
				</table><br><br>

				<table class="table table-condensed">
					<thead>
						<th style="color: #19e619;">Total Units Earned</th>
						<th>Grand Total Units</th>
					</thead>
					<tbody>
						<td style="color: #19e619;""><?php echo $earned_total;?></td>
						<td><?php echo $grand_total;?></td>
					</tbody>
				</table>

				<?php
					if(isset($_GET['print'])){
						echo '<center style="color: coral;">Printed Form</center>';
					}
				?>

			<?php
			if(isset($_GET['print'])){
				echo "
				<script type='text/javascript'>
					var printing = printPage('page-wrapper');
					function printPage(divName){
						var printContents = document.getElementById('page-wrapper').innerHTML;
						var originalContents = document.body.innerHTML;
						
						document.body.innerHTML = printContents;

						window.print();

						document.body.innerHTML = originalContents;

					}
				</script>
				";
			}
			?>

			<a href="?curriculum=<?php echo $_GET['curriculum'];?>&print=true" class="btn-sm btn-danger" style="float: right; margin-right: 10%; padding-left: 25px; padding-right: 25px;" >Print</a>

			<br><br>
			</div>
		</div>
		


</body>
</html>
