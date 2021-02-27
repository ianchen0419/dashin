<?php /* Template Name: about */ ?>
<?php get_header();?>

<div class="full-visual">
	<?php 

		$my_getposts=get_pages(array(
			'child_of'		=>	get_the_ID(),//現在のページID
			'sort_column' 	=> 	'post_date',
		));
	?>
	<div class="wrapper-size">
		<div class="wp-block-columns full-visual-content margin0">
			<div class="wp-block-column has-text-align-center">
				<div class="has-white-color has-huge-font-size">關於我們</div>
				<ul class="contact-path has-white-color">
					<li>
						<a href="http://192.168.1.111/dashin">Home</a>
					</li>
					<li>
						<a href="http://192.168.1.111/dashin/about">關於我們</a>
					</li>
				</ul>
			</div>
			<div class="wp-block-column">
				<div class="full-visual-items">
					<?php 

						foreach($my_getposts as $post){
							$post_ID=$post->ID;
							$post_url=get_the_permalink($post_ID);
							echo
							'<a href="'.$post_url.'" class="full-visual-item has-white-color has-medium-font-size">'.$post->post_title.'</a>';
						}

					?>
					<div class="image-item">
						<?php 

							foreach($my_getposts as $post){
								$post_ID=$post->ID;
								$post_thumbnail=get_the_post_thumbnail_url($post_ID);

								echo
								'<img src="'.$post_thumbnail.'" alt="'.$post->post_title.'" />';
							}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	header.style.background="none";
	header.style.color="#FFF";

	document.querySelector('.full-visual-item').classList.add('actived');
</script>

<?php get_footer();?>