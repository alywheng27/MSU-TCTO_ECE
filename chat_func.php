<?php
	$look = array('fuck', 'sex', 'bilat', 'shit');
	$change = array('****', '***', '*****', '****');

	if(isset($_POST['chat']) and !empty($_POST['chat'])){
		$chat = $_POST['chat'];
		$chat_change = str_ireplace($look, $change, $chat);

		if($chat_change != $chat){
			$query = "INSERT INTO chat (subject, id_number, message, message_change) VALUES ('$subject', '$id_number', '$chat', '$chat_change') ";
			
			$_GET['word_censed'] = 'true';
		}else{
			$query = "INSERT INTO chat (subject, id_number, message) VALUES ('$subject', '$id_number', '$chat') ";
		}

		$query_run = mysql_query($query);
	}
?>