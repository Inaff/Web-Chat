<?php
session_start();

require("security.php");

if ( ! isset($_SESSION['nonce'])) {
	$_SESSION['nonce'] = gen();
}


echo'
<html>
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="css/page/index.css"/>
	<script>if (/Android|iPhone|iPod|Windows Phone|webOS/i.test(navigator.userAgent)) {
				document.write(\'<link rel="stylesheet" href="/css/page/index_mob.css"/>\');
			}
	</script>
</head>
<body>

	<h1>Welcome</h1>

	<div id="login_cont">
		<form method="post">
			<p>Please enter your ID to continue:</p>
			<br><br>

			<label for="name"></label>
					<input type="text" name="name" id="name"/>
					<input type="submit" name="enter" id="enter" value="Enter"/>
					<input type="hidden" name="form_nonce" value="' .$_SESSION['nonce']. '">
		</form>
	</div>
	
</body>
</html>
';

    

if (isset($_POST['enter']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
	echo "Nonce: " . $_SESSION['nonce'] . "<br>Post: " . $_POST['form_nonce'] . "<br>";
	$_POST['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');

	if (trim($_POST['name']) !== '') {
		if (isset($_SESSION['nonce']) && $_SESSION['nonce'] === $_POST['form_nonce']) {
			$fp = fopen("./usr/config/hash.txt", "r");

			while (($line = fgets($fp)) !== false) {
				$string = explode(":", $line);
				if (hash("sha512", $_POST['name']) === $string[0]) {
					$_SESSION['user'] = $string[1];
					header("Location: /chat.php");
				}
			}
		
			fclose($fp);
		}
	} else {
		echo "<p class='error'>Invalid ID!</p>";
	}
}



?>
