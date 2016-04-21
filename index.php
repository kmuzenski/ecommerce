<?php require_once('session.php'); ?>


<!DOCTYPE html>
<html>

<?php require_once('header.php'); ?>

<body>



<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>



<div class="content">
<input type="text" class="search" id="searchid" placeholder="Search Products"> 
<div id="result"></div>
</div>




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
<script>
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString =  searchid;
if(searchid!= empty)
{
    $.ajax({
    type: "POST",
    url: "result.php",
    data: dataString,
    cache: false,
    success: function(html)
    {
    $("#result").html(html).show();
    }
    });
}return false;    
});
 
("#result").on("click",function(e){ 
    var $clicked = $(e.target);
    var $name = $clicked.find(.name).html();
    var decoded = $("<div>").html($name).text();
    $('#searchid').val(decoded);
});
(document).live("click", function(e) { 
    var $clicked = $(e.target);
    if (! $clicked.hasClass("search")){
    ("#result").fadeOut(); 
    }
});
$('#searchid').click(function(){
    ("#result").fadeIn();
});
});
</script>

<?php require_once('footer.php'); ?>




  </body>
</html>
