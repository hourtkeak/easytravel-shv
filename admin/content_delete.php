<?php
include_once "dbconfig.php";
$id_article=$_GET["id_article"];
$sql_delete=$DB_con->prepare(
  "DELETE FROM content WHERE id=:id_article"
  );
$sql_delete->execute(array(':id_article' => $id_article ));


$sql_delete_img=$DB_con->prepare(
 "DELETE FROM images WHERE id_article=:id_article"
  );
$sql_delete_img->execute(array(':id_article' => $id_article ));

//Redirect to form page
echo "<script type='text/javascript'>window.location='../sr-admin.php?page=content_list'</script>";
?>
