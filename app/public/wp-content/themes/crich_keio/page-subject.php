<?php
/*
Template Name: 履修情報トップ用
*/
get_header();
?>
<div class="l-content">
	<div class="pagehead">
		<h1 class="page_title">履修情報</h1>
	</div>

	<?php
	if(!$is_opened_subject) {
	// 履修情報をclose
	?>
		<div class="comingsoon">
			Coming soon
		</div>

	<?php
	// 履修情報をopen
	} else {
	?>

		<div class="searchbox">
			<div class="wrapper">
				<?php display_search_form('subject', 'キーワードから探す'); ?>
			</div>
		</div>

		<?php get_template_part('include/search-box-subject'); ?>

		<div class="content">
			<div class="wrapper">

				<?php
					/// 固定ページではページ数が取得できないのでループ内容を変える必要がある
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array(
						'post_type' => 'subject',
						'posts_per_page' => 8,
						'paged' => $paged,
						'post_status' => 'publish',
						'meta_key' => 'subject_eval', // ACFのフィールド名
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
					);

					$query = new WP_Query($args);
					// max_num_pagesを取得
					$MaxNumPages = $query->max_num_pages;
					// echo $MaxNumPages;
					if($query -> have_posts()) {
						echo '<ul class="card__grp card__grp--mlist">';
						while($query -> have_posts()) :
							$query->the_post();
							get_template_part( 'include/post-item-subject');
						endwhile;
						echo '</ul>';
					} else {
						echo '履修情報はありません。';
					}
					// ページネーション
					if (function_exists("pagination")) {
						pagination($MaxNumPages, get_query_var('paged'), 'subject_top');
					}
					wp_reset_postdata();

				?>
			</div>
		</div>
	<?php
	}
	?>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>