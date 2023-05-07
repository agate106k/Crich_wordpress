<?php
	// 親カテゴリーのものだけを一覧で取得
	$args = array(
		'parent' => 0,
		'orderby' => 'term_order',
		'order' => 'ASC'
	);
	$cats = get_terms( 'article_category', $args );
	if(!empty($cats)) {
		echo '<ul class="card__grp">';
		foreach($cats as $cat):
			if($cat) {
				// サムネイル取得
				$attachment_id = get_field('category_image', 'article_category_'.$cat->term_id);

				if($attachment_id) {
					$image_src = wp_get_attachment_image_src($attachment_id, 'thumbsnail')['0'];
				} else {
					$image_src = '/img/no_image.png';
				}
				?>

					<li class="card__item card__item--category">
						<a class="card__item__link" href="<?php echo home_url('/') . 'article/category/' . $cat->slug; ?>">
							<figure class="card__item__fig"><img src="<?php echo $image_src; ?>" alt=""></figure>
							<div class="card__item__catlabel"><?php echo $cat->name; ?></div>
						</a>
					</li>
		<?php
			}
		endforeach;
		echo '</ul>';
	} else {
		echo '<p class="txtc">現在カテゴリーがありません。</p>';
	}
?>