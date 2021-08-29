<?php

/* ** Setup of your chatroom database **
 * 
 * $chatdb is the database, create an empty one (e.g. with phpLiteAdmin).
 * 
 * The chat scripts must be in directory protected by basic authentication
 * $validboxes points to the user file for this realm (~"htpasswd file")
 * 
 * The tables=chatboxes will created automatically, their names
 * will be derived from the "users" defined in above file
 * In other words: all participants in the chatbox remain unregistered and
 * the userid-password combination is shared between them !
 * 
 * Please consider the related potential security risks, however
 * it can very handy as long as you know what you're doing
 */

$chatdb = 'sqlite:/some/path/chat.db';
$validboxes = '/some/path/.chat';

// Some local customizations
$title = 'HomspaceChat';
$site_logo = '/homspace-logo.png';
$home_url = '/';
$menu_path_2_chatrooms = 'home->chatboxes';
$sponsor_logo = 'MannyHommer30.png';

// Long name lengths open possibilities for SQL injections
$nickname_length = 20;

// File upload parameters
$validext = array('.py', '.txt', '.csv', '.jpg', '.png', '.zip');
$MaxKbUp = 500;

?>
