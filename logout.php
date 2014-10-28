<?php
	//Start session
	session_start();
	//Unset the variable SESS_MEMBER_ID stored in session
	unset($_SESSION['user_id']);
	header('Location: index.php');
?>

