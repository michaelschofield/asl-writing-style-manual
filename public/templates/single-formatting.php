<?php get_header(); ?>
	
	<div id="content">
				
		    <main id="main" role="main">

			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    <?php
			    $references 		= get_field( 'reference-list_examples' );
			    $citations 			= get_field( 'in-text_examples' );
			    $fischler			= get_post_meta( get_the_ID(), 'fischler_rule', true );
			    $notes 				= get_post_meta( get_the_ID(), 'asl_note', true );
			    $primary_example	= ( $references ? $references[0]['reference_example'] : null );
			    ?>
			
			    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
					<div class="background-base clearfix has-background hero">
						<header class="center-grid eightcol">
							<h1 class="beta" itemprop="headline"><?php the_title(); ?></h1>
							<?php echo ( has_excerpt() ? '<p>' . get_the_excerpt() . '</p>' : '' ); ?>
						</header>

					<?php if ( $primary_example ) : ?>
						<figure class="center-grid eightcol">
							<span class="epsilon">
							<?php echo strip_tags( $primary_example, '<b><i><em><strong>' ); ?>
							</span>
						</figure>
					<?php endif; ?>

					</div>
			
				    <section class="center-grid clearfix eightcol post-content hero" itemprop="articleBody">
				    	
				    	<?php if ( $references ) : ?>
				    	<h2 class="gamma">Reference Examples</h2>

					    	<?php foreach( $references as $reference ) : ?>
					    	<figure class="epsilon">
					    		<?php echo strip_tags( $reference['reference_example'], '<b><i><em><strong>' ); ?>
					    	</figure>

					    	<?php endforeach; ?>
				    	<?php endif; ?>

					    <?php if ( $citations ) : ?>
					    <h2 class="gamma">In-Text Citations</h2>

					   		<?php foreach( $citations as $citation ) : ?>
					   		<figure class="epsilon">
					   			<?php echo strip_tags( $citation['in-text_example'], '<b><i><em>strong>' ); ?>
					   		</figure>
					   		<?php endforeach; ?>

				   		<?php endif; ?>

				   		<?php if ( $fischler ) :  ?>
				   		<h2 class="gamma">Fischler Rules</h2>
				   		<?php echo '<p>' . $fischler . '</p>'; ?>
				   		<?php endif; ?>


				   		<?php if ( $notes ) :  ?>
				   		<h2 class="gamma">Notes</h2>
				   		<?php echo '<p>' . $notes . '</p>'; ?>
				   		<?php endif; ?>

					</section> <!-- end article section -->
				
				    <footer class="article-footer wrap clearfix">
	
					    <?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
						
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

		    <?php //get_sidebar(); ?>
		    
	</div> <!-- end #content -->

<?php get_footer(); ?>