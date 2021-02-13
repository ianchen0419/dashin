<?php /* Template Name: posts */ ?>
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

	<?php 
		//カテゴリーリスト
		// $cat=the_category();
		$page_category_slug=$post->post_name; //news or success
		$category_id=get_category_by_slug($page_category_slug)->cat_ID;
		$cat=get_category($category_id);
		$cat_slug=$cat->slug;
		$cat_id=$cat->cat_ID;
		$child_categories=get_categories(
			array('parent' => $cat_id)
		);

		$parent_cat_count=0;
		foreach($child_categories as $child){
			$parent_cat_count+=$child->count;
		}
			
		$categories_list_html='<ul class="wp-block-categories wp-block-categories-list margin60">';
		$categories_list_html.=
				'<li class="cat-item actived">'.
					'<a href="javascript:;" data-count="'.$parent_cat_count.'" onclick="get_post_data(\''.$cat_slug.'\', this)">'.
						'所有'.
					'</a>'.
				'</li>';

		foreach($child_categories as $child){
			$categories_list_html.=
				'<li class="cat-item">'.
					'<a href="javascript:;" data-count="'.$child->count.'" onclick="get_post_data(\''.$child->slug.'\', this)">'.
						$child->cat_name.
					'</a>'.
				'</li>';
		}
		$categories_list_html.='</ul>';

		echo $categories_list_html;

	?>
	
	<h2 id="listTitle">所有</h2>
	<ul id="listArea" class="wp-block-latest-posts wp-block-latest-posts__list has-dates"></ul>
	<script>
		var category_type="<?php echo $page_category_slug ?>";
		var category_count=0;
		var category_has_shown=0;
		var is_end=false;
		var is_loading=true;
		var is_change_type=false;
		var list_start=0;
		var list_end=0;

		function get_post_data(type, ths){
			//calculate start and end
			is_change_type=false;
			if(category_type!==type){
				is_change_type=true;
				category_has_shown=0;
			}
			list_start=category_has_shown+1;

			//update var
			category_type=type;

			//loading
			if(category_has_shown==0){
				listArea.innerHTML='<i class="ai-loading-3-quarters news-list-loading"></i>';
			}
			is_loading=true;

			//active style
			document.querySelector('.cat-item.actived').classList.remove('actived');
			ths.parentNode.classList.add('actived');
			listTitle.textContent=ths.textContent;

			//make count
			category_count=parseInt(ths.getAttribute('data-count'));
			if(category_count-category_has_shown<10){
				category_has_shown+=category_count-category_has_shown;
				is_end=true;
			}else{
				category_has_shown+=10;
				is_end=false;
			}

			list_end=category_has_shown;

			//make ajax
			var mailXhr=new XMLHttpRequest();
			var admin_url="<?php echo admin_url('admin-ajax.php'); ?>";
			mailXhr.open('POST', admin_url, true);
			mailXhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			mailXhr.onreadystatechange=function(){
				if(mailXhr.readyState==4 && mailXhr.status==200){
					document.querySelector('.news-list-loading').remove();
					var json=JSON.parse(mailXhr.responseText);
					listArea.innerHTML+=json;
					if(!is_end){
						listArea.innerHTML+='<i class="ai-loading-3-quarters news-list-loading" />';
					}
					is_loading=false;
				}
			};
			mailXhr.send("action=getpost"+"&"+"type="+category_type+"&"+"count="+category_count+"&"+"start="+list_start+"&"+"end="+list_end);
		}

		get_post_data(category_type, document.querySelector('.cat-item a'));

		//scroll to load new
		window.addEventListener('scroll', function(){
			var scroller=document.documentElement;
			if(scroller.scrollTop==0){
				scroller=document.body;
			}
			var scrollTop=scroller.scrollTop;
			var scrollHeight=scroller.scrollHeight;
			if(innerHeight+scrollTop>=scrollHeight-footerMenu.clientHeight-footerInfo.clientHeight && !is_loading && !is_end){
				get_post_data(category_type, document.querySelector('.cat-item.actived a'));
			}
		})
		
	</script>
</main>


<?php get_footer();?>