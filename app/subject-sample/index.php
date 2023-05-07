<?php
define('WP_USE_THEMES', false);
require(dirname(__FILE__) . '/../wp/wp-blog-header.php');

get_header();
?>
<div class="l-content">
			<div class="entry entry--subject">
				<header class="subject_head">
					<div class="subject_head__faculty">一般教養科目 / 理系</div>
					<h1 class="subject_head__title">
						情報サンプル学
						[秋]
					</h1>
					<div class="subject_head__prof"><a href="#">山田花子</a></div>
				</header>
				<div class="subject_body">
					<div class="subject_star">
						<div class="starbox starbox--single">
							<div class="starbox__rate">
								<div class="starbox__rate_active" data-star-point="4.3"></div>
							</div>
						</div>
					</div>
					<div class="subject_radar">
						<canvas class="radar_chart_large" data-module="4.5" data-record="3.7" data-interest="3.7"></canvas>
					</div>
					<div class="subject_tag">
						<ul class="tag__grp">
							<li class="tag__item"><a href="#">#課題有</a></li>
							<li class="tag__item"><a href="#">#試験有</a></li>
							<li class="tag__item"><a href="#">#持込無</a></li>
						</ul>
					</div>
					<div class="subject_box">
						<dl class="subject_box__head">
							<dt class="subject_box__label">課題</dt>
							<dd class="subject_box__cont">課題の頻度：時々、課題の種類：問題演習</dd>
						</dl>
						<canvas class="js-bar_graph" data-easy="4" data-average="1" data-hard="1" width="320" height="100"></canvas>
					</div>
					<div class="subject_box">
						<dl class="subject_box__head">
							<dt class="subject_box__label">試験</dt>
							<dd class="subject_box__cont">試験について：レポート型の試験、試験の形態：論述・記述、資料の持ち込み：持ち込み・参照可</dd>
						</dl>
						<canvas class="js-bar_graph" data-easy="131" data-average="3" data-hard="2" width="320" height="100"></canvas>
					</div>
					<div class="subject_box">
						<dl class="subject_box__head">
							<dt class="subject_box__label">授業形式</dt>
							<dd class="subject_box__cont">オンデマンド</dd>
						</dl>
					</div>
					<div class="subject_box">
						<dl class="subject_box__head">
							<dt class="subject_box__label">出欠</dt>
							<dd class="subject_box__cont">オンライン上での小テストへの回答</dd>
						</dl>
					</div>
					<div class="subject_box">
						<dl class="subject_box__head">
							<dt class="subject_box__label">小テスト</dt>
							<dd class="subject_box__cont">時々<br>楽</dd>
						</dl>
					</div>
					<div class="subject_box">
						<dl class="subject_box__head">
							<dt class="subject_box__label">教材</dt>
							<dd class="subject_box__cont">配布資料（PDFやスライドなど）</dd>
						</dl>
					</div>
					<section class="subject_box">
						<h1 class="subject_box__title"><i class="icon icon--wom"></i>口コミ・感想</h1>
						<div>
							<ul class="contribute__grp">
								<li class="contribute__item">期末のレポートをちゃんとやればAやBくらいは取れる。授業も全て音声付きパワポで、リアタイはなし。</li>
								<li class="contribute__item">先生がとてもわかりやすいです</li>
								<li class="contribute__item">取り敢えず課題の問題解けばOK。動画を見ながら穴埋めするタイプの課題だけど、分からなかったり面倒くさかったりすれば理工学部の友達に聞けば余裕。</li>
								<li class="contribute__item">レポートやれば単位は来ます。高評価も取りやすそうです。</li>
								<li class="contribute__item">オンデマンドを視聴し、学期末にテストがある。時々、授業の復習として小テストがあるが、授業を聞いてノートを取っていれば大丈夫。今年はオンデマンド形式であったため、例年より単位が取りやすくなったと思う。先生が気難しい人なのできちんと授業を視聴することをオススメする。</li>
								<li class="contribute__item">本当に簡単な課題を出すだけでS。理系っぽいのが好きな人なら内容もけっこうおもしろい。</li>
							</ul>
						</div>
					</section>
					<section class="subject_box">
						<h1 class="subject_box__title"><i class="icon icon--advice"></i>コツ・アドバイス</h1>
						<div>
							<ul class="contribute__grp">
								<li class="contribute__item">レポートを出せばok</li>
								<li class="contribute__item">授業を見て考えて課題をやっていれば大丈夫です。</li>
								<li class="contribute__item">微積分が強い友達に教えてもらうのが1番いい</li>
								<li class="contribute__item">レポートはほとんど授業でやったことなのでめちゃくちゃ簡単です。対面で受けたかった</li>
								<li class="contribute__item">課題は教科書のどこかに載っていることをまとめて書けばSが来る。また、指定された教科書でなくても内容はほとんど同じなので別の教科書を入手して、課題の答えとなりそうなところを丸写しするという手もあるそう。(最終手段)</li>
							</ul>
						</div>
					</section>
				</div>
			</div>
		</div>
		<!-- //.l-content-->
<?php
get_template_part( 'include/footer.html');echo "\n";
get_template_part( 'include/footer_script.html');echo "\n";
get_template_part( 'include/trakingcode_in_bottom.html');echo "\n";
wp_footer();
?>
<script>
$(function(){

	// 履修情報一覧用
	$('.radar_chart').each(function() {
		drawEvalChartMini($(this));
	})

	function drawEvalChartMini(data) {
		var param1 = $(data).attr('data-module');
		var param2 = $(data).attr('data-record');
		var param3 = $(data).attr('data-interest');

		var ctx = $(data);
		var myRadarChart = new Chart(ctx, {
			type: 'radar',
			data: {
				labels: ["", "", ""],
				datasets: [{
					data: [param1, param2, param3],
					backgroundColor: 'RGBA(128, 198, 92, 0.5)',
					borderColor: 'RGBA(75, 155, 33, 1)',
					borderWidth: 1,
					pointBackgroundColor: 'RGB(32, 84, 1)',
					pointRadius: 1
				}]
			},
			options: {
				tooltips: {
					enabled: false
				},
				legend: {
					display: false
				},
				scale:{
					ticks:{
						suggestedMin: 0,
						suggestedMax: 5,
						stepSize: 5,
						callback: function(value, index, values){
							return value
						}
					}
				}
			}
		});
	}

	// 履修情報詳細
	$('.radar_chart_large').each(function() {
		drawEvalChart($(this));
	})

	function drawEvalChart(data) {
		var param1 = $(data).attr('data-module');
		var param2 = $(data).attr('data-record');
		var param3 = $(data).attr('data-interest');

		var ctx = $(data);
		var myRadarChart = new Chart(ctx, {
			type: 'radar',
			data: {
				labels: ["単位", "面白さ", "高成績"],
				datasets: [{
					data: [param1, param2, param3],
					backgroundColor: 'RGBA(128, 198, 92, 0.5)',
					borderColor: 'RGBA(75, 155, 33, 1)',
					borderWidth: 4,
					pointBackgroundColor: 'RGB(32, 84, 1)'
				}]
			},
			options: {
				legend: {
					display: false
				},
				scale:{
					pointLabels: {
						fontSize: 15
					},
					ticks:{
						suggestedMin: 0,
						suggestedMax: 5,
						stepSize: 1,
						callback: function(value, index, values){
							return  value
						}
					}
				}
			}
		});
	}

	// 帯グラフ
	$('.js-bar_graph').each(function() {
		drawGraphHomework($(this));
	})
	function drawGraphHomework(data) {
		var param1 = $(data).attr('data-easy');
		var param2 = $(data).attr('data-average');
		var param3 = $(data).attr('data-hard');
		new Chart($(data), {
			type: 'horizontalBar',
			data: {
				labels: [""],
				datasets: [
					{ label: "楽",    data: [param1],  backgroundColor: "rgba(4, 196, 99, 0.8)" },
					{ label: "ふつう", data: [param2], backgroundColor: "rgba(255, 235, 51, 0.8)" },
					{ label: "きつい",   data: [param3],  backgroundColor: "rgba(255, 67, 23, 0.8)" }
				]
			},
			options: {
				plugins: {
					stacked100: { enable: true }
				}
			}
		});
	}
});
</script>
	</body>
</html>