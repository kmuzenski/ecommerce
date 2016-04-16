<?php require_once('session.php'); ?>


<!DOCTYPE html>
<html>

<?php require_once('header.php'); ?>

<body>



<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>


<input type="text" name="typeahead">

<center>

<img alt="lipslogo" title="lips" src="assets/img/banner.png" width="500">


</center>
<br><br><br><br>

		

	
<div class="container">
	<div class="row">


		<div class="col-md-6">
		<center>
		<h3>See what everyone is talking about!</h3><br>
		<a href="trending.php"><img alt="trending" title="trending" :wq
src="assets/img/trending.png" width="500"></a>
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
<script src="typeahead.min.js"></script>
<script>
$(document).ready(function(){
	$('input.typeahead').typeahead({
		name: 'typeahead',
		remote: 'search.php?key=%QUERY',
		limit: 10

	});

});
</script>

  </body>
</html>
