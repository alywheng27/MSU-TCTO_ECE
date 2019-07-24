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
		
		<form method="POST" action="search_profile.php?id_number=<?php echo $id_number; ?>&changes=true">
		<div style="display: -webkit-box; -webkit-box-orient: horizontal; width: 22%; position: relative; left: 68%;">
			<input type="text" class="form-control" placeholder="Search by ID Number" name="search_profile" style="margin-top: 3px;"/>
			<button type="submit" class="btn btn-primary glyphicon glyphicon-search" style="margin-left: 5px;"></button>

		</div><br>
		<?php
				if(isset($_GET['exist_mark'])){
					echo '<div style="color: coral; padding-left: 73%; ">ID Number doesn\'t exist</div>';
				}
			?>
		</form><br>
		
		<div id="page-wrapper" style="width: 90%; margin-left: 5%; border-top: 1px solid #767676;">
			<h3> List of ID Numbers </h3><br><br>
			<table class="table table-condensed table-hover">
				<thead>
					<th>ID Number</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Last Name</th>
					<th>Role</th>
				</thead>
				<tbody>
					<?php
						$query = "SELECT accounts.id_number, first_name, middle_name, last_name, role FROM accounts WHERE role = 'Student' or role = 'Instructor' ";
						$query_run = mysql_query($query);
						while($query_row = mysql_fetch_assoc($query_run)){
							echo '
								<tr>
									<td><a href="?profile=true&search_id_number='.$query_row['id_number'].'&role='.$query_row['role'].'">'.$query_row['id_number'].'</a></td>
									<td>'.$query_row['first_name'].'</td>
									<td>'.$query_row['middle_name'].'</td>
									<td>'.$query_row['last_name'].'</td>
									<td>'.$query_row['role'].'</td>
								</tr> ';
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
		


</body>
</html>
