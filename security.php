<?php
	function gen() {
   		$ip = $_SERVER['REMOTE_ADDR'];
		$nonce = bin2hex(openssl_random_pseudo_bytes(16)) . md5($ip);
    		
        return $nonce;
	}
?>