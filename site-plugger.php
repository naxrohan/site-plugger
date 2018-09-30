<?php
/*
Plugin Name: Site Plugger
description: > a plugin to create & deploy static sites to aws s3
Version: 1.0
Author: Rohan JD
License: GPL2
*/

add_action('admin_menu', 'site_plugger_admin_menu' );
add_action('admin_init', 'site_plugger_add_conf_fields');

function site_plugger_admin_menu() {
    add_menu_page('Site Plugger Menu','Site Plugger',
            'manage_options','site-plugger-admin',
            'site_plugger_admin_page');
    
    add_submenu_page('site-plugger-admin','Site Plugger Menu',
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

    $file = plugin_dir_path( __FILE__ ) . "admin/site-plugger-admin.php";
    print "<p class='description'>Included from <code>$file</code></p>";
    
    if ( file_exists( $file ) )
        require $file;

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

    if ( file_exists( $file ) )
        require $file;

    print '</div>';
}

function site_plugger_add_conf_fields(){
    
    register_setting( 'creds_section', 's3_credentials' );
    register_setting( 'bucket_section', 'bucket_name' );
    register_setting( 'bucket_section', 'bucket_region' );

    add_settings_section("bucket_section", "S3 bucket details", "display_header_options_content", "s3-config");
    add_settings_section("creds_section", "AWS credentials","display_advertising_options_content", "s3-config");

    add_settings_field('s3_credentials','Credentials','s3_credentials_form_element',"s3-config",'creds_section' );
    add_settings_field("bucket_name", "Bucket name", "bucket_name_form_element", "s3-config", "bucket_section");
    add_settings_field("bucket_region", "Region code", "bucket_region_form_element", "s3-config", "bucket_section");
}
function display_header_options_content() {  echo "Enter the S3 bucket name/region";}
function display_advertising_options_content() {echo "Enter the AWS s3 credentials";}
function bucket_name_form_element() {
    echo '<input type="text" name="bucket_name" id="bucket_name" value="'.get_option('bucket_name').'" />';
}
function bucket_region_form_element() {
    echo '<input type="text" name="bucket_region" id="bucket_region" value="'.get_option('bucket_region').'" />';
}
function s3_credentials_form_element($args){
    echo '<input type="text" name="s3_credentials" id="s3_credentials" value="'.get_option('s3_credentials').'" />';
}


?>
