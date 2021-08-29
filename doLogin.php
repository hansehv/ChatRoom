<?php session_start(); 
require_once './config.php';

if ( $_SERVER['REMOTE_USER'] != "" ) {
	
	if ( isset($_POST['username']) ) {
		if ( strlen( $_POST['username'] ) <= $nickname_length ) {
			$_SESSION["username"] = $_POST['username'];
		} else {
			header("location: ./what3.png");
			exit();
		}
	} else {
		header("location: ./index.php");
		exit();
	}
	
	$_SESSION["favcolor"] = "#000000";
	if ( isset($_POST['favcolor']) ) {
		if( preg_match('/^#[a-f0-9]{6}$/i', $_POST['favcolor']) ) {
			$_SESSION['favcolor'] = $_POST['favcolor'];
		} else {
			header("location: ./what3.png");
			exit();
		}
	}

	$file = file_get_contents($validboxes);
	$searchfor = $_SERVER['REMOTE_USER'] .':';
	if( strpos($file, $searchfor) !== FALSE ) {
		header("location: ./chat.php");
		exit();
	};

};

?> 

<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<style type="text/css" media="screen"></style>
	<link rel="stylesheet" type="text/css" href="chat.css">
    </head>
    
    <body>
		
		<h3>
			<A HREF="<?php echo $home_url; ?>"><IMG SRC="<?php echo $site_logo; ?>" BORDER="0" ALIGN="left" ALT=""></A>
			&nbsp; &nbsp; Chat
		</h3>
		<b>Please refresh the logon to your chatbox</b>
		
		<ol>
		<li>Click <A HREF="<?php echo $home_url; ?>">the site logo</A>, then
		<li>follow <?php echo $menu_path_2_chatrooms; ?> to restart.
		</ol>
		
		If that doesn't help, you need to start in a fresh browser session<br>
		So you might close this tab/browser instance and/or use different one.
	</body>
</html>
