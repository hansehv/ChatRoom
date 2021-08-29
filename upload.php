<?php session_start(); 

if 	(
	!isset($_SESSION['username'])
|| 	$_SESSION['username']==''
	) {
	header("location: ./index.php");
	exit();
}

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
    90 => 'No file was selected',
    91 => 'Allowed file types: ' . implode(', ', $_SESSION["validext"]),
    92 => 'Cannot move temporary file.',
);

function upload_file($stamp, $upload_dir)
{
	if (!isset($_FILES['file'])) {
		return 90;
	}

	// return false if error occurred
	$error = $_FILES['file']['error'];

	if ($error !== UPLOAD_ERR_OK) {
		return $error;
	}

	$allowedfileExtensions = $message = str_replace( '.', '', $_SESSION["validext"]);;
	$path_parts = pathinfo($_FILES['file']['name']);

	if (in_array($path_parts['extension'], $allowedfileExtensions)) {

		// move the uploaded file to the upload_dir
		$new_file = $upload_dir . $path_parts['filename'] .'.'. $stamp .'.'. $path_parts['extension'];

		if ( move_uploaded_file($_FILES['file']['tmp_name'], $new_file) ) {
			return 0;
		}
		else {
			return 92;
		}
	}
	else {
		return 91;
	}

}

$upload_dir = 'uploads/';
$date = new DateTime();
$stamp = date_timestamp_get($date);
$status = upload_file( $stamp, $upload_dir );
$file = "";

if ($status == 0) {

	// construct new message
	$path_parts = pathinfo($_FILES['file']['name']);
	$message = 'Shared ' . '<A HREF=`' .
				$upload_dir . $path_parts['filename'] .'.'. $stamp .'.'. $path_parts['extension'] .
				'`>' . $_FILES['file']['name'] . '</A>';

	// insert new message in db
	$file_db = new PDO('sqlite:/cloud/sqlite/chat.db') or die("cannot open database");
	$query = 'INSERT INTO ' . $_SERVER['REMOTE_USER'] . ' (sender_name, message) 
				VALUES ("' . $_SESSION['username'] . '","' . $message . '");';
	$file_db->query($query);
	
	// return to chat window
	header("location: ./chat.php");

} else {
	if ($status != 90) {
		$file = $_FILES['file']['name'];
	}
}

echo '
<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HomspaceChat</title>
	<style type="text/css" media="screen"></style>
	<link rel="stylesheet" type="text/css" href="chat.css">
    </head>
    
    <body>
		
		<h3>
			&nbsp; &nbsp; <A HREF="/"><IMG SRC="../homspace-logo.png" BORDER="0" ALIGN="left" ALT=""></A>
			&nbsp; &nbsp; Chat
			&nbsp;';
			echo $_SERVER['REMOTE_USER'];
			echo '<BR><BR>Upload ';
			echo $file;
			echo' failed:</h3>
		Return code = ';
		echo $status;
		echo '<BR><BR>Meaning:<BR><BR>';
		echo $phpFileUploadErrors[$status];
		echo '<BR><BR><h3>';
			echo '<A HREF="./chat.php">Back to chat window</A>';
		echo '</h3>
	</body>
  </html>';
 
?>

