<?php get_header();?>

<?php
	$home_url=get_home_url();
	$now_url=get_the_permalink($post);
	$cat=get_the_category()[0];
	$cat_parent_id=$cat->category_parent;
	$cat_parent=get_the_category_by_ID($cat_parent_id);
	$cat_title_name=$cat->cat_name;
	
	$post_id=get_the_ID();

	if($cat_parent_id!==0){
		$cat_title_name=$cat_parent;
	}

	$cat_title_ID=get_cat_ID($cat_title_name);
	$cat_title_slug=get_category($cat_title_ID)->slug;

	$post_thumbnail=get_the_post_thumbnail_url();
	if($post_thumbnail==''){
		$post_thumbnail=get_stylesheet_directory_uri().'/img/post_default.png';
	}

?>
<div id="visual">
	<div class="page-title">
		<img src="<?php echo get_stylesheet_directory_uri().'/img/title.png' ?>" height="100%" />
		<div class="wrapper-size">
			<h1 class="has-blue-color has-text-align-center"><?php echo $cat_title_name ?></h1>
		</div>
	</div>
</div>
<main id="contact" class="single-contact">
	<div class="single-bg">
		<div class="single-wrapper">
			<?php
				echo 
				'<ul class="contact-path has-gray-color">'.
					//ホーム
					'<li>'.
						'<a href="'.$home_url.'">Home</a>'.
					'</li>'.
					//第二層
					'<li>'.
						'<a href="'.$home_url.'/'.$cat_title_slug.'">'.$cat_title_name.'</a>'.
					'</li>'.
					//第三層
					'<li>'.
						'<a href="'.$now_url.'">'.get_the_title().'</a>'.
					'</li>'.
				'</ul>';
			?>

			<h1><?php the_title(); ?></h1>

			<?php 
				if($cat_parent_id!==0){
					echo
					'<div class="single-info">'.
						'<div class="single-info-item">'.
							'<i class="ai-calendar has-pink-color"></i>'.
							'<span class="has-gray-color">'.get_the_date().'</span>'.
						'</div>'.
						'<div class="single-info-item">'.
							'<i class="ai-tag has-pink-color"></i>'.
							'<span class="has-pink-color">'.$cat->cat_name.'</span>'.
						'</div>'.
					'</div>';
				}
			?>

			<div class="single-panel">
				<img class="single-thumbnail" src="<?php echo $post_thumbnail; ?>" alt="<?php echo the_title(); ?>" width="100%" />
				<div class="single-panel-body">
					<?php
						
						while(have_posts()): the_post();
							the_content();
						endwhile;
					?>
				</div>
			</div>

			<?php 
				if($cat_parent_id!==0){
					echo
					'<div class="single-info">'.
						'<div class="single-info-item">'.
							'<i class="ai-tag has-pink-color"></i>'.
							'<span class="has-pink-color">'.$cat->cat_name.'</span>'.
						'</div>'.
					'</div>';
				}
			?>
		</div>
	</div>

	<div class="single-relates">
		<h2 class="has-black-color">相關主題</h2>
		<div class="wp-block-latest-posts wp-block-latest-posts__list is-grid columns-3 has-dates">
			<?php 

				$args=array(
					'category__in'=>wp_get_post_categories($post->ID), 
					'numberposts'=>3,
					'post__not_in'=>array($post->ID)
				);
				$posts=get_posts($args);

				foreach($posts as $post){
					$post_ID=$post->ID;
					$post_url=get_the_permalink($post_ID);
					$post_thumbnail=get_the_post_thumbnail_url($post_ID, array('380' , '400'));
					$post_title=$post->post_title;
					$post_date=explode(' ', $post->post_date)[0];
					$post_category_name=get_the_category($post_ID)[0]->name;

					if($post_thumbnail==''){
						$post_thumbnail=get_stylesheet_directory_uri().'/img/post_default_thumbnail.png';
					}

					echo 
					'<li>'.
						'<a class="post-image" href="'.$post_url.'">'.
							'<div class="wp-block-latest-posts__featured-image">'.
								'<img width="150" height="150" src="'.$post_thumbnail.'" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" loading="lazy" />'.
							'</div>'.
						'</a>'.
						'<a class="post-title" href="'.$post_url.'">'.$post_title.'</a>'.
						'<time class="wp-block-latest-posts__post-date">'.$post_date.'</time>'.
						// '<a class="post-category" href="'.$post_category_url.'" target="_self">'.$post_category_name.'</a>'.
						'<div class="post-category">'.$post_category_name.'</div>'.
					'</li>';
				}

			?>
		</div>
	</div>
</main>


<?php get_footer();?>