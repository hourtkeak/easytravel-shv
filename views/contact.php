
<!-- 

	To use this code, you'll need to update your email address in the javascript 
	on this page, and in the php code in submit.php
	
	If you add any form fields to this page, you will also need to update the PHP script.
	
	You are 100% allowed to remove the credit link at the bottom and do whatever 
	you like with the form.  However, I would greatly appreciate it if you left 
	the link intact :)
		
	Thanks,
	-Nathan
	
-->

	
	<script type="text/javascript">
		// split your email into two parts and remove the @ symbol
		var first = "sales";
		var last = "srangkortrave.com";
	</script>
    		
    		
    		<div class="row">
    			<div class="col-md-12">
    				<div class="contact_form_wraper">
    					<h1>Please send us your inquiries by using our contact detail below:</h1>
    					
							
							<?php
								if(isset($_REQUEST["id_package"])){ 
								
					                    $stmt_p = $DB_con->prepare("SELECT p_title,  tour_code, img_thunail FROM package_tours WHERE p_id =:id_package");
					                    $stmt_p -> execute(array(':id_package' => $_REQUEST['id_package']));
					                    $rs_package = $stmt_p -> fetch(PDO::FETCH_ASSOC);
					                    $title = $rs_package['p_title'];
					                    $code = $rs_package['tour_code'];

						                echo '<div class="select-tours-package"><div class="row">';
							               	echo "<div class='col-md-2'><img src='img/uploads/".$rs_package["img_thunail"]."'></div>";
							                echo " <div class='col-md-10'><h2> TOUR NAME:<span> ".$title."</span></h2>";
							                echo "<h3>TOUR CODE:<span> ".$code."</span></h3></div>";
		    							echo "</div></div>";
			                    }else{

			                    	$title = 'NO Selection';
			                    	$code = 'NO Selection';
			                    }   
			                ?>

						
						<form method="post" action="index.php?page=email">

							<input type="hidden" name="tour_name" value="TOUR NAME: <?php echo $title;?>">
							<input type="hidden" name="tour_code" value="TOUR CODE: <?php echo $code;?>">

							<div class="row">
								 <div class="col-xs-12">
					                <div class="form-group">
					                	<label for="full-name" class="control-label">Full Name:</label>
					                	<input type="text" name="name" class="form-control" placeholder="Type your name here...">
					                </div>
					            </div>
					            <div class="col-xs-12">
					            	<div class="form-group">
					            		<label for="e-mail-adress" class="control-label">E-Mail adress:</label>
					                	<input type="text" class="form-control" name="email" placeholder="Your Address E-mail">
					                </div>
					            </div>
				            </div>
				            <div class="row">
						 		<div class="col-xs-4">

						 			<div class="form-group">
						 				<label for="number-of-pax"  class="control-label">Number of Pax:</label>
										<select class="form-control" name="num_pax">
										
											<?php $i=1; while ($i <= 30) { ?>
											<option class="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php $i++; } ?>
										</select>
									</div>
					            </div>
					            <div class="col-xs-4">
					            	
						            <div class="form-group">
						                <label for="contry-State" class="control-label">Travel Date:</label>
						                <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						                    <input class="form-control" size="16" name="travel_date" type="text" value="" readonly>
						                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
						                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						                </div>
						                <input type="hidden" id="dtp_input2" name="travel_date" value="" />
					            	</div>
				 
					            </div>
					            <div class="col-xs-4">
					            	<div class="form-group">
					            		<label for="contry-State" class="control-label">Country/State:</label>
					                	<input type="text" name="country" class="form-control" placeholder="Enter Country/State">
					                </div>
					            </div>
					         </div>
					        <div class="rows">
								<!-- Important: if you add any fields to this page, you will also need to update the php script -->
								
								<p class="antispam">Leave this empty:
								<br /><input name="url" /></p>
								<div class="form-group">
									<label for="recipient-name" class="control-label">Description:</label>
									<textarea name="message" rows="10" cols="50" class="form-control" ></textarea>
								</div>
								
								
							</div>
							<p style="text-align:center;"><input type="submit" value="Submit" class="btn btn-warning" /></p>
						
						</form>
					</div>
    			</div>
    		</div>
	
	<!--<p>My e-mail address:
	<script type="text/javascript">
		document.write('<a href="mailto:'+first + '@' + last+'">'+first + '@' + last+'<\/a>');
	</script>
	</p>-->
	


