<?php 
	include_once'connection_setting.php';
	include_once 'class.user.php';
	$user = new USER($DB_con);
	$user->sec_session_start();
?>