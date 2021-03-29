<?php get_header();?>

<div id="visual">
	<div class="page-title">
		<img src="<?php echo get_stylesheet_directory_uri().'/img/title.png' ?>" height="100%" />
		<div class="wrapper-size">
			<h1 class="has-blue-color has-text-align-center">此頁面不存在</h1>
		</div>
	</div>
</div>
<main id="contact">
	<p>您尋找的頁面不存在，或許您想尋找…</p>
	<div class="wrapper-size has-gray-color">
		<?php wp_nav_menu(array('theme_location' => 'full')); ?>
	</div>
</main>


<?php get_footer();?>