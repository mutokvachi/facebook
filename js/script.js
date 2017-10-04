$('.reg_form_div input').on('focusout',function(){ // reg inputs validation;
	if($(this).val() == ''){
		$(this).addClass('reg_error_class').next().show();
	}else{
		$(this).removeClass('reg_error_class').next().hide();
	}
});

function regSelectCheck(){ // reg selects validation;
	var select_1 = $('#reg_selection_day').val();
	var select_2 = $('#reg_selection_month').val();
	var select_3 = $('#reg_selection_year').val();
	if(select_1 == 'Day' || select_2 == 'Month' || select_3 == "Year"){
		$('#reg_form select').addClass('reg_error_class');
		$('.reg_error_5').show();
	}else{
		$('#reg_form select').removeClass('reg_error_class');
		$('.reg_error_5').hide();
	}

}
function checkSexInput(){ // reg sex validation;  // naxe es da es aucileblad !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	var checkbox = $(".reg_sex input");
	if(checkbox.is(':checked')){
		$('.reg_sex div').removeClass('reg_error_class');
		$('.reg_error_6').hide();
	}else{
		$('.reg_sex div').addClass('reg_error_class');
		$('.reg_error_6').show();
	}
}

$('#reg_form select').on('focusout', regSelectCheck);
$(".reg_sex input").on('focusout', checkSexInput);

$('#reg_form').submit(function(event){
	event.preventDefault();

	if($('.reg_form_div #first_name').val() == '')
		$('#first_name').addClass('reg_error_class').next().show();
	
	if($('.reg_form_div #surname').val() == '')
		$('#surname').addClass('reg_error_class').next().show();
	
	if($('.reg_form_div #reg_mobile').val() == '')
		$('#reg_mobile').addClass('reg_error_class').next().show();
	
	if($('.reg_form_div #new_pass').val() == '')
		$('#new_pass').addClass('reg_error_class').next().show();
	
	regSelectCheck();
	checkSexInput();
	var serial = $('#reg_form').serialize();
	console.log(serial);
	$.ajax({
		url: 'mb/registerform/index.php',
		method: 'post',
		data: serial,
		success: function(response){
			console.log(response);
			var response = JSON.parse(response);
			console.log(response);
			var redirect = "../../main.php";
			if(response.error == 't')
				$('#reg_mobile').addClass('reg_error_class').next().show();
			if(response.reg_mobile == 'false')
				$('#reg_mobile').addClass('reg_error_class').next().show();
			if(response.first_name == 'false')
				$('#first_name').addClass('reg_error_class').next().show();
			if(response.surname == 'false')
				$('#surname').addClass('reg_error_class').next().show();
			if(response.new_pass == 'false')
				$('#new_pass').addClass('reg_error_class').next().show();
			if(response.success == "success")
				window.location.href = "main.php";
		}
})
});

//___________ main.php script ____________

$('.right_side .fa-caret-down').click(function(){
	$('.clicked_caret').toggle();
});

$('.friend_list_ul li').click(function(){
	$('.friend_chat').show();
});

$('.friend_chat .fa-remove').click(function(event){
	event.preventDefault();
	$('.friend_chat').hide();
	clearInterval(chatReloadInterval);
});

$('.mini_friend_list p').click(function(){
	$('.mini_list').show();
});

$('.friend_search').click(function(){
	$('.mini_list').css("display", "none");
});
$('#messenger_notification').click(function(){
	$('.clicked_messages').toggle();
});



// chat mesijebis gamotana;
var clickedOnFriend = false;
var chatReloadInterval = null;
var lastID = 0;
var myFriendName = null;
function showChatMessages(){
	
	var serial = {
		attr: clickedOnFriend,
		last_id: lastID
	};
	$.ajax({
		url: 'mb/mainPage/chatBox.php',
		method: 'post',
		data: serial,
		success: function(response){
			$('.hheader .row h2 a').html(myFriendName);
			
			if(response){
				var response = JSON.parse(response);
				lastID = response.last_id;
				for(var i = 0;i < response.message.length; i++){
					var message = response.message[i];
					if(message.substring(message.length-2, message.length) == 'me'){
						message = message.substring(0, message.length-2);
						if(response.message.length > 1)
							$("<p class='me'>"+message+"</p>").prependTo($('.chat_box'));
						else
							$("<p class='me'>"+message+"</p>").appendTo($('.chat_box'));
					}
					else if(message.substring(message.length-2, message.length) == 'he'){
						message = message.substring(0, message.length-2);
						if(response.message.length > 1)
							$("<p class='sender'>"+message+"</p>").prependTo($('.chat_box'));
						else
							$("<p class='sender'>"+message+"</p>").appendTo($('.chat_box'));
					}
				}
			}
		var objDiv = document.getElementById("scrollBox");
		objDiv.scrollTop = objDiv.scrollHeight;
		}
	})

}


$('.friend_list_ul li').click(function(){
	$('.chat_box').html('');
	event.preventDefault();
	$('#addMessage textarea').val('');

	clickedOnFriend = $(this).attr('myFriendId');
	myFriendName = $(this).find('.my_friends_names').html();
	lastID = 0;
	showChatMessages();
	
	if(chatReloadInterval){
		clearInterval(chatReloadInterval);
	}
	chatReloadInterval = setInterval(showChatMessages, 5000);
});
// End;

// chatshi mesijis damateba;
$('#addMessage').keydown(function(event){ 
	var textarea = $('#addMessage textarea').val();
	
	if(event.which == 13){
		if(textarea != ''){
		
			var serial = {
				to: clickedOnFriend,
				message: textarea,
			}

			$.ajax({
				url: 'mb/mainPage/addMessage.php',
				method: 'post',
				data: serial,
				success: function(){
					var serial = {
						attr: clickedOnFriend,
					};
					$.ajax({
						url: 'mb/mainPage/chatBox.php',
						method: 'post',
						data: serial,
						success: showChatMessages,
					})
				
				}
			});
		}
		event.preventDefault();
		$('#addMessage textarea').val('');
	}
});
// End

// postis damateba;
$("#postNewItem").keydown(function(event){ 

	if(event.which == 13){
		var serial = {
			textarea: $('#postNewItem textarea').val(),
		};
		$.ajax({
			url: 'mb/mainPage/addPost.php',
			method: 'post',
			data: serial,
			success: function(response){
				refreshPosts();
			}
		})
		event.preventDefault();
		$('#postNewItem textarea').val('');
	}
});
// End;

// postebis gamotana;
function refreshPosts(){

	var serial = $('.last_id').html();
	
	if(serial == undefined){
		serial = 0;
	}
	var message = {
		last_id: serial
	};
	
	$.ajax({
		url: "mb/mainPage/showPosts.php",
		method: 'post',
		data: message,
		success: function(response){
			$('.posted_items').prepend(response);
			showPostComments();
			addPostComment();
		}
	})
}

refreshPosts();
setInterval(refreshPosts, 5000); 
// End;

// post_comments camogeba;
var id = 0;
function showPostComments(){
	var data = {
		last_id: id
	}
	$.ajax({
		url: "mb/mainPage/showPostComments.php",
		method: 'post',
		data: data,
		success: function(response){
			if(response){
			var response = JSON.parse(response);
				id = response[0].last_id;
				
				for(var i = 0;i < response.length; i++){
					var target = $(".my_post[post_id="+response[i].id+"] .post_comments");
					if(response.length > 1){
						target.prepend(response[i].comment);
					}else{
						target.append(response[i].comment);
					}
			
				}
			}
		}
	})
}
// End;

// post_comments gagzavna;
function addPostComment(){
	$('#postMyItem textarea').keydown(function(event){
		if(event.which == 13){
			var text = $(this).val();
			var id = $(this).parent().parent().attr("post_id");
			var data = {
				comment: text,
				post_id: id,
			}
			if(text != ''){
				$.ajax({
					url: "mb/mainPage/addPostComment.php",
					method: 'post',
					data: data,
					success: function(response){
						showPostComments();
					}
				})
			}
			event.preventDefault();
			$(this).val('');
		}
	});
}
// End;





	
// chiqos anaxe length >1 ze eg rogor sheidzleba sxvanairad, an tu ketdeba vapshe ajaxit!
// 30 minutes ago eg riti gavaketo yvelaze kargi varianti, bazis gamoyenebis gareshe ar sheidzleba?