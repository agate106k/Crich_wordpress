<?php
get_header();
?>
<div class="l-content">
<?php
while ( have_posts() ) : the_post();
	the_content();
endwhile;
?>
</div><!-- // .l-content -->
<?php
get_footer();
?>