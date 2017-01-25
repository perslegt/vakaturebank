<?php
    function checkEmail($str) {  // This function is going to help us filter out bad email from the good one and it makes sure the email enter is in the format of as@as.com 
	    return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
    }
    function randomCode() { 
    	$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    	srand((double)microtime()*1000000); 
    	$i = 0; 
    	$pass = ''; 
    	while ($i <= 7) { 
        	$num = rand() % 33; 
        	$tmp = substr($chars, $num, 1); 
        	$pass = $pass . $tmp; 
        	$i++; 
    	} 
    	return $pass; 
	}
?>