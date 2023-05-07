
<header class="l-header" id="head">
	<div class="header__main">
		<div class="logobox"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo__item" src="/img/logo.png" alt="Crich"/></a></div>
		<nav class="mainnav">
			<ul class="mainnav__grp">
				<!-- 履修情報入力ページ追加 -->
				<li class="mainnav__item"><a class="mainnav__link" href="<?php echo esc_url( home_url( '/search-syllabus' ) ); ?>"><span class="mainnav__label">履修情報入力</span></a></li>
				<li class="mainnav__item"><a class="mainnav__link" href="<?php echo esc_url( home_url( '/subject' ) ); ?>"><span class="mainnav__label">履修情報</span></a></li>
				<li class="mainnav__item"><a class="mainnav__link" href="<?php echo esc_url( home_url( '/circle' ) ); ?>"><span class="mainnav__label">サークル</span></a></li>
				<li class="mainnav__item"><a class="mainnav__link" href="<?php echo esc_url( home_url( '/article' ) ); ?>"><span class="mainnav__label">まとめ</span></a></li>
			<?php
			if(is_user_logged_in()){
				// ログイン中
			?>
				<li class="mainnav__item"><a class="mainnav__link" href="<?php echo esc_url( home_url( '/logout' ) ); ?>"><span class="mainnav__label">ログアウト</span></a></li>

			<?php
			} else {
				// ログインしてない
			?>
				<li class="mainnav__item"><a class="mainnav__link mainnav__link--regist" href="<?php echo esc_url( home_url( '/regist' ) ); ?>"><span class="mainnav__label">登録<br class="s-pchidden"/>（無料）</span></a></li>
				<li class="mainnav__item"><a class="mainnav__link mainnav__link--login" href="<?php echo esc_url( home_url( '/login' ) ); ?>"><span class="mainnav__label">ログイン</span></a></li>

			<?php
			}
			?>
			</ul>
		</nav>
	</div>
</header>
<div class="headermg"></div>

<?php
// if(is_user_logged_in()){
// 	echo 'ログイン中';
// }  else {
// 	echo 'ログインしてない';
// }
?>