$(document).ready(function() {
	$("#livesearch").on('input', function() {
		$('#livesearch').html("");
	
		

	return $.ajax({
		type: "POST",
		datatype : "json",
		url: "search.php",
		data: { terms: $("#livesearch").val() },


		success : function (results) {


		$('#results').html("");

			$.each($.parseJSON(results), function(key, value) {
				$('#results').append('<div><p>' + value.name + '</p></div>');
					console.log($('#results').val());

			});


		}


	})




	})





})



