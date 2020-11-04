<?php

// страница ОФОРМИТЬ ЗАКАЗ для юр.лиц

 

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



$query='SELECT 	wMain.user_id as user_id,

				wRegpartner.meta_value as reg_partner,

				wPayproduct1000.meta_value as pay_product_1000,

				wPayproduct400.meta_value as pay_product_400,

				wArendaproduct.meta_value as arenda_product

		FROM wp_usermeta wMain

		LEFT JOIN wp_usermeta wRegpartner

			ON wMain.user_id=wRegpartner.user_id and wRegpartner.meta_key="regpartner"

		LEFT JOIN wp_usermeta wPayproduct1000

			ON wMain.user_id=wPayproduct1000.user_id and wPayproduct1000.meta_key="payproduct"

		LEFT JOIN wp_usermeta wPayproduct400

			ON wMain.user_id=wPayproduct400.user_id and wPayproduct400.meta_key="payproduct_18"

		LEFT JOIN wp_usermeta wArendaproduct

			ON wMain.user_id=wArendaproduct.user_id and wArendaproduct.meta_key="arendaproduct"

		WHERE wMain.user_id='.$sponsor.' 

		LIMIT 1';





$results = $wpdb->get_results( $query);

$links = $results[0];



//echo '<pre>';

//print_r($links);

//echo '</pre>';



?>



<style>



#product900-container,
#product1000-container,
#product400-container,
#product100-container{

	display: none;

}



</style>



<script type="text/javascript">

	$ = jQuery.noConflict();



	var links = {

		regpartner 			: "<?=$links->reg_partner?>",

		pay_product_1000 	: "<?=$links->pay_product_1000?>",

		pay_product_400 	: "<?=$links->pay_product_400?>",

		arenda_product 		: "<?=$links->arenda_product?>"

	}



	var linkPartner = {

		value : "<?=$links->reg_partner?>",

		block : "product900-container"

	};



	var linkProduct1000 = {

		value : "<?=$links->pay_product_1000?>",

		block : "product1000-container"

	};



	var linkProduct400 = {

		value : "<?=$links->pay_product_400?>",

		block : "product400-container"

	};



	var linkArenda = {

		value : "<?=$links->arenda_product?>",

		block : "product100-container"

	};



	$(function(){



		setPriceBlock(linkPartner);

		//setPriceBlock(linkProduct1000);

		//setPriceBlock(linkProduct400);

		//setPriceBlock(linkArenda);



		var partnerButton = $(".product-900 a");



		if(typeof partnerButton != 'undefined'){



			partnerButton.attr("href", linkPartner.value);



		}



		// product900-container product1000-container product400-container product100-container

	}); 





	function setPriceBlock(link){

		console.log(link);



		if(link.value.length>0){

			console.log(11);

			$("."+link.block+" a").attr("href", link.value);

			$("."+link.block+" a").attr("target", "_blank");

			$("."+link.block).show(1000);



		}



	}

</script>





