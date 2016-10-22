
 <div class="box">
  <div class="box-header">
    <h3 class="box-title" style="padding-right:20px;">List view </h3>
   <!-- <a href="sr-admin.php?page=add_package_tours" class="btn btn-primary btn-sm"> Add new tour</a>-->
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
        <th>item name</th>
        <th>Star</th>
        <th>Images</th>
        <th>Display</th>
        <th>Action</th>
      </tr>

       <?php
          $stmt_s= $DB_con->prepare("SELECT * FROM services WHERE service_type=:sercive_type"); 
          $stmt_s-> execute(array('sercive_type' => $_REQUEST["sercive_type"]));
          while($result_s = $stmt_s->fetch(PDO::FETCH_ASSOC)){
        ?>
      <tr>
        <td> <?php echo $result_s['id_more_service'];?> </td>
        <td> <?php echo $result_s['service_name'];?> </td>
        <td> <?php echo $result_s['star'];?> </td>
        <td> <img src="img/uploads/thumbs/<?php echo $result_s['thumail_img'];?>" class="photo_in_list"></td>
        <td> <?php echo $result_s['display'];?></td>
        <td>
          <a href="admin/services_delete.php?services_id=<?php echo $result_s['id_more_service'];?>&service_type=<?php echo $result_s["service_type"]; ?>" class="btn btn-danger btn-xs" style="width:50px;"><i class="fa fa-fw fa-close"></i></a>  
          <a href="sr-admin.php?page=services&service_type=<?php echo $result_s["service_type"]; ?>&action=edit&services_id=<?php echo $result_s['id_more_service'];?>" class="btn  btn-warning btn-xs" style="width:50px;"><i class="fa fa-fw fa-edit"></i></a>
         
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
