<?php
get_header();
?>
<div class="l-content">
	<div class="pagehead">
		<h1 class="page_title">大学生活をより豊かにするまとめ一覧</h1>
	</div>
	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">まとめ</h1>
		</div>
		<div class="wrapper">
			<div class="pb30">
				<?php
					if(have_posts()):
						echo '<ul class="card__grp card__grp--mlist">';
						while(have_posts()) : the_post();
							get_template_part( 'include/post-item-article');
						endwhile;
						echo '</ul>';
					endif;

					// ページネーション
					if (function_exists("pagination")) {
						pagination($wp_query->max_num_pages);
					}
				?>
			</div>
		</div>
	</section>
	<aside class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">カテゴリ</h1>
		</div>
		<div class="wrapper">
			<?php get_template_part('include/article-category-list'); ?>
		</div>
	</aside>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>