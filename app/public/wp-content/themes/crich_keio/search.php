<?php
get_header();
?>
<div class="l-content">
	<?php
		global $wp_query;
		$total_results = $wp_query->found_posts;
		$search_query = get_search_query();

		if ($search_query) {
			// フリーワード検索の場合。queryあり
			?>

			<div class="content">
				<div class="content__head">
					<h1 class="content__title">「<?php echo $search_query; ?>」の検索結果<span class="normal">（<?php echo $total_results; ?>件）</span></h1>
				</div>
				<div class="wrapper">
			<?php
			if( $total_results > 0 ):
				if(have_posts()):
					echo '<ul class="card__grp">';
					while(have_posts()): the_post();
						// 投稿タイプによって読み込みテンプレート変える
						if (get_post_type() === 'subject') {
							get_template_part( 'include/post-item-subject');
						} elseif(get_post_type() === 'circle') {
							get_template_part( 'include/post-item-circle');
						} else {
							get_template_part( 'include/post-item-article');
						}
					endwhile;
					echo '</ul>';
					// ページネーション
					if (function_exists("pagination")) {
						pagination($wp_query->max_num_pages);
					}
				endif;
				else: ?>
				<div class="pall30 txtc">
					<p>
						<?php echo get_post_type(); ?>
					<?php echo $search_query; ?> に一致する情報は見つかりませんでした。<br>
				もう一度条件を変えて探してください。</p>
				</div>
			<?php endif;?>

				</div><!-- // .wrapper -->
			</div><!-- // .content -->

			<?php
		} else {
			// 絞り込み検索の場合。queryなし
			?>

			<div class="content">
				<div class="content__head">
					<h1 class="content__title">検索結果<span class="normal">（<?php echo $total_results; ?>件）</span></h1>
				</div>
				<div class="wrapper">
			<?php
			if( $total_results > 0 ):
				if(have_posts()):
					echo '<ul class="card__grp">';
					while(have_posts()): the_post();
						// 投稿タイプによって読み込みテンプレート変える
						if (get_post_type() === 'subject') {
							get_template_part( 'include/post-item-subject');
						} elseif(get_post_type() === 'circle') {
							get_template_part( 'include/post-item-circle');
						} else {
							get_template_part( 'include/post-item-article');
						}
					endwhile;
					echo '</ul>';
					// ページネーション
					if (function_exists("pagination")) {
						pagination($wp_query->max_num_pages);
					}
				endif;
				else: ?>
				<div class="pall30 txtc">
					<p>
					条件に一致する情報は見つかりませんでした。<br>
					もう一度条件を変えて探してください。</p>
				</div>
			<?php endif;?>

				</div><!-- // .wrapper -->
			</div><!-- // .content -->

			<?php
		}
	?>

</div>
<!-- //.l-content-->
<?php
get_footer();
?>
