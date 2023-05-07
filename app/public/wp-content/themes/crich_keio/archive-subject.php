<?php
get_header();
?>
<div class="l-content">
	<div class="pagehead">
		<h1 class="page_title">履修情報</h1>
	</div>
	<div class="searchbox">
		<div class="wrapper">
			<?php display_search_form('subject', 'キーワードから探す'); ?>
		</div>
	</div>

	<?php get_template_part('include/search-box-subject'); ?>

	<div class="content">
		<div class="wrapper">

			<?php
				$args = array(
					'post_type' => 'subject',
					'posts_per_page' => 8,
					'paged' => $paged,
					'post_status' => 'publish',
					'meta_key' => 'subject_eval', // ACFのフィールド名
					'orderby' => 'meta_value_num',
					'order' => 'DESC'
				);
				$domestic_post = get_posts($args);
				if($domestic_post) {
					echo '<ul class="card__grp card__grp--mlist">';
					foreach($domestic_post as $post) :
						setup_postdata( $post );
						get_template_part( 'include/post-item-subject');
					endforeach;
					echo '</ul>';
				} else {
					echo '履修情報はありません。';
				}
				// ページネーション
				if (function_exists("pagination")) {
					pagination($wp_query->max_num_pages);
				}
				wp_reset_postdata();

			// 上のようにget_postsしてqueryを回すと、全件表示されてしまう模様。CFの値で並び替えるには？要調査必要
			// if(have_posts()) {
			// 	echo '<ul class="card__grp card__grp--mlist">';
			// 	while(have_posts()):the_post();
			// 		get_template_part( 'include/post-item-subject');
			// 	endwhile;
			// 	echo '</ul>';
			// } else {
			// 	echo 'サークルはありません。';
			// }

				// // ページネーション
				// if (function_exists("pagination")) {
				// 	pagination($wp_query->max_num_pages);
				// }
			?>
		</div>
	</div>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>