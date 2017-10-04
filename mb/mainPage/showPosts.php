<?php
	include "../mb.php";

		$sql = mysqli_query(connect(),"SELECT * FROM posts WHERE id > ".$_POST['last_id']." ORDER BY id DESC");
		$result = mysqli_fetch_array($sql);
		
		if(!isset($result['id'])){
			die();
		}
		echo "<div class='last_id' style='display:none'>".$result['id']."</div>";

		do{ 
			$sql2 = mysqli_query(connect(),"SELECT * FROM users WHERE id =".$result['autor_id']);
			$result_2 = mysqli_fetch_array($sql2);
		?>
		<div class="my_post" post_id="<?php echo $result['id']; ?>">
			<div class="item" >
				<img src="img/profile.jpg" alt="">
				<a href=""><?php echo $result_2['first_name']." ".$result_2['surname']; ?></a>
				<h4>Just now</h4>
				<div class="clear"></div>
				<p><?php echo htmlspecialchars($result['text']); ?></p>
				<hr>
				<ul>
					<li><i></i>Like</li>
					<li><i></i>Comment</li>
					<li><i></i>Share</li>
				</ul>
			</div>
			<div class="post_comments">
				
			</div>
			<div class="clear"></div>
			<form method="post" id="postMyItem">
				<img src="img/profile.jpg" alt="">
				<textarea placeholder="Write a comment..."></textarea>
				<i id="post_your_image1"></i>
				<i id="post_your_image2"></i>
			</form>
		</div>
		<?php } while($result = mysqli_fetch_array($sql));
?>