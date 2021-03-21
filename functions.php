<?php 

/********************
// カスタマイズロゴ
********************/
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
		'language'	=> 'language',
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
				'before_widget' => '<td>',
				'after_widget' => '</td>',
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

		$category_id=get_cat_ID($atts['category']);
		$atts['category']=$category_id;

		$args=shortcode_atts(array(
			'posts_per_page' => '-1',
			'category' => '',
		), $atts);


		$posts=get_posts($args);
		$output='<div class="wp-block-latest-posts wp-block-latest-posts__list is-grid columns-3 has-dates">';

		for($i=0;$i<3;$i++){
			$mypost_date=explode(' ', $posts[$i]->post_date)[0];
			$mypost_title=$posts[$i]->post_title;
			$mypost_ID=$posts[$i]->ID;
			$mypost_url=get_the_permalink($mypost_ID);
			$mypost_category_name=get_the_category($mypost_ID)[0]->name;
			$mypost_category_slug=get_the_category($mypost_ID)[0]->slug;
			$mypost_category_ID=get_the_category($mypost_ID)[0]->term_id;
			$mypost_category_url=get_site_url().'/news#'.$mypost_category_slug;
			$mypost_thumbnail=get_the_post_thumbnail_url($mypost_ID, array('380' , '400'));


			if($mypost_thumbnail==''){
				$mypost_thumbnail=get_stylesheet_directory_uri().'/img/post_default_thumbnail.png';
			}


			$output.='<li>'.
						'<a class="post-image" href="'.$mypost_url.'">'.
							'<div class="wp-block-latest-posts__featured-image" >'.
								'<img width="150" height="150" src="'.$mypost_thumbnail.'" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" loading="lazy" />'.
							'</div>'.
						'</a>'.
						'<a class="post-title" href="'.$mypost_url.'">'.$mypost_title.'</a>'.
						'<time class="wp-block-latest-posts__post-date">'.$mypost_date.'</time>'.
						// '<a class="post-category" href="'.$mypost_category_url.'" target="_self">'.$mypost_category_name.'</a>'.
						'<div class="post-category">'.$mypost_category_name.'</div>'.
					'</li>';
		}

		$output.='</div>';

		return $output;

	}
}
add_action('init', 'myposts_init');

/********************
パンくずリスト
********************/
function make_bread_nav_list($post){
	// 親ページ	
	$parent_id=$post->post_parent; // 親ページのIDを取得
	$parent_slug=get_post($parent_id)->post_name; // 親ページのスラッグを取得
	$parent_url=get_permalink($parent_id); // 親ページの URL を取得
	$parent_title=get_post($parent_id)->post_title; // 親ページのタイトルを取得

	// 現在ページ
	$now_slug=get_post($post)->post_name;
	$now_url=get_the_permalink($post);
	$now_title=get_the_title($post);

	//ホームページ
	$home_url=get_home_url();

	$parent_nav_list='';
	if($parent_id){
		$parent_nav_list=
		'<li>'.
			'<a href="'.$parent_url.'">'.$parent_title.'</a>'.
		'</li>';
	}

	echo 
	'<ul class="contact-path has-gray-color">'.
		//ホーム
		'<li>'.
			'<a class="has-gray-color" href="'.$home_url.'">Home</a>'.
		'</li>'.
		//第二層（もしあれば）
		$parent_nav_list.
		//第三層
		'<li>'.
			'<a class="has-gray-color" href="'.$now_url.'">'.$now_title.'</a>'.
		'</li>'.
	'</ul>';
}

/********************
投稿文章抜粋の[...]を削除
********************/
function new_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


/********************
ニュース一覧HTMLテンプレート
********************/
function post_list_html($type, $count, $start, $end){
	
	$args=array(
		'posts_per_page' => -1,
		'category_name' => $type
	);

	$posts=get_posts($args);
	$posts_list_html='';


	for($i=$start;$i<=$end;$i++){

		$post_ID=$posts[$i-1]->ID;
		$post_thumbnail=get_the_post_thumbnail_url($post_ID, array('260' , '150'));
		$post_title=$posts[$i-1]->post_title;
		$post_url=get_the_permalink($post_ID);
		$post_excerpt=get_the_excerpt($post_ID);
		$post_date=explode(' ', $posts[$i-1]->post_date)[0];
		$post_category_name=get_the_category($post_ID)[0]->name;
		$post_category_slug=get_the_category($post_ID)[0]->slug;
		$post_category_url=get_site_url().'/news#'.$post_category_slug;

		if($post_thumbnail==''){
			$post_thumbnail=get_stylesheet_directory_uri().'/img/post_default_medium.png';
		}

		$posts_list_html.=
		'<li class="showing">'.
			'<div class="wp-block-latest-posts__featured-image">'.
				'<a href="'.$post_url.'">'.
					'<img src="'.$post_thumbnail.'" class="attachment-medium size-medium wp-post-image" loading="lazy" />'.
				'</a>'.
			'</div>'.
			'<div class="post-content">'.
				'<div>'.
					'<a class="post-title" href="'.$post_url.'">'.$post_title.'</a>'.
					'<div class="wp-block-latest-posts__post-excerpt">'.$post_excerpt.'</div>'.
				'</div>'.
				'<div>'.
					'<time>'.$post_date.'</time>'.
					'<div class="post-category">'.$post_category_name.'</div>'.
				'</div>'.
			'</div>'.
		'</li>';
	}
	return $posts_list_html;
}

/********************
ニュース一覧ajaxデータ取得
********************/
function getPostFunc(){
	$post_type=$_POST['type'];
	$post_count=$_POST['count'];
	$post_start=$_POST['start'];
	$post_end=$_POST['end'];

	wp_send_json(post_list_html($post_type, $post_count, $post_start, $post_end));
	wp_die();
}

add_action('wp_ajax_getpost', 'getPostFunc');
add_action('wp_ajax_nopriv_getpost', 'getPostFunc');

/********************
EmbedブロックのRWD
********************/
add_theme_support('responsive-embeds');

/********************
独自メタデータ登録
********************/
function myguten_register_post_meta() {
	register_post_meta('page', 'loading', array(
		'show_in_rest' => true,
		'single' => true,
		'type' => 'boolean',
		)
	);
}
add_action('init', 'myguten_register_post_meta');

?>