<?php
get_header();

$cat_info = get_category( $cat );
$catName = ( $cat_info->name );
$catId = ( $cat_info->cat_ID );
?>
<div class="l-content">
	<div class="pagehead">
		<h1 class="page_title">大学生活をより豊かにするまとめ一覧</h1>
	</div>
	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon"><?php echo $catName; ?>のまとめ</h1>
		</div>
		<div class="wrapper">
			<div class="pb30">
				<ul class="card__grp card__grp--mlist">

				<?php
						if(have_posts()): while(have_posts()) : the_post();
					?>
						<li class="card__item">
							<a class="card__item__link" href="<?php echo get_permalink();?>">
								<figure class="card__item__fig">
								<?php
									if (has_post_thumbnail()){
										$altName = get_the_title();
										the_post_thumbnail(
											'thumbsnail',
											array(
												'alt' => $altName
											)
										);
									} else {
										echo '<img src="/img/no_image.png" alt="no image">';
									}
								?>
								</figure>
								<div class="card__item__labels">
									<div class="card__item__date">
										<time><i class="icon icon--time"></i><?php echo get_the_date('Y年n月j日') ?></time>
									</div>
									<div class="card__item__title"><?php the_title(); ?></div>
								</div>
							</a>
						</li>
					<?php
						endwhile;
						endif;
					?>
				</ul>
			</div>
		</div>
	</section>
	<aside class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">カテゴリ</h1>
		</div>
		<div class="wrapper">
			<ul class="card__grp">

<?php
	// 親カテゴリーのものだけを一覧で取得
	$args = array(
		'parent' => 0,
		'orderby' => 'term_order',
		'order' => 'ASC'
	);
	$cats = get_categories( $args );

	foreach($cats as $cat):
		if($cat) {

			// サムネイル取得
			$attachment_id = get_field('category_image', 'category_'.$cat->cat_ID);
			if($attachment_id) {
				$image_src = wp_get_attachment_image_src($attachment_id, 'thumbsnail')['0'];
			} else {
				$image_src = '/img/no_image.png';
			}
			?>

				<li class="card__item card__item--category">
					<a class="card__item__link" href="<?php echo home_url('/') . 'article/' . $cat->slug; ?>">
						<figure class="card__item__fig"><img src="<?php echo $image_src; ?>" alt=""></figure>
						<div class="card__item__catlabel"><?php echo $cat->cat_name; ?></div>
					</a>
				</li>
	<?php
		}
	endforeach;
?>

			</ul>
		</div>
	</aside>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>