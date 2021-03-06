<?php
include_once 'dbconfig.php';
include_once 'upload_images.php';
include_once 'resize-class.php';

$n_service = $_REQUEST['s_name'];
$star = $_REQUEST['star_rate'];
$id_destination = $_REQUEST['tour_dest'];
$contact_info = $_REQUEST['contact_info'];
$description = $_REQUEST['description'];
$service_type = $_REQUEST['service_type'];

if (isset($_REQUEST['display'])) {$display = 1;} else { $display = 0;}

$thumain_larg = $_FILES['img_thumnail_services']['name'];
$thumail_img = 'thumbnail-' . $thumain_larg;

if (!empty($thumain_larg)) {

	$target_dir = '../img/uploads/';
	$file_smg = uploadImage($target_dir, 'img_thumnail_services');
	$full_name_original = '../img/uploads/' . $thumain_larg;
	$resize_img = "../img/uploads/thumbs/thumbnail-" . $thumain_larg;

	// *** 1) Initialise / load image
	$resizeObj = new resize($full_name_original);
	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj->resizeImage(300, 'auto', 'auto');
	// *** 3) Save image
	$resizeObj->saveImage($resize_img, 100);
	// insert images
}

$stmt_services = $DB_con->prepare("INSERT INTO services(service_name, star, id_destination, contact_info, description, thumail_img, large_img, display, service_type)
VALUES (:n_service, :star, :id_destination, :contact_info, :description, :thumnail_img, :larg_img, :display, :service_type)");
$stmt_services->execute(array(':n_service' => $n_service, ':star' => $star, ':id_destination' => $id_destination,
	':contact_info' => $contact_info, ':description' => $description, ':thumnail_img' => $thumail_img, ':larg_img' => $thumain_larg,
	':display' => $display, ':service_type' => $service_type));

// GET LAST INSERT ID
$last_id = $DB_con->lastInsertId();
if ($last_id != "") {
	$msg = "Success! The data have been insert.";
}

echo "<script type='text/javascript'>window.location='../sr-admin.php?page=services&service_type=" . $service_type . "&action=edit&services_id=" . $last_id . "&msg=" . $msg . "'</script>";
?>