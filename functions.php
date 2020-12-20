<?php 

// カスタマイズロゴ
$defaults = array(
	'height'				=> 50,
	'width'					=> 160,
	'flex-height'			=> true,
	'flex-width'			=> true,
	'header-text'			=> array('site-title', 'site-description'),
	'unlink-homepage-logo'	=> true, 
);
add_theme_support('custom-logo', $defaults);

/********************
カスタマイズメニュー有効化
********************/
function register_my_menu() {
	$locations = array(
		'header'	=> 'header',
		'footer'	=> 'footer',
		'social'	=> 'social',
		'full'		=> 'full',
	);
	register_nav_menus($locations);
}
add_action('init', 'register_my_menu');

/********************
ウィジェット（フッター）有効化
********************/
function register_my_widget() {
	register_sidebar(
		array_merge(
			array(
				'name' => 'フッター',
				'id' => 'footer-info',
				'description' => 'デフォルトフッター',
				'before_widget' => '<div class="wp-block-column">',
				'after_widget' => '</div>',
				'before_title' => '<h3 hidden>',
				'after_title' => '</h3>'
				)
			)
		);
}
add_action('widgets_init', 'register_my_widget');


/********************
カラーパレット定義
********************/
add_theme_support('editor-color-palette', array(
	array(
		'name'  => '白色',
		'slug'  => 'white',
		'color'	=> '#FFFFFF',
	),
	array(
		'name'  => '黒色',
		'slug'  => 'black',
		'color' => '#262626',
	),
	array(
		'name'  => '藍色',
		'slug'  => 'blue',
		'color' => '#4978BC',
	),
	array(
		'name'  => '粉紅色',
		'slug'  => 'pink',
		'color' => '#F27179',
	),
	array(
		'name'  => '淺藍色',
		'slug'  => 'sky',
		'color' => '#EAF3FA',
	),
	array(
		'name'  => '淺粉紅色',
		'slug'  => 'rose',
		'color' => '#FDF4F5',
	),
	array(
		'name'  => '灰色',
		'slug'  => 'gray',
		'color' => '#595959',
	),
)
);

/********************
自作UIブロック　＆　現存してるUIブロックのスタイル追加
********************/
function add_my_assets_to_block_editor() {
	wp_enqueue_style('block-type', get_stylesheet_directory_uri().'/block.css');
	wp_enqueue_script('block-type', get_stylesheet_directory_uri().'/block.js', array(), "", true);
}
add_action('enqueue_block_editor_assets', 'add_my_assets_to_block_editor');

/********************
全幅ブロック有効化
********************/
add_theme_support('align-wide');

/********************
アイキャッチ画像
********************/
add_theme_support('post-thumbnails');


/********************
ホームページ＆ニュース一覧　カテゴリーつきの投稿一覧ショートコード
********************/
add_shortcode('myposts', 'myposts_function');
function myposts_init(){
	function myposts_function($atts){

		$args=shortcode_atts(array(
			'posts_per_page' => '-1',
		), $atts);


		$posts=get_posts($args);
		$output='<div class="wp-block-latest-posts wp-block-latest-posts__list is-grid columns-3 has-dates">';

		for($i=0;$i<3;$i++){
			$mypost_date=explode(' ', $posts[$i]->post_date)[0];
			$mypost_title=$posts[$i]->post_title;
			$mypost_ID=$posts[$i]->ID;
			$mypost_url=get_the_permalink($mypost_ID);
			$mypost_category=get_the_category($mypost_ID)[0]->name;
			$mypost_category_ID=get_the_category($mypost_ID)[0]->term_id;
			$mypost_category_url=get_category_link($mypost_category_ID);
			$mypost_thumbnail=get_the_post_thumbnail_url($mypost_ID);

			$output.='<li>'.
						'<div class="wp-block-latest-posts__featured-image">'.
							'<img width="150" height="150" src="'.$mypost_thumbnail.'" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" loading="lazy" />'.
						'</div>'.
						'<a href="'.$mypost_url.'">'.$mypost_title.'</a>'.
						'<time class="wp-block-latest-posts__post-date">'.$mypost_date.'</time>'.
						'<a href="'.$mypost_category_url.'" class="category" target="_self">'.$mypost_category.'</a>'.
					'</li>';
		}

		$output.='</div>';

		return $output;

	}
}
add_action('init', 'myposts_init');


?>