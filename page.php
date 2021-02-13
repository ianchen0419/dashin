<?php get_header();?>

<div id="visual">
	<div class="page-title">
		<img src="<?php echo get_stylesheet_directory_uri().'/img/title.png' ?>" height="100%" />
		<div class="wrapper-size">
			<h1 class="has-blue-color has-text-align-center"><?php the_title(); ?></h1>
		</div>
	</div>
</div>
<main id="contact">
	<?php
		make_bread_nav_list($post);
		
		while(have_posts()): the_post();
			the_content();
		endwhile;
	?>
</main>


<?php get_footer();?>