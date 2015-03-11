<?php get_header(); ?>
	
	<div id="content">

    	<section class="background-base has-background hero">
			<form class="form" role="form">
				<ul>
					<li class="form__field">
						<label class="form__label">How do I cite</label>
						<input class="form__input form__input--full-width search__search-field search__search-field--transparent input--large input--epislon" type="search" value="<?php the_title(); ?>">
					</li>		    					
				</ul>
			</form>
    	</section>
				
	    <main id="main" role="main">
	    
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	    <?php
	    $categories 		= get_the_category();
	    $references 		= get_field( 'reference-list_examples' );
	    $citations 			= get_field( 'in-text_examples' );
	    $fischler			= get_post_meta( get_the_ID(), 'fischler_rule', true );
	    //$notes 				= get_post_meta( get_the_ID(), 'asl_note', true );
	    $notes 				= get_field( 'asl_note' );
	    $primary_example	= ( $references ? $references[0]['reference_example'] : null );

	    ?>
		
		    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix hero'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
				<div class="card--alt col--centered col-md--eightcol">

					<header>
						<h1 class="gamma" itemprop="headline"><?php the_title(); ?></h1>
						
						<?php  echo ( has_excerpt() ? '<p>' . get_the_excerpt() . '</p>' : '' ); ?>
					</header>


					<?php if ( $primary_example ) : ?>
					<figure class="citation__example">
						<?php echo strip_tags( $primary_example, '<b><i><em><strong><b><i><em><strong><br><p>' ); ?>							
					</figure>
					<?php endif; ?>

					<section class="accordion">

						<?php if ( $notes ) : ?>
						<section class="accordion__section" id="notes">
							<a href="#notes">
								<h2 class="accordion__section__title">Notes</h2>
							</a>

							<div class="accordion__section__content">
								<?php echo strip_tags( $notes, '<b><i><em><strong><b><i><em><strong><br><p>' ); ?>
							</div>

						</section>
						<?php endif; ?>

				    	<?php if ( $references ) : ?>
						<section class="accordion__section" id="more-examples">
							<a href="#more-examples">
								<h2 class="accordion__section__title">More Examples</h2>
							</a>

							<div class="accordion__section__content">

						    	<?php foreach( $references as $reference ) : ?>
						    	<figure class="citation__example">
						    		<?php echo strip_tags( $reference['reference_example'], '<b><i><em><strong><br><p>' ); ?>
						    	</figure>
						    	<?php endforeach; ?>

					    	</div>

						</section>
						<?php endif; ?>

						<?php if ( $fischler ) : ?>
						<section class="accordion__section" id="fischler-rules">
							<a href="#fischler-rules">
								<h2 class="accordion__section__title">Fischler Rules</h2>
							</a>

							<div class="accordion__section__content">
								<?php echo '<p>' . $fischler . '</p>'; ?>
							</div>

						</section>
						<?php endif; ?>
					</section>

				</div><!--/.card-->

			    <footer class="align-right col--centered col-md--eightcol">

				<?php 	if ( $categories ) {

							echo '<p class="zeta"><b>Section:</b> ';
						    
						    foreach ($categories as $category ) {
						    	echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a>';
						    } 

						    echo '</p>';
					    } ?>
						

				    <?php the_tags('<p class="no-margin small-text"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
				    

			    </footer> <!-- end article footer -->


		    </article> <!-- end article -->
		
		    <?php endwhile; ?>		
		
		    <?php else : ?>
		
			    <article id="post-not-found" class="hentry clearfix">
			    	<header class="article-header">
			    		<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
			    	</header>
			    	<section class="post-content">
			    		<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
			    	</section>
			    	<footer class="article-footer">
			    	    <p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
			    	</footer>
			    </article>
		
		    <?php endif; ?>

		</main> <!-- end #main -->
		    
	</div> <!-- end #content -->

<?php get_footer(); ?>