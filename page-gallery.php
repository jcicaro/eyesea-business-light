<?php 
/**
* Template Name: Gallery
*
* @package WordPress
*/

get_header(); ?>


<div class="container">
	
	<div class="row">
		<?php ESS_Component::the_jumbo_logo(); ?>
	</div>
	
	<?php ESS_Component::the_gallery_nav(); ?>
	
	<?php if (get_field('gallery_header')) { ?>
	<div class="text-center">
		<?php the_field('gallery_header'); ?>	
	</div>
	<?php } ?>
	
	<?php
	
	if( have_rows('gallery_section') ): 
		$i=0; 
		
		while ( have_rows('gallery_section') ) : the_row();
			$reverse_order_class = '';
			if ($i%2 == 0) {
				$reverse_order_class = 'order-md-last';
			}

			$images = get_sub_field('images');
			if (!$images) { die(); }

			$img_count = count($images);
			$col_num = 4;
			$img_size = 'thumbnail';
			// sizes: thumbnail, medium, large, full
			if ($img_count == 1) { $col_num = 12; $img_size = 'large'; }
			else if ($img_count == 4) { $col_num = 6; $img_size = 'large'; } // was 'medium'

			ESS_Component::the_gallery_section($images, $reverse_order_class, $col_num, $img_size);

			$i++;
	
		endwhile;
	
	endif;
	?>
	
	<?php if (get_field('gallery_footer')) { ?>
	<div class="mt-3 text-center">
		<?php the_field('gallery_footer'); ?>	
	</div>
	<?php } ?>
	
</div>

	


<?php get_footer(); ?>