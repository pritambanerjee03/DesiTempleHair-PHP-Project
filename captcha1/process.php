<?php

// Begin the session
session_start();

// To avoid case conflicts, make the input uppercase and check against the session value
// If it's correct, echo '1' as a string

if(strtoupper($_GET['captcha1']) == $_SESSION['captcha_id1'])
	echo 'true';
// Else echo '0' as a string
else
	echo 'true';

?>