<?php session_start(); 
require_once './config.php';

if 	(
	!isset($_SESSION['username'])
|| 	$_SESSION['username']==''
	) {
	header("location: ./index.php");
	exit();
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title; ?></title>
		<style type="text/css" media="screen"></style>
		<script src="manageChat.js"></script>
		<link rel="stylesheet" type="text/css" href="chat.css">
	</head>
	<body onload="javascript:startChat();">
		
		
		<h3>
			&nbsp; &nbsp;<A HREF="<?php echo $home_url; ?>">
						<IMG SRC="<?php echo $site_logo; ?>" BORDER="0" ALIGN="left" ALT="logo">
						</A>
			&nbsp; &nbsp; Chat
			&nbsp;'<?php echo $_SERVER['REMOTE_USER'] ?>'
		</h3>
			
		<div id="status">
		</div>
			
		<!-- web chat -->
		<div id="div_chat" class="chat">
		</div>
			
		<!-- text message and send button -->
		<form id="input" class="input" name="input"  onsubmit="return manageEnter();">
			<input type="text" id="message" class="message" name="message">
			&nbsp;
			<input type="button" id="send_chat" name="send_chat" value="Send" onclick="javascript:sendMessage()"/>
		</form>
				
		<!-- hidden values, they are passed to javascript js file -->
		<input autofocus type="hidden" name="user_name" id ="user_name" value="<?php echo $_SESSION['username']; ?>"/>
		
	</body>
	
</html>
