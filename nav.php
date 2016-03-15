
	<nav class="navbar navbar-default navbar-fixed-top">
      	
		<div class="container">
        	<div class="navbar-header">
          
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
            		<span class="sr-only">Toggle navigation</span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
         		</div>

         
	 <div id="navbar" class="collapse navbar-collapse">
          	
		<ul class="nav navbar-nav">
            
		<li><a href="index.php">Home</a></li>

		<li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Products<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#">Inbox</a></li>
                <li><a href="#">Drafts</a></li>
                <li><a href="#">Sent Items</a></li>
                <li class="divider"></li>
                <li><a href="#">Trash</a></li>
            </ul>
        </li>


		<li><a href="register.php">Register</a></li>
         
		<li><a href="loginpage.php">Login</a></li>

		<?php if( isset($_SESSION['permission']) && $_SESSION['permission'] == 2){?> 
			<li><a href="profile.php">Profile</a></li>
		<?php } ?>

		
		<?php if ( isset($_SESSION['permission']) && $_SESSION['permission'] == 1) {?>
		
			<li><a href="admin.php">Admin</a></li>
		<?php } ?>

	   
	</ul>
        	</div>
      	</div>
    	</nav>
