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
    <title>Grades - MSU-TCTO S-ECE</title>

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
				$query = "SELECT first_name, last_name, middle_name FROM accounts WHERE id_number = '$id_number' and role = 'Student' ";
				$query_run = mysql_query($query);

				echo '<h2><b>'.mysql_result($query_run, 0, 'last_name').', '.mysql_result($query_run, 0, 'first_name').' '.mysql_result($query_run, 0, 'middle_name').'</b></h2>';
			?>
			<h3> <?php echo $_GET['semester'].' ('.$_GET['year'].')'?> </h3><br><br>
			<table class="table table-condensed table-hover">
				<thead>
					<th>Subject</th>
					<th>Description</th>
					<th>Units</th>
					<th>Raw Grade</th>
					<th>Grade</th>
				</thead>
				<tbody>
					<?php
						$query ="SELECT grades.subject, description, units, raw_grade, grade FROM grades JOIN curriculum ON grades.subject = curriculum.subject
								WHERE id_number = '$id_number' and semester='".$_GET['semester']."' and year = '".$_GET['year']."'";
						$query_run = mysql_query($query);
						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
								<tr>
									<td>'.$query_row['subject'].'</td>
									<td>'.$query_row['description'].'</td>
									<td>'.$query_row['units'].'</td>';

									if($query_row['raw_grade'] == '5.00' or $query_row['raw_grade'] == 'INC'){
										echo '<td style="color: red;">'.$query_row['raw_grade'].'</td>';
									}else{
										echo '<td>'.$query_row['raw_grade'].'</td>';
									}
									
									if(($query_row['grade'] == '5.00' or $query_row['grade'] == 'INC') and isset($_GET['print'])){
										echo '<td>'.$query_row['grade'].'</td>';
									}else if($query_row['grade'] == '5.00' or $query_row['grade'] == 'INC'){
										echo '<td><a style="color: red;" href="?semester='.$_GET['semester'].'&year='.$_GET['year'].'&scores='.$query_row['subject'].'">'.$query_row['grade'].'</a></td>';
									}else if(isset($_GET['print'])){
										echo '<td>'.$query_row['grade'].'</td>';
									}else{
										echo '<td><a href="?semester='.$_GET['semester'].'&year='.$_GET['year'].'&scores='.$query_row['subject'].'">'.$query_row['grade'].'</a></td>';
										$_GET['grade'] = $query_row['grade'];
									}

									
								echo '</tr> ';
						}
					?>
				</tbody>
			</table>
			<center>- - - - - - - - - - - - - - - - - - - - - -   Nothing Follows   - - - - - - - - - - - - - - - - - - - - - -</center>
			<br><br>
			<?php
			if(isset($_GET['print'])){
				echo '<center style="color: coral;">Printed Form</center>';
			}
			?>
		</div>
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

		

		<a href="?semester=<?php echo $_GET['semester'];?>&year=<?php echo $_GET['year'];?>&print=<?php echo $_GET['grade'];?>" class="btn-sm btn-danger" style="float: right; margin-right: 10%; padding-left: 25px; padding-right: 25px;" >Print</a>

		
			
		
</div>


</body>
</html>
