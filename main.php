<?php
    include "mb/mb.php";
    session_start();
    connect();
    logout();
    if(!isset($_SESSION['user_id'])){
    	die("<font color='red'>Page Not Found !</font>");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facebook</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body style="background: #E9EBEE;">
	<div class="main_page">
	<div class="header">
		<div class="sizer">
			<div class="main_size">
				<div class="left_side">
					<a href=""><i class="fa fa-facebook-official fa-2x"></i></a>
					<form method="post" id="main_search">
						<input type="text" name="search" id="search" placeholder="Search Facebook">
						<div class="search_button">

							<a href="#"><i class="fa fa-search"></i></a>
						</div>
					</form>
				</div>
				<div class="right_side" > 
					<div class="profile_icon">
						<img src="img/profile.jpg" alt="">
						<span><a href="#"><?php logedUserOnlyName(); ?></a></span>
						<span class="home_span"><a href="">Home</a></span>
					</div>
						<ul>
							<li><img src="img/friends.png"></li>
							<li id="messenger_notification"><img src="img/messenger.png"></li>
							<li><img src="img/notification.png"></li>
							<li><p></p></li>
							<li><i class="fa fa-question-circle"></i></li>
							<li><i class="fa fa-caret-down"></i></li>
						</ul>
				</div>
				<div class="clicked_caret" style="display: none;">
					<ul>
						<li><a>Create Page</a></li>
						<li><a>Manage Pages</a></li>
						<hr>
						<li><a>Create Group</a></li>
						<li><a>New Groups</a></li>
						<hr>
						<li><a>Create Adverts</a></li>
						<li><a>Advertising on Facebook</a></li>
						<hr>
						<li><a>Activity Log</a></li>
						<li><a>News Feed Preferences</a></li>
						<li><a>Settings</a></li>
						<li><a href="?logout">Log out</a></li>
					</ul>
				</div>

				<div class="clicked_messages" style="display: none;">
					<div class="head">
						<div class="left pull-left">
							<span>Recent</span>
							<span>Message Requests</span>
						</div>
						<div class="right pull-right">
							<span>Mark All as Read</span> · 
							<span>New Message</span>
						</div>
					</div>

					<div class="body">
						<?php showNotificationMessages(); ?>						
					</div>
					
					<div class="footer">
						<a href="#">See all in Messenger</a>
					</div>
				</div>
			</div>
		</div>
			<div class="main_size">
			<div class="clear"></div>
			<div class="main_content">
				<div class="main_left_side">
					<ul>
						<li>
							<a>
								<img src="img/profile.jpg" alt=""><?php logedUserName(); ?>
							</a>
						</li>
						<li>
							<a>
								<img src="img/newsFeed.png" alt="">News Feed
							</a>
						</li>
						<li>
							<a>
								<img src="img/main_messenger.png" alt="">Messenger
							</a>
						</li>
						<li>
							SHORTCUTS
						</li>
					</ul>
				</div>
				
				<div class="main_middle_side">
					<div class="new_post">
						<div class="head">
							<span><a href=""><img src="img/pencil.png"> Create a Post</a></span>
							<span><a href=""><img src="img/book.png"> Photo/Video Album</a></span>				
						</div>
						<div class="footer">
							<img src="img/profile.jpg">
							<form method="post" id="postNewItem">
								<textarea placeholder="What's on your mind?"></textarea>
							</form>
							<hr>
							<div class="clear"></div>
							
							<div class="upload_photo">
								<span><a href=""><i class="fa fa-photo"></i>Photo/Video</a></span>
								<span><a href=""><i class="fa fa-smile-o" style="color: orange;"></i>Feeling/Activity</a></span>
								<span><a href=""><img src="img/three-dots.png"></a></span>
							</div>
						</div>
					</div>
					<!-- <div class="pic_posts">
						<img src="img/post1.png">
						<img src="img/post2.png">
						<img src="img/post3.png">
						<img src="img/post4.png">
					</div> -->
					<div class="clear"></div>
					<div class="all_posts">
						<div class="posted_items">
							
						</div>
					</div>
				</div>
			
				<div class="main_right_side">
					<a href="">
						<img src="img/calendar-icon.png" alt="">
						2 event invitations
					</a>
				</div>
			</div>	
		</div>
	</div>
	<div class="friend_list">
		<ul class="friend_list_ul">
			<?php myFriendList(); ?>
		</ul>		
	</div>
	<div class="friend_chat">
		<div class="hheader">
			<div class="last_chat_id" style="display: none;"></div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<div class="row">
					<h2><p></p><a href="#"></a></h2>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<ul>
					<li><a href=""><i class="fa fa-plus"></i></a></li>
					<li><a href=""><i class="fa fa-video-camera"></i></a></li>
					<li><a href=""><i class="fa fa-phone"></i></a></li>
					<li><a href=""><i class="fa fa-cog"></i></a></li>
					<li><a href="#"><i class="fa fa-remove"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		<div class="chat_box" id="scrollBox">

		</div>
		<div class="clear"></div>

		<div class="chat_text">
			<form method="post" id="addMessage">
				<textarea placeholder="Type a message..."></textarea>	
			</form>
			<div class="clear"></div>
			<div class="chat_pics">
				<ul>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
				</ul>
				<div class="chat_like">
					<span></span>
				</div>
			</div>
		</div>
	</div>

		<div class="mini_friend_list">
			<p><span class="active"></span>Chat (77)</p>
		<div class="mini_list">
			<div class="friend_search">
				<h3>Chat</h3>
			</div>
			<div class="clear"></div>
			<ul class="friend_list_ul">
				<?php myFriendList(); ?>
			</ul>		
			<form method="post">
				<i class="fa fa-search"></i>
				<input type="text" name="" placeholder="Search...">
			</form>
		</div>
		</div>

	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>