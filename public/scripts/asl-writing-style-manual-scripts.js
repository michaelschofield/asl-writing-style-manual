(function(){

	$( document ).on( 'keyup', '#s', function( e ) {

		// Set a timeout
		clearTimeout( $.data( this, 'timer' ) );

		// Store the search string
		var query 	= $( '#s' ).val();

		if ( query !== '' ) {

			$.ajax({

				cache : false,
				url: asl_writing_style_manual_search.ajax_url,
				type: 'post',
				data: {
					action: 'asl_writing_style_manual_search_fetch_results',
					query : query
				},

				success : function( response ) {
					$( '#inner-content' ).html( response );
				}

			});

			return false;

		}

		else {

			$( this ).data( 'timer', setTimeout( 100 ) );
		}

		e.preventDefault();

	});
	
})();