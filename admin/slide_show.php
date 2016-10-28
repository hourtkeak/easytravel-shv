<?php 
include_once 'upload_images.php';
if(@$_REQUEST['s_link']==""){@$_REQUEST['s_link']='#';}
	
 	if(@$_REQUEST['action']=="Add slide"){
 		
 		/* Move Large image */
 		$target_dir_l = 'img/uploads/';
 		$img_smg_l=uploadImage($target_dir_l, 'img_slide');
 		$img_slide = $_FILES['img_slide']['name'];

 		$stmt_img = $DB_con -> prepare("INSERT INTO package_tours_slide(s_title, s_description, s_img, link, ordering, type) 
 									VALUES (:slide_title, :slide_desc, :img_slide, :s_link, :ordering, :type)");
 		
 		$stmt_img -> execute (array(':slide_title'=>$_REQUEST['slide_title'], ':slide_desc' => $_REQUEST['slide_desc'], 
 										':img_slide' => $img_slide, ':s_link' => $_REQUEST["s_link"], ':ordering'=> $_REQUEST['ordering'], ':type'=> $_REQUEST['type_sp']));

 	}elseif(@$_REQUEST['action'] == "edit") {

		$stmt_sile_edit = $DB_con -> prepare("SELECT * FROM package_tours_slide WHERE slide_id =:s_id");
        $stmt_sile_edit -> execute(array(':s_id' => $_REQUEST['s_id'])); 
        $rs_slide = $stmt_sile_edit -> fetch(PDO::FETCH_ASSOC);

 		
	}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=="Save slide"){
 		
 		/* Move Large image */
 		$target_dir_l = 'img/uploads/';
 		$img_smg_l=uploadImage($target_dir_l, 'img_slide');
 		$img_slide = $_FILES['img_slide']['name'];

 		if($img_slide!=""){
 			$stmt_img = $DB_con -> prepare("UPDATE package_tours_slide SET s_title=:slide_title, 
 										s_description=:slide_desc, s_img=:img_slide, link=:s_link, ordering=:ordering, type =:type_sp WHERE slide_id=:s_id"); 
 							
 			$stmt_img -> execute (array(':slide_title'=>$_REQUEST['slide_title'], ':slide_desc' => $_REQUEST['slide_desc'], 
 										':img_slide' => $img_slide, ':s_link' => $_REQUEST["s_link"], ':s_id' => $_REQUEST['s_id'], ':ordering'=>  $_REQUEST['ordering'], ':type_sp'=>$_REQUEST['type_sp'] ));
 		
 		}else{
 			$stmt_img = $DB_con -> prepare("UPDATE package_tours_slide SET s_title=:slide_title, 
 			s_description=:slide_desc, link=:s_link, ordering=:ordering, type=:type_sp WHERE slide_id=:s_id"); 
 							
 			$stmt_img -> execute (array(':slide_title'=>$_REQUEST['slide_title'], ':slide_desc' => $_REQUEST['slide_desc'], 
 				':s_link' => $_REQUEST["s_link"], ':s_id' => $_REQUEST['s_id'], ':ordering'=>  $_REQUEST['ordering'], ':type_sp'=>$_REQUEST['type_sp']));
 		}
 		
 	}elseif (isset($_REQUEST['action']) && $_REQUEST['action']=="delete") {
 		$stmt_d = $DB_con->prepare("DELETE FROM package_tours_slide WHERE slide_id =:s_id");

 		$stmt_d -> execute(array(':s_id' => $_REQUEST['s_id']));
 	}
 ?>

<div class="row">
	<div class="col-md-6">
		<div class="box box-solid box-primary ">
		  <div class="box-header with-border">
		    <h3 class="box-title">Add Slide / Promotions</h3>
		    <div class="box-tools pull-right">
		      <a type="button" class="btn btn-warning" href="sr-admin.php?page=slide_show">Add</a>
		    </div><!-- /.box-tools -->
		  </div><!-- /.box-header -->
		  <div class="box-body">
			<form  method="POST" enctype="multipart/form-data" action="">
		        <!-- text input -->
				<div class="form-group">
					<label>Slide Title</label>
					<input type="text" class="form-control" name="slide_title" placeholder="Enter ..." value="<?php echo @$rs_slide['s_title']; ?>">
				</div>
				
				<div class="form-group">
					<label>Slide Subtitle</label>
					<input type="text" name="slide_desc" class="form-control" value="<?php echo @$rs_slide['s_description']; ?>" placeholder="Enter ...">
				</div>
				 <div class="form-group">
					<label for="exampleInputFile">Upload Images Large</label>
					<input type="file" name="img_slide">
					<p class="help-block"> Width: 752px x Height: 468 px </p>

					<?php if(@isset($_REQUEST['action'])){ echo '<p>'.@$img_smg_l.'</p>';}?>
						
					<?php
					   if(@$rs_slide['s_img']!=""){
					?>
					   	<img src="img/uploads/<?php echo $rs_slide['s_img']; ?>" style="width:200px;">
					<?php
					   } 
					 ?>
		         </div>

		         <div class="form-group">
				    <label>Link</label>
				    <input type="text" class="form-control" name="s_link" placeholder="Enter ..." value="<?php echo @$rs_slide['link']; ?>">
				   	
				</div>
				<div class="form-group">
					<input type="number" class="form-control" name="ordering" value="<?php echo @$rs_slide['ordering']; ?>">
				</div>

				<div class="form-group">
					<?php if(@$rs_slide['type']==1){ ?>

					<div class="radio"><label><input type="radio" name="type_sp" value="1" checked>Slide Show</label></div>
					<div class="radio"><label><input type="radio" name="type_sp" value="2">Promotions</label></div>
					<?php 
						}else if(@$rs_slide['type']==2){
					?>
						<div class="radio"><label><input type="radio" name="type_sp" value="1" >Slide Show</label></div>
						<div class="radio"><label><input type="radio" name="type_sp" value="2" checked>Promotions</label></div>
					<?php
					}else{
					?>
						<div class="radio"><label><input type="radio" name="type_sp" value="1">Slide Show</label></div>
						<div class="radio"><label><input type="radio" name="type_sp" value="2">Promotions</label></div>

					<?php 

					}?>

				</div>
				<input type="hidden" name="s_id" value="<?php echo @$rs_slide['slide_id'];?>">
		  </div><!-- /.box-body -->
		  <div class="box-footer">
		    <input type="submit" class="btn btn-primary" name="action" value="<?php if(@$_REQUEST['action']=="edit"){ echo 'Save slide';}else{echo 'Add slide';} ?>">
		    
		  </div><!-- box-footer -->
		  </form>
		</div><!-- /.box -->
	</div>
	<div class="col-md-6">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Slide List</h3>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
         
              <table class="table table-condensed">
                <tbody>
                <tr>
                 	<th style="width: 10px">ID</th>
                  	<th>Title</th>
                  	<th>Ordering</th>
                  	<th>Images</th>
                  	<th style="width: 40px">Action</th>
                </tr>
                <?php 
            		$stmt_slide_list = $DB_con->prepare("SELECT * FROM package_tours_slide");
            		$stmt_slide_list -> execute(); 
                	while ($rs_slide_list=$stmt_slide_list->fetch(PDO::FETCH_ASSOC)){
                ?>​
                <tr>
                  	<td><?php echo $rs_slide_list['slide_id'];?></td>
                 	<td>
                 		<?php echo $rs_slide_list['s_title'];?><br> Type:
                 		<?php if($rs_slide_list['type']==1){echo 'slide';}else{echo 'Promotion';}?>
                 	</td>
                 	<td><?php echo $rs_slide_list['ordering'];?></td>

                  	<td>
                   		<img src="img/uploads/<?php echo $rs_slide_list['s_img']; ?>" class="photo_in_list">
                 	</td>
                  	<td> <a href="sr-admin.php?page=slide_show&s_id=<?php echo $rs_slide_list['slide_id']; ?>&action=delete" class="btn btn-danger btn-xs" style="width:50px;"><i class="fa fa-fw fa-close"></i></a>
          
         				<a href="sr-admin.php?page=slide_show&s_id=<?php echo $rs_slide_list['slide_id']; ?>&action=edit" class="btn  btn-warning btn-xs" style="width:50px;"><i class="fa fa-fw fa-edit"></i></a>
         			</td>
                </tr>
                <?php
                	}
                ?>
              	</tbody>
              </table>
            </div><!-- /.box-body -->
          </div>	
	</div>
</div>
