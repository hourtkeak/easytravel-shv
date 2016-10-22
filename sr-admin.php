<?php include_once 'admin/dbconfig.php';
if (!$user->is_loggedin()) {
	$user->redirect('login.php');
} else {

	$user_id = $_SESSION['user_id'];
	$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id" => $user_id));
	$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
	$user_level = $userRow['u_level'];
	date_default_timezone_set('Asia/Bangkok');
}

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin| Easy Trave SHV.</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
     <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
     <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
     <link rel="stylesheet" href="plugins/select2/select2.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="dist/css/adjustment.css">

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="sr-admin.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>E</b>T</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin </b>Travel</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="img/user2-160x160.gif" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php print($userRow['user_name']);?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="img/user2-160x160.gif" class="img-circle" alt="User Image">
                    <p>
                      <?php print($userRow['user_name']);?> - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="admin/logout.php?logout=true" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="img/user2-160x160.gif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php print($userRow['user_name']);?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
           <!-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->

             <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>MENU</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="sr-admin.php?page=menu_list">List all MENU</a></li>
                <li><a href="sr-admin.php?page=add_menu">Add New MENU</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>PACKAGE TOURS</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="sr-admin.php?page=package_tours_list">List Package Tours</a></li>
                <li><a href="sr-admin.php?page=add_package_tours">Add Packages Tours</a></li>
                 <li><a href="sr-admin.php?page=slide_show">Slide</a></li>
              </ul>
            </li>

              <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>OUR BLOG</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">

                <li><a href="sr-admin.php?page=content_list">Content</a></li>
                <li><a href="sr-admin.php?page=content">Add new Content</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Services</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="sr-admin.php?page=services&service_type=hotel">Add Hotel</a></li>
                <li><a href="sr-admin.php?page=services_list&sercive_type=hotel">List Hotel</a></li>
                 <li><a href="sr-admin.php?page=services&service_type=restaurant">Add Restaurant</a></li>
                <li><a href="sr-admin.php?page=services_list&sercive_type=restaurant">List Restaraunt</a></li>
                <li><a href="sr-admin.php?page=bus_shedule_departure">Add transportation schedule</a></li>
                <li><a href="sr-admin.php?page=bus_shedule_list">List Add transportation schedule</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#">All User</a></li>
                <li><a href="#">Register New User</a></li>
              </ul>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Easy Travel SHV
            <small>System Administrator</small>
          </h1>
         <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>-->
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <?php
switch (@$_REQUEST["page"]) {
case 'add_menu':
	include "admin/menu.php";
	break;
case 'menu_list':
	include "admin/menu_list.php";
	break;
case 'add_images':
	include "admin/add_image_all.php";
	break;
case 'add_package_tours':
	include "admin/package_tours.php";
	break;
case 'package_tours_list':
	include "admin/package_tours_list.php";
	break;
case 'content':
	include "admin/content.php";
	break;
case 'content_list':
	include "admin/content_list.php";
	break;
case 'slide_show':
	include "admin/slide_show.php";
	break;

case 'services':
	include "admin/services.php";
	break;
case 'services_list':
	include "admin/services_list.php";
	break;

case 'bus_shedule_departure':
	include "admin/bus_shedule_departure.php";

	break;
case 'bus_shedule_list':
	include "admin/bus_shedule_list.php";

	break;
default:
	include "admin/first_box.php";
	break;
}
?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Developed by: SATHAPANEK.
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="http://srangkortravel.com/">SR Angkor Travel Co., Ltd.</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
      $(function () {
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>

    <script src="plugins/select2/select2.full.min.js"></script>
      <script>
        $(function () {
          //Initialize Select2 Elements
          $(".select2").select2();
          });
      </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
<script type="text/javascript" src="plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
  selector: ".textarea1",



  plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker jbimages"
        ],

        toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft jbimages",

        menubar: false,
        toolbar_items_size: 'small',


// Image Path Convert URL
relative_urls: false,
remove_script_host: false,
document_base_url: 'http://srangkortravel.com',

 /*font_formats: "Hanuman='Hanuman', serif;"+
        "Arial=arial,helvetica,sans-serif;"+
        "Arial Black=arial black,avant garde;"+
        "Book Antiqua=book antiqua,palatino;"+
        "Comic Sans MS=comic sans ms,sans-serif;"+
        "Courier New=courier new,courier;"+
        "Georgia=georgia,palatino;"+
        "Helvetica=helvetica;"+
        "Impact=impact,chicago;"+
        "Symbol=symbol;"+
        "Tahoma=tahoma,arial,helvetica,sans-serif;"+
        "Terminal=terminal,monaco;"+
        "Times New Roman=times new roman,times;"+
        "Trebuchet MS=trebuchet ms,geneva;"+
        "Verdana=verdana,geneva;"+
        "Webdings=webdings;"+
        "Wingdings=wingdings,zapf dingbats"*/

});

</script>


  </body>
</html>
