<div class="wrap">
    <div id="icon-options-general" class="icon32"></div>
    <?php settings_errors(); ?>

    <?php
        if( isset( $_GET[ 'tab' ] ) ) {
            $active_tab = $_GET[ 'tab' ];
        } else {
            $active_tab = "creds_options";
        }
    ?>    
    <h2 class="nav-tab-wrapper">
        <a href="?page=s3-config&tab=creds_options" class="nav-tab <?php echo $active_tab == 'creds_options' ? 'nav-tab-active' : ''; ?>">AWS S3 bucket details</a>
        <a href="?page=s3-config&tab=folder_options" class="nav-tab <?php echo $active_tab == 'folder_options' ? 'nav-tab-active' : ''; ?>">Local & Cloud Folders</a>
    </h2>
    
    <form method="post" action="options.php">
        <?php
        if($active_tab == "creds_options"){
            settings_fields("creds_section");
            do_settings_sections("s3-config");
        }else {
            settings_fields("folder_section");
            do_settings_sections("folder-config");
        }
        
        submit_button();
    
        ?>          
    </form>

</div>
