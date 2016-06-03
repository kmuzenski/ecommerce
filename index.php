<?php require_once('session.php'); ?>


<!DOCTYPE html>
<html>

<?php require_once('header.php'); ?>

<body>



<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>





<div id="searchResult"></div>
</div>
<div id="hidden">
</div>





<br><br><br><br>

		

	
<div class="container">
	<div class="row">


		<div class="col-md-6">
		<center>
		<h3>See what everyone is talking about!</h3><br>
		<a href="trending.php"><img alt="trending" title="trending" src="assets/img/trending.png" width="500"></a>
		</center>
		</div>

		<div class="col-md-6">
		<center>
		<h3>Find your colour!</h3><br>
		<img alt="lipstickAD" title="lipstick" src="assets/img/afterDark.png" width="500">
		</center>
		</div>



	</div>
</div>

<br><br><br><br>




<br><br><br><br><br>
<?php require_once('footer.php'); ?>
<script src="searchJS.js"></script>
<script>
$("#results").keyup(function(){
    if($(this).val()) {
        $("#hidden").hide();
    } else {
        $("#hidden").show();
    }   
});
</script>




  </body>
</html>
