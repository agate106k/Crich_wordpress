<?php

/*
Plugin Name: CSV to MySQL
Description: Plugin to register CSV to MySQL
Version: 0.1
Author: Pan Shimura
*/

// Create a new table
function plugin_table(){

   global $wpdb;
   $charset_collate = $wpdb->get_charset_collate();

   $tablename = $wpdb->keio_syllabus;

   $sql = "CREATE TABLE $tablename (
     keio_syllabus_id bigint(20) NOT NULL AUTO_INCREMENT, --id
     year varchar(20) NOT NULL, --開講年度
     campus_name varchar(20) NOT NULL, --開講キャンパス
     course_title varchar(191) NOT NULL, --科目名
     semester varchar(100) NOT NULL, --開講学期
   --   day varchar(20) NOT NULL, --曜日
     period varchar(20) NOT NULL, --曜日&時限
   --   lecturer blob DEFAULT NULL, --講師名, blob, 配列をserializeして入れる
     lecturer varchar(191) NOT NULL,
     primary_category varchar(191) NOT NULL, --第一分類
     secondary_category varchar(191) NOT NULL, --第二分類
     PRIMARY KEY (keio_syllabus_id)
     INDEX (year)
   ) $charset_collate;";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );

}
register_activation_hook( __FILE__, 'plugin_table' );

// Add menu
function plugin_menu() {

   add_menu_page("CSV to MySQL", "CSV to MySQL","manage_options", "csv-to-mysql", "displayList");

}
add_action("admin_menu", "plugin_menu");

function displayList(){
   include "displaylist.php";
}
