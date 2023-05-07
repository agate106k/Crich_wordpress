<?php
if (isset($_COOKIE['univ'])) {
	// topページで大学を選択していたらcookieを読み取ってその大学へ遷移させる
	$url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_COOKIE['univ'];
	header('Location: ' . $url);
	exit;
} else {

define('WP_USE_THEMES', false);
require(dirname(__FILE__) . '/keio/wp/wp-load.php');
?>
<!DOCTYPE html>
<html lang="ja">
	<head prefix="og: http://ogp.me/ns#  article: http://ogp.me/ns/website#">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Crich</title>
		<meta name="description" content="Campusライフを、よりrichに。豊かな人間性は豊かな経験に基づきます。私たちは学生生活で得られる経験をより豊かにすることで、豊かな人間性を持った人たちの溢れる社会を実現します。">
		<meta name="copyright" content="Crich">
		<link rel="shortcut icon" href="favicon.ico">
		<meta property="og:type" content="website">
		<meta property="og:title" content="Crich">
		<meta property="og:description" content="Campusライフを、よりrichに。豊かな人間性は豊かな経験に基づきます。私たちは学生生活で得られる経験をより豊かにすることで、豊かな人間性を持った人たちの溢れる社会を実現します。">
		<meta property="og:url" content="https://crich-media.com/">
		<meta property="og:image" content="https://crich-media.com/keio/img/og_image.jpg">
		<meta property="og:site_name" content="Crich">
		<meta name="viewport" content="width=device-width">
		<meta name="format-detection" content="telephone=no">
		<link href="/css/style.min.css?v1.0.2" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>

		<div class="l-content">
			<div class="home">
				<header class="home_head">
					<div class="home_head__inner">
						<h1 class="home_head__logo"><img src="/img/logo.png" alt="Crich"></h1>
						<h2 class="home_head__copy">大学生のための情報支援サイト</h2>
					</div>
				</header>
				<div class="home_univ_list">
					<div class="home_univ_list__copy">閲覧したい大学をお選びください</div>
					<ul class="btnarea btnarea--center pb30">
						<li class="btnwrapper"><a class="btn btn--normal btn--shadow js-choose-univ" href="/keio/"><span>慶應義塾大学</span></a></li>
						<?php
							date_default_timezone_set('Asia/Tokyo');
							if (strtotime(date('Y-m-d H:i')) >= strtotime('2021-03-20 18:00')) { ?>
						<li class="btnwrapper"><a class="btn btn--normal btn--shadow js-choose-univ" href="/waseda/"><span>早稲田大学</span></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<!-- //.l-content-->
<?php
get_footer();

}
?>