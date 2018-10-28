<div class="wrap">

    <h2 class="nav-tab-wrapper">
        <a href="?page=site-plugger-admin&tab=scanner" class="nav-tab <?php echo $active_tab == 'scanner' ? 'nav-tab-active' : ''; ?>">Step 1:</a>
        <a href="?page=site-plugger-admin&tab=saver" class="nav-tab <?php echo $active_tab == 'saver' ? 'nav-tab-active' : ''; ?>">Step 2:</a>
        <a href="?page=site-plugger-admin&tab=bucket" class="nav-tab <?php echo $active_tab == 'bucket' ? 'nav-tab-active' : ''; ?>">Step 3:</a>
    </h2>

    <h3><?php echo $tab_name; ?></h3>

<?php
    require_once $tab_file_name;
?>          

</div>