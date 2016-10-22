<?php 
include_once 'dbconfig.php';
include("resize-class.php");

				 
				$stmt = $DB_con ->prepare("SELECT img_thunail FROM package_tours");
				$stmt -> execute();
				while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){

echo $rs['img_thunail'];
				//path and file name
				$full_name_original = "../img/uploads/".$rs['img_thunail'];				
				$full_name_thumb = "../img/convert/".$rs['img_thunail'];
				// *** 1) Initialise / load image
				$resizeObj = new resize($full_name_original);
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> resizeImage(450,'auto', 'auto');
				// *** 3) Save image
				$resizeObj -> saveImage($full_name_thumb, 100);
				// insert images
			} 

?>