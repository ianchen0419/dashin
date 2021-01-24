<?php get_header();?>

<main id="contact" class="margin0">
	<?php
		while(have_posts()): the_post();
			the_content();
		endwhile;
	?>
</main>


<?php get_footer();?>