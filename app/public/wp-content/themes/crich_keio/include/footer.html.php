<div class="l-footer">
	<div class="footer__inner">
		<div class="logobox logobox--footer"><a href="/"><img class="logo__item" src="/img/logo.png" alt="<?php echo COMPANY_NAME; ?>"/></a></div>
		<aside class="footer__social">
			<h1 class="footer__social__title">Follow Us</h1>
			<ul class="social__grp">
				<?php if(defined('URL_FACEBOOK')): ?>
				<li class="social__item"><a class="social__link social__link--fb" href="<?php echo URL_FACEBOOK; ?>" target="_blank"><i class="fa fa-facebook-f" aria-hidden="true"></i></a></li>
				<?php endif; ?>
				<?php if(defined('URL_TWITTER')): ?>
				<li class="social__item"><a class="social__link social__link--tw" href="<?php echo URL_TWITTER; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<?php endif; ?>
				<?php if(defined('URL_INSTAGRAM')): ?>
				<li class="social__item"><a class="social__link social__link--instagram" href="<?php echo URL_INSTAGRAM; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<?php endif; ?>
			</ul>
		</aside>
		<div class="footer__textlink">
			<ul class="footer__textlink__grp">
				<li class="footer__textlink__item"><a class="footer__textlink__link" href="<?php echo URL_PRIVACY; ?>">プライバシーポリシー</a></li>
				<li class="footer__textlink__item"><a class="footer__textlink__link" href="<?php echo URL_TERMS; ?>">ご利用規約</a></li>
				<li class="footer__textlink__item"><a class="footer__textlink__link" href="<?php echo URL_CONTACT;?>" target="_blank">お問い合わせ</a></li>
				<li class="footer__textlink__item"><a class="footer__textlink__link" href="<?php echo URL_CONTACT_CIRCLE;?>" target="_blank">掲載をご希望のサークルの方へ</a></li>
				<li class="footer__textlink__item"><a class="footer__textlink__link" href="<?php echo URL_CONTACT_BUSINESS;?>" target="_blank">掲載をご希望の企業の方へ</a></li>
			</ul>
		</div>
	</div>
	<div class="footer__copyright"><span>Copyright © <?php echo COMPANY_NAME; ?> All rights reserved.</span></div>
	<div class="btnpagetop"><a class="js-btnpagetop btnpagetop__link" href="#"></a></div>
</div>