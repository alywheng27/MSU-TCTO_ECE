<?php
	if(isset($_POST['post_text'])){
		$post_text = htmlentities(addslashes($_POST['post_text']));

		if(!empty($post_text)){
			$query1 = "INSERT INTO posts (id_number, admin_subject, post, date) VALUES('$id_number','".$_GET['post']."', '$post_text', '".date('M d, Y', strtotime('-1 day'))." at ".date('h:i a', strtotime('+14 hours'))."')";
			$query_run1 = mysql_query($query1);
		}

		header('Location: index.php?post='.$_GET['post'].'');
		
	}

	if(isset($_POST['photo_submit'])){
		$post_text_photo = $_POST['post_text_photo'];
		$photo_number = $_GET['photo_number'];

		$query1 = "INSERT INTO posts (id_number, admin_subject, post, date) VALUES('$id_number','".$_GET['post']."', '$post_text_photo', '".date('M d, Y', strtotime('-1 day'))." at ".date('h:i a', strtotime('+14 hours'))."')";
		$query_run1 = mysql_query($query1);

		$query1 = "SELECT post_id FROM posts WHERE id_number = '$id_number' AND admin_subject = '".$_GET['post']."' AND post = '$post_text_photo' AND date = '".date('M d, Y', strtotime('-1 day'))." at ".date('h:i a', strtotime('+14 hours'))."' ";
		$query_run1 = mysql_query($query1);

		for ($i=0; $i < $photo_number; $i++) { 
			$check = getimagesize($_FILES['post_photo'.$i.'']["tmp_name"]);
			if($check !== false){
				$image = $_FILES['post_photo'.$i.'']['tmp_name'];
				$imgContent = addslashes(file_get_contents($image));
				
				$dbHost     = 'localhost';
				$dbUsername = 'root';
				$dbPassword = '';
				$dbName     = 's-ece database';

				$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

				if($db->connect_error){
					die("Connection failed: " . $db->connect_error);
				}

				$insert1 = $db->query("INSERT INTO posts_photos (post_id, photo) VALUES ('".mysql_result($query_run1, 0, 'post_id')."', '$imgContent')");
			}
		}
	}

	if(isset($_POST['post_edit'])){
		$post_text_photo = $_POST['post_text_photo'];
		$photo_number = $_GET['photo_number'];
		$post_id = $_GET['edit_post'];

		$query1 = "UPDATE posts SET post = '$post_text_photo' WHERE post_id = '$post_id' ";
		$query_run1 = mysql_query($query1);


		for ($i=0; $i < $photo_number; $i++) { 
			$check = getimagesize($_FILES['post_photo'.$i.'']["tmp_name"]);
			if($check !== false){
				if($i == 0){
					$query1 = "DELETE FROM posts_photos WHERE post_id = '$post_id' ";
					$query_run1 = mysql_query($query1);
				}
				$image = $_FILES['post_photo'.$i.'']['tmp_name'];
				$imgContent = addslashes(file_get_contents($image));
				
				$dbHost     = 'localhost';
				$dbUsername = 'root';
				$dbPassword = '';
				$dbName     = 's-ece database';

				$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

				if($db->connect_error){
					die("Connection failed: " . $db->connect_error);
				}

				$insert1 = $db->query("INSERT INTO posts_photos (post_id, photo) VALUES ('".$post_id."', '$imgContent')");
			}
		}
	}

	if(isset($_GET['enter_delete'])){
		$post_id = $_GET['edit_post'];

		$query1 = "DELETE FROM posts WHERE post_id = '$post_id' ";
		$query_run1 = mysql_query($query1);

		$query1 = "DELETE FROM posts_photos WHERE post_id = '$post_id' ";
		$query_run1 = mysql_query($query1);

		$query1 = "DELETE FROM comments WHERE post_id = '$post_id' ";
		$query_run1 = mysql_query($query1);
	}


	if(isset($_POST['comment_text']) and !empty($_POST['comment_text'])){
		$comment_text = htmlentities(addslashes($_POST['comment_text']));

		$query1 = "INSERT INTO comments (id_number_comment, admin_subject_comment, comment, post_id) VALUES('$id_number','".$_GET['post']."', '$comment_text', '".$_GET['post_id']."')";
		mysql_query($query1);
	}

	if(isset($_GET['delete_comment'])){
		$delete_comment = $_GET['delete_comment'];

		$query = "DELETE FROM comments WHERE comment_id = '$delete_comment' ";
		$query_run = mysql_query($query);
	}

	if(isset($_POST['post_comment']) and !empty($_POST['post_comment'])){
		$post_comment = $_POST['post_comment'];

		$query = "UPDATE comments SET comment = '$post_comment' WHERE comment_id = '".$_GET['edit_comment']."' ";
		$query_run = mysql_query($query);

		header("Location: index.php?post=".$_GET['post']."");
	}

?>