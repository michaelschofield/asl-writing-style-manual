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