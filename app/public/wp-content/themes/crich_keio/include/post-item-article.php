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
				<time datetime="<?php echo get_the_date('Y-n-j'); ?>"><i class="icon icon--time"></i><?php echo get_the_date('Y年n月j日'); ?></time>
			</div>
			<div class="card__item__title"><?php the_title(); ?></div>
		</div>
	</a>
</li>