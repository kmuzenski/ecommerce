$(document).ready(function() {
	$("#results").on('input', function() {
		$('#searchResults').html("");
		var searchPhrase = $("#results").val();

	if (searchPhrase != null && searchPhrase != ""){


	return $.ajax({
		type: "POST",
		datatype : "json",
		url: "productSearch.php",
		data: { terms: searchPhrase },


		success : function (r) {
			var item = $.parseJSON(r);

			if (item.length > 0) {
				$.each(item, function(key, value) {
					$('#searchResults').append('<div class="col-xs-12"><p>' + value.product + '</p></div>');
					
				});

			} else {
				$('#searchResults').append('<div class="col-xs-12"><p>No Results</p></div>');

			}

	}

	});
	}
});

});






