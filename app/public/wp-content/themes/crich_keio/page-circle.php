<?php
/*
Template Name: サークルトップ用
*/
get_header();
?>
<div class="l-content">
	<div class="pagehead">
		<h1 class="page_title">サークル</h1>
	</div>

<?php
	$args_circle_carousel = array(
		'post_type' => 'circle', //カスタム投稿名
		'posts_per_page'=> 10, //表示件数（-1で全ての記事を表示）
		'meta_key' => 'circle_is_slider', // CFのフールド名
		'meta_value' => true, // CFのフィールドの値
		'meta_compare' => 'LIKE' // 値との関係性
	);
	$cover_array = array();
	query_posts( $args_circle_carousel );
	if(have_posts()):
		while(have_posts()):the_post();
			array_push($cover_array, array(
				'imgurl' => wp_get_attachment_image_src(SCF::get('circle_photo')['0']['circle_photo_item'], 'carousel'),
				'name' => the_title('','', false),
				'permalink' => get_permalink(),
				'copy' => get_post_meta(get_the_ID(), 'circle_catch_copy', true)
			));
		endwhile;
	endif;

	shuffle($cover_array); // 配列をシャッフル

	if(have_posts()):
		echo '<div class="carousel s-hidden">';
		echo '<ul class="carousel__grp js-slide">';
		// シャッフルした配列を出力
		foreach ($cover_array as $cover) :
?>
			<li class="carousel__item">
				<a class="carousel__link" href="<?php echo $cover['permalink']; ?>">
					<figure class="carousel__fig">
						<?php
							if($cover['imgurl']['0']) {
								// 1枚目の写真を表示
								echo '<img src="'. $cover['imgurl']['0']. '" alt="' . $cover['name'] . '">';
							} else {
								echo '<img src="/img/no_image.png" alt="no image">';
							}
						?>
					</figure>
					<div class="carousel__title">
						<div class="bold"><?php echo $cover['name']; ?></div>
						<?php
							echo '<div class="carousel__copy">'.$cover['copy'].'</div>';

						?>
					</div>
				</a>
			</li>
<?php endforeach;
		echo '</ul></div>';
	endif;
?>

	<div class="searchbox">
		<div class="wrapper">
			<?php display_search_form('circle', 'サークル・団体名/活動内容など'); ?>
		</div>
	</div>

	<?php get_template_part('include/search-box-circle'); ?>

	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">ピックアップ</h1>
		</div>
		<div class="wrapper">
<?php
	$args = array(
		'post_type' => 'circle', //カスタム投稿名
		'posts_per_page'=> 6, //表示件数（-1で全ての記事を表示）
		'meta_key' => 'circle_is_pickup', // CFのフールド名
		'meta_value' => true, // CFのフィールドの値
		'meta_compare' => 'LIKE' // 値との関係性
	);
	query_posts( $args );
	if(have_posts()) {
		echo '<ul class="card__grp">';
		while(have_posts()):the_post();
			get_template_part( 'include/post-item-circle');
		endwhile;
		echo '</ul>';
	}
?>

		</div>
	</section>
	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">新着サークル</h1>
		</div>
		<div class="wrapper">
			<?php
				$postTypeName = 'circle';//投稿タイプの名前
				$num = 4;//表示する投稿の数 -1で全部

				$args = array(
					'posts_per_page' => $num,
					'post_type' => $postTypeName,
					'order' => 'DESC'
				);
				$myPost = get_posts($args);

				if($myPost) {
					echo '<ul class="card__grp">';
					foreach($myPost as $post) : setup_postdata( $post );
						get_template_part( 'include/post-item-circle');
					endforeach;
					echo '</ul>';
				} else {
					echo 'サークルはありません。';
				}
				wp_reset_postdata();
			?>

		</div>
		<ul class="btnarea btnarea--center">
			<li class="btnwrapper"><a class="btn btn--normal" href="<?php echo home_url('/circle/list/'); ?>"><span>一覧を見る</span></a></li>
		</ul>
	</section>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>