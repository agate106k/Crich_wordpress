<?php
get_header();
?>

<div class="l-content">
	<div class="entry entry--article">

		<?php
			if (has_post_thumbnail()){
				echo ' <figure class="entry_ic">';
				$altName = get_the_title();
				the_post_thumbnail(
					'carousel',
					array(
						'alt' => $altName
					)
				);
				echo '</figure>';
			}
		?>
		<header class="entry_head">
			<div class="entry_head__cont">
				<time class="entry_head__time"><i class="icon icon--time"></i><?php echo get_the_date('Y年n月j日') ?></time>
				<h1 class="entry__title"><?php the_title(); ?></h1>
			</div>

			<div class="entry_author">
				<figure class="entry_author__photo"><?php echo get_avatar( get_the_author_meta('email'), 160, '', '', array('class' => 'profilebox__avatar__item') ); ?></figure>
				<div class="entry_author__name"><?php echo get_userdata($post->post_author) -> display_name; ?></div>
			</div>

			<div class="socialmedia">
				<ul class="socialmedia__grp">
					<li class="socialmedia__item"><a href="http://www.facebook.com/share.php?u=<?php echo the_permalink();?>" target="_blank" class="socialmedia__btn socialmedia__btn--fb"><i class="fa fa-facebook-f" aria-hidden="true"></i></a></li>
					<li class="socialmedia__item"><a class="socialmedia__btn socialmedia__btn--tw" <?php if(defined('TWITTER_ACCOUNT')){ echo 'data-via="'. TWITTER_ACCOUNT .'"'; } ?> target="_blank" href="https://twitter.com/share?text=<?php echo the_title();?>&amp;url=<?php echo the_permalink();?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li class="socialmedia__item"><a class="socialmedia__btn socialmedia__btn--line" href="https://timeline.line.me/social-plugin/share?url=<?php echo the_permalink();?>"><img src="/img/icon_line.svg"></a></li>
				</ul>
			</div>
		</header>

		<?php
			if(get_field('article_summary')):
				echo '<div class="entry_summary">'.get_field('article_summary').'</div>';
			endif;
		?>

		<div class="entry_body">
			<?php the_content(); ?>
		</div>
	</div>

	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">新着記事</h1>
		</div>
		<div class="wrapper">
			<div class="pb30">
				<?php
					$args = array(
						'post_type' => 'article', //カスタム投稿名
						'posts_per_page'=> 8 //表示件数（-1で全ての記事を表示）
					);
					query_posts( $args );
					if(have_posts()):
						echo '<ul class="card__grp card__grp--mlist">';
						while(have_posts()) : the_post();
							get_template_part( 'include/post-item-article');
						endwhile;
						echo '</ul>';
					endif;
				?>
			</div>
		</div>
	</section>

	<aside class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon">カテゴリ</h1>
		</div>
		<div class="wrapper">
			<?php get_template_part('include/article-category-list'); ?>
		</div>
	</aside>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>