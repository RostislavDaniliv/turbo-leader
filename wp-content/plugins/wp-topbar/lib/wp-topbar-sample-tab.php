<?php 

/*
Sample ToolBars Tab

i18n Compatible 

*/



//=========================================================================			
// Sample Toolbars
//=========================================================================			


function wptb_fix_sample_filepath($wptb_filename, $wptb_pathname) {

	$wptb_debug=get_transient( 'wptb_debug' );	

	if ($wptb_filename == "") return "";
	
	$path_parts = pathinfo($wptb_filename);
	
	$new_filename = str_ireplace( 'https://','http://', $wptb_pathname.$path_parts['basename'] );
		
	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_fix_sample_filepath() for filename: '.$wptb_filename.' to '.$new_filename.'</code>';
	
	return $new_filename;
		
} 

// end of wptb_fix_sample_filepath


function wptb_fix_sample_row($wptbOptions, $wptb_pathname) {

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_fix_sample_row() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';

	$wptbOptions['enable_topbar'] = 'false';

	// following section converts all file paths to the /sample directory
	
	$wptbOptions['close_button_image']  = wptb_fix_sample_filepath($wptbOptions['close_button_image'], $wptb_pathname);
	$wptbOptions['reopen_button_image'] = wptb_fix_sample_filepath($wptbOptions['reopen_button_image'], $wptb_pathname );
	$wptbOptions['bar_image']           = wptb_fix_sample_filepath($wptbOptions['bar_image'], $wptb_pathname);
	for ($i=1; $i<=10; $i++)  {
		$wptbOptions['social_icon'.$i.'_image'] = wptb_fix_sample_filepath($wptbOptions['social_icon'.$i.'_image' ], $wptb_pathname);
	}

	return $wptbOptions;

} // end of wptb_fix_sample_row


function wptb_fix_all_rows($wptbRows, $wptb_pathname, $wptb_barid) {

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_fix_all_rows() for ['.$wptb_pathname. ']. Starting ID is '.$wptb_barid.'</code>';

	$num_rows = count($wptbRows);
	$j = 0;
	
	while ( $j < $num_rows ) {	
		$data[$j] = wptb_fix_sample_row($wptbRows[$j], $wptb_pathname);		
		$data[$j]['bar_id'] = $wptb_barid + 1;		
//			echo "</br>Before: ".$wptbRows[$j]['bar_image']."</br>After: ".$data[$j]['bar_image']."</br>";			
		$wptb_barid++;
		$j++;
	}

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_fix_all_rows() Ending ID is '.$wptb_barid.'</code>';

	return $data;

} // end of wptb_fix_all_rows


function wptb_get_sample_data() {

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_get_sample_data()</code>';

  	$wptbGlobalOptions = wptb::wptb_get_GlobalSettings();
	$wptbGlobalOptions [ 'custom_samples_path' ] = $wptbGlobalOptions [ 'custom_samples_path' ];

	$file_data1 = file_get_contents( dirname(__FILE__).'/samples/sample_topbars.json');
    $raw_data = wptb_fix_all_rows(json_decode($file_data1, true), plugins_url('', __FILE__).'/samples/', 0);
	
    if ( $wptbGlobalOptions [ 'custom_samples_path' ] != "" ) {
		if($wptb_debug)
			echo '</br><code>WP-TopBar Debug Mode: wptb_get_sample_data() - loading: ['.$wptbGlobalOptions [ 'custom_samples_path' ].'custom_topbars.json'.']</code>';

			$file_data2 = file_get_contents( $wptbGlobalOptions [ 'custom_samples_path' ].'custom_topbars.json' );
			if($wptb_debug) {
				echo '</br><code>WP-TopBar Debug Mode: wptb_get_sample_data() - Type Custom File '.gettype($file_data2).'</code>';
				echo '</br><code>WP-TopBar Debug Mode: wptb_get_sample_data() - Type JSON Decon '.gettype(json_decode($file_data2,2)).'</code>';
		}
		if ( is_array(json_decode($file_data2, true)) ) {
			if($wptb_debug)
				echo '</br><code>WP-TopBar Debug Mode: wptb_get_sample_data() - fixing: ['.$wptbGlobalOptions [ 'custom_samples_path' ].'custom_topbars.json'.']</code>';
		    $raw_data2 = wptb_fix_all_rows(json_decode($file_data2, true), $wptbGlobalOptions [ 'custom_samples_path' ], count($raw_data));
			$raw_data  = array_merge($raw_data, $raw_data2);
		}
	}
	
	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_get_sample_data(): Number of rows returning '.count($raw_data).'</code>';
	
//		echo '['.file_get_contents( $wptbGlobalOptions [ 'custom_samples_path' ].'custom_topbars.json').']';
//		var_dump($file_data2);
//		echo "</br>";
//		echo "Number of rows: ".count($file_data)."</br>";


	return $raw_data;
	
} // end of wptb_get_sample_data

//=========================================================================		
//  Display the Sample topbars table
//
//=========================================================================		
function wptb_display_Sample_TopBars() {

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_display_all_TopBars()</code>';

	 //Prepare Table of elements

	global $WPTB_DB_VERSION;
	global $wpdb;

	$wptbGlobalOptions = wptb::wptb_get_GlobalSettings();
	
   	$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
   	if (!$wptb_barid_prefix) $wptb_barid_prefix=rand(100000,899999);
   	set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );


	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";
    $data = wptb_get_sample_data();       		
   	
	?>
	
<style media="screen" type="text/css">
	.wptbactions {
	    visibility:hidden;
	}
</style>
	
	
     <div class="wrap">
        
        <div id="icon-options-general" class="icon32"><br/></div>
        <h2><?php _e('Sample TopBars','wp-topbar'); ?></h2>
        
        <div style="background:#ECECEC;border:1px solid #CCC;padding:0 10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
            <p><?php _e('You can copy one row (by hovering over the TopBar and clicking the Copy TopBar link.)  Or you can copy multiple samples by clicking on their checkboxes and then using the drop down box on the Bulk Options to copy those TopBars.','wp-topbar'); ?></p> 
            <?php if ( $wptbGlobalOptions [ 'custom_samples_path' ] != "") 
            			echo __('Attempting to load custom TopBars from this location','wp-topbar').': <code>'.htmlspecialchars($wptbGlobalOptions [ 'custom_samples_path' ]).'custom_topbars.json</code>';
    	  		  echo '<br>'.__('To load your own Custom Samples Topbars, go to the', 'wp-topbar')." <a href='?page=wp-topbar.php&action=globalsettings'>".__('Global Settings tab','wp-topbar').'</a>';
 ?>
        </div>        
	</div>
    
 <div class="tab-pane active" id="demo">
      <p >
		<strong>Bulk Actions</strong>: <select id="selectOpt">
		<option></option>
		<?php 
			echo '<option value="bulkcopy">'.__('Copy to TopBar Table','wp-topbar')."</option>";
         ?>  
        </select>
        <button type="button" onclick="processCheckBoxes()">Apply</button>
&nbsp;&nbsp;&nbsp;
        <strong>Search</strong>: <input id="filter" type="text">
        <form id="topbar-filter" name="addform" method="get">
  	    <table data-filter="#filter" data-filter-disable-enter="true" data-page-size="20" id="footable">		
	    <thead>
			<tr>
		        <th data-sort-ignore="true" data-ignore="true"><input type="checkbox" id="chk_new"  onclick="checkAll('chk');" ></th>
				<th data-class="expand">ID</th>
		        <th data-sort-ignore="true" data-ignore="true"></th>
				<?php echo "<th>".__('Sample')."</th>"; ?>
			</tr>
		</thead>
		<tbody>
		
    <?php 

	foreach ( $data as $wptbOptions ) {	
			
		echo '<tr class="wptbrow" style="vertical-align: top;">';
		echo '<td data-ignore="true"><input type="checkbox"  class="wptbCheckBox" value="'.($wptbOptions['bar_id']+0).'"></td>';
		echo '<td data-type="numeric" data-value="'.($wptbOptions['bar_id']+0).'">'.$wptbOptions['bar_id']."</td>";
		echo '<td data-ignore="true">';	
				echo sprintf('<a href="?page=%s&amp;action=%s&amp;barid=%s&amp;noheader=true">Copy&nbspTopbar</a>',$_REQUEST['page'],'copysample',($wptbOptions['bar_id']+$wptb_barid_prefix));		
		echo '</td>';
		echo '<td>';

		if (isset($wptbOptions['allow_reopen']) && ($wptbOptions['allow_reopen']) == "yes")
			wptb::wptb_display_TopBar('',$wptbOptions, false, 1, true);
		else 
			wptb::wptb_display_TopBar('',$wptbOptions, false, 1, false);		
		
		echo '</td>';
		
		echo '</tr>';
	}

	?>
		</tbody>
	<tfoot>
		<tr>
			<td colspan="5">
				<div class="pagination pagination-centered hide-if-no-paging"></div>
			</td>
		</tr>
	</tfoot>		
	</table>

	
    </form>
    </div>	
    </div>	
	
	<?php


} // end of wptb_display_Sample_TopBars

function wptb_process_Sample_bulk_action() {

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : array();

   	switch ( $action ) {
			
	case "bulkcopy":
        $data = wptb_get_sample_data();       		
		$barid = isset($_REQUEST['barid']) ? $_REQUEST['barid'] : array();
		$barids = explode(",", $barid);
        $n = count($barids);
		foreach ($barids as $key => $barid) {
		  	$wptbOptions = $data [$barid - 1];			
		  	$wptbOptions['enable_topbar'] = 'false';
  			wptb_insert_row($wptbOptions);
  		}
		if ($n > 0) {
	        $wptb_i18n = sprintf( _n('%d row copied.', '%d rows copied.', $n, 'wp-topbar'), $n );
	        echo '<div class="updated"><p><strong>'.$wptb_i18n.'</strong></p></div>';		
		}	  

	}
}
    
?>