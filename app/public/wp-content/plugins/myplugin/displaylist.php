<?php
global $wpdb;

// Table name
$tablename = $wpdb->keio_syllabus;;

// Import CSV
if (isset($_POST['butimport'])) {

    // File extension
    $extension = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);

    // If file extension is 'csv'
    if (!empty($_FILES['import_file']['name']) && $extension == 'csv') {
        $totalInserted = 0;

        // Open file in read mode
        $csv_file = file($_FILES['import_file']['tmp_name']);

        // Skipping header row
        $csv_header = $csv_file[0];
        $csv_body = array_splice($csv_file, 1);

        // プレースホルダーとインサートするデータ配列
        $arrayValues = array();
        $place_holders = array();

        foreach ($csv_body as $row) {
            // $rowはstringなのでカンマ区切りのarrayに変換
            $arr = explode(",", $row);
            // インサートするデータを格納
            $arrayValues[] = $arr[0];
            $arrayValues[] = $arr[1];
            $arrayValues[] = $arr[2];
            $arrayValues[] = $arr[3];
            $arrayValues[] = $arr[4];
            $arrayValues[] = $arr[5];
            $arrayValues[] = $arr[6];
            $arrayValues[] = $arr[7];
            // プレースホルダーの作成
            $place_holders[] = '(%s, %s, %s, %s, %s, %s, %s, %s)';
        }
        // SQLの生成
        $sql = "INSERT IGNORE INTO wp_keio_syllabus (`year`, `campus_name`, `course_title`, `semester`, `period`, `lecturer`, `primary_category`, `secondary_category`) VALUES" . join(',', $place_holders);
        // SQL実行
        if ($wpdb->query($wpdb->prepare($sql, $arrayValues))) {
            echo 'Successed to insert data.';
        } else {
            echo 'Failed to insert data.';
        }
        echo "<h3 style='color: green;'>Total Record Inserted: " . count($csv_body) . "</h3>";
    } else {
        echo "<h3 style='color: red;'>Invalid Extension</h3>";
    }
}

?>
<h2>All Entries</h2>

<!-- Form -->
<form method='post' action='<?= $_SERVER['REQUEST_URI']; ?>' enctype='multipart/form-data'>
    <input type="file" name="import_file">
    <input type="submit" name="butimport" value="Import">
</form>

<!-- Record List -->
<!-- <table width='100%' border='1' style='border-collapse: collapse;'>
    <thead>
        <tr>
            <th>id</th>
            <th>year</th>
            <th>campus_name</th>
            <th>course_title</th>
            <th>semester</th>
            <th>period</th>
            <th>lecturer</th>
            <th>primary_category</th>
            <th>secondary_category</th>
        </tr>
    </thead>
    <tbody>

        <?php
        // Fetch records
        // $entriesList = $wpdb->get_results("SELECT * FROM $tablename ORDER BY keio_syllabus_id ASC");
        // if (count($entriesList) > 0) {
        //     $count = 0;
        //     foreach ($entriesList as $entry) {
        //         $id = $entry->keio_syllabus_id;
        //         $year = $entry->year;
        //         $campus_name = $entry->campus_name;
        //         $course_title = $entry->course_title;
        //         $semester = $entry->semester;
        //         $period = $entry->period;
        //         $lecturer = $entry->lecturer;
        //         $primary_category = $entry->primary_category;
        //         $secondary_category = $entry->secondary_category;

        //         echo "<tr>
        //         <td>" . $id . "</td>
        //         <td>" . $year . "</td>
        //         <td>" . $campus_name . "</td>
        //         <td>" . $course_title . "</td>
        //         <td>" . $semester . "</td>
        //         <td>" . $period . "</td>
        //         <td>" . $lecturer . "</td>
        //         <td>" . $primary_category . "</td>
        //         <td>" . $secondary_category . "</td>
        //         </tr>
        //         ";
        //     }
        // } else {
        //     echo "<tr><td>No record found</td></tr>";
        // }
        ?>
    </tbody>
</table> -->