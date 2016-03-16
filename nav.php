
<nav class="navbar navbar-default navbar-fixed-top">
      	
	<div class="container">
    <div class="navbar-header">
          
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
         	<span class="sr-only">Toggle navigation</span>
         	<span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
         <a class="navbar-brand" href="index.html"><img src="assets/img/liplogo.png" width="50"></a>		
     </div>

         
	 <div id="navbar" class="collapse navbar-collapse">
          	
		<ul class="nav navbar-nav">
            
		<li><a href="index.php">Home</a></li>

            					
            	<?php 
		require_once('database.php');
		$pdo = Database::connect();
         	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$sql = "SELECT * FROM category ORDER BY name ASC";
		
		echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Products<span class="caret"></span></a>';
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

		Database::disconnect();
	
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
