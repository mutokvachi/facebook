<?php
	include "../mb.php";
	session_start();
	$serial = $_POST['textarea'];
	$serial = mysqli_escape_string(connect(), $serial);
	$session_id = $_SESSION['user_id'];


	if(!empty($serial)){
		$insert = mysqli_query(connect(),"INSERT INTO posts (autor_id, text)
		VALUES ('$session_id', '$serial')");
			echo "success";
		}

?>