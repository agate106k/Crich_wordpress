<li class="card__item">
	<a class="card__item__link" href="<?php echo get_permalink();?>">
		<figure class="card__item__fig">
			<?php
				if(SCF::get('circle_photo')['0']['circle_photo_item'] !== '') {
					// 1枚目の写真を表示
					echo wp_get_attachment_image(SCF::get('circle_photo')['0']['circle_photo_item'], 'thumbsnail');
				} else {
					echo '<img src="/img/no_image.png" alt="no image">';
				}
			?>
		</figure>
		<div class="card__item__labels">
			<div class="card__item__title"><?php the_title(); ?></div>
			<?php
				if(get_field('circle_catch_copy')):
					echo '<div class="card__item__subtitle">'.get_field('circle_catch_copy').'</div>';
				endif;
			?>
		</div>
	</a>
</li>