<?php require_once('session.php'); ?>


<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>
<body>


<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>
<p>hello world</p>
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
<h3>Find </h3><br>
<img alt="lipstickAD" title="lipstick" src="assets/img/afterDark.png" width="500">
</center>
</div>



</div>
</div>
<br><br><br><br>


<form>
<input type="text" size="30" onkeyup="showResult(this.value)">
<div id="livesearch"></div>
</form>


<br><br><br><br><br>

<?php require_once('footer.php'); ?>
<script>
function showResult(str) {
	if (str.length==0) {
	document.getElementById("livesearch").innerHTML="";
	document.getElementById("livesearch").style.border="0px";
	return;
	}

if (window.XMLHttpRequest) {
//IE7 Ffox chrome safari opera

	xmlhttp = new XMLHttpRequest();

} else {
//IE - 6

	xmlhttp = new ActiveXObject ("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
	document.getElementById("livesearch").style.border="1px solid #A5ACB2";
	}
}
xmlhttp.open("GET","livesearch.php?q="+str,true);
xmlhttp.send();

}
</script>
  </body>
</html>
