$(document).ready(function() {
	$("#livesearch").on('input', function() {
		

	return $.ajax({
		type: "POST",
		datatype : "json",
		url: "search.php",
		data: { terms: $("#livesearch").val() },


		success : function (results) {


		$('#response').html("");

			$.each($.parseJSON(results), function(key, value) {
				$('#response').append('<div><p>' + value.name + '</p></div>');
					console.log($('#response').val());

			});


		}


	})




	})





})



