<?php

use Scanner\SitePlugger;
/*
Plugin Name: Site Plugger
description: > a plugin to create & deploy static sites to aws s3
Version: 1.0
Author: Rohan JD
License: GPL2
*/

require_once 'SitePlugger.php';
require_once 'admin/admin_fields_n_validation.php';

add_action('admin_menu', 'site_plugger_admin_menu' );
add_action('admin_init', 'site_plugger_add_conf_fields');

add_action( 'admin_footer', 'site_plugger_action_javascript' ); // Write our JS below here
add_action( 'wp_ajax_site_plugger_action', 'site_plugger_action' );

function site_plugger_action_javascript() {
    if ( is_admin() ) {
        wp_enqueue_script(
                'ajax-script', 
                plugins_url('/script.js', __FILE__), 
                array('jquery'));
        
        wp_localize_script(
                'ajax-script', 
                'ajax_object', 
                    array(
                        'ajax_url' => admin_url('admin-ajax.php'), 
                        'run_type' => array(
                            'scanner', 'saver', 'bucket'
                        )
                    )
                );
    }
}

function site_plugger_action() {
    global $wpdb;

    if (isset($_POST['action_step'])) {
        $scanner = new SitePlugger();
        $scanner->base_site = get_option('base_site');
        $scanner->replace_site = get_option('replace_site');

        $scanner->save_ext = ".html";
        $scanner->skip_path_array = ['feed', 'amp'];

        $scanner->save_files = false;
        $scanner->replace_domain_in_file = true;

        $scanner->setSave_directory(get_option('save_folder'));
        $scanner->save_bucket_s3 = get_option('bucket_name');
        $scanner->s3_region = get_option('bucket_region');
        $scanner->s3_prefix = "testing";

        $action_step = $_POST['action_step'];

        switch ($action_step) {
            case 'scanner':
//                 $scanner->run_plugger("scan_pages");

                break;
            case 'saver':
//                 $scanner->run_plugger("logger_save");

                break;
            case 'bucket':
//                $scanner->run_plugger("save_2_s3");

                break;
        }
        //var_dump($scanner->all_urls);
    }else {
        echo "\n No Action selected";
    }

    wp_die();
}

function site_plugger_admin_menu() {
    add_menu_page('Site Plugger','Site Plugger',
            'manage_options','site-plugger-admin',
            'site_plugger_admin_page');
    
    add_submenu_page('site-plugger-admin','Site Plugger',
        'AWS S3 configure','manage_options',
        's3-config','site_plugger_admin_s3_config');

}

/**
 * The Run tool section.
 * @global type $title
 */
function site_plugger_admin_page(){
    global $title;

    print '<div class="wrap">';
    print "<h1>$title</h1>";
    
    if( isset( $_GET[ 'tab' ] ) ) {
        $active_tab = $_GET[ 'tab' ];
    } else {
        $active_tab = "scanner";
    }
    
    switch($active_tab){
      default: case 'scanner':
          $tab_name = "Scan Site for new pages";

          break;  
      case 'saver': 
          $tab_name = "Save Selected pages";
          break;  
      case 'bucket': 
          $tab_name = "Move pages to S3 bucket";
          break;  

    }


    $file = plugin_dir_path( __FILE__ ) . "admin/site-plugger-admin.php";
   
    if ( file_exists( $file ) ){
        require $file;
    }

    print '</div>';
}

/**
 * Saving s3 config section
 * @global type $title
 */
function site_plugger_admin_s3_config(){
    global $title;

    print '<div class="wrap">';
    print "<h1>$title-2</h1>";

    $file = plugin_dir_path( __FILE__ ) . "admin/admin-s3-config.php";

    if ( file_exists( $file ) ){
        require_once $file;
    }

    print '</div>';
}

function site_plugger_add_conf_fields(){
    
    register_setting( 'creds_section', 'bucket_name' );
    register_setting( 'creds_section', 'bucket_region' );
    register_setting( 'creds_section', 's3_credentials' );
    
    register_setting( 'folder_section', 'base_site' , 'base_site_validation' );
    register_setting( 'folder_section', 'replace_site', 'replace_site_validation');
    register_setting( 'folder_section', 'save_folder' );

    add_settings_section("creds_section", "AWS S3 bucket details","display_S3_options_content", "s3-config");
    add_settings_section("folder_section", "Local & Cloud Folders","display_folder_options_content", "folder-config");

    
    add_settings_field("base_site", "Base Site URL", "base_site_form_element", "folder-config", "folder_section");
    add_settings_field("replace_site", "Replace Site URL", "replace_site_form_element", "folder-config", "folder_section");
    add_settings_field('save_folder','Local Folder name','save_folder_form_element',"folder-config",'folder_section' );

    add_settings_field("bucket_name", "Bucket name", "bucket_name_form_element", "s3-config", "creds_section");
    add_settings_field("bucket_region", "Region code", "bucket_region_form_element", "s3-config", "creds_section");
    add_settings_field('s3_credentials','Credentials','s3_credentials_form_element',"s3-config",'creds_section' );
}



?>
