	<div class="search_subject">
		<form method="get" action="<?php echo home_url('/'); ?>">
			<input type="hidden" name="post_type" value="circle">
			<input type="hidden" name="s">
			<div class="search_subject__box">
				<div class="search_subject__box__title js-togglebtn on">ジャンルから探す</div>
				<div class="js-togglecont search_subject__box__cont" style="display:none;">
					<?php
					// サークルのタームリスト 表示。引数はtaxonomy。第二引数はサブカテゴリを持つかどうか。
					display_search_categories('circle_category', true, true, false);
					?>
				</div>
			</div>
			<div class="search_subject__box">
				<div class="search_subject__box__title js-togglebtn on">キャンパスから探す</div>
				<div class="js-togglecont search_subject__box__cont" style="display:none;">
					<?php
					// サークルのタームリスト 表示。引数はtaxonomy
					display_search_categories('circle_campus', false, false, false);
					?>
				</div>
			</div>
			<div class="search_subject__box">
				<div class="search_subject__box__title js-togglebtn on">こだわりから探す</div>
				<div class="js-togglecont search_subject__box__cont" style="display:none;">
					<?php
					// サークルのタームリスト 表示。引数はtaxonomy
					display_search_categories('circle_feature');
					?>
				</div>
			</div>
			<ul class="btnarea btnarea--center pt20">
				<li class="btnwrapper">
					<button class="btn btn--normal"><span>検索する</span></button>
				</li>
			</ul>
		</form>
	</div>