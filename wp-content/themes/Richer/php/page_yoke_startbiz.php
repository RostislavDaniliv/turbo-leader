<style>
#yoke-promo-kod{
	font-size: 22px;
}
</style>

<?php

$user_id = get_current_user_id();

if ($user_id <= 0){
	$user_id = 1;
}

global $wpdb;

$sponsor = $wpdb->get_row( "SELECT * FROM wp_usermeta where meta_key = 'submitted' and user_id = {$user_id}");
$submitData = unserialize($sponsor->meta_value);
$sponsor = $submitData['referer_id'];


if (!$sponsor){
	$sponsor = 1;					
}


$query='SELECT 	wMain.meta_value 
		FROM wp_usermeta wMain
		WHERE wMain.user_id='.$sponsor.' AND wMain.meta_key="yoke_promo"
		LIMIT 1';

$yoke_id = $wpdb->get_var( $query);

?>

<script>
$(document).ready(function(){

	var yoke_code = "<?php echo $yoke_id ?>";

	if(yoke_code.length>0){

		$("#yoke-promo-kod").text(yoke_code);

	}
});

</script>