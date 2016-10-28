<!-- gray bg -->	
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			<!-- slider -->
			<div class="flexslider flexslider-about effect2">
			  <ul class="slides">
			    <?php
$stmt_about = $DB_con->prepare("SELECT c_id, c_title, c_is_show, c_desc, c_headline, c_main_id FROM menu  WHERE c_main_id=6 AND c_is_show=1 order by c_id ASC");
$stmt_about->execute();
while ($result_about = $stmt_about->fetch(PDO::FETCH_ASSOC)) {
	?>
							 

			    <li>
			      <img src="img/about-1.jpg" alt="image" />
			      <div class="flex-caption">
			      	<h2 class="slider-title"><?php echo $result_about['c_title']; ?></h2>
			      	<h3 class="slider-subtitle"><?php echo $result_about['c_headline']; ?></h3>
			      	<p class="slider-description"> <?php echo $result_about['c_desc']; ?></p>
			      	<div class="slider-social">
			      		<a href="#" class="tm-social-icon"><i class="fa fa-twitter"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-facebook"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-pinterest"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-google-plus"></i></a>
			      	</div>
			      </div>			      
			    </li>

<?php } ?>

			   		  </ul>
			</div>
		</div>
	
		
		
	</section>		
	
	<!-- white bg -->
	<section class="tm-white-bg section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-4 col-md-6 col-sm-6"><h2 class="tm-section-title">What we do</h2></div>
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
			<div class="row">
				<!-- Testimonial -->
				<div class="col-lg-12">
					<div class="tm-what-we-do-right">
						<?php
						$stmt_do= $DB_con->prepare("SELECT c_id, c_title, c_is_show, c_desc, c_headline, c_main_id FROM menu  WHERE c_main_id=65 AND c_is_show=1 order by c_id ASC");
						$stmt_do->execute();
						while ($result_do = $stmt_do->fetch(PDO::FETCH_ASSOC)) { ?>
						 
						<div class="tm-about-box-2 margin-bottom-30">
							<img src="img/about-2.jpg" alt="image" class="tm-about-box-2-img">
							<div class="tm-about-box-2-text">
								<h3 class="tm-about-box-2-title"><?php echo $result_do['c_title'];?></h3>
				                <p class="tm-about-box-2-description gray-text"><?php echo $result_do['c_headline'];?></p>
				                <p class="tm-about-box-2-footer">Contact Us</p>	
							</div>		                
						</div>
						<?php } ?>
					</div>
					<div class="tm-testimonials-box">
						<h3 class="tm-testimonials-title">Testimonials</h3>
						<div class="tm-testimonials-content">
							<div>
					<?php 
						$stmt_terminal = $DB_con->prepare("SELECT c_id, c_title, c_is_show, c_desc, c_headline, c_main_id FROM menu  WHERE c_main_id=63 AND c_is_show=1 order by c_id ASC");
						$stmt_terminal->execute();
						while ($result_terminal = $stmt_terminal->fetch(PDO::FETCH_ASSOC)) { ?>
							<div class="tm-testimonial">
								<p><?php echo $result_terminal['c_headline'];?></p>
		                		<strong class="text-uppercase"><?php echo $result_terminal['c_title'];?></strong>	
							</div>
						<?php } ?>
						</div>
					</div>	
				</div>							
			</div>			
		</div>
	</section>