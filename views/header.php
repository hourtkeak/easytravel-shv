<?php
include_once 'admin/dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Easy Travel - SHV</title>
<!--
Holiday Template
http://www.templatemo.com/tm-475-holiday
-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="css/flexslider.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body class="tm-gray-bg">
  	<!-- Header -->
  	<div class="tm-header">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-3 col-md-4 col-sm-3 tm-site-name-container">
  					<img src="img/logo-easy-travel-shv.png" alt="logo">
  				</div>
	  			<div class="col-lg-9 col-md-8 col-sm-9">
	  				<div class="mobile-menu-icon">
		              <i class="fa fa-bars"></i>
		            </div>
	  				<nav class="tm-nav">
						<ul><?php
$stmt_menu = $DB_con->prepare("SELECT c_id, c_title, c_is_show, c_headline, c_main_id FROM menu  WHERE c_main_id=0 AND c_is_show=1 order by ordering ASC");
$stmt_menu->execute();
while ($result_menu = $stmt_menu->fetch(PDO::FETCH_ASSOC)) {
	?>
							<li><a href="index.php?page_id=<?php echo $result_menu['c_id']; ?>"> <?php echo $result_menu['c_title']; ?></a> </li>
								<?php
}?>
						</ul>
					</nav>
	  			</div>
  			</div>
  		</div>
  	</div>
