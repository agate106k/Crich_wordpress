<div class="entry entry--subject">
		<header class="subject_head">
			<div class="subject_head__faculty">

			<?php display_subject_faculty(get_the_ID(), true); ?>
			</div>
			<h1 class="subject_head__title">
				<?php the_title(); ?>
				<?php
					if(get_field('subject_term')):
						echo '['.get_field('subject_term').']';
					endif;
				?>
			</h1>
			<div class="subject_head__prof">
				<?php display_teachers(get_the_ID()); ?>
			</div>
		</header>
		<div class="subject_body">
			<div class="subject_star">
				<div class="starbox starbox--single">
					<div class="starbox__rate">
						<div class="starbox__rate_active" data-star-point="<?php echo get_subject_eval(get_the_ID());?>"></div>
					</div>
				</div>
			</div>
			<div class="subject_radar">
				<canvas class="radar_chart_large" data-module="<?php echo get_subject_module(get_the_ID());?>" data-record="<?php echo get_subject_record(get_the_ID());?>" data-interest="<?php echo get_subject_interest(get_the_ID());?>"></canvas>
			</div>
			<div class="subject_tag">
				<ul class="tag__grp">
					<?php display_features(get_the_ID()); ?>
				</ul>
			</div>
			<div class="subject_box">
				<dl class="subject_box__head">
					<dt class="subject_box__label">課題</dt>
					<dd class="subject_box__cont">
					<?php
					if(get_field('subject_hw')['subject_hw_opinion']):
						echo get_field('subject_hw')['subject_hw_opinion'];
					endif;
					?>
					</dd>
				</dl>

				<canvas class="js-bar_graph" data-easy="<?php
					if(get_field('subject_hw')['subject_hw_easy']) {
						echo get_field('subject_hw')['subject_hw_easy'];
					} else {
						echo '0';
					}
					?>"
					 data-average="<?php
					if(get_field('subject_hw')['subject_hw_average']) {
						echo get_field('subject_hw')['subject_hw_average'];
					} else {
						echo '0';
					}
					?>"
					 data-hard="<?php
					if(get_field('subject_hw')['subject_hw_hard']) {
						echo get_field('subject_hw')['subject_hw_hard'];
					} else {
						echo '0';
					}
					?>" width="320" height="100">

				</canvas>
			</div>
			<div class="subject_box">
				<dl class="subject_box__head">
					<dt class="subject_box__label">試験</dt>
					<dd class="subject_box__cont">
					<?php
					if(get_field('subject_exam')['subject_exam_opinion']):
						echo get_field('subject_exam')['subject_exam_opinion'];
					endif;
					?>
					</dd>
				</dl>
				<canvas class="js-bar_graph" data-easy="<?php
					if(get_field('subject_exam')['subject_exam_easy']) {
						echo get_field('subject_exam')['subject_exam_easy'];
					} else {
						echo '0';
					}
					?>"
					 data-average="<?php
					if(get_field('subject_exam')['subject_exam_average']) {
						echo get_field('subject_exam')['subject_exam_average'];
					} else {
						echo '0';
					}
					?>"
					 data-hard="<?php
					if(get_field('subject_exam')['subject_exam_hard']) {
						echo get_field('subject_exam')['subject_exam_hard'];
					} else {
						echo '0';
					}
					?>" width="320" height="100">

				</canvas>
			</div>
			<div class="is_2021">
			<div class="subject_box">
				<dl class="subject_box__head">
					<dt class="subject_box__label">授業形式</dt>
					<dd class="subject_box__cont">
					<?php
					$class_types = get_field('subject_class')['subject_class_type'];
					// print_r($class_types);
					if($class_types) {
						foreach( $class_types as $class_type ) {
							echo $class_type.'<br>';
						}
					}
					if(get_field('subject_class')['subject_class_other']) {
						echo '（'.get_field('subject_class')['subject_class_other'].'）';
					}
					?>
					</dd>
				</dl>
			</div>
			</div>
			<div class="subject_box">
				<dl class="subject_box__head">
					<dt class="subject_box__label">出欠</dt>
					<dd class="subject_box__cont">
					<?php
						$attendances = get_field('subject_attendance');
						if($attendances) {
							foreach( $attendances as $attendance ) {
								echo $attendance.'<br>';
							}
						}
					?>
					</dd>
				</dl>
			</div>
			<div class="is_2021">
			<div class="subject_box">
				<dl class="subject_box__head">
					<dt class="subject_box__label">小テスト</dt>
					<dd class="subject_box__cont">
					<?php
					$mini_tests = get_field('subject_mini_test')['subject_mini_test_count'];
					if($mini_tests) {
						foreach( $mini_tests as $mini_test ) {
							echo $mini_test.'<br>';
						}
					}
					$subject_mini_test_difficulties = get_field('subject_mini_test')['subject_mini_test_difficulty'];
					if($subject_mini_test_difficulties) {
						foreach( $subject_mini_test_difficulties as $subject_mini_test_difficulty ) {
							echo $subject_mini_test_difficulty.'<br>';
						}
					}
					?>

					</dd>
				</dl>
			</div>
			<div class="subject_box">
				<dl class="subject_box__head">
					<dt class="subject_box__label">教材</dt>
					<dd class="subject_box__cont">
					<?php
						$materials = get_field('subject_material');
						if($materials) {
							foreach( $materials as $material ) {
								echo $material.'<br>';
							}
						}
					?>
					</dd>
				</dl>
			</div>
			</div>
			<section class="subject_box">
				<h1 class="subject_box__title"><i class="icon icon--wom"></i>口コミ・感想</h1>
				<div>
					<?php
					// 値がある場合
					// fieldが空でも、配列自体は生成されてるので、配列の1つ目の要素が空白かどうかをチェック
					if(SCF::get( 'subject_wom' )['0']['subject_wom_item'] !== '') {
						echo '<ul class="contribute__grp">';
						foreach ( SCF::get( 'subject_wom' ) as $wom ) {
							echo '<li class="contribute__item">'.esc_html( $wom['subject_wom_item']).'</li>';
						}
						echo '</ul>';
					} else {
						echo '現在口コミ・感想はありません。';
					}
					?>
				</div>
			</section>
			<div class="is_2021">
			<section class="subject_box">
				<h1 class="subject_box__title"><i class="icon icon--advice"></i>コツ・アドバイス</h1>
				<div>
					<?php
					// 値がある場合
					// fieldが空でも、配列自体は生成されてるので、配列の1つ目の要素が空白かどうかをチェック
					if(SCF::get( 'subject_advice' )['0']['subject_advice_item'] !== '') {
						echo '<ul class="contribute__grp">';
						foreach ( SCF::get( 'subject_advice' ) as $adv ) {
							echo '<li class="contribute__item">'.esc_html( $adv['subject_advice_item']).'</li>';
						}
						echo '</ul>';
					} else {
						echo '現在コツ・アドバイスはありません。';
					}
					?>
				</div>
			</section>
			</div>
		</div>

</div>
<div class="searchbox">
	<div class="wrapper">
		<?php display_search_form('subject', 'キーワードから探す'); ?>
	</div>
</div>
<?php
	$title = the_title('','',false);

	if (strpos($title, '2021') !== false) {
		echo '<style>';
		echo '.is_2021 {';
		echo 'display: none !important;';
		echo '}';
		echo '</style>';
	}
?>
<?php get_template_part('include/search-box-subject'); ?>