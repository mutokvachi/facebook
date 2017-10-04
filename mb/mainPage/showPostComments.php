<?php
	include "../mb.php";
	$last_id = $_POST['last_id'];

	$sql = mysqli_query(connect(),"SELECT * FROM post_comments WHERE id > ".$last_id." ORDER BY id DESC");
	$result = mysqli_fetch_array($sql);

	if(!isset($result['id'])){
		die();
	}
	$last_id = $result['id'];
	$sql2 = mysqli_query(connect(),"SELECT * FROM users WHERE id = ".$result['user_id']);
	$result_2 = mysqli_fetch_array($sql2);
	$name = $result_2['first_name']." ".$result_2['surname'];
 	$response = [];

	do{
	array_push($response, ['id' => $result['post_id'], 
		'comment' => '<div class="item">
		<img src="img/profile.jpg" alt="" >
		<div class="content">
			<span>'.htmlspecialchars($name).'</span>'.htmlspecialchars($result["text"]).'
			<div class="comment_like">
				<span>Like</span> · 
				<span>Reply</span> · 
				<span>30 mins</span>
			</div>
		</div>
	</div>
	',
	'last_id' => $last_id,
	]);
	}while($result = mysqli_fetch_array($sql));
	echo json_encode($response);
?>