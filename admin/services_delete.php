<?php 
	include_once 'dbconfig.php';
	$sql_delete_img=$DB_con->prepare("DELETE FROM services WHERE id_more_service = :id_article");
	$sql_delete_img->execute(array(':id_article' => $_REQUEST["services_id"]));

echo "<script type='text/javascript'>window.location='../sr-admin.php?page=services_list&sercive_type=".$_REQUEST["services_id"]."'</script>";
?>

