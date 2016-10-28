<!DOCTYPE html>
<html>
<body>

<form method="GET">
  <input type="radio" name="gender" value="male"> Male<br>
  <input type="radio" name="gender" value="female"> Female<br>
  <input type="radio" name="gender" value="other"> Other
  <input type="submit">
</form>
<?php
	echo $_REQUEST['gender'];
 ?>
</body>
</html>
