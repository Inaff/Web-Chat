<?php
session_start();

if ( ! isset($_SESSION['nonce']) || ! isset($_SESSION['user'] )) {
	session_destroy();
    	header("Location: /index.php");
		} 
?>


<html>
<head>
	<title>S</title>

	<style>
		@font-face {
			font-family: 'font_headers';
			src: url("/fonts/Infinity.ttf") format('truetype');
		} @font-face {
			font-family: 'font_light';
			src: url("/fonts/Folio Light.ttf") format('truetype'); }	

		body { word-wrap: break-word; }
		h4 { margin: 0; }
    		//h1 {background: linear-gradient(to right, orange , yellow, green, cyan, blue, violet); /* Standard syntax (must be last) */ }

		#search_box { width: 40%; }

		#msg img:first-child { 	height: 17px; 
							width: 17px; }

	</style>
</head>
<body style="text-align: center;">



<h1 style="font: 350% 'font_headers'; letter-spacing: 5px;">There's Nothing I Don't Know</h1>

<form action="/s?strig=" method="GET" action="#">
	<input type="text" name="string" id="search_box">
	<input type="submit" value="Submit">
</form>




<?php
	if (isset($_POST['submit'])){
		$link = $_GET['string'];
	} if (empty(@$string = htmlspecialchars($_GET["string"]))) { // @ is to silence errors
		echo "No string to search was given. Usage: example.com/s?string=word";
		exit();
	}


$fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/usr/searches/' . rtrim($_SESSION['user']) . "_" . date("d-m-Y") . '.txt', 'a');
	  fwrite($fp, $_GET['string'], 30);
	  fclose($fp);
$dir = new DirectoryIterator($_SERVER['DOCUMENT_ROOT'] . '/usr/logs/test/');



foreach ($dir as $file) {
	$content = file_get_contents($file->getPathname());

    	if (strpos($content, $string) !== false) {
		echo "<h4>FILE: " . $file . "</h4><br>";
        	echo $content . "<br><br><br><br>";
    	} 
}
?>



</body>
</html>