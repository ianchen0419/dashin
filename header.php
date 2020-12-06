<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
	<title><?php bloginfo('name'); wp_title('|'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="description" content="<?php bloginfo('description') ?>" />
	<meta name="keywords" content="台中不孕症婦產科, 台中不孕症門診醫院, 台中不孕門診,台中不孕症權威,台中試管嬰兒,台中婦產科診所,台中不孕症治療,台中人工受孕" />
	<link rel="stylesheet prefetch" href="<?php bloginfo('template_directory') ?>/style.css" />
	<link rel="stylesheet prefetch" href="<?php bloginfo('template_directory') ?>/mobile.css" media="screen and (max-width: 768px)" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ant-design-icons/dist/anticons.min.css" />

</head>
<body>
	<?php wp_body_open(); ?>
	<header id="header">
		<div class="wrapper-size">
			
			<table width="100%">
				<tr>
					<td align="left">
						<?php the_custom_logo(); ?>
						<h1 hidden>大新生殖中心|婦產科診所</h1>
					</td>
					<td align="right">
						<nav class="has-black-color">
							<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
						</nav>
					</td>
				</tr>
			</table>
		</div>
	</header>
