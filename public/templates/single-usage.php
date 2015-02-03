<?php get_header(); ?>
	
	<div id="content">
				
		    <main id="main" role="main">

			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    <?php
			    $fischler			= get_post_meta( get_the_ID(), 'fischler_rule', true );
			    $notes 				= get_post_meta( get_the_ID(), 'asl_note', true );
			    ?>
			
			    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
					<div class="background-base clearfix has-background hero">
						<header class="center-grid eightcol">
							<h1 class="beta" itemprop="headline"><?php the_title(); ?></h1>
							<?php echo ( has_excerpt() ? '<p>' . get_the_excerpt() . '</p>' : '' ); ?>
						</header>

					</div>
			
				    <section class="center-grid clearfix eightcol post-content hero" itemprop="articleBody">

				    	<?php the_content(); ?>
				    	
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