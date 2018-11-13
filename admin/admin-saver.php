<?php

?>

<div class="wrap">

    <!--<input type="button" class="button action" value="start-scan" id="start-scan" />-->
    <input type="button" class="button action" value="next-step" id="next-step" />

    <div id="sidebar">
        <ul>
            <li>
                <h4>Scan Status:</h4> 
                <code id="scan-status"></code>
            </li>
        </ul>
    <div/>
<?php

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

?>

    <table border="1">
        <thead>
            <th>Id</th>
            <th>URL</th>
            <th>Date</th>
        </thead>
        <tbody>

        <?php foreach ($saved_links as $key => $value) {

            echo "<tr>
            <td>{$value['id']}</td>
            <td>{$value['url']}</td>
            <td>{$value['added']}</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>

</div>
