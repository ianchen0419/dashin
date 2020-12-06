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
		'primary'  => 'primary',
	);
	register_nav_menus($locations);
}
add_action('init', 'register_my_menu');

/********************
ウィジェット（フッター）有効化
********************/
function register_my_widget() {

	// register_sidebar(
	// 	array(
	// 		'name' 			=> 'Contact Info',
	// 		'id' 			=> 'footer-contact',
	// 		'description' 	=> '最下面的藍色聯絡資訊',
	// 		'before_widget' => '<div class="wp-block-column">',
	// 		'after_widget' 	=> '</div>',
	// 		'before_title' 	=> '<h3 hidden>',
	// 		'after_title' 	=> '</h3>'
	// 	)
	// );

	register_sidebar(
		array(
			'name' 			=> 'Quick Menu',
			'id' 			=> 'footer-quick',
			'description' 	=> '下方的淺藍色Menu',
			'before_widget' => '<div class="wp-block-column">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h3 hidden>',
			'after_title' 	=> '</h3>'
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
// add_theme_support('align-wide');

/********************
アイキャッチ画像
********************/
add_theme_support('post-thumbnails');


?>