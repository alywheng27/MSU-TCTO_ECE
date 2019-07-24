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
    <title>Home - MSU-TCTO S-ECE</title>

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
			<h3> <?php echo $_GET['classmates_list']; ?> <br><span style="font-size: 16px; color: lightgrey;">LIST OF ENROLLEES</span></h3><br><br>
			<?php
				$query = "SELECT first_name, middle_name, last_name FROM accounts JOIN subjects ON subjects.id_number = accounts.id_number WHERE subject = '".$_GET['classmates_list']."' and role = 'Instructor'";
				$query_run = mysql_query($query);

				echo '<span style="color: #03d3db;">Instructor:</span> '.mysql_result($query_run, 0, 'last_name').', '.mysql_result($query_run, 0, 'first_name').' '.mysql_result($query_run, 0, 'middle_name').'';

			?>
			
			<br><br><br>
			<table class="table table-condensed table-hover">
				<thead>
					<th>ID_Number</th>
					<th>Name</th>
					<th>Course</th>
				</thead>
				<tbody>
					
					<?php
						$query = "SELECT accounts.id_number, first_name, middle_name, last_name, course FROM accounts JOIN accounts_info ON accounts.id_number = accounts_info.id_number JOIN subjects ON accounts_info.id_number = subjects.id_number WHERE subject = '".$_GET['classmates_list']."' and role = 'Student' and college != ''";
						$query_run = mysql_query($query);

						while($query_row = mysql_fetch_assoc($query_run)){
							echo '	<tr>
										<td>'.$query_row['id_number'].'</td>
										<td>'.$query_row['last_name'].', '.$query_row['first_name'].' '.$query_row['middle_name'].'</td>
										<td>'.$query_row['course'].'</td>
									</tr>';
						}
					?>
					
				</tbody>
			</table>

		</div>
	</div>

</body>
</html>
