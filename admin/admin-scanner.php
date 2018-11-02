<?php

?>
<div class="wrap">

    <input type="button" class="button action" value="start-scan" id="start-scan" />
    <input type="button" class="button action" value="next-step" id="next-step" />


    <div id="sidebar">
        <ul>
            
            <li>
                <h4>Last scanned site name: </h4>
                
                <code ><?php echo $site_name; ?></code>
            </li>
            <li>
                <h4>Total Links found: </h4>
                
                <code ><?php echo $total_log_lines; ?></code>
            </li>
            <li>
                <h4>Log file name:</h4> 
                <code ><?php echo $log_file_name; ?></code>
            </li>
            <li>
                <h4>Scan Status:</h4> 
                <code id="scan-status"></code>
            </li>
        </ul>

    <div/>

</div>
