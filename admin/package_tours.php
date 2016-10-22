<div class="box box-solid box-primary ">
  <div class="box-header with-border">
    <h3 class="box-title">MENU</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
     <a href="sr-admin.php?page=package_tours_list" class="btn btn-block btn-primary btn-sm"> View all Tours</a>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
	<form  method="post" enctype="multipart/form-data" action="<?php if(isset($_REQUEST['action'])){echo "admin/package_tours_update.php";}else{echo "admin/package_tours_save.php"; }?>">
	</select>
        <?php if(isset($_REQUEST['msg'])){ ?>
	        <div class="alert alert-success alert-dismissable">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
	            <?php echo $_REQUEST['msg']; ?>
	        </div>
        <?php  } ?>

        <?php
        	if(isset($_REQUEST["package_tour_id"])){
	        	
	        	// DATA from table package tours.
	        	$stmt_tour= $DB_con->prepare("SELECT a.p_id, a.tour_code, a.p_title, a.p_short_line, a.p_overviews, a.p_itinerary, 
	        		a.p_acc, a.p_ie, a.is_show, a.price, a.p_ordering, a.num_day, a.img_thunail, b.op_item, b.op_categories 
                    FROM package_tours as a LEFT JOIN tour_type_option as b on  a.p_id = b.op_item WHERE a.p_id =:tour_p_id"); 
	        	
	        	$stmt_tour ->execute(array(':tour_p_id'=>$_REQUEST['package_tour_id']));
	        	$rs_tour = $stmt_tour->fetch(PDO::FETCH_ASSOC);

	        	// DATA from table Type Tours
				$stmt_op= $DB_con->prepare("SELECT op_categories FROM tour_type_option WHERE op_item =:tour_p_id");
				$stmt_op ->execute(array(':tour_p_id'=>$_REQUEST['package_tour_id']));	        	
	        	$item_id = []; 
	        	while ($rs_op = $stmt_op->fetch(PDO::FETCH_ASSOC)){
	        		$item_id[$rs_op['op_categories']] = $rs_op['op_categories'];
	        	}
        	}
      	?>

		<div class="form-group">
			<label>Tours Package Name</label>
			<input type="text" class="form-control" name="package_name" placeholder="Enter ..." value="<?php echo @$rs_tour['p_title']; ?>">
		</div>
		
		<div class="form-group">
			<label>Destinations</label>
			<select class="form-control select2" multiple="multiple" data-placeholder="Select a Destination" name="tour_dest[]">
				<?php
					$dest_sql =$DB_con->prepare("SELECT c_id, c_title FROM menu WHERE c_type =:num and c_main_id =:main_id");
					$dest_sql->execute(array(':num'=>2,':main_id' => 2));
                    while($result_dest=$dest_sql->fetch(PDO::FETCH_ASSOC)){
                		
                		if($result_dest['c_id']==$item_id[$result_dest['c_id']]){ $select= "selected"; }else{ $select="";};
                ?>
            		<option value="<?php echo $result_dest['c_id']; ?>" <?php echo $select; ?> >
           		 		<?php echo $result_dest['c_title'];?>
            		</option>
                <?php
                			
                    }
				 ?>
				
			</select>
		</div>
		<div class="form-group">
			<label>Activities</label>
			<select class="form-control select2" multiple="multiple" data-placeholder="Select a Activities" name="tour_act[]">
				
				<?php
					$parent_sql =$DB_con->prepare("SELECT c_id, c_title FROM menu WHERE c_type =:num and c_main_id = :main_id");
					$parent_sql->execute(array(':num'=>2, ':main_id' => 3));
                    while($result_parent=$parent_sql->fetch(PDO::FETCH_ASSOC)){
                	if($result_parent['c_id']==$item_id[$result_parent['c_id']]){$select= "selected";}else{$select="";};

                ?>

                <option value="<?php echo $result_parent['c_id']; ?>" <?php echo $select; ?> >
               		 <?php echo $result_parent['c_title']; ?>
                </option>
                
                <?php	
                    }
				 ?>
				
			</select>
		</div>
		<div class="form-group">
			<label>Headline</label>
			<input type="text" name="tour_headline" class="form-control" value="<?php echo @$rs_tour['p_short_line'];?>" placeholder="Enter ...">
		</div>
		<div class="form-group">
			<label>Tour Code</label>
			<input type="text" name="tour_code" class="form-control" value="<?php echo @$rs_tour['tour_code'];?>" placeholder="Enter ...">
		</div>
		<div class="form-group">
			<label>Lenght of Days</label>
			<input type="text" name="lenght_day" class="form-control" value="<?php echo @$rs_tour['num_day'];?>" placeholder="Enter ...">
		</div>
		<div class="form-group">
			<label>Price</label>
			<input type="text" name="price" class="form-control" value="<?php echo @$rs_tour['price'];?>" placeholder="Enter ...">
		</div>
    
		<div class="form-group">
			<label>Introduction</label>
			<div class="box-body pad">
				
				<textarea class="textarea"  name="overview" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo @$rs_tour['p_overviews'];?></textarea>
				
			</div>
    	</div>
    	<div class="form-group">
			<label>Itinerary In Briefing</label>
			<div class="box-body pad">
				
				<textarea class="textarea1 tinymce"  name="accomodation" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo @$rs_tour['p_acc'];?></textarea>
				
			</div>
    	</div>
    	<div class="form-group">
			<label>Itinerary In Detail</label>
			<div class="box-body pad">
				
				<textarea class="textarea1 tinymce"  name="full_itinerary" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo @$rs_tour['p_itinerary'];?></textarea>
				
			</div>
    	</div>
    	

    	<div class="form-group">
			<label>Inclusions & Exclusions</label>
			<div class="box-body pad">
				
				<textarea class="textarea1 tinymce" name="iande" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo @$rs_tour['p_ie'];?></textarea>
				
			</div>
    	</div>




    	<div class="form-group">
			<label>Ordering</label>
			<input type="number" value="<?php echo @$rs_tour['p_ordering'];?>" name="ordering" class="form-control" placeholder="Enter ...">
		</div>
		<div class="form-group">
			<label for="exampleInputFile">Upload Images</label>
			<input type="file" id="exampleInputFile" name="img_thumnail_package">
			<p class="help-block">Icon or Photo</p>				
			<?php
			   if(@$rs_tour['img_thunail']!=""){
			?>
			   	<img src="img/uploads/<?php echo $rs_tour['img_thunail']; ?>" style="width:200px;">
			<?php
			   } 
			 ?>
         </div>
          <div class="form-group">
			<div class="checkbox">
				<label>
				  <input type="checkbox" name="display" <?php if(@$rs_tour['is_show']==1) echo 'checked="checked"'; ?>>
				  Check is show / Uncheck is unshow
				</label>
			</div>	
		</div>
		<input type="hidden" name="package_tour_id" value="<?php echo @$rs_tour['p_id'];?>">
	
  </div><!-- /.box-body -->
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    
  </div><!-- box-footer -->
  </form>
</div><!-- /.box -->