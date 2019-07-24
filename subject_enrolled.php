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
    <title>Subject Enrolled - MSU-TCTO S-ECE</title>

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

			<div class="row" id="subjectEnrolled">
				<div class="col-md-7">
					<?php 
						$query = "SELECT first_name, last_name, middle_name FROM accounts WHERE id_number = '$id_number' and role = 'Student' ";
						$query_run = mysql_query($query);

						echo '<h2><b>'.mysql_result($query_run, 0, 'last_name').', '.mysql_result($query_run, 0, 'first_name').' '.mysql_result($query_run, 0, 'middle_name').'</b></h2>';
					?>
					<h3> Subjects Enrolled </h3><br><br>
					<table class="table table-condensed table-hover">
						<thead>
							<th>Subject</th>
							<th>Desciption</th>
							<th>Units</th>
							<th>Number of Enrollees</th>
						</thead>
						<tbody>
							
							<?php
								$query = "SELECT curriculum.subject, description, units FROM curriculum JOIN subjects ON subjects.subject = curriculum.subject WHERE id_number = '$id_number'";
								$query_run = mysql_query($query);

								while($query_row = mysql_fetch_assoc($query_run)){
									echo '	<tr>';

											if(!isset($_GET['print'])){
												echo '<td><a href="?subject_enrolled=true&classmates_list='.$query_row['subject'].'">'.$query_row['subject'].'</a></td>';
											}else{
												echo '<td>'.$query_row['subject'].'</td>';
											}
											
											echo '<td>'.$query_row['description'].'</td>
												<td>'.$query_row['units'].'</td>
											';
									$query2 = "SELECT * FROM subjects JOIN accounts ON accounts.id_number = subjects.id_number WHERE subject = '".$query_row['subject']."' and role = 'Student'";
									$query_run2 = mysql_query($query2);

									echo '		<td>'.mysql_num_rows($query_run2).'</td>
											</tr>';
								}
							?>
							
						</tbody>
					</table>
					<center>- - - - - - - - - - - - - - - - - - - - - -   Nothing Follows   - - - - - - - - - - - - - - - - - - - - - -</center>

				</div>
				<br><br>
				<div class="col-md-4" style="border-left: 3px solid #dddddd; margin-left: 10px; margin-top: 10px;">
					<h3> FEES </h3><br><br>
					<table class="table table-condensed">
						<thead>
							<th>Fees</th>
							<th>Amount</th>
						</thead>
						<tbody>
							
							<?php
								$query = "SELECT DISTINCT semester, year FROM fees WHERE id_number = '$id_number' ORDER BY year DESC";
								$query_run = mysql_query($query);

								if(@$semester = mysql_result($query_run, 0, 'semester')){}
								if(@$year = mysql_result($query_run, 0, 'year')){}
								$query = "SELECT fee, amount FROM fees WHERE id_number = '$id_number' and semester = '".$semester."' and year = '".$year."'";
								$query_run = mysql_query($query);

								$total = 0;
								while($query_row = mysql_fetch_assoc($query_run)){
									echo '	<tr>
												<td>'.$query_row['fee'].'</td>
												<td>'.$query_row['amount'].'</td>
											</tr>';
									$total = $total + $query_row['amount'];
								}
							?>
							<tr>
								<td><b>Total</b></td>
								<td><?php echo $total; ?></td>
							</tr>
							
						</tbody>
					</table>
					<?php
						if(isset($_GET['print'])){
							echo '<center style="color: coral;">Printed Form</center>';
						}
					?>
				</div>
				
			</div>
			<?php
				if(isset($_GET['print'])){
					echo "
					<script type='text/javascript'>
						var printing = printPage('subjectEnrolled');
						function printPage(divName){
							var printContents = document.getElementById('subjectEnrolled').innerHTML;
							var originalContents = document.body.innerHTML;
							
							document.body.innerHTML = printContents;

							window.print();

							document.body.innerHTML = originalContents;

						}
					</script>
					";
				}
			?>

			<a href="?subject_enrolled=<?php echo $_GET['subject_enrolled'];?>&print=true" class="btn-sm btn-danger" style="float: right; margin-right: 10%; padding-left: 25px; padding-right: 25px;" >Print</a>

		</div>
	</div><br><br><br>

</body>
</html>
