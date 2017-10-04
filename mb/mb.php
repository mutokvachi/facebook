<?php
	function connect(){
		$localhost = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'facebook';
		
		if($connect = mysqli_connect($localhost, $user, $pass, $db)){
			$connect = mysqli_connect($localhost, $user, $pass, $db);
			mysqli_query($connect,"SET NAMES 'utf8' ");
		}else
			echo "Mysql connection problem";
		return $connect = mysqli_connect($localhost, $user, $pass, $db);
	}

	function regOptions(){  // registraciashi deebis triali;
		for($i = 1;$i <= 31;$i++){
			echo "<option>$i</option>";
		}
	}
	function regBirthOptions(){ // registraciashi dabadebis tarigi;
		for($i = 2017;$i >= 1905;$i--){
			echo "<option>$i</option>";
		}
	}

	function loginSelect($user, $pass){
		$user = mysqli_escape_string(connect(), $user);
		$pass = mysqli_escape_string(connect(), $pass);

		$sql = mysqli_query(connect(),"SELECT id FROM users WHERE mobile_email = '$user' && password = '$pass' ");
		$result = mysqli_fetch_array($sql);

		if(isset($result['id'])){
			$_SESSION['user_id'] = $result['id'];
			header("Location: main.php");
		}
	}
	function logout(){
		if(isset($_GET['logout'])){
			unset($_SESSION['user_id']);
			header("Location: index.php");
		}
	}

	function myFriendList(){
	$sql = mysqli_query(connect(),"SELECT * FROM users WHERE id != ".$_SESSION['user_id']);
	$result = mysqli_fetch_array($sql);
	do{
	?>
		<li myFriendId="<?php echo $result['id']; ?>">
			<a href="#">
				<img src="img/person.jpg" alt="">
				<div class="my_friends_names"><?= $result['first_name']." ".$result['surname']; ?></div>
				<span class="active"></span>
			</a>
		</li>
	<?php }while($result = mysqli_fetch_array($sql));
	}

	function logedUserName(){
		$session_id = $_SESSION['user_id'];
		$sql = mysqli_query(connect(),"SELECT * FROM users WHERE id =".$session_id);
		$result = mysqli_fetch_array($sql);
		echo $result['first_name']." ".$result['surname'];
	}

	function logedUserOnlyName(){
		$session_id = $_SESSION['user_id'];
		$sql = mysqli_query(connect(),"SELECT * FROM users WHERE id =".$session_id);
		$result = mysqli_fetch_array($sql);
		echo $result['first_name'];
	}
	function redirectToMain(){
		if(isset($_SESSION['user_id'])){
			header("Location: main.php");
		}
	}

	function showNotificationMessages(){
	$sql = mysqli_query(connect(), "SELECT * FROM messages WHERE user_id = $session_id OR from_id = $session_id")
	?>
	<div class="item">
		<div class="img pull-left">
			<img src="img/person.jpg" class="pull-left">
			<div class="overflow">
				<h2>Saba Yochiashvili</h2>
				<p>bicho ravaxar simonn asd asd asd asd asd asdasd as d asdasd as dsa</p>
			</div>
		</div>
		<div class="sent_time pull-right">
			07:49								
		</div>
	</div>
	<?php		
	}
	
?>