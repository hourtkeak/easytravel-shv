
	<!-- Banner -->
	<section class="tm-banner">
		<!-- Flexslider -->
		<div class="flexslider flexslider-banner">
		  <ul class="slides">
		  	<?php 
	            $stmt_sile = $DB_con -> prepare("SELECT s_title, s_description, s_img, link FROM package_tours_slide where type = 1 order by ordering ASC LIMIT 3");
	            $stmt_sile -> execute(); 
	            while($rs_slide = $stmt_sile -> fetch(PDO::FETCH_ASSOC)){
	        ?>
	        	 <li>
			    	<div class="tm-banner-inner">
						<h1 class="tm-banner-title"> <?php echo $rs_slide['s_title'];?> </h1>
						<p class="tm-banner-subtitle"><?php echo $rs_slide['s_description'];?></p>
					</div>
					 <img src="img/uploads/<?php echo $rs_slide['s_img']; ?>" alt="image">
		    	</li>	

	        <?php } ?>

		  </ul>
		</div>
	</section>

	<!-- gray bg -->
	<section class="container tm-home-section-1" id="more">
		<div class="row">
				<?php 
	            $stmt_pro = $DB_con -> prepare("SELECT s_title, s_description, s_img, link FROM package_tours_slide where type = 2 order by ordering ASC LIMIT 3");
	            $stmt_pro -> execute(); 
	            while($rs_pro = $stmt_pro -> fetch(PDO::FETCH_ASSOC)){
	       	 ?>


			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">
					 <img src="img/uploads/<?php echo $rs_pro['s_img']; ?>" alt="image">
					<a href="#">
						<div class="tm-green-gradient-bg tm-city-price-container">
							<span><?php echo $rs_pro['s_title'];?></span>
							<span><?php echo $rs_pro['s_description'];?></span>
						</div>
					</a>
				</div>
			</div>

			<?php } ?>
		</div>

		<div class="section-margin-top">
			<div class="row">
				<div class="tm-section-header">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Departure Schedule</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4>BUS DEPARTURE SCHEDULE</h4>
  					<!--<p>ALL BUS TICKETS ARE AVAILABLE HERE</p>-->
					  <table class="table table-condensed">
					    <thead>
					      <tr>
					    
					        <th>Departure Time</th>
					        <th>Price</th>
					        <th>Duration</th>
					        <th>Vichicle Type</th>
					        <th>Booking</th>
					      </tr>
					    </thead>
					    <tbody>

					    <?php
					    	$stmt_c = $DB_con->prepare("SELECT a.id,a.prices, a.destinations, a.tran_time, a.durations, a.tran_company,a.tran_enable,b.c_main_id,a.vichicle_type, b.c_title
          					 FROM transportation as a 
          					left JOIN menu as b ON b.c_id = a.tran_company group by a.tran_company order by a.tran_company");
          					$stmt_c->execute();
          					while ($result_c = $stmt_c->fetch(PDO::FETCH_ASSOC)) {
          					

							$stmt_s = $DB_con->prepare("SELECT a.id,a.prices, a.destinations, a.tran_time, a.durations, a.tran_company,a.tran_enable,b.c_main_id,a.vichicle_type, b.c_title
          					 FROM transportation as a 

          					left JOIN menu as b ON b.c_id = a.destinations

          		
          					where a.tran_company =:company order by a.destinations");
							$stmt_s->execute(array(':company' =>  $result_c["tran_company"]));
							
							$arrayd[] = array();
	
							$i=0;
							?>
									<tr><td colspan="5" style="background-color:#ccc;"><?php echo $result_c["c_title"];?></td></tr>
						<?php while ($result_s = $stmt_s->fetch(PDO::FETCH_ASSOC)) {
						?>		 
							
					         
					        	 <?php if($result_s['destinations']!=$arrayd[$i]){?>
								<tr>
					        		<td colspan="5" style="font-weight:bold;"> <?php echo  $result_s['c_title']; ?> </td>
					        	</tr>
					         <?php }?>
						      <tr>
						        <td style="padding-left:30px;"> <?php echo $result_s['tran_time']; ?> </td>
						        <td> <?php echo '$ ' . $result_s['prices'] . '.00'; ?> </td>
						        <td> <?php echo $result_s['durations'].'hours'; ?> </td>
						        <td> <?php echo $result_s['vichicle_type'] . ' Seat'; ?></td>
						        <td> <?php echo ($result_s['tran_enable'] == 1) ? 'Booking Now' : 'Full Seat'; ?></td>
						      </tr>

					     

					        

						     
						   

						      <?php
						     $arrayd[] = $result_s['destinations'];
						 
							$i++;	}

							}
							?>
					    </tbody>
					  </table>
				</div>

			</div>
			
				<div class="col-lg-12">

					<p class="home-description">
<button type="button" class="btn btn-primary">Inquiries</button><br><br>
					Please feel free to send us your inquiries or ideas about anything you would love: destinations, time of traveling, we will get back to you with details & best offers a reasonable price!</p>
				</div>
			</div>
		</div>
	</section>

	
	