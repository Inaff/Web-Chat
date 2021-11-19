<?php
session_start();

if ( ! isset($_SESSION['nonce']) || ! isset($_SESSION['user'])) { 	// Superfluous security measure
	http_response_code(404);
	include("404.html");
	exit();
		} 
?>


<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>	
	<link rel="stylesheet" href="/css/page/minimal.css" type="text/css"/>
</head>
 <body class="minimal">



<div id="chatbox"> </div>
     
	<form name="message">
        	<input name="usermsg" type="text" id="usermsg" onkeyup="activeInput()" placeholder="Message..." autocomplete="off">
		<div class="minimal_hr" id="thread"></div>

        	<input name="submitmsg" type="submit"  id="submitmsg" value="Send">
	</form>


<script type="text/javascript" src="/js/script.js"></script>



</body>
</html>
