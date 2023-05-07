<?php
get_header();
?>

<div class="l-content">
	<div class="scroll_to_bottom_btn js-scroll_to_bottom"><a href="#search"></a></div>
	<div class="carousel s-hidden">
		<ul class="carousel__grp js-slide">

		<?php
			$args = array(
				'post_type' => 'article', //カスタム投稿名
				'posts_per_page'=> 5, //表示件数（-1で全ての記事を表示）
				'meta_key' => 'is_carousel',
				'meta_value' => true,
				'meta_compare' => 'LIKE'
			);

			query_posts( $args );
			if(have_posts()):
				while(have_posts()):the_post();
					if (has_post_thumbnail()){
						?>
							<li class="carousel__item">
								<a class="carousel__link" href="<?php echo get_permalink();?>">
				<?php
						echo ' <figure class="carousel__fig">';
						$altName = get_the_title();
						the_post_thumbnail(
							'carousel',
							array(
								'alt' => $altName
							)
						);
						echo '</figure>';
				?>

							<div class="carousel__title"><?php the_title(); ?></div>
						</a>
					</li>
						<?php
					}
				endwhile;
			endif;
		?>

		</ul>
	</div>
	<div class="searchbox">
		<div class="wrapper">
			<?php
			if(!$is_opened_subject) {
			// 履修情報をclose
				display_search_form('circle' , 'サークルを探す');
			} else {
				display_search_form('' , '履修情報・サークルを探す');
			}
			?>
		</div>
	</div>
	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">人気の記事</h1>
		</div>
		<div class="wrapper">
			<div class="pb30">
				<?php
					query_posts(array(
						'post_type' => 'article',
						'posts_per_page' => 8,
						'meta_key' => 'is_top_popular',
						'meta_value' => true,
						'meta_compare' => 'LIKE'
					));
					if(have_posts()):
						echo '<ul class="card__grp card__grp--mlist">';
						while(have_posts()) : the_post();
							get_template_part( 'include/post-item-article');
						endwhile;
						echo '</ul>';
					endif;
				?>
			</div>
			<ul class="btnarea btnarea--center">
				<li class="btnwrapper"><a class="btn btn--normal" href="<?php echo home_url('/article/'); ?>"><span>もっと見る</span></a></li>
			</ul>
		</div>
	</section>

	<?php
	if(!$is_opened_subject) {
	// 履修情報をclose
	?>
		<div class="js-scroll_to_bottom_cont" id="search">
			<div class="content__head pb20">
				<h1 class="content__title content__title--icon">サークルを探す</h1>
			</div>
				<?php
					get_template_part('include/search-box-circle');
				?>
		</div>
	<?php
	} else {
	?>
		<div class="wrapper js-scroll_to_bottom_cont" id="search">
			<div class="tabcontent">
				<div class="tab_btns">
					<ul class="tab_btns__grp">
						<li class="tab_btns__item" data-tabcont="subject"><span>履修情報</span></li>
						<li class="tab_btns__item" data-tabcont="circle"><span>サークル</span></li>
					</ul>
					<div class="lamp subject"></div>
				</div>
				<div class="tabpanel">
					<ul class="tabpanel__grp">
						<li class="tabpanel__item" data-tabcont="subject">
							<?php get_template_part('include/search-box-subject'); ?>
						</li>
						<li class="tabpanel__item" data-tabcont="circle">
							<?php get_template_part('include/search-box-circle'); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	<?php
	}
	?>

	<section class="content content--org">
		<div class="wrapper">
			<div class="content__head">
				<h1 class="content__title content__title--icon">Crichについて</h1>
			</div>
			<div class="org">
				<div class="org__label">Mission</div>
				<h1 class="org__title">Campusライフを、よりrichに</h1>
				<div class="org__body">
					<p>豊かな人間性は豊かな経験に基づきます。私たちは学生生活で得られる経験をより豊かにすることで、豊かな人間性を持った人たちの溢れる社会を実現します。</p>
				</div>
			</div>
			<div class="org">
				<div class="org__label">Vision</div>
				<h1 class="org__title">無数にある選択肢の可視化</h1>
				<div class="org__body">
					<p>私たちは自分自身が大学生である立場を最大限に活かし、大学生の痛み、不満、悩みに徹底的に寄り添い、大学生の取り得る選択肢を可視化することによって大学生活をより豊かにします。</p>
				</div>
				<ul class="btnarea btnarea--center pt20">
					<li class="btnwrapper"><a class="btn btn--normal" href="#"><span>今後展開予定のサービス</span></a></li>
				</ul>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">お知らせ</h1>
		</div>
		<div class="wrapper">


				<?php
					query_posts(array(
						'post_type' => 'article',
						'posts_per_page' => 4,
						'tax_query' => array (
							array (
								'taxonomy' => 'article_category',
								'field' => 'slug',
								'terms' => 'news'
							)
						)
					));
					if(have_posts()) {
						echo '<ul class="news__grp">';
						while(have_posts()) : the_post();
							?>
							<li class="news__item">
								<a class="news__link" href="<?php echo get_permalink();?>">
									<?php // New アイコン表示
										add_new_icon(get_the_time('U'), 7);
									?>
									<time class="news__time" datetime="<?php echo get_the_date('Y-n-j'); ?>"><?php echo get_the_date('Y年n月j日'); ?></time>
									<?php the_title(); ?>
								</a>
							</li>
					<?php
						endwhile;
						echo '</ul>';
					} else {
						echo '<p class="txtc">現在お知らせはありません。</p>';
					}
				?>
		</div>
	</section>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>