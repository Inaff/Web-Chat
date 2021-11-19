<?php 
session_start();

	if ( ! isset($_SESSION['nonce']) || ! isset($_SESSION['user'])) { 	// Superfluous security measure
		http_response_code(404);
		include("404.html");
		exit();
			} 
 
	if (isset($_GET['logout'])){
		$fp = fopen($_SERVER["DOCUMENT_ROOT"] . "/usr/logs/test/" . date("Y-m") . ".htm", 'a');
        	fwrite($fp, "<div id='msg'><i>" .date("g:ia"). " " .trim($_SESSION['user']) ." has left the chat session</i></div>");
        	fclose($fp);
                	
        	session_destroy();
		header("Location: /index.php");
	}
	
	

	$fp = fopen("./usr/config/theme.txt", "r");
	
	if ( ! @$_SESSION['theme']) { // Silence suppression!
	while (($line = fgets($fp)) !== false) {
		$string = explode(":", $line);
		//echo "<br><br>" . $string[0] .  $string[1] . $_SESSION['user'];
		
		if (trim($_SESSION['user']) === $string[0]) {
			$_SESSION['theme'] = $string[1] . ".css";
			//echo "WORKING";
		}
	}}
	
	fclose($fp);
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<script>if (/Android|iPhone|iPod|Windows Phone|webOS/i.test(navigator.userAgent)) {
				document.execCommand('Stop');
				window.location = "/minimal";
			} else if (navigator.userAgent.toLowerCase().indexOf('TenFourFox') > -1) {
				document.execCommand('Stop');
				window.location = "/minimal";
			}
	</script>
	<title>Chat</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="BLANK">

  		<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> <!-- For auto scrolling -->
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --> <!-- For image modal -->

	<link rel="stylesheet" href="css/page/chat.css"/>
	<?php echo '<link rel="stylesheet" href="/css/theme/' . $_SESSION['theme'] . '"/>' ?>

	<link rel="shortcut icon" href="/favicon.ico"> <!-- Works in every desktop browser back to IE6. Icon is in root due to many things only checking a site's root -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="apple-mobile-web-app-title" content="Chat">
	<meta name="application-name" content="Chat">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<link rel="apple-touch-icon-precomposed" href="/img/favicon-152.png"> <!--- iOS 2.0+ and Android 2.1+ -->
	 <!-- <link rel="icon" type="image/png" href="/img/favicon.png"?v=1.0 /> <!-- v=X.X forces cache reload -->
	 <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>  IE8 support -->
</head>
 <body>





<!-- <div class="stop_motion_cont">
	<div class="square_left"></div><div class="square_m_left"></div>
	<div class="square_m_right"></div><div class="square_right"></div>
</div>
<div class="stop_motion_cont" style="right: 0 !important; left: initial; transform: rotate(5deg);">
	<div class="square_left"></div><div class="square_m_left"></div>
	<div class="square_m_right"></div><div class="square_right"></div>
</div> -->



<div class="glob_menu_wrap">
<div class="glob_menu">
	<a class="version" href="changelog.txt" onclick="stop_motion_start()">v0.7.1</a>
	<span class="MoTD" onclick="stopMotion_start(''); magic_timer();">MoTD</span>

	<!-- Right to left of screen -->
	<a class="logout" href="?logout=true" onclick="logout()" title="Logout">&#8627;</a>
	<button id="onoff" value="Off" title="Blacken background" onclick="ch_back_color()" style="float: right; margin: 4px;">&#9680;</button>
	<button id="button" onclick="dup_chat()" title="Chat" style="float: right; margin: 4px;">&#9633;+</button>
	<button id="button" onclick="dup_chat()" title="Room" style="float: right; margin: 4px;">&#9638;</button> 
	<button id="button" onclick="create_note()" title="Note" style="float: right; margin: 4px;">&#10063;</button>
	<!--
	<button id="button" onclick="duplicate()" title="Create chat" style="float: right; margin: 4px;">&#10022;</button>
	<button id="button" onclick="duplicate()" title="Create chat" style="float: right; margin: 4px;">&#10042;</button>
	<button id="button" onclick="duplicate()" title="Create chat" style="float: right; margin: 4px;">&#10063;</button> -->
</div>
</div>



<div id="ext_wrapper_def">
<div id="wrapper">
    	<div id="menu">
        	<span class="welcome">Welcome, <?php echo $_SESSION['user']; ?></span>

		<input type="checkbox"  id="checkbox_id"><label title="Popout chat" onclick="window.open('/minimal', this.href, 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=280px, height=380px');">&#8599;</label>   

		<input type="checkbox"  id="checkbox_id"><label title="Ground chat" onclick="ground_chat()">&#8595;</label>

		<input type="checkbox"  id="checkbox_id"><label title="Minimize chat" onclick="min_chat()">&#9472;</label>   	      	
	</div>
     
    	<div id="chatbox"></div>

    	<form name="message">
        	<input name="usermsg"     type="text" 	   id="usermsg" onkeyup="activeInput()" value='' autocomplete="off" placeholder="Message...">
        	<input name="submitmsg" type="submit"  id="submitmsg" value="Send">
    	</form>

	<hr id="thread" class="right" id="js_toggle">
</div>
</div>

<div class="minion"></div>



<script>
if (navigator.userAgent.indexOf('MSIE')!==-1 || navigator.appVersion.indexOf('Trident/') > 0) {
document.write("Internet Explorer? Ew") 
}</script>

<!-- 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$("#wrapper").resizable()
    	$("#wrapper").draggable(); 
</script> 
-->

<script type="text/javascript" src="js/script.js"></script>





</body>
</html>
