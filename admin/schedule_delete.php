<?php
include_once 'dbconfig.php';
$sql_delete_img = $DB_con->prepare("DELETE FROM transportation WHERE id = :bus_shedule_departure");
$sql_delete_img->execute(array(':bus_shedule_departure' => $_REQUEST["bus_shedule_departure"]));

echo "<script type='text/javascript'>window.location='../sr-admin.php?page=bus_shedule_list'</script>";
?>

