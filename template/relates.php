<?php /* Template Name: relates */ ?>
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

	<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>

	<h2 class="has-black-color">相關主題</h2>

	<?php

		$parent_ID=$post->post_parent;

		$my_getposts=get_pages(array(
			'child_of'		=>	$parent_ID,
			'sort_column' 	=> 	'post_date',
			'exclude'		=>	$post->ID,
		));

		$html.=
			'<div class="relates-slide-area">'.
				'<div class="wp-block-columns relates-slide-wrapper">';

				foreach($my_getposts as $post){

					$post_title=$post->post_title;
					$post_ID=$post->ID;
					$post_url=get_the_permalink($post_ID);
					$post_thumbnail=get_the_post_thumbnail_url($post_ID);

					$html.=
						'<a href="'.$post_url.'" class="wp-block-column is-style-card relates-slide">'.
							'<div class="wp-block-image">'.
								'<figure class="aligncenter size-large">'.
									'<img src="'.$post_thumbnail.'" alt="'.$post_title.'" width="72" />'.
								'</figure>'.
							'</div>'.

							'<p class="has-text-align-center">'.
								'<strong>'.$post_title.'</strong>'.
							'</p>'.

						'</a>';
				}

		$html.=
				'</div>';


		$is_nav_four='';
		if(count($my_getposts)<5){
			$is_nav_four=' relats-nav-four';
		}
		$nav_html=
				'<div class="has-text-align-center relates-nav'.$is_nav_four.'">'.
					'<i class="ai-left-circle-o relates-slide-icon-left" onclick="relatesToLeft()"></i>'.
					'<i class="ai-right-circle-o relates-slide-icon-right" onclick="relatesToRight()"></i>'.
				'</div>';

		$html.=$nav_html;

		$html.=
			'</div>';

		echo $html;

	?>
</main>

<?php get_footer();?>