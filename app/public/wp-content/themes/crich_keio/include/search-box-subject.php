	<div class="search_subject">
		<form method="get" action="<?php echo home_url('/'); ?>">
			<input type="hidden" name="post_type" value="subject">
			<input type="hidden" name="s">
			<div class="search_subject__box">
				<div class="search_subject__box__title js-togglebtn">学部・ジャンルから探す</div>
				<div class="js-togglecont search_subject__box__cont">
						<?php
						// タームリスト 表示。引数はtaxonomy
						display_search_categories('subject_faculty', true, true, false);
						?>
				</div>
			</div>
			<div class="search_subject__box">
				<div class="search_subject__box__title js-togglebtn">特徴から探す</div>
				<div class="js-togglecont search_subject__box__cont">
					<?php
						// タームリスト 表示。引数はtaxonomy
						display_search_categories('subject_feature', false, false, false);
						?>
				</div>
			</div>
			<ul class="btnarea btnarea--center pt20">
				<li class="btnwrapper">
					<button class="btn btn--normal"><span>検索する</span></button>
				</li>
			</ul>
		</form>
	</div><!-- // .search_subject -->