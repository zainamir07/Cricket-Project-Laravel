 
	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="img/slider-1.jpg">
				<div class="hs-text">
					<div class="container">
						<h2>The Best <span>Games</span> Out There</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada <br> lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. <br>Suspendisse cursus faucibus finibus.</p>
						<a href="#" class="site-btn">Read More</a>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="img/slider-2.jpeg">
				<div class="hs-text">
					<div class="container">
						<h2>The Best <span>Games</span> Out There</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada <br> lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. <br>Suspendisse cursus faucibus finibus.</p>
						<a href="#" class="site-btn">Read More</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

 
	<!-- Latest news section -->
	<?php include "includes/events-slide.php"; ?>
	<!-- Latest news section end -->

	<!-- Feature section -->
	<section class="feature-section spad">
		<div class="container">
		<div class="section-title">
				<!-- <div class="cata new">new</div> -->
				<h2>Recent Events</h2>
			</div>
			<div class="row">
				<?php  
                  $sql = "SELECT * FROM `tbl_news_events` WHERE `news_event_status` = 'A' AND `news_event_clubID` = '0' AND `news_event_type` = 'E' ORDER BY `new_event_id` DESC LIMIT 4 ";
				 
				  $result = mysqli_query($con, $sql);
				  if($result){
					  if(mysqli_num_rows($result)>0){
						  while($row = mysqli_fetch_array($result)){
							  ?>

                              <div class="col-lg-3 col-md-6 p-0">
							   <?php
							    $imagePath = "admin/".getRandomNewEventImage($row['new_event_id']);
                                   if($imagePath != "admin/" && file_exists($imagePath)){
                                     ?>
					<div class="feature-item set-bg" data-setbg="<?php echo $imagePath; ?>">
					<?php
                           }else{
                               ?>
                               <img src="img/authors/2.jpg" class="img-thumbnail" alt="">
                               <?php
                           }  
						?>
						<span class="cata strategy">
						<?php if($row['news_event_type'] == 'E'){
                          echo "Event";
                               }else if($row['news_event_type'] == 'N'){
                                   echo "News";
                        }  ?>
						</span>
						</span>
						<div class="fi-content text-white">
							<h5><a href="events.php?eventID=<?php echo $row['new_event_id']; ?>"><?php echo $row['news_event_title']  ?></a></h5>
							<p id="event_description"><?php echo $row['news_event_description'];  ?> </p>
							<a href="events.php?eventID=<?php echo $row['new_event_id']; ?>" class="fi-comment">Read More</a>
						</div>
					</div>
				</div>
				<?php
						  }
						}
					}
					?>
			</div>
			<div class="container text-center mt-4">
			<a class="btn btn-outline-secondary" href="events.php?type=E">View All Events</a>
			</div>
		</div>
	</section>
	<!-- Feature section end -->


	<!-- Recent game section  -->
	<section class="recent-game-section spad set-bg" data-setbg="img/news_background.jpg" style="background-position: revert;">
		<div class="container">
			<div class="section-title">
				<!-- <div class="cata new">new</div> -->
				<h2 class="text-white">Recent News</h2>
			</div>
			<div class="row">
			<?php  
                  $sql = "SELECT * FROM `tbl_news_events` WHERE `news_event_status` = 'A' AND `news_event_clubID` = '0' AND `news_event_type` = 'N' ORDER BY `new_event_id` DESC LIMIT 4 ";
				  $result = mysqli_query($con, $sql);
				  if($result){
					  if(mysqli_num_rows($result)>0){
						  while($row = mysqli_fetch_array($result)){
				  ?>
				<div class="col-lg-4 col-md-6">
					<div class="recent-game-item">
					<?php
					        $imagePath = "admin/".getRandomNewEventImage($row['new_event_id']);
                            if($imagePath != "admin/" && file_exists($imagePath)){
                    ?>
						<div class="rgi-thumb set-bg img-thumbnail" data-setbg="<?php echo $imagePath; ?>" style="background-size:contain;">
						<?php
                           }else{
                               ?>
                               <img src="img/authors/2.jpg" class="img-thumbnail" alt="">
                               <?php
                           }  
						?>
							<div class="cata new">
							<?php if($row['news_event_type'] == 'E'){
                          echo "Event";
                               }else if($row['news_event_type'] == 'N'){
                                   echo "News";
                        }  ?>
							</div>
						</div>
						<div class="rgi-content">
							<h5><a class="text-dark" href="events.php?eventID=<?php echo $row['new_event_id']; ?>"><?php echo $row['news_event_title']; ?></a></h5>
							<p id="event_description"><?php echo $row['news_event_description'];  ?> </p>
							<a href="events.php?eventID=<?php echo $row['new_event_id']; ?>" class="comment">Read More</a>
						</div>
					</div>	
				</div>
				<?php
						  }
						}
					}
					?>
			</div>
			<div class="container text-center mt-4">
			<a class="btn btn-warning" href="events.php?type=N">View All News</a>
			</div>
		</div>
	</section>
	<!-- Recent game section end -->


	<!-- Tournaments section -->
	<!-- <section class="tournaments-section spad">
		<div class="container">
			<div class="tournament-title">Tournaments</div>
			<div class="row">
				<div class="col-md-6">
					<div class="tournament-item mb-4 mb-lg-0">
						<div class="ti-notic">Premium Tournament</div>
						<div class="ti-content">
							<div class="ti-thumb set-bg" data-setbg="img/tournament/1.jpg"></div>
							<div class="ti-text">
								<h4>World Of WarCraft</h4>
								<ul>
									<li><span>Tournament Beggins:</span> June 20, 2018</li>
									<li><span>Tounament Ends:</span> July 01, 2018</li>
									<li><span>Participants:</span> 10 teams</li>
									<li><span>Tournament Author:</span> Admin</li>
								</ul>
								<p><span>Prizes:</span> 1st place $2000, 2nd place: $1000, 3rd place: $500</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="tournament-item">
						<div class="ti-notic">Premium Tournament</div>
						<div class="ti-content">
							<div class="ti-thumb set-bg" data-setbg="img/tournament/2.jpg"></div>
							<div class="ti-text">
								<h4>DOOM</h4>
								<ul>
									<li><span>Tournament Beggins:</span> June 20, 2018</li>
									<li><span>Tounament Ends:</span> July 01, 2018</li>
									<li><span>Participants:</span> 10 teams</li>
									<li><span>Tournament Author:</span> Admin</li>
								</ul>
								<p><span>Prizes:</span> 1st place $2000, 2nd place: $1000, 3rd place: $500</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- Tournaments section bg -->


	<!-- Review section -->
	<!-- <section class="review-section spad set-bg" data-setbg="img/review-bg.png">
		<div class="container">
			<div class="section-title">
				<div class="cata new">new</div>
				<h2>Recent Reviews</h2>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="review-item">
						<div class="review-cover set-bg" data-setbg="img/review/1.jpg">
							<div class="score yellow">9.3</div>
						</div>
						<div class="review-text">
							<h5>Assasin’’s Creed</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="review-item">
						<div class="review-cover set-bg" data-setbg="img/review/2.jpg">
							<div class="score purple">9.5</div>
						</div>
						<div class="review-text">
							<h5>Doom</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="review-item">
						<div class="review-cover set-bg" data-setbg="img/review/3.jpg">
							<div class="score green">9.1</div>
						</div>
						<div class="review-text">
							<h5>Overwatch</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="review-item">
						<div class="review-cover set-bg" data-setbg="img/review/4.jpg">
							<div class="score pink">9.7</div>
						</div>
						<div class="review-text">
							<h5>GTA</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- Review section end -->

	<!-- Footer section -->
	<?php  include "includes/footer.php" ?>
	<!-- Footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<?php  include "includes/jsfiles.php" ?>
    </body>
</html>