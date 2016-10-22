<?php
date_default_timezone_set('Asia/Bangkok');
include_once 'dbconfig.php';
include "resize-class.php";
$tran_id = $_REQUEST['bus_shedule_departure'];
$frm_times = $_REQUEST['frm_times'];
$frm_destinations = $_REQUEST['frm_destinations'];
$frm_Tran_company = $_REQUEST['frm_Tran_company'];
$frm_prices = $_REQUEST['frm_prices'];
$frm_durations = $_REQUEST['frm_durations'];
$frm_vichicle_type = $_REQUEST['frm_vichicle_type'];
if (isset($_REQUEST['frm_enable'])) {$frm_enable = 1;} else { $frm_enable = 0;}
if (isset($_REQUEST['frm_display'])) {$frm_display = 1;} else { $frm_display = 0;}

$stmt_transport = $DB_con->prepare("UPDATE transportation SET tran_time=:frm_times,destinations=:frm_destinations,tran_company=:frm_Tran_company,prices=:frm_prices,durations=:frm_durations,vichicle_type=:frm_vichicle_type,tran_enable=:frm_enable,display=:frm_display WHERE id=:tran_id");

$stmt_transport->execute(array(
	':frm_times' => $frm_times,
	':frm_destinations' => $frm_destinations,
	':frm_Tran_company' => $frm_Tran_company,
	':frm_prices' => $frm_prices,
	':frm_durations' => $frm_durations,
	':frm_vichicle_type' => $frm_vichicle_type,
	':frm_enable' => $frm_enable,
	':frm_display' => $frm_display,
	':tran_id' => $tran_id));

$msg = "Success! The data have been Update.";

echo "<script type='text/javascript'>window.location='../sr-admin.php?page=bus_shedule_list'</script>";
?>