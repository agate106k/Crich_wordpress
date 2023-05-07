<?php
get_header();
?>
<div class="l-content">
	<section class="content">
		<div class="content__head">
			<h1 class="content__title content__title--icon"><?php the_title(); ?></h1>
		</div>
		<div class="wrapper">
<?php
while ( have_posts() ) : the_post();
	the_content();
endwhile;
?>
		</div>
	</section>

</div><!-- // .l-content -->
<?php
get_footer();
?>