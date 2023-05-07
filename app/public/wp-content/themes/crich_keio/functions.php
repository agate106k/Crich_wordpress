<?php

// 履修情報を公開するかどうか
$is_opened_subject = true;

// URL setting
define('URL_PRIVACY', '/privacy/'); // 個人情報保護方針
define('URL_TERMS', '/term/'); // 利用規約
define('URL_CONTACT', 'https://forms.gle/MuvxLVvCX7tq66iT7'); // お問い合わせ
define('URL_CONTACT_CIRCLE', 'https://forms.gle/JxrSn21ZQTEGPa6q9'); // 掲載をご希望のサークルの方へ
define('URL_CONTACT_BUSINESS', 'https://forms.gle/94stLS7HyU7NgCDf8'); // 掲載をご希望の企業の方へ
// social media
define('URL_FACEBOOK', 'https://www.facebook.com/Crich-350315816055309/'); // Facebook page
define('URL_TWITTER', 'https://twitter.com/@Crichmedia_2021'); // Twitter url
define('URL_INSTAGRAM', 'https://www.instagram.com/crich_gourmet/'); // Instagram url
define('TWITTER_ACCOUNT', '@Crichmedia_2021'); // Twitter Account
// company
define('COMPANY_NAME', 'Crich');

// 大学固有 複製時に変更すること
define('UNIV_DIR', '/keio'); // 大学のディレクトリ

//eyeCatch表示
add_theme_support('post-thumbnails');
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'cover', 1200, 600, true );
	add_image_size( 'carousel', 1200, 900, true );
	add_image_size( 'thumbsnail', 450, 282, true );
	// add_image_size( 'company_logo', 210, 210, true );
	// add_image_size( 'card_index_vertical', 274, 323, true );
	// add_image_size( 'sigle_cover', 774, 387, true );
}
//headerからWPのバージョンを削除
remove_action('wp_head','wp_generator');
//js, cssからWPバージョン削除
function remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );

//ver4.4から実装されたレスポンシブイメージを停止。IEで動かないため。
function disable_srcset( $sources ) { return false; }
add_filter( 'wp_calculate_image_srcset', 'disable_srcset' );
// 投稿のフォーマットを「テキスト」にする
// add_filter( 'wp_default_editor', create_function( '', 'return "html";' ) );
//head内の整理
remove_action('wp_head','wp_generator');//headerからWPのバージョンを削除
remove_action('wp_head', 'rsd_link');//EditURIを削除
remove_action('wp_head', 'wlwmanifest_link');//wlwmanifestを削除
remove_action('wp_head', 'wp_shortlink_wp_head',10, 0 );//shortlinkを削除
remove_action('wp_head', 'wp_enqueue_scripts', 1 );//WPデフォルトのjsとcssを削除
remove_action('wp_head', 'rel_canonical'); // canonical 削除
//embed機能を削除
add_filter('embed_oembed_discover', '__return_false');
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
//ログイン画面のロゴを変更
function custom_login_logo() { ?>
	<style>
		.login #login h1 a {
			width: 300px;
			height: 188px;
			background: url(/img/logo.png) no-repeat 0 0;
			background-size: 50%;
			background-position: center;
		}
		.login {
			background: #fff;
			/*background-size: cover;*/
		}
		.login #backtoblog a, .login #nav a {
			color: #000 !important;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_logo' );
//ログイン画面のロゴのリンク先を変更
function custom_login_logo_url() {
	// return 'https://onebyone.kesion.com/';
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );
/**
 * 抜粋の末尾に表示される[…]を変更。
 */
function custom_excerpt_more($more) {
	return ' ... ';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );
//固定ページに「抜粋」を追加
add_post_type_support( 'page', 'excerpt' );
//概要（抜粋）の文字数調整
function my_excerpt_length($length) {
	return 120;
}
add_filter('excerpt_length', 'my_excerpt_length');

// カスタム投稿タイプを作成
function custom_post_type(){
	// 履修情報
	$labels = array(
		'name' => _x('履修情報', 'post type general name'),
		'singular_name' => _x('履修情報', 'post type singular name'),
		'add_new' => _x('履修情報を新規追加', 'subject'),
		'add_new_item' => __('新規項目追加'),
		'edit_item' => __('項目を編集'),
		'new_item' => __('新規項目'),
		'view_item' => __('項目を表示'),
		'search_items' => __('項目検索'),
		'not_found' => __('履修情報が見つかりません'),
		'not_found_in_trash' => __('ゴミ箱に履修情報はありません'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'subject/list' ),
		'has_archive' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		// 'taxonomies'=> array('post_tag' ),
		// rest-api用
		'show_in_rest' => true,
  		'rest_base' => 'subject',
		'supports' => array('title','editor','thumbnail','author','revisions','excerpt')
	);
	register_post_type('subject',$args);

	// サークル
	$circle_labels = array(
		'name' => _x('サークル', 'post type general name'),
		'singular_name' => _x('サークル', 'post type singular name'),
		'add_new' => _x('サークルを新規追加', 'circle'),
		'add_new_item' => __('新規項目追加'),
		'edit_item' => __('項目を編集'),
		'new_item' => __('新規項目'),
		'view_item' => __('項目を表示'),
		'search_items' => __('項目検索'),
		'not_found' => __('サークルが見つかりません'),
		'not_found_in_trash' => __('ゴミ箱にサークルはありません'),
		'parent_item_colon' => ''
	);
	$circle_args = array(
		'labels' => $circle_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'circle/list'),
		'has_archive' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		// 'taxonomies'=> array('post_tag' ),
		'supports' => array('title','editor','thumbnail','author','revisions','excerpt')
	);
	register_post_type('circle',$circle_args);

	// まとめ
	$matome_labels = array(
		'name' => _x('まとめ', 'post type general name'),
		'singular_name' => _x('まとめ', 'post type singular name'),
		'add_new' => _x('まとめを新規追加', 'article'),
		'add_new_item' => __('新規項目追加'),
		'edit_item' => __('項目を編集'),
		'new_item' => __('新規項目'),
		'view_item' => __('項目を表示'),
		'search_items' => __('項目検索'),
		'not_found' => __('まとめが見つかりません'),
		'not_found_in_trash' => __('ゴミ箱にまとめはありません'),
		'parent_item_colon' => ''
	);
	$article_args = array(
		'labels' => $matome_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'article'),
		'has_archive' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		// 'taxonomies'=> array('post_tag' ),
		'supports' => array('title','editor','thumbnail','author','revisions','excerpt')
	);
	register_post_type('article',$article_args);

	/**
	* カスタムタクソノミー / 学部
	*/
	 register_taxonomy(
		'subject_faculty',
		'subject',
		array(
			'hierarchical' => true,
			'label' => '学部',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'subject/faculty'),
			'show_in_rest' => true,
			'rest_base' => 'subject_faculty'
		)
	);// 学部/追加ここまで

	/**
	* カスタムタクソノミー / 特徴
	*/
	 register_taxonomy(
		'subject_feature',
		'subject',
		array(
			'hierarchical' => true,
			'label' => '特徴',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'subject/feature'),
			'show_in_rest' => true,
			'rest_base' => 'subject_feature'
		)
	);// 特徴/追加ここまで

	/**
	* カスタムタクソノミー / 教授
	*/
	 register_taxonomy(
		'subject_teacher',
		'subject',
		array(
			'hierarchical' => true,
			'label' => '教授',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'subject/teacher'),
			'show_in_rest' => true,
			'rest_base' => 'subject_teacher'
		)
	);// 教授/追加ここまで

	/**
	* カスタムタクソノミー のリライトルールを変更
	*/
	add_rewrite_rule('subject/faculty/([^/]+)/?$', 'index.php?subject_faculty=$matches[1]', 'top');
	add_rewrite_rule('subject/feature/([^/]+)/?$', 'index.php?subject_feature=$matches[1]', 'top');
	add_rewrite_rule('subject/teacher/([^/]+)/?$', 'index.php?subject_teacher=$matches[1]', 'top');
	/**
	* カスタムタクソノミー / サークルのジャンル
	*/
	 register_taxonomy(
		'circle_category',
		'circle',
		array(
			'hierarchical' => true,
			'label' => 'ジャンル',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'circle/category')
		)
	);// サークルのジャンル/追加ここまで
	/**
	* カスタムタクソノミー / サークル キャンパス
	*/
	 register_taxonomy(
		'circle_campus',
		'circle',
		array(
			'hierarchical' => true,
			'label' => 'キャンパス',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'circle/campus')
		)
	);// サークル キャンパス/追加ここまで
	/**
	* カスタムタクソノミー / サークル こだわり
	*/
	 register_taxonomy(
		'circle_feature',
		'circle',
		array(
			'hierarchical' => false,
			'label' => 'こだわり',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'circle/feature')
		)
	);// サークル こだわり/追加ここまで
	add_rewrite_rule('circle/category/([^/]+)/?$', 'index.php?circle_category=$matches[1]', 'top');
	add_rewrite_rule('circle/campus/([^/]+)/?$', 'index.php?circle_campus=$matches[1]', 'top');
	add_rewrite_rule('circle/feature/([^/]+)/?$', 'index.php?circle_feature=$matches[1]', 'top');

	/**
	* カスタムタクソノミー / まとめのカテゴリ
	*/
	 register_taxonomy(
		'article_category',
		'article',
		array(
			'hierarchical' => true,
			'label' => 'カテゴリー',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'article/category')
		)
	);// まとめのカテゴリ/追加ここまで
	/**
	* カスタムタクソノミー / まとめ タグ
	*/
	 register_taxonomy(
		'article_tag',
		'article',
		array(
			'hierarchical' => false,
			'label' => 'タグ',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'article/tag')
		)
	);// まとめ タグ/追加ここまで
	add_rewrite_rule('article/category/([^/]+)/?$', 'index.php?article_category=$matches[1]', 'top');
	add_rewrite_rule('article/tag/([^/]+)/?$', 'index.php?article_tag=$matches[1]', 'top');

	flush_rewrite_rules(true);
 }
add_action('init', 'custom_post_type');

// 「投稿」を管理画面から削除（標準の投稿は使わない）
function remove_menus() {
	remove_menu_page( 'edit.php', 'edit.php' ); // 投稿 / 投稿一覧.
}
add_action( 'admin_menu', 'remove_menus', 999 );

// 「履修情報」から「本文」削除
function my_remove_post_support() {
	remove_post_type_support('subject','editor');
}
add_action( 'init' , 'my_remove_post_support' );

// カスタムフィールド(ACFではない)を扱えるようにrest-apiを拡張
function slug_register_subject() {
    register_rest_field(
		'subject', //フィールドを追加したいcustom投稿タイプを指定（先ほど登録したカスタム投稿タイプslugを指定）
        'data', // rest-apiに追加するキー
        array(
            'get_callback'  => function(  $object, $field_name, $request  ) {
				// 出力したいカスタムフィールドのキーをここで定義
				$meta_fields = array(
					'subject_wom_item',
					'subject_advice_item'
				);
				$meta = array();
				foreach ( $meta_fields as $field ) {
					// 複数ある可能性のものはfalse(配列にしてとってくる)
					if($field === 'subject_wom_item' || $field === 'subject_advice_item' ) {
						$meta[ $field ] = get_post_meta( $object[ 'id' ], $field, false );
					} else {
						$meta[ $field ] = get_post_meta( $object[ 'id' ], $field, true );
					}
				}
				return $meta;
            },
            'update_callback' => function(  $value, $post, $field_name) {
				if (!$value) {return;}
				foreach($value as $key => $data) {
					if(is_array($data)) {
						foreach($data as $record) {
					  		add_post_meta($post->ID, $key, $record);
						}
				  	} else {
						add_post_meta($post->ID, $key, $data);
					}
				}
			},
            'schema' => null,
        )
    );
}
add_action( 'rest_api_init', 'slug_register_subject' );

// カスタム投稿タイプsubjectにinsertする時カスタムタクソノミーを操作できるようにする
function action_rest_insert_post( $post, $request, $true ) {
    $params = $request->get_json_params();
    if(array_key_exists('terms', $params)) {
        foreach($params['terms'] as $taxonomy => $terms) {
            wp_set_post_terms($post->ID, $terms, $taxonomy);
        }
    }
}
add_action( 'rest_insert_subject', 'action_rest_insert_post', 10, 3 );

// _log()でwp-content内にdebug.logに中身を出力
if(!function_exists('_log')){
    function _log($message) {
        if (WP_DEBUG === true) {
            if (is_array($message) || is_object($message)) {
                error_log(print_r($message, true));
            } else {
                error_log($message);
            }
        }
    }
}

//カテゴリーの選択を1つに制限
function category_radio() {
?>
<script>
jQuery(function($) {
	$('#categorychecklist input[type=checkbox]').each(function() {
		$(this).replaceWith($(this).clone().attr('type', 'radio'));
	});
});
</script>
<?php
}
// add_action( 'admin_head-post-new.php', 'category_radio' );
// add_action( 'admin_head-post.php', 'category_radio' );

// 履修情報 操業評価を取得して返す。
function get_subject_eval($post_id) {
	if(get_field('subject_eval')){
		return get_post_meta($post_id, 'subject_eval', true);
	} else {
		// 空の場合は0を返す
		return 0;
	}
}
// 履修情報 単位取得度を取得して返す。
function get_subject_module($post_id) {
	if(get_field('subject_module')){
		return get_post_meta($post_id, 'subject_module', true);
	} else {
		// 空の場合は0を返す
		return 0;
	}
}
// 履修情報 高評価取得度を取得して返す。
function get_subject_record($post_id) {
	if(get_field('subject_record')){
		return get_post_meta($post_id, 'subject_record', true);
	} else {
		// 空の場合は0を返す
		return 0;
	}
}
// 履修情報 面白さを取得して返す。
function get_subject_interest($post_id) {
	if(get_field('subject_interest')){
		return get_post_meta($post_id, 'subject_interest', true);
	} else {
		// 空の場合は0を返す
		return 0;
	}
}
// 履修情報 特徴を表示
function display_features($post_id) {
	$features = get_the_terms($post_id, 'subject_feature');
	if(!empty($features)) {
		foreach( $features as $feature ) {
			echo '<li class="tag__item"><a href="'. home_url('/') . 'subject/feature/' . $feature->slug .'">#' . $feature->name . '</a></li>';
		}
	}
}
// 履修情報 学科を表示
function display_subject_faculty($post_id, $has_link = true) {
	// 第二引数はリンクを貼るかどうか
	$faculties = get_the_terms($post_id, 'subject_faculty');
	if(!empty($faculties)) {
		if($has_link) {
			// 親を表示
			foreach( $faculties as $faculty ) {

				if($faculty->parent == 0) {
					echo '<a href="'. home_url('/') . 'subject/faculty/' . $faculty->slug .'">' . $faculty->name . '</a> / ';
				}
			}
			// 子を表示
			foreach($faculties as $faculty ) {
				if($faculty->parent != 0) {
					echo '<a href="'. home_url('/') . 'subject/faculty/' . $faculty->slug .'">' . $faculty->name . '</a>';
				}
			}
		} else {
			foreach( $faculties as $faculty ) {
				echo $faculty->name;
			}
		}
	}
}

// 履修情報 教授名を表示
function display_teachers($post_id, $has_link = true) {
	// 第二引数はリンクを貼るかどうか
	$teachers = get_the_terms($post_id, 'subject_teacher');
	$temp = $teachers;
	if(!empty($teachers)) {
		if($has_link) {
			foreach( $teachers as $teacher ) {
				echo '<a href="'. home_url('/') . 'subject/teacher/' . $teacher->slug .'">' . $teacher->name . '</a>';
				if(next($temp)) {
					echo '、';
				}
			}
		} else {
			foreach( $teachers as $teacher ) {
				echo $teacher->name;
				if(next($temp)) {
					echo '、';
				}
			}
		}
	}
}

// 履修情報一覧用 学部の短縮名所を表示
function display_faculty_shorten_icon($post_id) {
	$faculties = get_the_terms($post_id, 'subject_faculty');
	if(!empty($faculties)) {
		foreach( $faculties as $faculty ) {
			if(!$faculty->parent) {
				$parent_faculty = $faculty->name;
				$faculty_id = 'category_'.$faculty->term_id;
				echo '<i class="faculty_icon faculty_icon--abs">' . get_field('subject_cat_shorten_name',$faculty_id) . '</i>';
			}
		}
	}
}

// 履修情報一覧表示
function display_subject_list($taxonomy) {
	$postTypeName = 'subject';//投稿タイプの名前
	$num = -1;//表示する投稿の数 -1で全部
	$terms = get_terms($taxonomy);
	$thisterm = $terms['0'];
	foreach ( $terms as $term ){
		$args = array(
			'posts_per_page' => $num,
			'post_type' => $postTypeName,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $thisterm,
					'meta_key' => 'subject_eval', // ACFのフィールド名
					'orderby' => 'meta_value_num',
					'order' => 'DESC'
				)
			)
		);
	}
	$myPost = get_posts($args);

	if($myPost) {
		echo '<ul class="card__grp">';
		while(have_posts()) : the_post();
			get_template_part( 'include/post-item-subject');
		endwhile;
		echo '</ul>';
	} else {
		echo '履修情報はありません。';
	}
	// ページネーション
	if (function_exists("pagination")) {
		pagination();
	}
	wp_reset_postdata();
}

// サークル 雰囲気のスコアを表示
// 第２引数はCF
function display_ambience_score($post_id, $cf) {
	if(get_field($cf)){
		$score = get_post_meta($post_id, $cf, true);
	}
	echo $score;
	for ($i = 1; $i <= 5; $i++) {
		if($i == $score) {
			echo '<span class="js-fadein"></span><i></i>';
		} else {
			echo '<span></span><i></i>';
		}
	}
}

// サークルのジャンルリスト表示
function display_circle_category($post_id) {
	// 第二引数はリンクを貼るかどうか
	$categoryes = get_the_terms($post_id, 'circle_category');
	$temp = $categoryes;
	if(!empty($categoryes)) {
		echo '<ul class="tag__grp">';
		foreach( $categoryes as $category ) {
			echo '<li class="tag__item"><a href="'. home_url('/') . 'circle/category/' . $category->slug .'">' . $category->name . '</a></li>';
		}
		echo '</ul>';
	} else {
		echo 'ジャンルが設定されていません。';
	}
}
// サークルのキャンパスリスト表示
function display_circle_campus($post_id) {
	// 第二引数はリンクを貼るかどうか
	$campuses = get_the_terms($post_id, 'circle_campus');
	$temp = $campuses;
	if(!empty($campuses)) {
		echo '<ul class="tag__grp">';
		foreach( $campuses as $campus ) {
			echo '<li class="tag__item"><a href="'. home_url('/') . 'circle/campus/' . $campus->slug .'">' . $campus->name . '</a></li>';
		}
		echo '</ul>';
	} else {
		echo 'キャンパスが設定されていません。';
	}
}
// サークルのこだわりタグリスト表示
function display_circle_feature_tags($post_id) {
	// 第二引数はリンクを貼るかどうか
	$features = get_the_terms($post_id, 'circle_feature');
	$temp = $features;
	if(!empty($features)) {
		echo '<ul class="tag__grp">';
		foreach( $features as $feature ) {
			echo '<li class="tag__item"><a href="'. home_url('/') . 'circle/feature/' . $feature->slug .'">' . $feature->name . '</a></li>';
		}
		echo '</ul>';
	} else {
		echo 'こだわりが設定されていません。';
	}
}

// サークル一覧表示
function display_circle_list($taxonomy) {
	$postTypeName = 'circle';//投稿タイプの名前
	$num = -1;//表示する投稿の数 -1で全部
	$terms = get_terms($taxonomy);
	$thisterm = $terms['0'];
	foreach ( $terms as $term ){
		$args = array(
			'posts_per_page' => $num,
			'post_type' => $postTypeName,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $thisterm
				)
			),
			'order' => 'ASC'
		);
	}
	$myPost = get_posts($args);

	if($myPost) {
		echo '<ul class="card__grp">';
		while(have_posts()) : the_post();
			get_template_part( 'include/post-item-circle');
		endwhile;
		echo '</ul>';
	} else {
		echo 'サークルはありません。';
	}
	// ページネーション
	if (function_exists("pagination")) {
		pagination();
	}
	wp_reset_postdata();
}

// サークルの検索ボックスのタクソノミー表示
// arg 1 タクソノミー
// arg 2 子供を持つかどうか
// arg 3 toggle ボタンを親が持つかどうか（サークルのジャンルのみで使用）
// arg 4 履修情報のジャンルかどうか（input要素に .js-search_parentbtn をつける制御で使用）
function display_search_categories($taxonomy, $has_child = false, $has_toggle_btn = false, $is_subject_category = false) {

	// 親ジャンルのタームを取得
	$parents = get_terms(
		array(
			'taxonomy' => $taxonomy,
			'parent' => 0)
	);

	if(!empty($parents)) {
		echo '<ul class="checkbox__grp">';
		foreach($parents as $key => $parent) : ?>
			<li class="checkbox__item<?php if($has_child){ echo ' checkbox__item--haschild';} ?>">
				<input type="checkbox" id="<?php echo $parent->taxonomy .'_'. $parent->term_taxonomy_id; ?>" name="<?php echo $taxonomy;?>[]" value="<?php echo $parent->slug;?>" <?php if($is_subject_category) { echo 'class="js-search_parentbtn"';}?>>
				<label for="<?php echo $parent->taxonomy .'_'. $parent->term_taxonomy_id; ?>"><?php echo $parent->name;?></label>
				<?php
				$childs = get_terms(array('taxonomy' => $taxonomy, 'parent' => $parent->term_id));
				if(!empty($childs)) :?>
					<?php
					// 子供を表示するtoggleボタンを表示。サークルのジャンルのみで使用
					if($has_toggle_btn) { ?>
					<div class="checkbox__open_btn js-search_toggle_btn"></div>
					<?php } ?>
					<ul class="checkbox__grp checkbox__grp--child">
						<?php
						foreach($childs as $child) : ?>
						<li class="checkbox__item">
							<input type="checkbox" id="<?php echo $child->taxonomy .'_'.  $child->term_taxonomy_id; ?>" name="<?php echo $taxonomy;?>[]" value="<?php echo $child->slug;?>">
							<label for="<?php echo $child->taxonomy .'_'. $child->term_taxonomy_id; ?>"><?php echo $child->name; ?></label>
						</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</li>
		<?php
		endforeach;
		echo '</ul>';
	}
}

// pagination
function pagination($pages = '', $range = 1, $subject_top = false) {
	if($subject_top) {
		//表示するページ数。固定ページだとページネーションがうまく動かないため、履修情報のトップだけ書き換える
		$showitems = ($range)+2;
	} else {
		$showitems = ($range * 20)+1;//表示するページ数（５ページを表示）
	}

	global $paged;//現在のページ値

	if(empty($paged)) $paged = 1;//デフォルトのページ

	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;//全ページ数を取得
		if(!$pages)//全ページ数が空の場合は、１とする
		{
			$pages = 1;
		}
	}

	// echo $paged;
	// echo $pages;

	if(1 != $pages)//全ページが１でない場合はページネーションを表示する
	{
		echo "<div class=\"pagination\">\n";
		echo "<ul class=\"pagination__grp\">\n";
		//Prev：現在のページ値が１より大きい場合は表示
		if($paged > 1) {
			echo "<li class=\"pagination__item\"><a href='".get_pagenum_link($paged - 1)."'><span class=\"pagination__label\"><i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i></span></a></li>\n";
		}
		for ($i=1; $i <= $pages; $i++) {
			// echo $i;
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				//三項演算子での条件分岐
				echo ($paged == $i)? "<li class=\"pagination__item pagination__item--current\"><a href=\"#\"><span class=\"pagination__label\">".$i."</span></a></li>\n":"<li class=\"pagination__item\"><a href='".get_pagenum_link($i)."'><span class=\"pagination__label\">".$i."</span></a></li>\n";
			}
		}
		//Next：総ページ数より現在のページ値が小さい場合は表示
		if ($paged < $pages) echo "<li class=\"pagination__item\"><a href=\"".get_pagenum_link($paged + 1)."\"><span class=\"pagination__label\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></span></a></li>\n";
		echo "</ul>\n";
		echo "</div>\n";
	}

}
// 前後ナビにclass追加
add_filter( 'previous_post_link', 'add_prev_post_link_class' );
function add_prev_post_link_class($output) {
	return str_replace('<a href=', '<a class="pagenav__link pagenav__link--prev" href=', $output);
}
add_filter( 'next_post_link', 'add_next_post_link_class' );
function add_next_post_link_class($output) {
	return str_replace('<a href=', '<a class="pagenav__link pagenav__link--next" href=', $output);
}

// カスタムフィールドの内容も検索結果に含める
function cf_search_join( $join ) {
	global $wpdb;
	if ( is_search() ) {
		$join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
	}
	return $join;
}
add_filter( 'posts_join', 'cf_search_join' );
function cf_search_where( $where ) {
	global $wpdb;
	if ( is_search() ) {
		$where = preg_replace(
			"/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where );

		// 特定のカスタムフィールドを検索対象から外す
		// $where .= " AND (" . $wpdb->postmeta . ".meta_key NOT LIKE 'number')";
	}
	return $where;
}
add_filter( 'posts_where', 'cf_search_where' );
function cf_search_distinct( $where ) {
	global $wpdb;
	if ( is_search() ) {
		return "DISTINCT";
	}
	return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );


// // 検索対象を『タイトルのみ』にする
// function __search_by_title_only( $search, & $wp_query ) {
// 	global $wpdb;
// 	if ( empty( $search ) )
// 		return $search; // skip processing - no search term in query
// 	$q = $wp_query->query_vars;
// 	$n = !empty( $q[ 'exact' ] ) ? '' : '%';
// 	$search =
// 		$searchand = '';
// 	foreach ( ( array )$q[ 'search_terms' ] as $term ) {
// 		$term = esc_sql( like_escape( $term ) );
// 		$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
// 		$searchand = ' AND ';
// 	}
// 	if ( !empty( $search ) ) {
// 		$search = " AND ({$search}) ";
// 		if ( !is_user_logged_in() )
// 			$search .= " AND ($wpdb->posts.post_password = '') ";
// 	}
// 	return $search;
// }
// add_filter( 'posts_search', '__search_by_title_only', 500, 2 );

// フリーワード検索窓を表示
// 第1引数 投稿タイプ
// 第2引数 placeholder
function display_search_form($arg, $placeholder) {
	?>
	<form method="get" action="<?php echo home_url('/'); ?>" >
		<div class="searchbox__form">
			<input class="searchbox__input" type="text" placeholder="<?php echo $placeholder;?>" name="s">
			<input type="hidden" value="<?php echo $arg;?>" name="post_type" id="post_type">
		<button type="submit" id="submitBtn" class="searchbox__btn"><i class="fa fa-search" aria-hidden="true"></i></button>
		</div>
	</form>
	<?php
}

// カスタム投稿ごとにsearch.phpを切り分ける
function custom_search_template($template){
	if ( is_search()){
		$post_types = get_query_var('post_type');
		foreach ( (array) $post_types as $post_type )
			$templates[] = "search-{$post_type}.php";
			$templates[] = 'search.php';
			$template = get_query_template('search',$templates);
	}
	return $template;
}

add_filter('template_include','custom_search_template');

// 検索対象から特定のページを除外
function search_pre_get_posts( $query ) {
	if ( $query->is_search && !is_admin() ){
		// // 投稿のスラッグから検索結果を除外する
		// $post_slug = "post_slug1"; // ←ここに投稿のスラッグを入れる
		// $post_id = get_page_by_path($post_slug, "OBJECT", "post");
		// $post_id = $post_id->ID;

		// 固定ページのスラッグから検索結果を除外する
		function get_page_id($arg) {
			$page_slug = $arg; // ←ここに固定ページのスラッグを入れる
			$page_id = get_page_by_path($page_slug);
			if ($page_id) {
				$page_id = $page_id->ID;
			}
			return $page_id;
		}

		// 検索結果から除外する
		$query->set('post__not_in', array(get_page_id('subject'), get_page_id('circle'), get_page_id('login'), get_page_id('mypage'), get_page_id('regist') ));
	}
	return $query;
}
add_action( 'pre_get_posts', 'search_pre_get_posts' );

// New 表示
function add_new_icon( $date, $days ){
	$today = date_i18n('U');
	$elapsed = date('U',($today - $date)) / 86400;
	if ( $days > $elapsed ) {
		echo '<i class="icon icon--new"></i>';
	}
}

// 管理ツールバーからいらないもの削除
function remove_admin_bar_menu_control( $wp_admin_bar ) {
	// $wp_admin_bar->remove_menu( 'wp-logo' );      // WordPressロゴ
	// $wp_admin_bar->remove_menu( 'site-name' );    // サイト名
	// $wp_admin_bar->remove_menu( 'view-site' );    // サイト名 → サイトを表示
	// $wp_admin_bar->remove_menu( 'dashboard' );    // サイト名 → ダッシュボード（ウェブサイト側）
	// $wp_admin_bar->remove_menu( 'themes' );       // サイト名 → テーマ（ウェブサイト側）
	$wp_admin_bar->remove_menu( 'customize' );    // サイト名 → カスタマイズ（ウェブサイト側）
	$wp_admin_bar->remove_menu( 'comments' );     // コメント
	// $wp_admin_bar->remove_menu( 'updates' );      // 更新
	// $wp_admin_bar->remove_menu( 'view' );         // 投稿を表示
	// $wp_admin_bar->remove_menu( 'new-content' );  // 新規
	$wp_admin_bar->remove_menu( 'new-post' );     // 新規 → 投稿
	// $wp_admin_bar->remove_menu( 'new-media' );    // 新規 → メディア
	// $wp_admin_bar->remove_menu( 'new-link' );     // 新規 → リンク
	// $wp_admin_bar->remove_menu( 'new-page' );     // 新規 → 固定ページ
	$wp_admin_bar->remove_menu( 'new-user' );     // 新規 → ユーザー
	$wp_admin_bar->remove_menu( 'my-account' );   // マイアカウント
	$wp_admin_bar->remove_menu( 'user-info' );    // マイアカウント → プロフィール
	$wp_admin_bar->remove_menu( 'edit-profile' ); // マイアカウント → プロフィール編集
	$wp_admin_bar->remove_menu( 'logout' );       // マイアカウント → ログアウト
	// $wp_admin_bar->remove_menu( 'search' );       // 検索（ウェブサイト側）
}
add_action('admin_bar_menu', 'remove_admin_bar_menu_control', 111);

// 以下、会員管理用
// RSS feedを停止（会員サイトにしたが、feedから要約がみれてしまうため）
function custom_main_query($query) {
	if(is_admin() || !$query->is_main_query())
	return;

	if(is_feed()){
		exit();
	}
}
// 購読者はWPの管理画面にログインさせない
add_action('pre_get_posts', 'custom_main_query');
function subscriber_go_to_home($user_id) {
  $user = get_userdata($user_id);
  if(!$user->has_cap('edit_posts')) {
    wp_redirect(get_home_url());
    exit();
  }
}
add_action('auth_redirect', 'subscriber_go_to_home');
// 購読者はWPのツールバーを表示させない
function subscriber_hide_admin_bar() {
  $user = wp_get_current_user();
  if(isset($user->data) && !$user->has_cap('edit_posts')) {
    show_admin_bar(false);
  }
}
add_action('after_setup_theme', 'subscriber_hide_admin_bar');
// 投稿者のページは禁止
function show_404_error($query) {
  if(is_author()) {
    $query->set_404();
    status_header(404);
    get_template_part(404);
    exit();
  }
}
add_action('parse_query', 'show_404_error');
// WP membersが出力するラベルの変更
function my_default_text($text) {
  $current_user = wp_get_current_user();

  // ログインフォームの「既存ユーザのログイン」
  $text['login_heading'] = '';

  // ログインフォームの「ログイン情報を保存」
  // $text['remember_me'] = '';

  // ログインフォームの「はじめての方はこちら」
  $text['register_link_before'] = '';

   // ログインフォームの「新規ユーザー登録」
  $text['register_link'] = '新規会員登録';

   // ログインフォームの「パスワードをお忘れですか？」
  $text['forgot_link_before'] = '';

   // ログインフォームの「パスワードリセット」
  $text['forgot_link'] = 'パスワードを忘れた場合';

  // ウィジェットの「こんにちは {ユーザー名} さん」
  // $text['sb_status'] = "ようこそ $current_user->nickname さん";

  // ログインページの「こんにちは {ユーザー名} さん」
  // $text['login_welcome'] = "ようこそ $current_user->nickname さん";

  // ウィジェットの「パスワードをお忘れですか？」
  $text['sb_login_forgot'] = 'パスワードを忘れた場合';

  // ウィジェットの「登録」
  $text['sb_login_register'] = '新規会員登録';

  // 登録フォームの「新規ユーザー登録」
  $text['register_heading'] = '会員登録';

  // 登録フォームの「Terms of Service」
  $text['register_tos'] = '利用規約をお読みいただき、チェックしてください。';

  // メンバーシップの「このコンテントにアクセスする権限がありません。」
  // $text['product_restricted'] = 'このページは有料会員のみ閲覧できます。';

  return $text;
}
add_filter('wpmem_default_text', 'my_default_text');

// 利用規約のリンク先変更
function my_function( $text )
	{
	$text = '<a href="/term/" target="_blank" sl-processed="1">利用規約</a>に同意する';
	return $text;
}
add_filter('wpmem_tos_link_txt', 'my_function' );
