<html>
<head>
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
	document.getElementById("livesearch").styl.border="1px solid #A5ACB2";
	}
}
xmlhttp.open("GET","livesearch.php?q="+str,true);
xmlhttp.send();

}
</script>
</head>
<body>

<form>
<input type="text" size="30" onkeyup="showResult(this.value)">
<div id="livesearch"></div>
</form>

</body>
</html>