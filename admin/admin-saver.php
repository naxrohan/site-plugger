<?php

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class Links_Table extends WP_List_Table {

  public $per_page_display = 15;

  public function __construct() {
		parent::__construct( [
			'singular' => __( 'Link', 'sp' ), //singular name of the listed records
			'plural'   => __( 'Links', 'sp' ), //plural name of the listed records
			'ajax'     => false //should this table support ajax?

		] );
	}

   function get_link_data($per_page = 10, $page_number = 1){
     global $wpdb;
     $per_page = $this->per_page_display;
     $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}site_plugger_logs "
                                 . "ORDER BY id ASC LIMIT {$per_page} OFFSET " .
                                  ( $page_number - 1 ) * $per_page, ARRAY_A ,5);

     return $result;
   }

   public function record_count() {
      global $wpdb;

      $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}site_plugger_logs";
      $count = $wpdb->get_var( $sql );

      return $count;
    }

    function get_bulk_actions() {
      $actions = array(
        'save'    => 'Save Files'
      );
      return $actions;
    }

    function column_cb( $item ) {
      return sprintf(
        '<input type="checkbox" name="bulk-action[]" value="%s" />', $item['ID']
      );
    }

  function get_columns(){
    $columns = array(
      'cb'      => '<input type="checkbox" />',
      // 'id'      => 'ID',
      'url'     => 'URL',
      'added'   => 'DATE'
    );
    return $columns;
  }

  public function screen_option() {

  	$option = 'per_page';
  	$args   = [
  		'label'   => 'Links',
  		'default' => $this->per_page_display,
  		'option'  => 'links_per_page'
  	];

  	add_screen_option( $option, $args );

  	$this->customers_obj = new Customers_List();
  }

  function prepare_items() {
    $columns = $this->get_columns();
    $hidden = array();
    $sortable = array();
    $this->_column_headers = array($columns, $hidden, $sortable);
    $this->process_bulk_action();

    $per_page     = $this->get_items_per_page( 'links_per_page', $this->per_page_display );
    $current_page = $this->get_pagenum();
    $total_items  = self::record_count();

    $this->set_pagination_args( [
      'total_items' => $total_items, //WE have to calculate the total number of items
      'per_page'    => $per_page //WE have to determine how many items to show on a page
    ] );

    $this->items = self::get_link_data( $per_page, $current_page );
  }

  function column_default( $item, $column_name ) {
    switch( $column_name ) {
      case 'id':
      case 'url':
      case 'added':
        return $item[ $column_name ];
      default:
        return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

  function get_sortable_columns() {
    $sortable_columns = array(
      'id'  => array('id',false),
      'url'  => array('url',false),
      'added' => array('added',false)
    );
    return $sortable_columns;
  }
}
?>

<div class="wrap">

    <!--<input type="button" class="button action" value="start-scan" id="start-scan" />-->
    <input type="button" class="button action" value="next-step" id="next-step" />

  <?php

    $myListTable = new Links_Table();

    echo '<div class="wrap"><h4>Scanned Links</h4>';

    $myListTable->prepare_items();
    $myListTable->display();

    echo '</div>';

  ?>

</div>
