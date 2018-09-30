<div class="wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h1>Theme Options</h1>
    <form method="post" action="options.php">
        <?php
        //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
        settings_fields("bucket_section");
        settings_fields("creds_section");

        // all the add_settings_field callbacks is displayed here
        do_settings_sections("s3-config");

        // Add the submit button to serialize the options
        submit_button();
        ?>          
    </form>
</div>