<?php
	include "../mb.php";
	session_start();
	$session_id = $_SESSION['user_id'];
	$message = $_POST['message'];
	$to = $_POST['to'];
	$message = mysqli_escape_string(connect(), $message);
	$to = mysqli_escape_string(connect(), $to);

	if(!empty($message)){
		$insert = mysqli_query(connect(),"INSERT INTO messages (user_id, from_id, text)
		VALUES ('$session_id', '$to', '$message')");
	}
?>