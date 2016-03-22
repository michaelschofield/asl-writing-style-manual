(function(){

	/*------------------------------------*\
		$APA-SEARCH
	\*------------------------------------*/

	/**
	 * Do a WP_Query() using the #s keyword value as
	 * the user types. Then, return the results in the
	 * same screen.
	 */

	$( document ).on( 'keyup', '#s', function( e ) {

		if ( this.value.length < 4 ) return;

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
					_gaq.push(['_trackEvent', 'APA', 'search', query ]);
					//ga( 'send', 'event', 'APA', 'search', query );

				}

			});

			return false;

		}

		else {

			$( this ).data( 'timer', setTimeout( 200 ) );
		}

		e.preventDefault();

	});

	/*------------------------------------*\
		$SIDE-MENU
	\*------------------------------------*/

	/**
	 * 
	 * @hooks 'js--top-menu'
	 *
	 */

	adjust_top_menu_height = function() {

		var top_menu		= document.querySelector( '.js--top-menu' ),
			responsive_viewport = window.innerWidth;

		if ( responsive_viewport >= 1024 ) {	
			$( top_menu ).css( 'height', $( document ).height() - 275 + 'px' );
		}

	} 

	adjust_top_menu_height();

	$( window ).on( 'resize', function() {
		adjust_top_menu_height();
	});


	
})();