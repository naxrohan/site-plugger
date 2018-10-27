<?php

//==Setting Sections
function display_S3_options_content() {echo "Enter the AWS S3 details below";}
function display_folder_options_content() {echo "Enter the Folder Structure";}


//==Setting Fileds
function base_site_form_element() {
    echo '<input type="text" name="base_site" id="base_site" value="'.get_option('base_site').'" />';
}
function replace_site_form_element() {
    echo '<input type="text" name="replace_site" id="replace_site" value="'.get_option('replace_site').'" />';
}
function save_folder_form_element(){
    echo '<input type="text" name="save_folder" id="save_folder" value="'.get_option('save_folder').'" />';
}
function bucket_name_form_element() {
    echo '<input type="text" name="bucket_name" id="bucket_name" value="'.get_option('bucket_name').'" />';
}
function bucket_region_form_element() {
    echo '<input type="text" name="bucket_region" id="bucket_region" value="'.get_option('bucket_region').'" />';
}
function s3_credentials_form_element($args){
    echo '<input type="text" name="s3_credentials" id="s3_credentials" value="'.get_option('s3_credentials').'" />';
}

//====Setting Validations
function base_site_validation($input){
    return $input;
}
function replace_site_validation($input){
    return $input;
}