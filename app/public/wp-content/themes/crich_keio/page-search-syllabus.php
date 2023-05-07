<?php
/*
Template Name: シラバス検索ページ
*/
get_header();
?>
<div class="l-content">
    <div class="pagehead">
        <h1 class="page_title">2021年度シラバス検索</h1>
    </div>
    <style>
        .table_td {
            text-align:center;
            height:20px;
        }
    </style>
    <div class="content">
        <div class="wrapper">
            <?php
            global $wpdb;
            // select box
            $campus_list = ["三田", "日吉", "矢上", "芝共立", "信濃町"];
            $day_list = ["--", "月曜", "火曜", "水曜", "木曜", "金曜", "土曜"];
            $period_list = ["--", "１限", "２限", "３限", "４限", "５限", "６限", "７限"];
            ?>
            <!-- シラバス検索form -->
            <form method="post">
                <select name="campus">
                    <?php
                    foreach ($campus_list as $campus) {
                        echo "<option value={$campus}>{$campus}</option>";
                    }
                    ?>
                </select>
                <select name="day">
                    <?php
                    foreach ($day_list as $day) {
                        echo "<option value={$day}>{$day}</option>";
                    }
                    ?>
                </select>
                <select name="period">
                    <?php
                    foreach ($period_list as $period) {
                        echo "<option value={$period}>{$period}</option>";
                    }
                    ?>
                </select>
                <input type="text" name="course_text" placeholder="を含む科目名" style="width:20%;" autofocus>
                <input type="submit" name="search" value="検索" />
                <a href="https://forms.gle/ivXrNFB77iPiHCPB8" target="_blank" style="padding-left: 30px;">科目が見つからない場合はこちらから</a>
            </form>
            <br>
            <!-- 選択した科目をentry-subjectに送るform -->
            <form name="subject_form" action="entry-subject" method="post" onSubmit="return check_radio_btn()">
                <table border="1" style="width:100%; table-layout:fixed; overflow-y:scroll;">
                    <thead>
                        <tr>
                            <th style='width:10%; height:20px;'>キャンパス</th>
                            <th style='width:35%'>科目名</th>
                            <th style='width:10%'>開講学期</th>
                            <th style='width:10%'>曜日・時限</th>
                            <th style='width:30%'>講師名</th>
                            <th style='width:5%'>選択</th>
                        </tr>
                    </thead>
                    <?php
                    // 検索ボタンをクリックした際にシラバス取得
                    if (isset($_POST['campus']) && isset($_POST['day']) && isset($_POST['period'])) {
                        // シラバス取得
                        $selected_campus = $_POST['campus'];
                        $selected_period = mb_substr($_POST['day'], 0, 1, "utf-8") . mb_substr($_POST['period'], 0, 1, "utf-8");
                        $course_text = str_replace(array(" ", "　"), "", $_POST['course_text']);
                        $results;
                        if ($_POST['day'] == "--" || $_POST['period'] == "--") {
                            if ($course_text != "") {
                                // 科目名のみ入っている場合
                                $query = "SELECT * FROM $wpdb->keio_syllabus
                                WHERE `campus_name` = %s AND `course_title` LIKE %s";
                                $results = $wpdb->get_results(
                                    $wpdb->prepare($query, $selected_campus, "%$course_text%")
                                );
                            } else {
                                echo '<script type="text/javascript">alert("曜日・時限か科目名を入力してください");</script>';
                            }
                        } else if ($_POST['day'] != "--" && $_POST['period'] != "--" && $course_text != "") {
                            // 科目名を入力していた場合そのワードを含んで検索
                            $query = "SELECT * FROM $wpdb->keio_syllabus
                                WHERE `campus_name` = %s AND `period` LIKE %s AND `course_title` LIKE %s";
                            $results = $wpdb->get_results(
                                $wpdb->prepare($query, $selected_campus, "%$selected_period%", "%$course_text%")
                            );
                        } else {
                            $query = "SELECT * FROM $wpdb->keio_syllabus
                                WHERE `campus_name` = %s AND `period` LIKE %s";
                            $results = $wpdb->get_results(
                                $wpdb->prepare($query, $selected_campus, "%$selected_period%")
                            );
                        }
                        if ($results) {
                            echo "<input type='submit' value='選択した科目の情報を入力' style='margin-left: auto;'>";
                            echo "<br />";
                            echo "<tbody style='overflow-y:scroll'>";
                            foreach ($results as $row) {
                                echo "<tr>";
                                echo "<td class='table_td'>{$row->campus_name}</td>";
                                echo "<td class='table_td'>{$row->course_title}</td>";
                                echo "<td class='table_td'>{$row->semester}</td>";
                                echo "<td class='table_td'>{$row->period}</td>";
                                echo "<td class='table_td'>{$row->lecturer}</td>";
                                // なぜかlecturerが正しくpostできないためidのみpostして遷移先で再び科目情報を取得
                                echo "<td class='table_td'><input type='radio' name='subject_id' value='$row->keio_syllabus_id'></td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                        } else {
                            print("該当する科目はありません");
                        }
                    }
                    ?>
                </table>
                <script type="text/javascript">
                    // ラジオボタンがチェックされているかをチェック
                    function check_radio_btn() {
                        if (document.subject_form.subject_id.value == "") {
                            alert("科目を選択してください");
                            return false;
                        }
                    }
                </script>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>