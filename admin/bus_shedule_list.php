
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
        <th>Destinations</th>
        <th>Time</th>
        <th>Transportation Company</th>
        <th>Is enable</th>
        <th>Display</th>
        <th>Action</th>
      </tr>

       <?php
$stmt_s = $DB_con->prepare("SELECT a.id, a.tran_time, a.tran_company,a.tran_enable,b.c_main_id, a.display,b.c_title, (SELECT s.c_title FROM menu as s
          WHERE s.c_id=a.destinations) as destinations FROM transportation as a LEFT JOIN menu as b ON b.c_id=a.tran_company");
$stmt_s->execute();
$i = 1;
while ($result_s = $stmt_s->fetch(PDO::FETCH_ASSOC)) {
	?>
      <tr>
        <td> <?php echo $i; ?> </td>
        <td> <?php echo $result_s['destinations']; ?> </td>
        <td> <?php echo $result_s['tran_time']; ?> </td>
        <td> <?php echo $result_s['c_title']; ?> </td>
        <td> <?php echo ($result_s['tran_enable']) ? 'Enable' : 'Disable'; ?></td>
        <td> <?php echo ($result_s['display'] == 1) ? 'Publish' : 'Unpublish'; ?></td>
        <td>
          <a href="admin/schedule_delete.php?page=bus_shedule_departure&bus_shedule_departure=<?php echo $result_s['id']; ?>" class="btn btn-danger btn-xs" style="width:50px;"><i class="fa fa-fw fa-close"></i></a>
          <a href="sr-admin.php?page=bus_shedule_departure&action=edit&bus_shedule_departure=<?php echo $result_s['id']; ?>" class="btn  btn-warning btn-xs" style="width:50px;"><i class="fa fa-fw fa-edit"></i></a>

        </td>
      </tr>
      <?php
$i++;
}
?>
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
