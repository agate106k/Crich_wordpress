<?php
get_header();
?>
<div class="l-content">
	<div class="pagehead">
		<h1 class="page_title">サークル</h1>
	</div>

	<div class="searchbox">
		<div class="wrapper">
			<?php display_search_form('circle', 'サークル・団体名/活動内容など'); ?>
		</div>
	</div>

	<?php get_template_part('include/search-box-circle'); ?>

	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">サークル一覧</h1>
		</div>
		<div class="wrapper">
		<?php
			if(have_posts()) {
				echo '<ul class="card__grp">';
				while(have_posts()):the_post();
					get_template_part( 'include/post-item-circle');
				endwhile;
				echo '</ul>';
			} else {
				echo 'サークルはありません。';
			}

			// ページネーション
			if (function_exists("pagination")) {
				pagination($wp_query->max_num_pages);
			}
		?>

		</div>
	</section>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>