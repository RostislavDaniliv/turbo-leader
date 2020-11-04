<?php 

/*
export Functions

i18n Compatible

*/


//=========================================================================			
// Export Options
//=========================================================================			

function wptb_display_export_options() {
	
	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_display_export_options()</code>';

// siteurl broken in 3.4.1
	
	$url=get_option('siteurl');
	$url=get_option('siteurl')."/wp-admin/?page=wp-topbar.php&amp;action=export&amp;noheader=true";

	if ( is_ssl() AND (substr($url, 0, 5) != "https" ) AND ( substr($url, 0, 4) == "http" ) ) {
		$url="https".substr($url,4);
	}
	
//	$url.="/wp-admin/?page=wp-topbar.php&action=export&noheader=true";
	
	
	?>
	
	<div class="wrap">
    <div id="icon-options-general" class="icon32"><br/></div>
    <h2><?php _e('Export Options','wp-topbar'); ?></h2>
        <div style="background:#ECECEC;border:1px solid #CCC;padding:0 10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
  	      <p><?php _e('Select the <strong>Export Options</strong> buttons to create either a CSV, SQL (insert) or JSON file for download.   Future versions will include an import functions.','wp-topbar'); ?></br></br>
  			<?php _e('Note: Any PHP options you have entered may cause the CSV export to break a single TopBar into multiple rows in the CSV file.','wp-topbar'); ?>
  			</br>	      
  	      
  	      </p> 
        </div>
		<div>
		   <form method="post" action="<?php echo $url;?>"></form>
		</div>
	    <form method="post"    action="<?php echo $url;?>">
	        <p class="submit">
	            <input type="submit" name="wptbExportJSON" class="button-primary" value="<?php _e('Export Options in JSON Format','wp-topbar'); ?>" />
	            <input type="submit" name="wptbExportSQL"  class="button-primary"  value="<?php _e('Export Options in SQL Format','wp-topbar'); ?>" />
	            <input type="submit" name="wptbExportCSV"  class="button-primary"  value="<?php _e('Export Options in CSV Format','wp-topbar'); ?>" />
	        </p>
	    </form>
	</div>
	
	<?php

	
}

function wptb_export_options_csv() {

	// no html output is allows in this function

	if ( ! isset($_REQUEST['page']) || $_REQUEST['page'] != 'wp-topbar.php' )
		return;

	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	// select one row from the database to setup for the get_col_info function to display column names in one row
	
	$sql ="SELECT * FROM `".$wptb_table_name."` LIMIT 1";
	$mycols = $wpdb->get_row( $sql, ARRAY_A );

	$export_output = "";
	
	foreach ($mycols as $column_name => $column_value) {
		$export_output .= $column_name.";";
	}
	// trim the trailing end semicolon from the export
	$export_output = substr($export_output, 0, -1);

	$export_output .= "\n";
		
	$sql ="SELECT * FROM `".$wptb_table_name."` ORDER BY `bar_id`";

	$myrows = $wpdb->get_results( $sql, ARRAY_A );
	
	$num_rows=$wpdb->num_rows;
	
	$j=0;
	while ( $j < $num_rows ) {	

		$num_cols = sizeof($myrows[$j]);
		$col_count = 0;

		foreach ($myrows[$j] as $column_name => $column_value) {
		
		
			$col_count++;
			
			switch ( $column_name ) :
				//format numeric columns
				case 'bar_id':
				case 'weighting_points':
				case 'delay_time':
				case 'slide_time': 
				case 'scroll_amount': 
				case 'display_time':
				case 'bottom_border_height':
				case 'font_size':
				case 'padding_top':
				case 'padding_bottom':
				case 'margin_top':
				case 'margin_bottom':
						$export_output .= $column_value;
						break;
				//format the remaining -- as text
				default: 
						$export_output .= "'".($column_value)."'";
			endswitch;		

			if ($col_count < $num_cols)
				$export_output .= ';';
			else 
				$export_output .= "\n";
			}
			$j++;
	}

	$file = 'wp_topbar_export';
	$filename = $file."_".date("Y-m-d_H-i",time());

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
	header('Content-disposition: attachment; filename='.$filename.'.csv');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . strlen( $export_output ) );
    echo $export_output;
	return;

}	// End of wptb_export_options_csv



function wptb_export_options_json() {

	// no html output is allows in this function

	if ( ! isset($_REQUEST['page']) || $_REQUEST['page'] != 'wp-topbar.php' )
		return;

	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	$sql ="SELECT * FROM `".$wptb_table_name."` ORDER BY `bar_id`";

	$myrows = $wpdb->get_results( $sql, ARRAY_A );
	
	$num_rows=$wpdb->num_rows;
 
    $json_output = json_encode( $myrows );
    
	$file = 'wp_topbar_export';
	$filename = $file."_".date("Y-m-d_H-i",time());

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
	header('Content-disposition: attachment; filename='.$filename.'.json');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . strlen( $json_output ) );
    echo $json_output;
	return;

}	// End of wptb_export_options_json

function wptb_export_options_sql() {

	// no html output is allows in this function

	if ( ! isset($_REQUEST['page']) || $_REQUEST['page'] != 'wp-topbar.php' )
		return;

	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	
	
	// select one row from the database to setup for the get_col_info function to display column names in one row
	
	$sql ="SELECT * FROM `".$wptb_table_name."` LIMIT 1";
	$mycols = $wpdb->get_row( $sql, ARRAY_A );

	$export_output = "";
	$insert_columns = "(";
	
	foreach ($mycols as $column_name => $column_value) {
		$insert_columns .= $column_name.", ";
	}
	// trim the trailing end semicolon from the export
	$insert_columns = substr($insert_columns, 0, -2).")";
		
	$sql ="SELECT * FROM `".$wptb_table_name."` ORDER BY `bar_id`";

	$myrows = $wpdb->get_results( $sql, ARRAY_A );
	
	$num_rows=$wpdb->num_rows;
	
	$j=0;
	while ( $j < $num_rows ) {	

		$num_cols = sizeof($myrows[$j]);
		$col_count = 0;

		foreach ($myrows[$j] as $column_name => $column_value) {
		
			$col_count++;
			
			switch ( $column_name ) :
				
				case 'bar_id': $export_output .= 'INSERT INTO `'.$wptb_table_name.'`
     '.$insert_columns.'
     VALUES( '.$column_value;
					  break;
				case 'weighting_points':
				case 'delay_time':
				case 'slide_time': 
				case 'display_time':
				case 'scroll_amount': 
				case 'bottom_border_height':
				case 'scroll_amount':
				case 'font_size':
				case 'padding_top':
				case 'padding_bottom':
				case 'margin_left':
				case 'margin_right':
				case 'margin_top':
				case 'margin_bottom':
						$export_output .= $column_value;
						break;
				default: 
						$export_output .= "'".$column_value."'";
						break;
			endswitch;		
			
			if ($col_count < $num_cols) 
				$export_output .= ', ';
			else 
				$export_output .= ");

";
		}
		$j++;
	}
	
//	if ( ! $settings ) return;
    
	$file = 'wp_topbar_export';
	$filename = $file."_".date("Y-m-d_H-i",time());

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
	header('Content-disposition: attachment; filename='.$filename.'.sql');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . strlen( $export_output ) );
    echo $export_output;
	return;

}	// End of wptb_export_options_sql

?>
