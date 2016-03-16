	<nav class="navbar navbar-default navbar-fixed-top">
      	
		<div class="container">
        	<div class="navbar-header">
          
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
         		</div>

         
	 <div class="collapse navbar-collapse" id="navbar">
          	
		<ul class="nav navbar-nav">
            
		<li><a href="index.php">Home</a></li>

            					
            	<?php 
		require_once('database.php');
		$pdo = Database::connect();
         	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$sql = 'SELECT id, name FROM category ORDER BY name ASC';
		echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="category.php">Categories<span class="caret"></span></a>';
         	 echo '<ul class="dropdown-menu">';
          	foreach ($pdo->query($sql) as $category) {
            	echo '<li id="' . $category['name'] . '">';
              	echo '<a href="category.php?id=' . $category['id'] . '">';
                echo ' ' . $category['name'] . ' ';
              	echo '</a>';
            	echo '</li>';
            
          }
          echo '</ul>';
          echo '</li>';	
		Database:disconnect();
	
		 ?>          		  					
            				
	

		<li><a href="register.php">Register</a></li>
        
		<li><a href="loginpage.php">Login</a></li>

		<?php if( isset($_SESSION['permission']) && $_SESSION['permission'] == 2){?> 
			<li><a href="profile.php">Profile</a></li>
			<li><a href="update.php">Update</a></li>
		<?php } ?>

		
		<?php if ( isset($_SESSION['permission']) && $_SESSION['permission'] == 1) {?>
			<li><a href="update.php">Update</a></li>	
			<li><a href="admin.php">Admin</a></li>
		<?php } ?>

	   
	</ul>
        	</div>
      	</div>
    	</nav>
