<?php /* Template Name: news */ ?>
<?php get_header();?>

<div id="visual">
	<div class="page-title">
		<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>" height="100%" />
		<div class="wrapper-size">
			<h1 class="has-large-font-size has-blue-color has-text-align-center"><?php the_title(); ?></h1>
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

	<?php 
		//カテゴリーリスト
		$category_id=get_cat_ID('最新消息');
		$cat=get_category($category_id);
		$cat_id=$cat->cat_ID;
		$child_categories=get_categories(
			array('parent' => $cat_id)
		);
			
		$categories_list_html='<ul class="wp-block-categories wp-block-categories-list margin60">';
		foreach($child_categories as $child){
			$categories_list_html.=
				'<li class="cat-item">'.
					'<a>'.
						$child ->cat_name.
					'</a>'.
				'</li>';
		}
		$categories_list_html.='</ul>';

		echo $categories_list_html;

	?>

	<?php
		// 投稿リスト
		$args=array(
			'posts_per_page' => -1,
			'category_name' => 'news'
		);
		$posts=get_posts($args);

		$posts_list_html='<div class="wp-block-latest-posts wp-block-latest-posts__list has-dates">';
		foreach($posts as $post){

			$post_ID=$post->ID;
			$post_thumbnail=get_the_post_thumbnail_url($post_ID, array('260' , '150'));
			$post_title=$post->post_title;
			$post_url=get_the_permalink($post_ID);
			$post_excerpt=get_the_excerpt($post_ID);
			$post_date=explode(' ', $post->post_date)[0];
			$post_category_name=get_the_category($post_ID)[0]->name;
			$post_category_slug=get_the_category($post_ID)[0]->slug;
			$post_category_url=get_site_url().'/news#'.$post_category_slug;

			if($post_thumbnail==''){
				$post_thumbnail=get_stylesheet_directory_uri().'/img/news_default.png';
			}

			$posts_list_html.=
			'<li>'.
				'<div class="wp-block-latest-posts__featured-image">'.
					'<img src="'.$post_thumbnail.'" class="attachment-medium size-medium wp-post-image" loading="lazy" />'.
				'</div>'.
				'<div>'.
					'<div>'.
						'<a class="post-title" href="'.$post_url.'">'.$post_title.'</a>'.
						'<div class="wp-block-latest-posts__post-excerpt">'.$post_excerpt.'</div>'.
					'</div>'.
					'<div class="post-content">'.
						'<time>'.$post_date.'</time>'.
						'<a class="post-category" href="'.$post_category_url.'" target="_self">'.$post_category_name.'</a>'.
					'</div>'.
				'</div>'.
			'</li>';
		}
		$posts_list_html.='</div>';
		echo $posts_list_html;

	?>
</main>


<?php get_footer();?>