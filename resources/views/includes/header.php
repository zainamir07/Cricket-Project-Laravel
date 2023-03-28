<header class="header-section">
		<div class="container">
			<!-- logo -->
			<a class="site-logo" href="index.php">
				<img src="img/logo.png" alt="">
			</a>
			<?php if(checkLogin() == false){ ?>
				<div class="user-panel ">
					<a href="login.php" class="text-decoration-none">Login</a>  /  <a class="text-decoration-none" href="registration.php">Register</a>
				</div>
			<?php }else{ ?>
				<div class=" user-panel" style="margin-left:10px;">
				    <a href="javascript:;" class=" dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
				      <?php echo $_SESSION['uFullName']." - ".getUserTypeTitle($_SESSION['uType']); ?>
					  <span class="badge bg-danger " id="counterMsg"></span>
				    </a>
				    <ul class="dropdown-menu" >
					  <li><a class="dropdown-item" href="dashboard.php">My Dashboard</a></li>
				      <li><a class="dropdown-item" href="profile.php">My Profile</a></li>

				      
					  <?php if($_SESSION['uType'] == "CM"){
						?>
						<li><a class="dropdown-item" href="chatList.php">Inbox  <span class="badge bg-danger " id="counterInbox"></span></a></li>
						<li><a class="dropdown-item" href="teamCoaches.php">Coaches</a></li>
						<li><a class="dropdown-item" href="viewAllMembers.php">Members</a></li>
						<li><a class="dropdown-item" href="viewAllTeams.php">Teams</a></li>
						<li><a class="dropdown-item" href="matches.php">Matches</a></li>
						
						
						
						<?php
					  }else if($_SESSION['uType'] == "M"){ ?>
						<li><a class="dropdown-item" href="myTeams.php">My Teams</a></li>
						<li><a class="dropdown-item" href="memberChatBox.php?clientID=<?php echo $_SESSION['uClubID']; ?>">Inbox <span class="badge bg-danger " id="counterInbox"></span></a></li>

					  <?php } ?>
				      
					  <li><a class="dropdown-item" href="viewAllEvents.php?eventType=N">News</a></li>
					  <li><a class="dropdown-item" href="viewAllEvents.php?eventType=E">Events</a></li>
					
					  <li><a class="dropdown-item" href="changePassword.php">Change Password</a></li>
				      <li><a class="dropdown-item" href="logout.php">Logout</a></li>
					  	
				    </ul>
				</div>
				<?php 

				$notiFor = $_SESSION['uType'];
	            $notiForID = $_SESSION['uID'];
	            $sqlNoti= "SELECT * FROM `tbl_notifications` WHERE `noti_for` = '$notiFor' AND `noti_forID` = '$notiForID' AND `noti_status` = '0' ORDER BY `noti_id` DESC";
	            $resultNoti = mysqli_query($con,$sqlNoti);
	            $totNoti = mysqli_num_rows($resultNoti);

				?>
				<div class=" user-panel">
				    <a href="javascript:;" class=" dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
				    	Notifications <?php if($totNoti > 0){ ?> <span class="badge bg-danger" style="position:relative; top:-3px;"><?php echo $totNoti; ?></span><?php } ?>
				    </a>
				    <ul class="dropdown-menu" >
				    	<?php if($totNoti>0){
				    			while($rowNoti= mysqli_fetch_array($resultNoti)){
				    				if($rowNoti['noti_type'] == "MR"){
										$notiUrl = "viewMatchdetails.php?requestID=".$rowNoti['noti_typeID']."&notiID=".$rowNoti['noti_id'];
									}else{
										$notiUrl = "javascript:;";
									}
				    				// $notiUrl = "requestID=".$rowNoti['noti_id'];
				    				?>
									  <li><a class="dropdown-item" href="<?php echo $notiUrl; ?>"><?php echo $rowNoti['noti_title']; ?></a></li>
									  <hr>
				    				<?php
				    			}
				    	} ?>

				      <li class="text-center"><a class="dropdown-item" href="myAllNotifications.php">View All Notifications</a></li>
				      
					 
				    </ul>
				</div>
			<?php } ?>	
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<!-- site menu -->
			<nav class="main-menu">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="events.php">News & Events</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>
		</div>
	</header>

		