<li class="card__item">
	<a class="card__item__link" href="<?php echo get_permalink();?>">
		<?php display_faculty_shorten_icon(get_the_ID()); ?>
		<figure class="card__item__fig card__item__fig--chart">
			<canvas class="radar_chart" data-module="<?php echo get_subject_module(get_the_ID());?>" data-record="<?php echo get_subject_record(get_the_ID());?>" data-interest="<?php echo get_subject_interest(get_the_ID());?>" width="200" height="173"></canvas>
		</figure>
		<div class="card__item__labels card__item__labels--subject">
			<div class="card__item__title"><?php the_title(); ?></div>
			<div class="card__item__subtitle"><?php display_teachers(get_the_ID(), false); ?></div>
			<div class="card__item__sub_bottom">
				<div class="starbox">
					<div class="starbox__rate">
						<div class="starbox__rate_active" data-star-point="<?php echo get_subject_eval(get_the_ID());?>"></div>
					</div>
				</div>
				<div class="card__cta"><span>口コミをチェック</span></div>
			</div>
		</div>
	</a>
</li>