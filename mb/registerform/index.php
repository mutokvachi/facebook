<?php
	include "../mb.php";
	session_start();
	connect();
	

		$first_name = $_POST['first_name'];
		$surname = $_POST['surname'];
		$reg_mobile = $_POST['reg_mobile'];
		$new_pass = $_POST['new_pass'];
		$reg_day = $_POST['reg_day'];
		$reg_month = $_POST['reg_month'];
		$reg_year = $_POST['reg_year'];
		@$sex = $_POST['sex'];
		$birthday = "$reg_day-$reg_month-$reg_year";

		$message = [
			"error" => 'XX',
			"first_name" => 'XX',
			"reg_mobile" => 'XX',
			"surname" => 'XX',
			"new_pass" => 'XX',
			"success" => 'XX',
		];

		$regex = "/^[a-zA-Z]+$/";
		if (!preg_match($regex, $first_name)){
			$message['first_name'] = "false";
			$first_name = false;
		}

		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		$regex2 =  "/^[0-9]+$/";
		if (preg_match($regex, $reg_mobile))
			$reg_mobile = $_POST['reg_mobile'];
		elseif(preg_match($regex2, $reg_mobile))
			$reg_mobile = $_POST['reg_mobile'];
		else{
			$message['reg_mobile'] = "false";
			$reg_mobile = false;
		}
		
		$regex = "/^[a-zA-Z]+$/";
		if (!preg_match($regex, $surname)){
			$message['surname'] = "false";
			$surname = false;
		}
		$regex = "/^[a-zA-Z0-9]+$/";
		if (!preg_match($regex, $new_pass)){
			$message['new_pass'] = 'false';
			$new_pass = false;
		}

		$sql = mysqli_query(connect(),"SELECT id FROM users WHERE mobile_email = '$reg_mobile'");
		$result = mysqli_fetch_array($sql);

		

		if(!empty($first_name) && !empty($surname) && !empty($reg_mobile) && !empty($new_pass) && !empty($reg_day) && !empty($reg_month) && !empty($reg_year) && !empty($sex)){
			if(!isset($result['id'])){
		 		$insert = mysqli_query(connect(),"INSERT INTO users (first_name, surname, mobile_email, password, day_month_year, sex)
				VALUES ('$first_name', '$surname', '$reg_mobile', '$new_pass', '$birthday', '$sex')");
				$message['success'] = "success";
				
				$sql = mysqli_query(connect(),"SELECT id FROM users WHERE mobile_email = '$reg_mobile' && password = '$new_pass' ");
				$result = mysqli_fetch_array($sql);

				if(isset($result['id'])){
					$_SESSION['user_id'] = $result['id'];
				}
			}else{
				$message['error'] = 't';
			}
		}
		
	
	echo json_encode($message);

	

?>