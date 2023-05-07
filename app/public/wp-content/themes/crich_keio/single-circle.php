<?php
get_header();
?>

<div class="l-content">
	<section class="entry">
		<header class="circle_head">
			<?php
				if(get_field('circle_type')):
					echo '<div class="circle_head__faculty">'.get_field('circle_type').'</div>';
				endif;
			?>
			<h1 class="circle_head__title"><?php the_title(); ?></h1>
		</header>
		<?php
		if(SCF::get('circle_photo')['0']['circle_photo_item'] !== '') {
			echo '<div class="carousel carousel--circle_single s-hidden">';
			echo '<ul class="carousel__grp js-slide">';
			foreach( SCF::get('circle_photo') as $photo ) {
		?>
			<li class="carousel__item">
				<div class="carousel__link">
					<div class="figure carousel__fig"><?php echo wp_get_attachment_image($photo['circle_photo_item'], 'carousel');?></div>
				</div>
			</li>
		<?php
			}
			echo '</ul>';
			echo '</div>';
		}
		?>
		<main class="circle_body">
			<?php
			$photos = SCF::get('circle_news');
			if(SCF::get('circle_news')['0']['circle_news_date'] !== '') {
				echo '<section class="content">';
				echo '<div class="content__head content__head--s"><h2 class="circle_message__title"><i class="icon icon--bell"></i>新着情報</h2></div>';
				echo '<div class="circle_news">';
				echo '<ul class="news__grp">';
				foreach( SCF::get('circle_news') as $news ) {
			?>
				<li class="news__item">
					<time class="news__time" datetime="2021-04-15">
						<i class="icon icon--time"></i>
						<?php echo $news['circle_news_date']; ?>
					</time>
					<?php echo nl2br($news['circle_news_body']); ?>
				</li>
			<?php
				}
				echo '</ul>';
				echo '</div>';
				echo '</section>';
			}
			?>

			<?php
				if(get_field('circle_catch_copy')):
					echo '<div class="circle_catch">'.get_field('circle_catch_copy').'</div>';
				endif;
			?>
			<div class="circle_desc">
				<?php the_content(); ?>
			</div>
			<section class="content">
				<div class="content__head">
					<h1 class="content__title content__title--icon">雰囲気</h1>
				</div>
				<div class="circle_ambience">
					<dl class="ambience_box">
						<dt class="ambience_box__label">活動の<br>真剣さ</dt>
						<dd class="ambience_box__score">
							<div class="ambience_box__unit">ゆるい</div>
							<div class="ambience_box__rate">
								<?php
									display_ambience_score(get_the_ID(), 'circle_seriousness');
								?>
							</div>
							<div class="ambience_box__unit">真剣</div>
						</dd>
					</dl>
					<dl class="ambience_box">
						<dt class="ambience_box__label">上下関係</dt>
						<dd class="ambience_box__score">
							<div class="ambience_box__unit">ゆるい</div>
							<div class="ambience_box__rate">
								<?php
									display_ambience_score(get_the_ID(), 'circle_hierarchical');
								?>
							</div>
							<div class="ambience_box__unit">ちゃんとしている</div>
						</dd>
					</dl>
					<dl class="ambience_box">
						<dt class="ambience_box__label">兼サーの<br>しやすさ</dt>
						<dd class="ambience_box__score">
							<div class="ambience_box__unit">しにくい</div>
							<div class="ambience_box__rate">
								<?php
									display_ambience_score(get_the_ID(), 'circle_multi');
								?>
							</div>
							<div class="ambience_box__unit">しやすい</div>
						</dd>
					</dl>
					<dl class="ambience_box">
						<dt class="ambience_box__label">仲のよさ</dt>
						<dd class="ambience_box__score">
							<div class="ambience_box__unit">うーん</div>
							<div class="ambience_box__rate">
								<?php
									display_ambience_score(get_the_ID(), 'circle_friendship');
								?>
							</div>
							<div class="ambience_box__unit">仲良し</div>
						</dd>
					</dl>
					<dl class="ambience_box">
						<dt class="ambience_box__label">例年の<br>食事会の<br>頻度</dt>
						<dd class="ambience_box__score">
							<div class="ambience_box__unit">少ない</div>
							<div class="ambience_box__rate">
								<?php
									display_ambience_score(get_the_ID(), 'circle_meal_times');
								?>
							</div>
							<div class="ambience_box__unit">多い</div>
						</dd>
					</dl>
				</div>
			</section>
			<section class="content">
				<div class="content__head">
					<h1 class="content__title content__title--icon">基本情報</h1>
				</div>
				<div class="circle_info">
					<table class="circle_table">
						<tr>
							<th>団体名</th>
							<td>
								<?php the_title(); ?>
								<?php
									if(get_field('circle_kana')):
										echo '<div class="small">'.get_field('circle_kana').'</div>';
									endif;
								?>
							</td>
						</tr>
						<tr>
							<th>所属</th>
							<td>
								<?php
									if(get_field('circle_type')):
										echo get_field('circle_type');
									endif;
								?>
							</td>
						</tr>
						<tr>
							<th>人数</th>
							<td><?php
									if(get_field('circle_num_op')):
										echo get_field('circle_num_op');
									endif;
								?>
							</td>
						</tr>
						<tr>
							<th>活動場所</th>
							<td><?php
									if(get_field('circle_place')):
										echo get_field('circle_place');
									endif;
								?></td>
						</tr>
						<tr>
							<th>活動日数</th>
							<td><?php
									if(get_field('circle_date')):
										echo get_field('circle_date');
									endif;
								?></td>
						</tr>
						<tr>
							<th>入会費・会費</th>
							<td>入会金：<?php
									if(get_field('circle_entry_cost')):
										echo get_field('circle_entry_cost');
									endif;
								?>
								<br>
								会費：
								<?php
									if(get_field('circle_running_cost')):
										echo get_field('circle_running_cost');
									endif;
								?>
							</td>
						</tr>
						<tr>
							<th>初期費用</th>
							<td><?php
									if(get_field('circle_initial_cost')):
										echo get_field('circle_initial_cost');
									endif;
								?></td>
						</tr>
						<tr>
							<th>合宿回数</th>
							<td><?php
									if(get_field('circle_num_training')):
										echo get_field('circle_num_training');
									endif;
								?></td>
						</tr>
					</table>
				</div>
			</section>
			<section class="content">
				<div class="content__head">
					<h1 class="content__title content__title--icon">入会を希望される方へ</h1>
				</div>
				<section class="circle_message">
					<h2 class="circle_message__title"><i class="icon icon--message"></i>新入生へのメッセージ</h2>
					<div class="circle_message__body">
						<?php
							if(get_field('circle_msg_for_new')) {
								echo '<p>'.nl2br(get_field('circle_msg_for_new')).'</p>';
							} else {
								echo 'ただいまメッセージはありません。';
							}
						?>
					</div>
				</section>
				<div class="circle_message">
					<h2 class="circle_message__title"><i class="icon icon--message"></i>途中入会を検討している学生へ</h2>
					<div class="circle_message__body">
						<?php
							if(get_field('circle_msg_for_old')) {
								echo '<p>'.nl2br(get_field('circle_msg_for_old')).'</p>';
							} else {
								echo 'ただいまメッセージはありません。';
							}
						?>
					</div>
				</div>
				<div class="circle_message">
					<h2 class="circle_message__title"><i class="icon icon--join"></i>入会方法</h2>
					<div class="circle_message__body">
						<?php
							if(get_field('circle_way_of_entry')) {
								echo '<p>'.nl2br(get_field('circle_way_of_entry')).'</p>';
							} else {
								echo 'まだ入会方法が入力されていません。';
							}
						?>
					</div>
				</div>
			</section>
			<div class="circle_media">
				<table class="circle_media__table">
					<?php
						if(get_field('circle_hp_url')):
					?>
					<tr>
						<th>
							<div class="circle_media__icon circle_media__icon--hp"><img src="/img/icon_www_white.svg" alt="web site"></div>
						</th>
						<td><a href="<?php echo get_field('circle_hp_url'); ?>" target="_blank" rel="nofollow noopener"><?php echo get_field('circle_hp_url'); ?></a></td>
					</tr>
					<?php
						endif;
					?>

					<?php
						if(get_field('circle_twitter_id')):
					?>
					<tr>
						<th>
							<div class="circle_media__icon circle_media__icon--tw"><i class="fa fa-twitter" aria-hidden="true"></i></div>
						</th>
						<td><a href="https://twitter.com/<?php echo get_field('circle_twitter_id'); ?>" target="_blank" rel="nofollow noopener"><?php echo get_field('circle_twitter_id'); ?></a></td>
					</tr>
					<?php
						endif;
					?>

					<?php
						if(get_field('circle_instagram_id')):
					?>
					<tr>
						<th>
							<div class="circle_media__icon circle_media__icon--instagram"><i class="fa fa-instagram" aria-hidden="true"></i></div>
						</th>
						<td><a href="https://www.instagram.com/<?php echo get_field('circle_instagram_id'); ?>" target="_blank" rel="nofollow noopener"><?php echo get_field('circle_instagram_id'); ?></a></td>
					</tr>
					<?php
						endif;
					?>
				</table>
			</div>
			<div class="circle_taxonomy">
				<div class="circle_taxonomy__label">ジャンル</div>
				<div class="circle_taxonomy__terms">
					<?php display_circle_category(get_the_ID()); ?>
				</div>
				<div class="circle_taxonomy__label">キャンパス</div>
				<div class="circle_taxonomy__terms">
					<?php display_circle_campus(get_the_ID()); ?>
				</div>
				<div class="circle_taxonomy__label">こだわりタグ</div>
				<div class="subject_tag">
					<?php display_circle_feature_tags(get_the_ID()); ?>
				</div>
			</div>
		</main>
	</section>
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