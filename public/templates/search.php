<?php get_header(); ?>
			
			<div id="content">


				<div id="inner-content" class="wrap clearfix">

					<div class="hero">


					<header>
						<h1 class="archive-title hide-accessible"> Search Results: "<?php echo esc_attr(get_search_query()); ?>"</h1>
					</header>

						<?php $count = 0; ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <?php
					    $categories 		= get_the_category();
					    $references 		= get_field( 'reference-list_examples' );
					    $citations 			= get_field( 'in-text_examples' );
					    $fischler			= get_post_meta( get_the_ID(), 'fischler_rule', true );
					    //$notes 				= get_post_meta( get_the_ID(), 'asl_note', true );
					    $notes 				= get_field( 'asl_note' );
					    $primary_example	= ( $references ? $references[0]['reference_example'] : null );
					    $count++;
					    ?>
		
				    <article id="post-<?php the_ID(); ?>" <?php post_class('card--alt col--centered col-md--tencol'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
						<header data-type="Example">
							<a href="<?php echo get_the_permalink(); ?>">
							<h2 class="gamma" itemprop="headline"><?php the_title(); ?></h1>
							</a>
							
							<?php  echo ( has_excerpt() ? '<p>' . get_the_excerpt() . '</p>' : '' ); ?>
						</header>


						<?php if ( $primary_example ) : ?>
						<figure class="citation__example">
							<?php echo strip_tags( $primary_example, '<b><i><em><strong><b><i><em><strong><br><p>' ); ?>							
						</figure>
						<?php endif; ?>

						<section class="accordion">

							<?php if ( $notes ) : ?>
							<section class="accordion__section" id="<?php echo $count; ?>-notes">
								<a href="#<?php echo $count; ?>-notes">
									<h2 class="accordion__section__title">Notes</h2>
								</a>

								<div class="accordion__section__content">
									<?php echo strip_tags( $notes, '<b><i><em><strong><b><i><em><strong><br><p>' ); ?>
								</div>

							</section>
							<?php endif; ?>

					    	<?php if ( $references ) : ?>
							<section class="accordion__section" id="<?php echo $count; ?>-more-examples">
								<a href="#<?php echo $count; ?>-more-examples">
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
							<section class="accordion__section" id="<?php echo $count; ?>-fischler-modifications">
								<a href="#<?php echo $count; ?>-fischler-modifications">
									<h2 class="accordion__section__title">Fischler Modifications</h2>
								</a>

								<div class="accordion__section__content">
									<?php echo '<p>' . $fischler . '</p>'; ?>
								</div>

							</section>
							<?php endif; ?>
						</section>

				    </article> <!-- end article -->
					
						<?php endwhile; ?>	
						<?php wp_reset_query(); ?>
					
						    <?php if (function_exists('bones_page_navi')) { // if expirimental feature is active ?>
						
						        <?php bones_page_navi(); // use the page navi function ?>
						
					        <?php } else { // if it is disabled, display regular wp prev & next links ?>
						        <nav class="wp-prev-next">
							        <ul class="clearfix">
								        <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
								        <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
							        </ul>
						        </nav>
					        <?php } ?>			
					
					    <?php else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Sorry, No Results.", "bonestheme"); ?></h1>
    					    	</header>
    					    	<section class="post-content">
    					    		<p><?php _e("Try your search again.", "bonestheme"); ?></p>
    					    	</section>
    					    	<footer class="article-footer">
    					    	    <p><?php _e("This is the error message in the search.php template.", "bonestheme"); ?></p>
    					    	</footer>
    					    </article>
					
					    <?php endif; ?>

						</div>
			
				    </div> <!-- end #main -->
    			
			</div> <!-- end #content -->

<?php get_footer(); ?>
