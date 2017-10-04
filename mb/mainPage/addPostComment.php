<?php
	include "../mb.php";
	session_start();

	$comment = $_POST['comment'];
	$post_id = $_POST['post_id'];
	$session_id = $_SESSION['user_id'];
	
	$comment = mysqli_escape_string(connect(), $comment);
	$post_id = mysqli_escape_string(connect(), $post_id);

	if(!empty($comment) && !empty($post_id) && !empty($session_id)){
		$insert = mysqli_query(connect(),"INSERT INTO post_comments (post_id, user_id, text)
		VALUES ('$post_id', '$session_id', '$comment')");
	}
?>