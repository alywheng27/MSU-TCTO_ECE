<?php
	$query0 = "SELECT subject FROM subjects WHERE id_number = '$id_number' ";
	$query_run0 = mysql_query($query0);

	$subjects_count = mysql_num_rows($query_run0);
	$subjects_counting = 1;

	while($query_row0 = mysql_fetch_assoc($query_run0)){
		$query1 = "SELECT grade FROM grades WHERE id_number = '$id_number' AND subject = '".$query_row0['subject']."'";
		$query_run1 = mysql_query($query1);

		if(mysql_num_rows($query_run1) == 0){
			break;
		}else if($subjects_counting == $subjects_count){

			/* ----------------------------------------------- Notification Start ----------------------------------------------- *

			require 'clockwork-php-master/src/Clockwork.php';
			require 'clockwork-php-master/src/ClockworkException.php';

			$API_KEY = '91d98eeb833a4c252125561b9e03c487fea6f1c8';
			try
			{
				// Create a Clockwork object using your API key
				$clockwork = new mediaburst\ClockworkSMS\Clockwork( $API_KEY );

				$query = "SELECT contact_number, parent_contact_number FROM accounts_info WHERE id_number = '$id_number' ";
				$query_run = mysql_query($query);

				while($query_row = mysql_fetch_assoc($query_run)){
					if(!empty($query_row['contact_number'])){
						// Setup and send a message
						$message = array( 'to' => '0'.$query_row['contact_number'].'', 'message' => 'All Grades are Complete! You may now visit the S-ECE website to see your grades.' );
						$result = $clockwork->send( $message );

						$query = "UPDATE accounts SET notification_sent = '1' WHERE id_number = '$id_number' AND role = 'Student' ";
						$query_run = mysql_query($query);
					}
					if(!empty($query_row['parent_contact_number'])){
						// Setup and send a message
						$message = array( 'to' => '0'.$query_row['parent_contact_number'].'', 'message' => 'All Grades are Complete! You may now visit the S-ECE website to see your grades.' );
						$result = $clockwork->send( $message );

						$query = "UPDATE accounts SET notification_sent = '1' WHERE id_number = '$id_number' AND role = 'Student' ";
						$query_run = mysql_query($query);
					}
				}

				// Check if the send was successful
				if($result['success']) {
					echo 'Message sent - ID: ' . $result['id'];
				} else {
					echo 'Message failed - Error: ' . $result['error_message'];
				}
			}
			catch (mediaburst\ClockworkSMS\ClockworkException $e)
			{
				echo 'Exception sending SMS: ' . $e->getMessage();
			}

			/* ----------------------------------------------- Notification Start ----------------------------------------------- */

		}
		$subjects_counting++;
	}	
?>