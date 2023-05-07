
<head prefix="og: http://ogp.me/ns#  article: http://ogp.me/ns/website#">
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<?php get_template_part('include/trakingcode_in_start_head.html');echo "\n"; ?>
	<title><?php
	if(isset($non_wp_title)) {
		echo $non_wp_title; // WPのテーマの外でタイトルを設定してある場合
	} elseif(get_the_title()) {
			wp_title('|', true, 'right'); bloginfo('name');
	} else {
		bloginfo('name');
	} ?></title>

<?php
// descriptionの設定
if(isset($non_wp_description)) {
	$description = $non_wp_description;
	echo '	<meta name="description" content="'. $description . '" />';echo "\n"; // WPのテーマの外で設定してある場合
}elseif (is_singular() && ! is_archive() && ! is_front_page() && ! is_home()){//投稿ページ、固定ページの場合
	if(have_posts()) {
		while(have_posts()): the_post();
			$description = mb_substr(get_the_excerpt(), 0, 120);//抜粋を表示
			echo '	<meta name="description" content="'. $description . '" />';echo "\n";
		endwhile;
	}
} elseif (is_home()){
	$description = get_bloginfo('description');//「一般設定」管理画面で指定したブログの説明文を表示
	echo '	<meta name="description" content="'. $description . '" />';echo "\n";
} else {
	$description = get_bloginfo('description');//「一般設定」管理画面で指定したブログの説明文を表示
	echo '	<meta name="description" content="'. $description . '" />';echo "\n";
}
?>

	<meta name="copyright" content="<?php echo COMPANY_NAME; ?>">
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
	<meta property="og:type" content="website"/>
<?php
//og:description & og:title & og:url 設定
if(isset($non_wp_title)) {
	// // WPのテーマの外で設定してある場合
	echo '	<meta property="og:description" content="'. $description .'">';echo "\n";//「一般設定」管理画面で指定したブログの説明文を表示
	echo '	<meta property="og:title" content="'; echo $non_wp_title.' | '. get_bloginfo('name') .'">';echo "\n";//「一般設定」管理画面で指定したブログのタイトルを表示
	echo '	<meta property="og:url" content="'; echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; echo '">';echo "\n";//「一般設定」管理画面で指定したブログのURLを表示
} elseif (is_single()){//単一記事ページの場合
	if(have_posts()): while(have_posts()): the_post();
		echo '	<meta property="og:description" content="'. $description .'" />';echo "\n";//抜粋を表示
	endwhile; endif;
	echo '	<meta property="og:title" content="'; the_title(); echo '">';echo "\n";//単一記事タイトルを表示
	echo '	<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";//単一記事URLを表示
} elseif (is_page()) {//固定ページの場合
	echo '	<meta property="og:description" content="'. $description .'" />';echo "\n";//抜粋を表示
	echo '	<meta property="og:title" content="'; wp_title('|', true, 'right'); bloginfo('name'); echo '">';echo "\n";//単一記事タイトルを表示
	echo '	<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";//単一記事URLを表示
} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
	echo '	<meta property="og:description" content="'. $description .'">';echo "\n";//「一般設定」管理画面で指定したブログの説明文を表示
	echo '	<meta property="og:title" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのタイトルを表示
	echo '	<meta property="og:url" content="'; bloginfo('url'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのURLを表示
}

// og:image 設定
if(is_404() == false ){
	$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿にイメージがあるか調べる
	if (is_single()){//単一記事ページの場合
		$str = $post->post_content;
		if (has_post_thumbnail()){//投稿にサムネイルがある場合の処理
			$image_id = get_post_thumbnail_id();
			$image = wp_get_attachment_image_src( $image_id, 'ogimage');
			echo '	<meta property="og:image" content="'.$image[0].'">';echo "\n";
		} else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//投稿にサムネイルは無いが画像がある場合の処理
				echo '	<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
		} else {//投稿にサムネイルも画像も無い場合の処理
			echo '	<meta property="og:image" content="'. home_url().'/Users/hayashihirofumi/Local Sites/crichmediadev/app/img/og_image.jpg">';echo "\n";
		}
	} elseif(is_page()){//固定ページの場合
		$str = $post->post_content;
		if (has_post_thumbnail()){//投稿にサムネイルがある場合の処理
			$image_id = get_post_thumbnail_id();
			$image = wp_get_attachment_image_src( $image_id, 'ogimage');
			echo '	<meta property="og:image" content="'.$image[0].'">';echo "\n";
		} else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//投稿にサムネイルは無いが画像がある場合の処理
			echo '	<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
		} else {//投稿にサムネイルも画像も無い場合の処理
			echo 	'<meta property="og:image" content="'. home_url().'/Users/hayashihirofumi/Local Sites/crichmediadev/app/img/og_image.jpg">';echo "\n";
		}
	} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
		echo '	<meta property="og:image" content="'. home_url().'/Users/hayashihirofumi/Local Sites/crichmediadev/app/img/og_image.jpg">';echo "\n";
	}
}
?>
<?php if(defined('TWITTER_ACCOUNT')): ?>
	<meta name="twitter:site" content="<?php echo TWITTER_ACCOUNT; ?>">
<?php endif; ?>
	<meta name="twitter:card" content="summary">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="viewport" content="width=device-width">
	<meta name="format-detection" content="telephone=no">

<!-- style.min.cssのパスの参照先をローカルのものに変更 20210731localfixed -->
<?php $param = date("YmdHis",filemtime("/Users/hayashihirofumi/Local Sites/crichmediadev/app/public/css/style.min.css")); ?>
	<link href="/css/style.min.css?<?=$param?>" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<?php
wp_head(); //including wp functions.php etc
get_template_part( 'include/trakingcode_in_head.html');echo "\n";
wp_head();
?>
</head>