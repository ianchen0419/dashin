<?php get_header();?>

<div id="visual">
	<div class="blue-title">
		<div class="wrapper-size">
			<h1><?php single_cat_title(); ?></h1>
		</div>
	</div>
</div>
	<?php
		// make_bread_nav_list($post);
		
		while(have_posts()): the_post();
			the_content();
		endwhile;
	?>
</main>


<?php get_footer();?>