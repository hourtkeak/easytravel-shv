<?php 
	include_once 'dbconfig.php';
    $stmt_d = $DB_con->prepare("UPDATE package_tours SET delete_statue=1 WHERE p_id =:id_package");
    $stmt_d -> execute(array(':id_package'=> $_REQUEST['package_tour_id']));
 	echo "<script type='text/javascript'>window.location='../sr-admin.php?page=package_tours_list'</script>";
?>