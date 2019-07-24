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
    <title>Billing Accounts - MSU-TCTO S-ECE</title>

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

			<div class="row" id="billingAccount">
				<div class="col-md-10 col-md-offset-1">
					<?php 
						$query = "SELECT first_name, last_name, middle_name FROM accounts WHERE id_number = '$id_number' and role = 'Student' ";
						$query_run = mysql_query($query);

						echo '<h2><b>'.mysql_result($query_run, 0, 'last_name').', '.mysql_result($query_run, 0, 'first_name').' '.mysql_result($query_run, 0, 'middle_name').'</b></h2>';
					?>
					<h3> BILLING ACCOUNTS </h3><br><br>
					<?php
						$query = "SELECT DISTINCT semester, year FROM fees WHERE id_number = '$id_number' ORDER BY year DESC, semester DESC";
						$query_run = mysql_query($query);

						$overall_total = 0;
						while($query_row = mysql_fetch_assoc($query_run)){
							echo '<span style="font-size: 20px;">'.$query_row['semester'].' ('.$query_row['year'].')</span><br><br>
								<table class="table table-condensed">
									<thead>
										<th>Fees</th>
										<th>Amount</th>
									</thead>
									<tbody>';
										
									$query2 = "SELECT fee, amount FROM fees WHERE id_number = '$id_number' and semester = '".$query_row['semester']."' and year = '".$query_row['year']."'";
									$query_run2 = mysql_query($query2);

									$total = 0;
									while($query_row2 = mysql_fetch_assoc($query_run2)){
										echo '	<tr>
													<td>'.$query_row2['fee'].'</td>
													<td>'.$query_row2['amount'].'</td>
												</tr>';
										$total = $total + $query_row2['amount'];
									}

									echo '<tr>
										<td><b>Total</b></td>
										<td>'.$total.'</td>
									</tr>
										
									</tbody>
								</table><hr><br>
							';
							$overall_total = $overall_total + $total;
						}
					?>
					<br><hr>
					<div class="row">
						<div class="col-md-8">
							<b><span style="font-size: 18px;">Total</span></b>
						</div>
						<div class="col-md-1" style="margin-left: 10px;">
							<b><?php echo $overall_total; ?></b>
						</div>
					</div>
					<hr>

					<?php
						if(isset($_GET['print'])){
							echo '<center style="color: coral;">Printed Form</center><br><br><br>';
						}
					?>
					
				</div>

			</div>
			<?php
				if(isset($_GET['print'])){
					echo "
					<script type='text/javascript'>
						var printing = printPage('billingAccount');
						function printPage(divName){
							var printContents = document.getElementById('billingAccount').innerHTML;
							var originalContents = document.body.innerHTML;
							
							document.body.innerHTML = printContents;

							window.print();

							document.body.innerHTML = originalContents;

						}
					</script>
					";
				}
			?>

			<a href="?billing_accounts=<?php echo $_GET['billing_accounts'];?>&print=true" class="btn-sm btn-danger" style="float: right; margin-right: 10%; padding-left: 25px; padding-right: 25px;" >Print</a>
			<br><br><br><br><br>
			

		</div>
	</div>

</body>
</html>
