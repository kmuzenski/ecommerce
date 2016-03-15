
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

		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Products<span class="caret"></span></a>
            			<ul class="dropdown-menu">
            					
            					<?php foreach ($category as $row){?><li id="<?php echo $row['id'];?>"><a href="category.php?catid=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></li><?php }?>
            					
            			</ul></li> 	
	

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
