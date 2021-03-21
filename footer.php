	<footer id="footerMenu" class="has-sky-background-color">
		<table width="100%">
			<tr>
				<td>
					<?php the_custom_logo(); ?>
				</td>
				<td>
					<?php wp_nav_menu(array('theme_location' => 'footer')); ?>
				</td>
				<td>
					<?php wp_nav_menu(array('theme_location' => 'social')); ?>
				</td>
			</tr>
		</table>
	</footer>
	<footer id="footerInfo" class="has-blue-background-color has-white-color">
		<table width="100%">
			<tr class="has-small-font-size">
				<?php dynamic_sidebar('footer-info'); ?>
			</tr>
		</table>
	</footer>
	<script src="<?php bloginfo('template_directory') ?>/script.js"></script>
	<?php wp_footer(); ?>
</body>
</html>