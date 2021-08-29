<?php session_start();
require_once './config.php';

if ( $_SERVER['REMOTE_USER'] == "" ) {
	header("location: ./doLogin.php");
}
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
	    &nbsp; &nbsp; <A HREF="<?php echo $home_url; ?>"><IMG SRC="<?php echo $site_logo; ?>" BORDER="0" ALIGN="left" ALT=""></A>
	    &nbsp; &nbsp; Chat facility
	</h3>
	<HR><BR>

	<form action="doLogin.php" method="post">
	    <table class="form">
		
		<tr>
		    <td colspan=2 align="center">
			<h2>Hello, about to meet in '<?php echo $_SERVER['REMOTE_USER'] ?>'</h2>
		    </td>
		</tr>
		
		<tr>
		    <td align="center">What is your (nick)name:
			<br>(max 20 characters)
		    </td>
		    <td valign="top"><input type="text" MAXLENGTH="<?php echo $nickname_length = 20 ?>" name="username" autofocus></td>
		</tr>
		
		<tr><td>&nbsp;</td></tr>
		
		<tr>
		    <td align="center"><label for="favcolor">Choose your text colour:
			<br>(modern browsers only)</label>
		    </td>
		    <td valign="top"><input type="color" id="favcolor" name="favcolor" value="#000000"></td>
		</tr>
		
		<tr>
		    <td colspan=2 align="center"><BR><BR>
			<input type="submit" value="Enter chatbox" style="font-weight:bold; padding:5px 10px; font-size:large;">
		    </td>
		</tr>
		
		<tr>
		    <td colspan=2 align="center">
			<BR><BR><BR><BR>
			<A HREF="https://en.wikipedia.org/wiki/Beerware">
			    <IMG SRC="80px-BeerWare_Logo.svg.png" ALT="Beerware" ALIGN="middle">
			</A>
			<BR>based on an
			<A HREF="https://github.com/IvanoAlvino/ChatRoom">
			    idea of IvanoAlvino
			</A>
			<BR>and sponsored by<BR>
			<IMG SRC="<?php echo $sponsor_logo; ?>" ALT="" ALIGN="middle">
		    </td>
		</tr>
	    
	    </table>
	</form> 
    </body>
 
 </html>
