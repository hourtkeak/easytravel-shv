<?php
	include 'views/header.php';

	if(@$_REQUEST['page_id']==6){
		include 'views/about_us.php';
	}elseif (@$_REQUEST['page_id']==4) {
		include 'views/contact_us.php';
	
	}else{
		include 'views/home.php';
	}

	include 'views/footer.php';
?>