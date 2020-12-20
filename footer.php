	<footer id="footerMenu" class="has-sky-background-color">
		<div class="wrapper-size">
			<div class="wp-block-columns margin20">
				<div class="wp-block-column">
					<?php the_custom_logo(); ?>
				</div>
				<div class="wp-block-column">
					<?php wp_nav_menu(array('theme_location' => 'footer')); ?>
				</div>
				<div class="wp-block-column">
					<?php wp_nav_menu(array('theme_location' => 'social')); ?>
				</div>
			</div>
		</div>
	</footer>
	<footer id="footerInfo" class="has-blue-background-color has-white-color">
		<div class="wrapper-size">
			<div class="wp-block-columns has-small-font-size margin20 are-vertically-aligned-center">
				<?php dynamic_sidebar('footer-info'); ?>
			</div>
		</div>
	</footer>
	<script src="<?php bloginfo('template_directory') ?>/script.js"></script>
	<?php wp_footer(); ?>
</body>
</html>
