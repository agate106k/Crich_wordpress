
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/jquery.cookie.js"></script>
<script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/smooth-scroll.polyfills.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script src="/js/chartjs-plugin-stacked100.js"></script><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.charset="UTF-8";js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<!-- LINE -->
<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
<!-- app.jsのパスの参照先をローカルのものに変更 20210731localfixed -->
<?php $param = date("YmdHis",filemtime("/Users/hayashihirofumi/Local Sites/crichmediadev/app/public/js/app.js")); ?>
<script src="/js/app.js?<?=$param?>"></script>

<?php // 履修情報の時だけ表示
if(is_singular('subject') || is_page('subject') || is_post_type_archive('subject') || is_tax('subject_teacher') || is_tax('subject_faculty') || is_tax('subject_feature') || is_search() ) :
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
<?php endif?>