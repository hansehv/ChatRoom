<?php session_start();
require_once './config.php';

// send headers to prevent caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );

// open database
$file_db = new PDO($chatdb) or die("cannot open database");
$json = array();

if ($file_db) {
    $query = 'CREATE TABLE IF NOT EXISTS ' . $_SERVER['REMOTE_USER'] . ' (
	    "message_id" INTEGER PRIMARY KEY NOT NULL,
	    "sender_name" TEXT NOT NULL,
	    "message" TEXT NOT NULL,
	    "time" DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	    "favcolor" TEXT NOT NULL DEFAULT "#000000")';
    $file_db->query($query);

    // check if a message was sent to the server
    if (isset($_POST['message']) ) {
    
	// insert new message in db
	$query = $file_db->prepare("INSERT INTO " . $_SERVER['REMOTE_USER'] . " (sender_name, message, favcolor)
				VALUES (:sender_name, :message, :favcolor)");
	$query->bindParam(':sender_name' ,$sender_name);
	$query->bindParam(':message' ,$message);
	$query->bindParam(':favcolor' ,$favcolor);
	
	$table = $_SERVER['REMOTE_USER'];
	$sender_name = $_POST["sender_name"];
	$message = $_POST["message"];
	$favcolor = $_SESSION["favcolor"];
	
	$query->execute();
    }
	
    // retrieve all new messages from server
    else if (isset($_POST["lastReceivedMessage"])) {
	
	// retrieve all unread messages from server
	$lastMessage = $_POST["lastReceivedMessage"];
	if (is_numeric( $lastMessage )) {

	    $query = 'SELECT * FROM ' . $_SERVER['REMOTE_USER'] . ' WHERE message_id > ' . $lastMessage . ';';
	    $result = $file_db->query($query);
	    
	    // for every line, create a json element
	    while($row = $result->fetch()) {
		$message = str_replace( '`', '"', $row['message']);
		$json[] = array("message_id" => $row['message_id'], 
				"sender" => $row['sender_name'],
				"message" => $message,
				"favcolor" => $row['favcolor'],
				"time" => $row['time']);
	    }

	    // print json	 
	    echo json_encode($json);
	}
	else {
	    http_response_code(401);
	}
    }
}
?>


