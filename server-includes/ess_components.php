<?php

class ESS_Component {

	
	/*******************************************
	* Public site - General 
	********************************************/
	
	public static function the_home_button_links() {
		?>

		<div>
			<?php if( have_rows('button_links') ): ?>
			<?php while ( have_rows('button_links') ) : the_row();  ?>
			<a href="<?php the_sub_field('link'); ?>" target="<?php the_sub_field('target'); ?>"><button class="btn btn-outline-light"><?php the_sub_field('button_label'); ?></button></a>

			<?php endwhile; ?>
			<?php endif; ?>	
		</div>

		<?php
	}
	
	public static function the_page_section_description() {
		?>

		<h3 class="lead-text"><?php the_sub_field('lead_text'); ?></h3>
		<p><?php the_sub_field('sub_text'); ?></p>

		
	<?php if( have_rows('paragraphs') ): ?>
	<div>
		<?php while ( have_rows('paragraphs') ) : the_row();  ?>

		<p>
			<small>
				<?php the_sub_field('paragraph'); ?>
			</small>
			
		</p>

		<?php endwhile; ?>
	</div>
	<?php endif; ?>	
		

		<?php self::the_home_button_links(); ?>

		<?php
	}
	
	public static function the_home_section_description() {
		?>

		<h3 class="lead-text"><?php the_sub_field('lead_text'); ?></h3>
		<p><?php the_sub_field('sub_text'); ?></p>
		<?php self::the_home_button_links(); ?>

		<?php
	}
	
	public static function the_home_section_main_image($main_image) {
		?>

			<?php if($main_image) {  ?>
				<img class="img-fluid w-100 h-100 img-mh-md" src="<?php echo esc_url($main_image['sizes']['large']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>" data-aos="fade" data-aos-delay="100">
			<?php } else { ?>
				<img class="img-fluid w-100 img-mh-md" src="<?php the_sub_field('image_url'); ?>" alt="" data-aos="fade" data-aos-delay="100">
			<?php } ?>

		<?php
	}
	
	
	
	/*******************************************
	* Public site - Front Page
	********************************************/
	
	public static function the_jumbo_logo() {
		?>

		<div class="col text-center p-4">
			<img class="img-responsive" src="https://eyesea.studio/wp-content/themes/eyesea-studio-v2/assets/img/eye-sea-studio-logo2.png" alt="" style="max-width: 70%; margin: auto">
		</div>

		<?php
	}
	
	public static function the_home_section($main_image, $reverse_order_class) { 
		?>

		<section class="home-item row no-gutters bg-black">

			<div class="home-item-txt-container col-md-6 p-5 d-flex flex-column align-self-center p-5 <?= $reverse_order_class ?>"  data-aos="fade-right" data-aos-delay="100">
				
				<?php self::the_home_section_description(); ?>

			</div>

			<div class="home-item-img-container col-md-6">
				<?php self::the_home_section_main_image($main_image); ?>
			</div>

		</section>

		<?php
	}
	
	public static function the_contact_form() {
		?>
		
<div class="bg-white contact-clean">
    <form data-aos="fade" data-bss-recipient="651af00c1422ae94ed09d3346eb678d9" data-bss-subject="From your website ">
        <h2 class="text-center">Contact Icy</h2>
        <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name"></div>
        <div class="form-group"><input class="border-dark form-control is-invalid" type="email" name="email" placeholder="Email"></div>
        <div class="form-group"><textarea class="form-control" name="message" placeholder="Message" rows="14"></textarea></div>
        <div class="form-group contact-submit"><button class="btn bg-black" type="submit">send </button></div>
    </form>
</div>

		<?php
	}
	
	/*******************************************
	* Public site - Page General
	********************************************/
	
	public static function the_page_general_section($main_image, $reverse_order_class) { 
		?>

		<section class="home-item row no-gutters bg-black">

			<div class="home-item-txt-container col-md-6 p-5 d-flex flex-column align-self-center p-5 <?= $reverse_order_class ?>"  data-aos="fade-right" data-aos-delay="100">
				
				<?php self::the_page_section_description(); ?>

			</div>

			<div class="home-item-img-container col-md-6">
				<?php self::the_home_section_main_image($main_image); ?>
			</div>

		</section>

		<?php
	}
	
	
	/*******************************************
	* Public site - Gallery
	********************************************/

	public static function the_gallery_nav() {
		$current_page_id = get_the_ID();
		$additional_class = '';
		$child_page = new WP_Query( [
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'post_parent'    => wp_get_post_parent_id($current_page_id),
			'order'          => 'ASC',
			'orderby'        => 'menu_order'
		] );
		if ( $child_page->have_posts() ) : ?>

			<ul class="nav nav-pills justify-content-center gallery-nav mb-3">
				<li class="nav-item">
				  <a  class="nav-link" href="<?php echo home_url(); ?>" title="Home">Home</a>
				</li>

			<?php
			while ( $child_page->have_posts() ) : $child_page->the_post(); 
				if (get_the_ID() == $current_page_id) {
					$additional_class = 'active';
				}
				else {
					$additional_class = '';
				}
			?>


			  <li class="nav-item">
				  <a  class="nav-link <?php echo $additional_class; ?>" 
					 href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					  <?php the_title(); ?>
				  </a>
			  </li>

			<?php endwhile; ?>

			</ul>

			<?php
		endif; 
		wp_reset_postdata(); 
	}
	
	public static function the_gallery_section($images, $reverse_order_class, $col_num, $img_size) { 
		?>
		
		<section class="home-item row no-gutters bg-black">
		
			<div class="home-item-txt-container col-md-6 p-5 d-flex flex-column align-self-center p-5 <?= $reverse_order_class ?>"  data-aos="fade-right" data-aos-delay="100">
				<?php self::the_home_section_description(); ?>
			</div>

			<div class="home-item-img-container col-md-6">

				<div class="row no-gutters">

					<?php 
					if( $images ): ?>

							<?php foreach( $images as $image ): ?>

									<div class="col-<?php echo $col_num; ?>">
										<a href="<?php echo esc_url($image['sizes']['large']); // esc_url($image['url']); ?>" data-toggle="lightbox" data-title="<?php echo esc_attr($image['title']); ?>">
										 <img class="img-fluid w-100 h-100" style="object-fit: cover;" src="<?php echo esc_url($image['sizes'][$img_size]); ?>" alt="<?php echo esc_attr($image['alt']); ?>" data-aos="fade-in" data-aos-delay="100" />
										</a>
									</div>

							<?php endforeach; ?>

					<?php endif; ?>


				</div>
			</div>
		</section>

		<?php
	}
}

