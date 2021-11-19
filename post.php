<html>
<body>
<head></head>

<?php
session_start();


function chck_type($text, $fp) {
	$matches = '';

	//preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $text, $matches); Matches http and https links only
	preg_match_all('/^http:\/\/|(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/', $text, $matches);
	// preg_match_all('/(https?:\/\/\S+\.(?:jpg|png|gif))\s+/', $text, $matches);

	$link = $matches[0];



	if ($link) {
		if (substr($link[0], 0, 4) !== "www." && substr($link[0], 0, 8) !== "https://" && substr($link[0], 0, 7) !== "http://") {
			$link[0] = "https://www." . $link[0];

		} /* if (substr($link[0], 0, 5) === "http://") {
			str_replace("http://", "https://", $link[0]);
	
		}*/ if (substr($link[0], 0, 4) === "www.") {
			$link[0] = "https://" . $link[0];
		} 
	}


	if ($link) {
		if (preg_match('/\.(jpg|jpeg|png|gif)$/', $link[0])) {
		if (@getimagesize($link[0])) {
			fwrite($fp, "<img src='"  . $link[0] . "'>");

			$url = file_get_contents($link[0]);
			$url_path = "./usr/media/img/" . preg_replace('/[^A-Za-z0-9 _ .-]/', '_', $link[0]);
			file_put_contents($url_path, $url);
		} else {
			fwrite($fp, " [broken]");
		}
		} else {
			fwrite($fp, "<a href='"  . $link[0] . "'target='_blank'rel='noreferrer'> [Link]</a>");
		}
	}

	if ($link) {
	if (preg_match('/\.(mp3|wav|ogg)$/', $link[0])) {
		fwrite($fp, "<audio controls><source src='" .link[0] . "'</source>");
	}}
		
	if ($link) {
	if (strpos($link[0], "youtube.com/watch?v=") !== false) {
		$link[0] = str_replace("/watch?v=", "/embed/", $link[0]);
		fwrite($fp, "<iframe src='"  . $link[0] . "'allowfullscreen></iframe>");
	}}
}






if (isset($_SESSION['nonce']) && isset($_SESSION['user'])){
	$text = htmlspecialchars($_POST['text']);
		if (trim($text) === '') { exit(); }


	$dir_rand = bin2hex(openssl_random_pseudo_bytes(64));
	$user = trim($_SESSION['user']);

	//$dir = $_SERVER['DOCUMENT_ROOT'] . "/usr/logs/" .$dir_rand ."/" .$user ."/dummy";  /*** WARNING!!! - for some reason mkdir will not create the last directory, which appears to be a bug, therefore "/dummy" is being used ***/ 
	//$dir_path = dirname($dir);

	if ( ! is_dir($dir_path)) {
    			mkdir($dir_path, 0755, true); 
	}



	$path = $_SERVER['DOCUMENT_ROOT'] . "/usr/logs/test/" .date("Y-m") . ".htm";

	$fp = fopen($path, 'a');
	$user_icon = "/usr/icon/" .trim($_SESSION['user']). ".png";

	if ( ! file_exists("." . $user_icon)) { // Prepended period is required, as some PHP functions will not search root relatively, so ./ is needed
		$user_icon = "/usr/icon/default.png"; 
			}



	fwrite($fp, "<div id='msg'>".date("g:ia")." <img src='" .$user_icon. "'> ".stripslashes(htmlspecialchars($text)));



	chck_type(htmlspecialchars($text), $fp);
	fwrite($fp, "</div>");

	fclose($fp);
}
?>


</body>
</html>
