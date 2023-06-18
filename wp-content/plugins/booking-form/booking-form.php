<?php
/**
 * @package Hello_Dolly
 * @version 1.0
 */
/* 
Plugin Name: Form đặt lịch
Plugin URI: https://www.google.com.vn/?hl=vi
Description: Form đặt lịch made by Lucas
Author: Lucas
Version: 1.0
*/

function my_plugin_activate() {
    // Tạo bảng khi plugin được kích hoạt
    create_table();
}
register_activation_hook(__FILE__, 'my_plugin_activate');

function create_table() {
    // global $wpdb;
    // $table_name = $wpdb->prefix . 'booking_exam_form_data';
    // $charset_collate = $wpdb->get_charset_collate();

    // // Xóa bảng nếu nó đã tồn tại
    // if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
    //     $wpdb->query("DROP TABLE IF EXISTS $table_name");
    // }

    // // Tạo bảng mới
    // $sql = "CREATE TABLE $table_name (
    //     id INT(11) NOT NULL AUTO_INCREMENT,
    //     category INT(11) NOT NULL,
    //     service INT(11) NOT NULL,
    //     branch INT(11) NOT NULL,
    //     booking_date BIGINT(20) NOT NULL,
    //     booking_time BIGINT(20) NOT NULL,
    //     full_name VARCHAR(255) NOT NULL,
    //     mobile VARCHAR(255) NOT NULL,
    //     email VARCHAR(255) NOT NULL,
    //     PRIMARY KEY (id)
    // ) $charset_collate;";

    // require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    // dbDelta($sql);
}

function show_form() {
    $file_path  = plugin_dir_path(__FILE__) . 'templates/form-booking.php';
    $listTime = ['07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00'];
    if (!empty($_POST['action']) && $_POST['action'] == 'wp_ajax_save_data_booking_form') {
        $request = [];
        parse_str($_POST['data'],$request);

        if (empty($request['book'])) {
            return false;
        }

        $request = $request['book'];
        $input = [
            'category'   =>  !empty($request['category']) ? sanitize_text_field($request['category']) : '',
            'service'   =>  !empty($request['service']) ? sanitize_text_field($request['service']) : '',
            'branch'   =>  !empty($request['branch']) ? sanitize_text_field($request['branch']) : '',
            'booking_date'   =>  !empty($request['booking_date']) ? sanitize_text_field($request['booking_date']) : '',
            'booking_time'   =>  !empty($request['booking_time']) ? sanitize_text_field($request['booking_time']) : '',
            'full_name'   =>  !empty($request['full_name']) ? sanitize_text_field($request['full_name']) : '',
            'mobile'   =>  !empty($request['mobile']) ? sanitize_text_field($request['mobile']) : '',
            'email'   =>  !empty($request['email']) ? sanitize_email($request['email']) : '',
        ];
        echo '<pre>';print_r($input);exit;
    }
    ob_start();

    include($file_path);

    $output = ob_get_clean();

    return $output;
}
add_shortcode("form_dat_lich","show_form");

function custom_enqueue_scripts() {
    $directory_assets = plugin_dir_url(__FILE__) . 'assets/';

    wp_enqueue_script('jquery');

    // Thư viện flatpickr
    wp_enqueue_style('external-style', 'https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css');
    wp_enqueue_script('external-script', 'https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js');
    
    // Main css, js
    wp_enqueue_style('main-style', $directory_assets . 'css/style.css');
    wp_enqueue_script('main-script', $directory_assets . 'js/main.js');
    wp_localize_script('main-script', 'data', array(
        'stylesheetUri' => get_stylesheet_directory_uri(),
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    ));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');