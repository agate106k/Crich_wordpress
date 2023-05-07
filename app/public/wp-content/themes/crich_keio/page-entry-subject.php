<?php
/*
Template Name: 履修情報入力ページ
*/
session_start();
get_header();
?>
<div class="l-content">
	<div class="pagehead">
		<h1 class="page_title">2021年度履修情報入力</h1>
	</div>
	<style>
		.entry_subject {
			width: 600px;
		}

		.flex_box {
			display: flex;
			justify-content: center;
		}

		.flex_item {
			padding: 20px;
			text-align: center;
		}

		.radio_item {
			min-height: 3em;
		}

		.radio_btn {
			transform: scale(1.8);
		}

		.text_area {
			width: 100%;
			box-sizing: border-box;
			height: 120px;
		}

		.required:after {
			color: #E00;
			content: " *";
		}
	</style>
	<div class="content">
		<div class="wrapper">
			<div class="entry entry_subject">
				<div class="subject_head">
					<?php
					// search-syllabusで選択した科目を受け取り履修情報を入力
					if (isset($_POST['subject_id'])) {
						$selected_id = $_POST['subject_id'];
						$result = $wpdb->get_row(
							"SELECT *
							FROM $wpdb->keio_syllabus
							WHERE `keio_syllabus_id` = '$selected_id'"
						);
						$params = array(
							'year' => $result->year,
							'campus_name' => $result->campus_name,
							'course_title' => $result->course_title,
							'semester' => $result->semester,
							'day' => $result->day,
							'period' => $result->period,
							'lecturer' => $result->lecturer,
							'primary_category' => $result->primary_category,
							'secondary_category' => $result->secondary_category
						);
						// 履修情報登録のpost時に$paramsの値が廃棄されるのでsessionに保持
						$_SESSION['year'] = $params['year'];
						$_SESSION['course_title'] = $params['course_title'];
						$_SESSION['lecturer'] = $params['lecturer'];
						$_SESSION['primary_category'] = $params['primary_category'];
						$_SESSION['secondary_category'] = $params['secondary_category'];
						// 科目情報出力
						$primary_category = explode("／", $_SESSION['primary_category']);
						$secondary_category = explode("／", $_SESSION['secondary_category']);
						echo "<div class='subject_head__faculty' id='category'>";
						for ($i = 0; $i < count($primary_category); $i++) {
							if ($i > 0) {
								echo " , ";
							}
							echo $primary_category[$i] . " / " . $secondary_category[$i];
						}
						echo "</div>";
						echo "<h1 class='subject_head__title' id='course_title'>" . $_SESSION['course_title'] . "</h1>";
						echo "<div class='subject_head__prof' id='lecturer'>" . $_SESSION['lecturer'] . "</div>";
					}

					if (isset($_POST["subject_eval"])) {
						$eval = $_POST["subject_eval"];
						$module = $_POST["subject_module"];
						$record = $_POST["subject_record"];
						$interest = $_POST["subject_interest"];
						$hw = $_POST["subject_hw"];
						$hw_burden = $_POST["subject_hw_burden"];
						$exam = $_POST["subject_exam"];
						$exam_burden = $_POST["subject_exam_burden"];
						$attendance = $_POST["subject_attendance"];
						$wom = $_POST["subject_wom"];
						if ($hw == "なし") {
							$hw_burden = "";
						} else if ($exam == "なし") {
							$exam_burden = "";
						}
						$place_holders[] = "(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)";
						$wpdb->query($wpdb->prepare(
							// 本番環境はsubject_survey
							"INSERT INTO $wpdb->subject_info ( year, course_title, lecturer, primary_category, secondary_category, subject_eval, subject_module, subject_record, subject_interest, subject_hw, subject_hw_burden, subject_exam, subject_exam_burden, subject_attendance, subject_wom ) VALUES" . join(',', $place_holders),
							$_SESSION['year'],
							$_SESSION['course_title'],
							$_SESSION['lecturer'],
							$_SESSION['primary_category'],
							$_SESSION['secondary_category'],
							$eval,
							$module,
							$record,
							$interest,
							$hw,
							$hw_burden,
							$exam,
							$exam_burden,
							$attendance,
							$wom
						));
						session_destroy();
						// header関数はそれより先に何か出力していると機能しないので
						// echo '
						// <script type="text/javascript">
						// setTimeout("redirect()", 0);

						// function redirect() {
						// 	alert("履修情報を送信しました");
						// 	location.href="header("Location: https://crich-media.com/keio/search-syllabus");";
						// }
						// </script>';
						header("Location: search-syllabus");
						exit;

					}
					?>
				</div>
				<div>
					<form name="info_form" method="post" onsubmit="return confirm_register()">
						<hr />
						<input type="hidden" name="info" value="info" />
						<input type="hidden" name="year" value="<?php $_SESSION["year"] ?>" />
						<!-- 総合評価 -->
						<div class="flex_box">
							<p class="required">この科目の総合評価を5段階で教えてください</p>
						</div>
						<div class="flex_box">
							<div class="flex_item">
								<div class="radio_item"></div>
								<div class="radio_item">低評価</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>1</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_eval" value="1" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>2</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_eval" value="2" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>3</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_eval" value="3" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>4</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_eval" value="4" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>5</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_eval" value="5" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item"></div>
								<div class="radio_item">高評価</div>
							</div>
						</div>
						<hr />
						<!-- 各評価 -->
						<div class="flex_box">
							<p class="required">この科目の各評価を5段階で教えてください</p>
						</div>
						<div class="flex_box">
							<div class="flex_item">
								<div class="radio_item"></div>
								<div class="radio_item">単位の取得しやすさ</div>
								<div class="radio_item">高評価の取得しやすさ</div>
								<div class="radio_item">授業の面白さ</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>1</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_module" value="1" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_record" value="1" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_interest" value="1" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>2</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_module" value="2" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_record" value="2" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_interest" value="2" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>3</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_module" value="3" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_record" value="3" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_interest" value="3" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>4</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_module" value="4" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_record" value="4" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_interest" value="4" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">
									<p>5</p>
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_module" value="5" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_record" value="5" class="radio_btn">
								</div>
								<div class="radio_item">
									<input type="radio" name="subject_interest" value="5" class="radio_btn">
								</div>
							</div>
						</div>
						<hr />
						<!-- 課題・小テスト -->
						<div class="flex_box">
							<p class="required">課題・小テストについて教えてください</p>
						</div>
						<div class="flex_box">
							<div class="flex_item">
								<div class="radio_item">課題(問題演習や小レポートなど)</div>
								<div class="radio_item">
									<input type="radio" name="subject_hw" value="課題(問題演習や小レポートなど)" class="radio_btn" onchange="display_hw_burden(this)">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">小テスト</div>
								<div class="radio_item">
									<input type="radio" name="subject_hw" value="小テスト" class="radio_btn" onchange="display_hw_burden(this)">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">リアクションペーパー</div>
								<div class="radio_item">
									<input type="radio" name="subject_hw" value="リアクションペーパー" class="radio_btn" onchange="display_hw_burden(this)">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">なし</div>
								<div class="radio_item">
									<input type="radio" name="subject_hw" value="なし" class="radio_btn" onchange="display_hw_burden(this)">
								</div>
							</div>
						</div>
						<hr />
						<!-- 課題・小テストの負担 -->
						<div id="hw_burden">
							<div style="text-align:center;">
								<p class="required">上記で「なし」を選択しなかった方にお聞きします</p>
								<p>課題・小テストの負担について教えてください</p>
							</div>
							<div class="flex_box">
								<div class="flex_item">
									<div class="radio_item">楽</div>
									<div class="radio_item">
										<input type="radio" name="subject_hw_burden" value="楽" class="radio_btn">
									</div>
								</div>
								<div class="flex_item">
									<div class="radio_item">ふつう</div>
									<div class="radio_item">
										<input type="radio" name="subject_hw_burden" value="ふつう" class="radio_btn">
									</div>
								</div>
								<div class="flex_item">
									<div class="radio_item">きつい</div>
									<div class="radio_item">
										<input type="radio" name="subject_hw_burden" value="きつい" class="radio_btn">
									</div>
								</div>
							</div>
							<hr />
						</div>
						<!-- 試験 -->
						<div class="flex_box">
							<p class="required">試験について教えてください</p>
						</div>
						<div class="flex_box">
							<div class="flex_item">
								<div class="radio_item">ペーパーテスト</div>
								<div class="radio_item">
									<input type="radio" name="subject_exam" value="ペーパーテスト" class="radio_btn" onchange="display_exam_burden(this)">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">オンラインテスト</div>
								<div class="radio_item">
									<input type="radio" name="subject_exam" value="オンラインテスト" class="radio_btn" onchange="display_exam_burden(this)">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">期末レポート</div>
								<div class="radio_item">
									<input type="radio" name="subject_exam" value="期末レポート" class="radio_btn" onchange="display_exam_burden(this)">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">なし</div>
								<div class="radio_item">
									<input type="radio" name="subject_exam" value="なし" class="radio_btn" onchange="display_exam_burden(this)">
								</div>
							</div>
						</div>
						<hr />
						<!-- 試験の負担 -->
						<div id="exam_burden">
							<div style="text-align:center;">
								<p class="required">上記で「なし」を選択しなかった方にお聞きします</p>
								<p>試験の負担について教えてください</p>
							</div>
							<div class="flex_box">
								<div class="flex_item">
									<div class="radio_item">楽</div>
									<div class="radio_item">
										<input type="radio" name="subject_exam_burden" value="楽" class="radio_btn">
									</div>
								</div>
								<div class="flex_item">
									<div class="radio_item">ふつう</div>
									<div class="radio_item">
										<input type="radio" name="subject_exam_burden" value="ふつう" class="radio_btn">
									</div>
								</div>
								<div class="flex_item">
									<div class="radio_item">きつい</div>
									<div class="radio_item">
										<input type="radio" name="subject_exam_burden" value="きつい" class="radio_btn">
									</div>
								</div>
							</div>
							<hr />
						</div>
						<!-- 出欠 -->
						<div class="flex_box">
							<p class="required">出欠の有無について教えてください</p>
						</div>
						<div class="flex_box">
							<div class="flex_item">
								<div class="radio_item">あり</div>
								<div class="radio_item">
									<input type="radio" name="subject_attendance" value="あり" class="radio_btn">
								</div>
							</div>
							<div class="flex_item">
								<div class="radio_item">なし</div>
								<div class="radio_item">
									<input type="radio" name="subject_attendance" value="なし" class="radio_btn">
								</div>
							</div>
						</div>
						<hr />
						<!-- 口コミ・アドバイス -->
						<div style="text-align:center;">
							<p>この科目の口コミやアドバイスを教えてください</p>
							<p>授業内容や課題・試験の詳細、高評価を取るコツなどを是非ご記入ください！</p>
							<p>印象に残ったことや面白かったことなどもお待ちしています！</p>
							<textarea class="text_area" name="subject_wom" placeholder="ex) 試験はなく、課題は毎回問題演習があった。きちんとやればAはくる印象。先生の話がとても面白いのでおすすめ。"></textarea>
						</div>
						<hr />
						<input type="submit" value="入力した履修情報を送信" />
					</form>
				</div>
				<script type="text/javascript">
					// 課題の負担表示
					function display_hw_burden(select) {
						if (select.value == "なし") {
							document.getElementById('hw_burden').style.display = "none";
						} else {
							document.getElementById('hw_burden').style.display = "block";
						}
					}
					// 試験の負担表示
					function display_exam_burden(select) {
						if (select.value == "なし") {
							document.getElementById('exam_burden').style.display = "none";
						} else {
							document.getElementById('exam_burden').style.display = "block";
						}
					}
					// 送信前のconfirm
					function confirm_register() {
						$check_flag = true;
						// フォームのvalue
						$eval = document.info_form.subject_eval.value;
						$module = document.info_form.subject_module.value;
						$record = document.info_form.subject_record.value;
						$interest = document.info_form.subject_interest.value;
						$hw = document.info_form.subject_hw.value;
						$hw_burden = document.info_form.subject_hw_burden.value;
						$exam = document.info_form.subject_exam.value;
						$exam_burden = document.info_form.subject_exam_burden.value;
						$attendance = document.info_form.subject_attendance.value;
						$wom = document.info_form.subject_wom.value;
						$category = document.getElementById('category').textContent.split(' / ');
						$course_title = document.getElementById('course_title').textContent;
						$lecturer = document.getElementById('lecturer').textContent.split(',');

						// ラジオボタンが全てチェックされていたらconfirmに進む
						if ($eval == "" || $module == "" || $record == "" || $interest == "" || $hw == "" || $exam == "" | $attendance == "") {
							$check_flag = false;
						}
						if ($hw != "" && $hw != "なし") {
							if ($hw_burden == "") {
								$check_flag = false;
							}
						}
						if ($exam != "" && $exam != "なし") {
							if ($exam_burden == "") {
								$check_flag = false;
							}
						}
						if (!$check_flag) {
							alert("必須項目を全て選択してください");
							return false;
						} else {
							const select = confirm("入力した情報を送信しますか？");
							return select;
						}
					}
				</script>
				<?php
				?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
?>