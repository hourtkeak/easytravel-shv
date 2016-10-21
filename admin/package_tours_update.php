<?php
include_once 'dbconfig.php';
include_once 'upload_images.php';
/* Parameter */
$package_tour_id = $_REQUEST['package_tour_id'];
echo $package_tour_id;
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

	// Query INSERT DATA into table package tours
	$stmt_p = $DB_con->prepare("UPDATE package_tours SET tour_code=:tour_code, p_title=:package_name, p_short_line=:tour_headline, p_overviews=:overview, p_itinerary=:full_itinerary, p_acc=:accomodation, p_ie=:iande, is_show=:display, price=:price, p_ordering=:ordering, num_day=:lenght_day, img_thunail=:img_thumnail_package WHERE p_id =:package_tour_id"); 

	$stmt_p -> execute(array(':tour_code'=> $tour_code, ':package_name' => 
	$package_name, ':tour_headline'=>$tour_headline, ':overview'=>$overview, ':full_itinerary'=> $full_itinerary, 
	':accomodation'=>$accomodation, ':iande'=> $iande, ':display'=>$display, ':price'=>$price, ':ordering'=>$ordering, ':lenght_day'=> $lenght_day, ':img_thumnail_package' => $img_thumnail_package, ':package_tour_id'=> $package_tour_id ));



}else{ 

	// Query INSERT DATA into table package tours
	$stmt_p = $DB_con->prepare("UPDATE package_tours SET tour_code=:tour_code, p_title=:package_name, p_short_line=:tour_headline, p_overviews=:overview, p_itinerary=:full_itinerary, p_acc=:accomodation, p_ie=:iande, is_show=:display, price=:price, p_ordering=:ordering, num_day=:lenght_day WHERE p_id =:package_tour_id"); 

	$stmt_p -> execute(array(':tour_code'=> $tour_code, ':package_name' => 
	$package_name, ':tour_headline'=>$tour_headline, ':overview'=>$overview, ':full_itinerary'=> $full_itinerary, 
	':accomodation'=> $accomodation, ':iande'=> $iande, ':display'=>$display, ':price'=>$price, ':ordering'=>$ordering, ':lenght_day'=> $lenght_day, ':package_tour_id'=> $package_tour_id ));
}


$stmt_d = $DB_con-> prepare("DELETE FROM tour_type_option WHERE op_item =:package_tour_id");
$stmt_d -> execute(array(':package_tour_id' => $package_tour_id));

 foreach ($_POST['tour_dest'] as $destination)
{
    //print "You are selected $destination<br/>";
    $stmt_option_dest = $DB_con -> prepare("INSERT INTO tour_type_option(op_categories, op_item) VALUES (:destination,  :package_tour_id)");
    $stmt_option_dest->execute(array(':destination' => $destination, ':package_tour_id' => $package_tour_id));
}

 foreach ($_POST['tour_act'] as $activity)
{
    $stmt_option_act = $DB_con -> prepare("INSERT INTO tour_type_option(op_categories, op_item) VALUES (:activity,  :package_tour_id)");
    $stmt_option_act -> execute(array(':activity' => $activity, ':package_tour_id' => $package_tour_id ));
}

 
 $msg = "Success! The data have been insert.";
 //echo   $msg;
 echo "<script type='text/javascript'>window.location='../sr-admin.php?page=add_package_tours&action=edit&package_tour_id=".$package_tour_id."&msg=".$msg."'</script>";


?>