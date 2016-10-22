<?php 
include_once 'upload_images.php';
	
	//Parameter
	$item_id =$_REQUEST["item_id"];
 	$images_type =  $_REQUEST['images_type'];
	
 	if(@$_REQUEST['action']=="Add Image"){
 		
 		$target_dir_thumnail = 'img/uploads/thumbs/';
 		/* Move thumnail image */
 		$img_smg_s=uploadImage($target_dir_thumnail, 'img_thumnail');
 		$img_thumnail = $_FILES['img_thumnail']['name'];

 		/* Move Large image */
 		$target_dir_l = 'img/uploads/';
 		$img_smg_l=uploadImage($target_dir_l, 'img_large');
 		$img_large = $_FILES['img_large']['name'];

 		$stmt_img = $DB_con -> prepare("INSERT INTO img_galleries(img_title, item_id, img_thumnail, img_large, img_subtitle, img_type) 
 									VALUES (:image_title, :item_id, :img_thumnail, :img_large, :image_subtitle, :images_type)");
 		
 		$stmt_img -> execute (array(':image_title'=>$_REQUEST['image_title'], ':item_id' => $item_id, 
 										':img_thumnail'=> $img_thumnail, ':img_large'=>$img_large, 
 										':image_subtitle'=>$_REQUEST['image_subtitle'], ':images_type'=>$images_type));

 	}elseif(@$_REQUEST['action']=="edit") {

		$stmt_imgedit = $DB_con->prepare("SELECT * FROM img_galleries WHERE item_id =:r_itme_id and img_id=:image_id");
        $stmt_imgedit -> execute(array(':r_itme_id' => $_REQUEST['item_id'], ':image_id' => $_REQUEST['image_id'])); 
        $rs_img=$stmt_imgedit->fetch(PDO::FETCH_ASSOC);

 		
	}elseif(isset($_REQUEST['action']) && $_REQUEST['action']=="Save Image"){
 		
 		/* Move thumnail image */
 		$target_dir_thumnail = 'img/uploads/thumbs/';
 		$img_smg_s=uploadImage($target_dir_thumnail, 'img_thumnail');
 		$img_thumnail = $_FILES['img_thumnail']['name'];

 		/* Move Large image */
 		$target_dir_l = 'img/uploads/';
 		$img_smg_l=uploadImage($target_dir_l, 'img_large');
 		$img_large = $_FILES['img_large']['name'];
 		if($img_thumnail!=""){
 			
 			$stmt_img = $DB_con -> prepare("UPDATE img_galleries SET img_title = :image_title,
 		 	item_id=:item_id, img_thumnail=:img_thumnail, img_subtitle=:image_subtitle WHERE img_id=:image_id and img_type=:image_type"); 
 							
 			$stmt_img -> execute (array(':image_title'=>$_REQUEST['image_title'], ':item_id' => $item_id, 
 										':img_thumnail'=> $img_thumnail,
 										':image_subtitle'=>$_REQUEST['image_subtitle'], ':image_id'=>$_REQUEST['image_id'], ':image_type'=> $images_type));
 		
 		}elseif ($img_large!="") {
 			
 			$stmt_img = $DB_con -> prepare("UPDATE img_galleries SET img_title = :image_title,
 		 	item_id=:item_id, img_large =:img_large, img_subtitle=:image_subtitle WHERE img_id=:image_id and img_type=:image_type"); 
 							
 			$stmt_img -> execute (array(':image_title'=>$_REQUEST['image_title'], ':item_id' => $item_id, 
 										 ':img_large'=>$img_large, 
 										':image_subtitle'=>$_REQUEST['image_subtitle'], ':image_id'=>$_REQUEST['image_id'], ':image_type'=> $images_type));

 		
 		}else{
 			$stmt_img = $DB_con -> prepare("UPDATE img_galleries SET img_title = :image_title,
 		 	item_id=:item_id, img_subtitle=:image_subtitle WHERE img_id=:image_id and img_type=:image_type"); 
 							
 			$stmt_img -> execute (array(':image_title'=>$_REQUEST['image_title'], ':item_id' => $item_id, 
 										':image_subtitle'=>$_REQUEST['image_subtitle'], ':image_id'=>$_REQUEST['image_id'], ':image_type'=> $images_type));

 		}
 		
 	}elseif (isset($_REQUEST['action']) && $_REQUEST['action']=="delete") {
 		$stmt_d = $DB_con->prepare("DELETE FROM img_galleries WHERE img_id =:image_id");

 		$stmt_d -> execute(array(':image_id' => $_REQUEST['image_id']));
 	}
 ?>

<div class="row">
	<div class="col-md-6">
		<div class="box box-solid box-primary ">
		  <div class="box-header with-border">
		    <h3 class="box-title">Add Images</h3>
		    <div class="box-tools pull-right">
		      <!-- Buttons, labels, and many other things can be placed here! -->
		      <!-- Here is a label for example -->
		     <a href="sr-admin.php?page=menu_list" class="btn btn-block btn-primary btn-sm"> View all menu</a>
		    </div><!-- /.box-tools -->
		  </div><!-- /.box-header -->
		  <div class="box-body">
		  	<?php 
  				if($_REQUEST['images_type']=='d'){
  					$stmt_item = $DB_con->prepare("SELECT c_title FROM menu where c_id=:itme_id");
					$stmt_item -> execute(array(':itme_id'=> $_REQUEST['item_id']));
					$rs_item = $stmt_item -> fetch(PDO::FETCH_ASSOC);
					echo '<h3 class="item-title"> :::::'.$rs_item['c_title'].':::::</h3>';
				}elseif ($_REQUEST['images_type']=='t'){
					
					$stmt_item = $DB_con->prepare("SELECT p_title FROM package_tours WHERE p_id=:itme_id");
					$stmt_item -> execute(array(':itme_id'=> $_REQUEST['item_id']));
					$rs_item = $stmt_item -> fetch(PDO::FETCH_ASSOC);
					echo '<h3 class="item-title"> :::::'.$rs_item['p_title'].':::::</h3>';
				}
			?>
			
			<form  method="POST" enctype="multipart/form-data" action="">
		        <!-- text input -->
				<div class="form-group">
					<label>Image Title</label>
					<input type="text" class="form-control" name="image_title" placeholder="Enter ..." value="<?php echo @$rs_img['img_title']; ?>">
				</div>
				
				<div class="form-group">
					<label>Images Subtitle</label>
					<input type="text" name="image_subtitle" class="form-control" value="<?php echo @$rs_img['img_subtitle']; ?>" placeholder="Enter ...">
				</div>
				<div class="form-group">
					<label for="exampleInputFile">Upload Images Thumnail</label>
					<input type="file" name="img_thumnail">
					<p class="help-block">Icon or Photo</p>

					<?php if(@isset($_REQUEST['action'])){ echo '<p>'.@$img_smg_s.'</p>';}?>
						
					<?php
					   if(@$rs_img['img_thumnail']!=""){
					?>
					   	<img src="img/uploads/thumbs/<?php echo $rs_img['img_thumnail']; ?>" style="width:200px;">
					<?php
					   } 
					 ?>
		         </div>
				 <div class="form-group">
					<label for="exampleInputFile">Upload Images Large</label>
					<input type="file" name="img_large">
					<p class="help-block">Icon or Photo</p>

					<?php if(@isset($_REQUEST['action'])){ echo '<p>'.@$img_smg_l.'</p>';}?>
						
					<?php
					   if(@$rs_img['img_large']!=""){
					?>
					   	<img src="img/uploads/<?php echo $rs_img['img_large']; ?>" style="width:200px;">
					<?php
					   } 
					 ?>
		         </div>
				<input type="hidden" name="images_type" value="<?php echo $images_type;?>">
		  </div><!-- /.box-body -->
		  <div class="box-footer">
		    <input type="submit" class="btn btn-primary" name="action" value="<?php if(@$_REQUEST['action']=="edit"){ echo 'Save Image';}else{echo 'Add Image';} ?>">
		    
		  </div><!-- box-footer -->
		  </form>
		</div><!-- /.box -->
	</div>
	<div class="col-md-6">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Images List</h3>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
         
              <table class="table table-condensed">
                <tbody>
                <tr>
                 	<th style="width: 10px">ID</th>
                  	<th>Title</th>
                  	<th>Images</th>
                  	<th style="width: 40px">Action</th>
                </tr>
                <?php 
            		$stmt_imglist = $DB_con->prepare("SELECT * FROM img_galleries WHERE item_id =:r_itme_id and img_type=:image_type");
            		$stmt_imglist -> execute(array(':r_itme_id' => $_REQUEST['item_id'], ':image_type'=>$images_type)); 
                	while ($rs_imglist=$stmt_imglist->fetch(PDO::FETCH_ASSOC)) {
                ?>​
                <tr>
                  	<td><?php echo $rs_imglist['img_id'];?></td>
                 	 <td><?php echo $rs_imglist['img_title'];?></td>
                  	<td>
                   		<img src="img/uploads/thumbs/<?php echo $rs_imglist['img_thumnail']; ?>" class="photo_in_list">
                 	</td>
                  	<td> <a href="sr-admin.php?page=add_images&images_type=<?php echo $_REQUEST['images_type']; ?>&item_id=<?php echo $_REQUEST['item_id']; ?>&image_id=<?php echo $rs_imglist['img_id']; ?>&action=delete" class="btn btn-danger btn-xs" style="width:50px;"><i class="fa fa-fw fa-close"></i></a>
          
         				<a href="sr-admin.php?page=add_images&images_type=<?php echo $_REQUEST['images_type']; ?>&item_id=<?php echo $_REQUEST['item_id']; ?>&image_id=<?php echo $rs_imglist['img_id']; ?>&action=edit" class="btn  btn-warning btn-xs" style="width:50px;"><i class="fa fa-fw fa-edit"></i></a>
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
