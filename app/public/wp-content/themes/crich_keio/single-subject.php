<?php
get_header();

// $faculties = get_the_terms($post->ID,'subject_faculty');

// if($faculties) {
// 	foreach( $faculties as $faculty ) {
// 		if(!$faculty->parent) {
// 			$parent_faculty = $faculty->name;
// 		} else {
// 			$child_faculty = $faculty->name;
// 		}
// 	}
// }
?>
<div class="l-content">

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php if (is_user_logged_in()) : ?>

			<?php get_template_part('include/subject-content'); ?>

		<?php else ://ログインしてない場合 ?>

			<div class="wrapper">
				<div class="form_content">
					<?php the_content();?>
				</div>
			</div>

		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>


</div>
<!-- //.l-content-->
<?php
get_footer();
?>