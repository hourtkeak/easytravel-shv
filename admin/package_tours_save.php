<?php
include_once 'dbconfig.php';
include_once 'upload_images.php';
/* Parameter */
$package_name 	= $_REQUEST['package_name'];
$tour_headline	= $_REQUEST['tour_headline'];
$tour_code 		= $_REQUEST['tour_code'];
$lenght_day		= $_REQUEST['lenght_day'];
$price			= $_REQUEST['price'];
$overview		= $_REQUEST['overview'];
$full_itinerary	= $_REQUEST['full_itinerary'];
$accomodation	= $_REQUEST['accomodation'];
$iande			= $_REQUEST['iande'];
$ordering 		= $_REQUEST['ordering'];



// Check show or unshow 
if (isset($_REQUEST['display'])) {	$display = 1; }else{ $display = 0;}

// Check file images
if($_FILES["img_thumnail_package"]["name"]!=""){

	$img_thumnail_package = $_FILES["img_thumnail_package"]["name"];
	$target_dir = '../img/uploads/';
	uploadImage($target_dir,'img_thumnail_package');

}else{ $img_thumnail_package="";}



// Query INSERT DATA into table package tours
$stmt_p = $DB_con->prepare("INSERT INTO package_tours(tour_code, p_title, p_short_line, p_overviews,p_itinerary, p_acc, p_ie, is_show, price, p_ordering, num_day, img_thunail) 

	VALUES (:tour_code, :package_name, :tour_headline, :overview, :full_itinerary, :accomodation, :iande, :display, :price, :ordering, :lenght_day, :img_thumnail_package)");

$stmt_p -> execute(array(':tour_code'=> $tour_code, ':package_name' => 
	$package_name, ':tour_headline'=>$tour_headline, ':overview'=>$overview, ':full_itinerary'=> $full_itinerary, 
	':accomodation' => $accomodation, ':iande'=> $iande, ':display'=>$display, ':price'=>$price, ':ordering'=>$ordering, ':lenght_day'=> $lenght_day, ':img_thumnail_package' => $img_thumnail_package));

// GET LAST INSERT ID
 $last_id = $DB_con->lastInsertId();


 foreach ($_POST['tour_dest'] as $destination)
{
    //print "You are selected $destination<br/>";
    $stmt_option_dest = $DB_con -> prepare("INSERT INTO tour_type_option(op_categories, op_item) VALUES (:destination,  :last_id)");
    $stmt_option_dest->execute(array(':destination' => $destination, ':last_id' => $last_id));
}

 foreach ($_POST['tour_act'] as $activity)
{
    $stmt_option_act = $DB_con -> prepare("INSERT INTO tour_type_option(op_categories, op_item) VALUES (:activity,  :last_id)");
    $stmt_option_act -> execute(array(':activity' => $activity, ':last_id' => $last_id ));
}

 
 $msg = "Success! The data have been insert.";
 //echo   $msg;
 echo "<script type='text/javascript'>window.location='../sr-admin.php?page=add_package_tours&action=edit&package_tour_id=".$last_id."&msg=".$msg."'</script>";


?>