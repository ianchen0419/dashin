<?php /* Template Name: success */ ?>
<?php get_header();?>

<div id="visual">
	<div class="page-title">
		<img src="<?php echo get_stylesheet_directory_uri().'/img/title.png' ?>" height="100%" />
		<div class="wrapper-size">
			<h1 class="has-large-font-size has-blue-color has-text-align-center"><?php the_title(); ?></h1>
		</div>
	</div>
</div>
<main id="contact">
	<?php
		make_bread_nav_list($post);

		$category=get_category_by_slug('success');

		$my_getposts=get_posts(array(
			'posts_per_page'	=> '-1',
			'sort_column'		=> 'post_date',
			'category'			=> $category->cat_ID,
		));

		$post_length=count($my_getposts);

	?>

	<div id="listArea">
		<i class="ai-loading-3-quarters news-list-loading"></i>
	</div>

	<script>
		var post_length=<?php echo $post_length ?>;

		var ajax_count=0;
		var is_loading=true;
		var is_end=false;

		function get_success_post_data(){

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
					is_loading=false;
				}
			};

			list_start=6*ajax_count+1;
			list_end=list_start+5;
			ajax_count++;
			mailXhr.send("action=getsuccesspost"+"&"+"start="+list_start+"&"+"end="+list_end);

		}
		get_success_post_data();


		//scroll to load new
		window.addEventListener('scroll', function(){
			var scroller=document.documentElement;
			if(scroller.scrollTop==0){
				scroller=document.body;
			}
			var scrollTop=scroller.scrollTop;
			var scrollHeight=scroller.scrollHeight;
			if(innerHeight+scrollTop>=scrollHeight-footerMenu.clientHeight-footerInfo.clientHeight && !is_loading && !is_end){
				is_loading=true;
				listArea.innerHTML+='<i class="ai-loading-3-quarters news-list-loading"></i>';
				get_success_post_data();
				if(list_end>post_length){
					is_end=true;
				}
			}
		})
	</script>
</main>


<?php get_footer();?>