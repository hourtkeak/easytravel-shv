
 <div class="box">
  <div class="box-header">
    <h3 class="box-title" style="padding-right:20px;">MENU List </h3>
    <a href="sr-admin.php?page=add_package_tours" class="btn btn-primary btn-sm"> Add new tour</a>
    <div class="box-tools">
      <div class="input-group" style="width: 150px;">

        <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
        <div class="input-group-btn">
          <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tr>
        <th>ID</th>
        <th>Tour Code</th>
        <th>Length of Day</th>
        <th>Tour Packages Name</th>
        <th>Images</th>
        <th>Price</th>
        <th>Display</th>
        <th>Action</th>
      </tr>

       <?php
          $stmt_tour = $DB_con->prepare("SELECT a.p_id, a.tour_code, a.p_title, a.p_short_line, a.p_overviews, a.p_itinerary, 
              a.p_acc, a.p_ie, a.is_show, a.price, a.p_ordering, a.num_day, a.img_thunail, b.op_item, b.op_categories 
                    FROM package_tours as a LEFT JOIN tour_type_option as b on  a.p_id = b.op_item WHERE delete_statue = 0 GROUP BY  b.op_item"); 
         $stmt_tour-> execute();
          while($result_tour = $stmt_tour->fetch(PDO::FETCH_ASSOC)){
        ?>
      <tr>
        <td> <?php echo $result_tour['p_id'];?> </td>
        <td> <?php echo $result_tour['tour_code'];?> </td>
        <td> <?php echo $result_tour['num_day'];?> </td>
        <td> <?php echo $result_tour['p_title'];?> </td>
        <td> <img src="img/uploads/<?php echo $result_tour['img_thunail'];?>" class="photo_in_list"></td>
        <td> <?php echo $result_tour['price'];?></td>
        <td> <?php echo $result_tour['is_show'];?></td>
        <td>
        <a href="admin/package_tours_delete.php?package_tour_id=<?php echo $result_tour['p_id'];?>&action=delete" class="btn btn-danger btn-xs" style="width:50px;"><i class="fa fa-fw fa-close"></i></a>  
        <a href="sr-admin.php?page=add_package_tours&action=edit&package_tour_id=<?php echo $result_tour['p_id'];?>" class="btn  btn-warning btn-xs" style="width:50px;"><i class="fa fa-fw fa-edit"></i></a>
        <a href="sr-admin.php?page=add_images&item_id=<?php echo $result_tour['p_id'];?>&images_type=t" class="btn btn-default btn-xs" style="width:50px;"><i class="fa fa-fw fa-file-image-o"></i></a>
    
        </td>
      </tr>
      <?php } ?>
    </table>
  </div><!-- /.box-body -->
  <div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
      <li><a href="#">&laquo;</a></li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">&raquo;</a></li>
    </ul>
  </div>
</div><!-- /.box -->
