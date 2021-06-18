<?php session_start(); 
	
	$orig = array("'", '"', "<", ">", "&" , "+");
	$repl = array("`", "`", "< ", " >", " plus " , " plus ");
	$_SESSION["username"] = str_replace( $orig,$repl, $_POST['username'] );
	header("location: ./chat.php");
?> 
