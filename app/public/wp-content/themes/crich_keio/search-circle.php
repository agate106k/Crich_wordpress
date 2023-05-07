<?php
get_header();
?>
<div class="l-content">

<?php
	global $wp_query;
	$total_results = $wp_query->found_posts;
	$search_query = get_search_query();


// $s = $_GET['s'];
// $circle_campus = isset($_GET['circle_campus']) ? $_GET['circle_campus'] : null;
// $circle_category = isset($_GET['circle_category']) ? $_GET['circle_category'] : null;

// if($circle_campus) {
// 	$tax_ary[] = array(
// 		'taxonomy' => 'circle_campus',
// 		'field' => 'slug',
// 		'terms' => $circle_campus,
// 		'operator' => 'IN', //ANDかIN
// 	);
// }
// if($circle_category) {
// 	$tax_ary[] = array(
// 		'taxonomy' => 'circle_category',
// 		'field' => 'slug',
// 		'terms' => $circle_category,
// 		'operator' => 'IN', //ANDかIN
// 	);
// }

// if(is_array($circle_category)) {
// 	echo '<p>ジャンル:';
// 	foreach ($circle_category as $val) {
// 		$s_term = get_term_by('slug', $val, 'circle_category');
// 		echo $s_term->name;
// 		if ($val !== end($circle_category)) {
// 			echo ', ';
// 		}
// 	}
// 	echo '</p>';
// }

// if(is_array($circle_campus)) {
// 	echo '<p>キャンパス:';
// 	foreach ($circle_campus as $val) {
// 		$s_term = get_term_by('slug', $val, 'circle_campus');
// 		echo $s_term->name;
// 		if ($val !== end($circle_campus)) {
// 			echo ', ';
// 		}
// 	}
// 	echo '</p>';
// }

?>
			<div class="content">
				<div class="content__head">
					<h1 class="content__title">検索結果<span class="normal">（<?php echo $wp_query->found_posts; ?>件）</span></h1>
				</div>
				<div class="wrapper">


			<?php
			if( $total_results > 0 ):
				if(have_posts()):
					echo '<ul class="card__grp">';
					while(have_posts()): the_post();
						get_template_part( 'include/post-item-circle');
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
					条件に一致するサークルは見つかりませんでした。<br>
					もう一度条件を変えて探してください。</p>
				</div>
			<?php endif;?>

				</div><!-- // .wrapper -->
			</div><!-- // .content -->
			<div class="searchbox">
				<div class="wrapper">
					<?php
						display_search_form('circle', 'サークル・団体名/活動内容など');
					?>
				</div>
			</div>

			<?php
				get_template_part('include/search-box-circle');
			?>


</div>
<!-- //.l-content-->
<?php
get_footer();
?>
