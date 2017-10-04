<?php 
	include "../mb.php";
	session_start();
	$session_id = $_SESSION['user_id'];
	$serial = $_POST['attr'];
	$lastID =  $_POST['last_id'];
	$serial = mysqli_escape_string(connect(), $serial);

	$sql = mysqli_query(connect(),"SELECT * FROM users WHERE id =".$serial);
	$result = mysqli_fetch_array($sql);

	$sql2 = mysqli_query(connect(),"SELECT * FROM messages WHERE id > '$lastID' AND user_id = '$session_id' AND from_id = '$serial' OR user_id = '$serial' AND from_id = '$session_id' AND id > '$lastID' ORDER BY id DESC");
	
	$result_2 = mysqli_fetch_array($sql2);
	$last_id = $result_2['id'];
	
	if(!isset($last_id)){
		die();
	}
	
	$arr = [];
	if(isset($result_2['id'])){
		do{
			$result_2['text'] = htmlspecialchars($result_2['text']);
			if($result_2['user_id'] == $session_id)
				array_push($arr, $result_2['text']."me");
			else
				array_push($arr, $result_2['text']."he");
		}while($result_2 = mysqli_fetch_array($sql2));
		$response['message'] = $arr;
		$response['last_id'] = $last_id;
	}

	echo json_encode($response);
	
?>