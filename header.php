<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
	<title><?php bloginfo('name'); wp_title('|'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="description" content="<?php bloginfo('description') ?>" />
	<meta name="keywords" content="台中不孕症婦產科, 台中不孕症門診醫院, 台中不孕門診,台中不孕症權威,台中試管嬰兒,台中婦產科診所,台中不孕症治療,台中人工受孕" />
	<link rel="stylesheet prefetch" href="<?php bloginfo('template_directory') ?>/style.css" />
	<link rel="stylesheet prefetch" href="<?php bloginfo('template_directory') ?>/mobile.css" media="screen and (max-width: 1000px)" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ant-design-icons/dist/anticons.min.css" />
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
	<script>

		<?php
			$need_loading=get_post_meta($post->ID, 'loading', true);
			if($need_loading==true){
				echo 'var needLoading=true';
			}else{
				echo 'var needLoading=false';
			}
		?>
	</script>

	<script src="<?php bloginfo('template_directory') ?>/loading.js"></script>
	<?php wp_body_open(); ?>
	<section id="loading">
		<svg viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
			<circle cx="50" cy="50" fill="none" stroke="#4978BC" stroke-width="10" r="35" stroke-dasharray="165 57"></circle>
		</svg>
	</section>
	<header id="header" class="has-black-color">
		<table width="100%">
			<tr>
				<td align="left">
					<?php the_custom_logo(); ?>
					<h1 hidden>大新生殖中心|婦產科診所</h1>
				</td>
				<td align="right">
					<nav>
						<?php wp_nav_menu(array('theme_location' => 'header')); ?>
					</nav>
				</td>
				<td width="120"></td>
			</tr>
		</table>
		<div id="menu">
			<a href="javascript:;" onclick="showMenu(this)">
				<svg width="45" height="60" viewBox="0 0 45 60" onlcick="console.log('23')">
					<line class="svg-line1" x1="10" y1="6" x2="35" y2="6" stroke-width="2.5" stroke="white"></line>
					<line class="svg-line2" x1="10" y1="16" x2="35" y2="16" stroke-width="2.5" stroke="white"></line>
					<line class="svg-line3" x1="10" y1="26" x2="35" y2="26" stroke-width="2.5" stroke="white"></line>
					<line class="svg-line4" x1="12.5" y1="6" x2="33.5" y2="26" stroke-width="2.5" stroke="white"></line>
					<line class="svg-line5" x1="12.5" y1="26" x2="33.5" y2="6" stroke-width="2.5" stroke="white"></line>
					<text class="svg-text1" font-family="sans-serif" font-size="smaller" x="22.5" y="45" dominant-baseline="middle" fill="white" text-anchor="middle">MENU</text>
					<text class="svg-text2" font-family="sans-serif" font-size="smaller" x="22.5" y="45" dominant-baseline="middle" fill="white" text-anchor="middle">CLOSE</text>
				</svg>
			</a>
			<table width="100%">
				<tr>
					<td>
						<?php wp_nav_menu(array('theme_location' => 'full')); ?>
					</td>
					<td valign="bottom">
						<?php wp_nav_menu(array('theme_location' => 'social')); ?>
					</td>
				</tr>
			</table>
		</div>
	</header>
