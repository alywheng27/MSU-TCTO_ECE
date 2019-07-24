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
    <title>Teaching Load - MSU-TCTO S-ECE</title>

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
			<h3> Teaching Load </h3><br><br>

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
											echo '<td><a href="?teaching_load=true&master_list='.$query_row['subject'].'">'.$query_row['subject'].'</a></td>';
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

			<a href="?teaching_load=<?php echo $_GET['teaching_load'];?>&print=true" class="btn-sm btn-danger" style="float: right; margin-right: 5%; padding-left: 25px; padding-right: 25px;" >Print</a>

		</div>
	</div>

</body>
</html>
