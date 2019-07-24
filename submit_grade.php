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
    <title>Submit Grade - MSU-TCTO S-ECE</title>

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
			<h3> <?php echo $_GET['submit_grade_subject'];?> <br><span style="font-size: 16px; color: lightgrey;">SUBMIT GRADE</span></h3><br><br>
			
			<div class="row">
				<div class="col-md-9">
					<table class="table table-condensed table-hover">
						<thead>
							<th>Name</th>
							<th>Course</th>
							<th>Raw Grade</th>
							<th>Grade</th>
							<th></th>
						</thead>
						<tbody>
							<?php
								$query = "SELECT DISTINCT accounts.id_number, first_name, middle_name, last_name, course FROM accounts JOIN accounts_info ON accounts.id_number = accounts_info.id_number JOIN subjects ON accounts_info.id_number = subjects.id_number WHERE subject = '".$_GET['submit_grade_subject']."' AND role = 'Student' AND course != '' ORDER BY last_name, first_name, middle_name";
								$query_run = mysql_query($query);
								$x = 1;
								while($query_row = mysql_fetch_assoc($query_run)){

									$query1 = "SELECT raw_grade, grade FROM grades WHERE id_number = '".$query_row['id_number']."' AND subject = '".$_GET['submit_grade_subject']."'";
									$query_run1 = mysql_query($query1);
									if(@$raw_grade = mysql_result($query_run1, 0, 'raw_grade')){}
									echo '<tr>';

										if(mysql_num_rows($query_run1) > 0){
											echo '<td>'.$x.'. &nbsp;&nbsp;&nbsp;'.$query_row['last_name'].', '.$query_row['first_name'].' '.$query_row['middle_name'].'</td>
											<td>'.$query_row['course'].'</td>';

											if($raw_grade == '5.00' or $raw_grade == 'INC'){
												echo '<td style="color: red;">'.$raw_grade.'</td>';
											}else{
												echo '<td>'.$raw_grade.'</td>';
											}

											$grade = mysql_result($query_run1, 0, 'grade');
											if(!empty($grade)){
												if($grade == '5.00' or $grade == 'INC'){
													echo '<td style="color: red;">'.$grade.'</td>';
												}else{
													echo '<td>'.$grade.'</td>';
												}
												echo '<td></td>';
											}else{
												echo '
												<form action="index.php?submit_grade_subject='.$_GET['submit_grade_subject'].'&grade_id='.$query_row['id_number'].'" method="post">
													<td>
														<select name="grade_enter" class="form-control">
															<option value="1.00">1.00</option>
															<option value="1.25">1.25</option>
															<option value="1.50">1.50</option>
															<option value="1.75">1.75</option>
															<option value="2.00">2.00</option>
															<option value="2.25">2.25</option>
															<option value="2.50">2.50</option>
															<option value="1.75">2.75</option>
															<option value="3.00">3.00</option>
															<option value="5.00">5.00</option>
															<option value="INC">INC</option>
														</select>
													</td>';
													echo '<td><button type="submit" class="btn-sm btn-info" >Grade</button></td>
												</form>
												';
											}
										}else{
											echo '<td>'.$x.'. &nbsp;&nbsp;&nbsp;'.$query_row['last_name'].', '.$query_row['first_name'].' '.$query_row['middle_name'].'</td>
											<td>'.$query_row['course'].'</td>
											<td></td>
											<td></td>';
											if(!isset($_GET['print'])){
												echo '<td><a href="?submit_grade_subject='.$_GET['submit_grade_subject'].'&id_number='.$query_row['id_number'].'&first_name='.$query_row['first_name'].'&last_name='.$query_row['last_name'].'">Scores<a/></td>';
											}
											
										}
									}

									echo '</tr>';
									$x++;

								
							?>
							
						</tbody>
					</table>
					<hr>
					<center>- - - - - - - - - - - - - - - - - - - - - -   Nothing Follows   - - - - - - - - - - - - - - - - - - - - - -</center>
					<?php
						if(isset($_GET['print'])){
							echo '<br><br><center style="color: coral;">Printed Form</center><br><br><br>';
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

					<a href="?submit_grade_subject=<?php echo $_GET['submit_grade_subject'];?>&print=true" class="btn-sm btn-danger" style="float: right; padding-left: 25px; padding-right: 25px;" >Print</a>
				</div>
				<div class="col-md-2" style="margin-left: 15px;">
					<h4>Setting Terms and Scores Percentage</h4><br>
					<a href="?submit_grade_subject=<?php echo $_GET['submit_grade_subject'];?>&set_percentage=true" class="btn btn-block btn-info">Setting</a>
					<br><br><br>

					<form action="index.php?submit_grade_subject=<?php echo $_GET['submit_grade_subject']; ?>" method="post">
						<?php
							$query = "SELECT semester, year FROM subjects_percentage WHERE subject = '".$_GET['submit_grade_subject']."' ";
							$query_run = mysql_query($query);

							if(@$result = mysql_result($query_run, 0, 'year')){
								echo '<center><h4><span style="color: skyblue;">Year:</span> ' . mysql_result($query_run, 0, 'year') . '</h4></center>';
							}else{
								echo '<center><h4>Year: <span style="color: coral;">NOT SET</span></h4></center>';
							}
						?>
						
						<select class="form-control" name="year">
							<?php
								$date = date('Y')
							?>
							<option value="<?php echo $date - 1; ?>-<?php echo $date; ?>"><?php echo $date - 1; ?>-<?php echo $date; ?></option>
							<option value="<?php echo $date; ?>-<?php echo $date + 1; ?>"><?php echo $date; ?>-<?php echo $date + 1; ?></option>
						</select>
						<br>
						<?php
							if(@$result = mysql_result($query_run, 0, 'semester')){
								echo '<center><h4><span style="color: skyblue;">Semester:</span> ' . mysql_result($query_run, 0, 'semester') . '</h4></center>';
							}else{
								echo '<center><h4>Semester: <span style="color: coral;">NOT SET</span></h4></center>';
							}
						?>
						<select class="form-control" name="semester">
							<option value="First Semester">First Semester</option>
							<option value="Second Semester">Second Semester</option>
							<option value="Summer">Summer</option>
						</select>
						<br><br>
						<button type="submit" class="btn btn-block btn-success">SET</button>
					</form>
					<br>
					<?php
						if(isset($mark_semyear)){
							echo '<center style="color: lime; ">Year and Semester are SET!</center>';
						}else if(isset($sem_year_mark)){
							echo '<center style="color: coral;">Year and Semester must be SET!</center>';
						}
					?>
					
				</div>
			</div>

		</div>
		

<br><br><br><br>
</body>
</html>
