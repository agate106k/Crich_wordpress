<?php
/*
Template Name: form
*/
get_header();
?>
<div class="l-content">
	<div class="bg--gray">
		<section class="content">

			<div class="wrapper">
				<div class="form_content">
	<?php
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
	?>
				</div>
			</div>
		</section>
		</div>
</div><!-- // .l-content -->
<?php
get_footer();
?>