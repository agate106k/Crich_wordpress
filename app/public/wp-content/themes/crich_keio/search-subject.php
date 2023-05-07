<?php
get_header();
?>
<div class="l-content">
	<?php
		global $wp_query;
		$total_results = $wp_query->found_posts;
		$search_query = get_search_query();

		?>

			<div class="content">
				<div class="content__head">
					<h1 class="content__title">検索結果<span class="normal">（<?php echo $total_results; ?>件）</span></h1>
				</div>
				<div class="wrapper">
			<?php
			if( $total_results > 0 ):
				if(have_posts()):
					echo '<ul class="card__grp card__grp--mlist">';
					while(have_posts()): the_post();
						get_template_part( 'include/post-item-subject');
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
					条件に一致する履修情報は見つかりませんでした。<br>
					もう一度条件を変えて探してください。</p>
				</div>
			<?php endif;?>

				</div><!-- // .wrapper -->
			</div><!-- // .content -->
			<div class="searchbox">
				<div class="wrapper">
					<?php
						display_search_form('subject', 'キーワードから探す');
					?>
				</div>
			</div>

			<?php
				get_template_part('include/search-box-subject');
			?>

</div>
<!-- //.l-content-->
<?php
get_footer();
?>
