<?php
get_header();
?>

<div class="l-content">
	<section class="content">
		<div class="content__head">
			<h1 class="content__title">ジャンルが「<?php echo single_term_title("", false);?>」のサークル</h1>
		</div>
		<div class="wrapper">
			<?php
			display_circle_list('circle_category');
			?>
		</div>
	</section>
</div>
<!-- //.l-content-->
<?php
get_footer();
?>