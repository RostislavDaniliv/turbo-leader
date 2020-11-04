<style>

	#content i.fa{

		margin-right: 0 !important;

	}

	.events-edit-tables tfoot td{

	    background: #292d38;

	}

	.events-edit-tables input[type="number"],

	.events-edit-tables input[type="time"]{

	    background-color: #fff;

	    border: 1px solid #ddd;

	    padding: 5px 10px 5px;

	    outline: none;

	    font-size: 16px;

	    color: #777;

	    margin: 0;

	    width: 100%;

	    max-width: 100%;

	    display: block;

	    margin-bottom: 0;

	    -webkit-border-radius: 1px;

	    -moz-border-radius: 1px;

	    border-radius: 1px;

	    box-sizing: border-box;

	    -moz-box-sizing: border-box;

	    -webkit-appearance: none;

	}

</style>



<div id="content" class="span12">



	<div class="row" id="activate-user-form">

		<h4>Активация пользователя</h4>

		<div class="span3">

			<input name="user_id" type="text" placeholder="ID пользователя" />

		</div>

		<div class="span3">

			<input name="date" type="date" />

		</div>

		<div class="span3">

			<button id="activate-user" class="button green small simple"><i class="fa fa-check-circle" title="Добавить"></i></div>

		</div>

		

		

	</div>



	<div class="row">

		

		<div class="span5 events-edit-tables">

			<h4>Гостевая встреча UDS Game</h4>

			<div class="custom-table custom-table-2">

				<table id="table-gm-uds" width="100%">

					<thead>

						<tr>

							<th>День</th>

							<th>Время</th>

							<th style="width: 90px;"></th>

						</tr>

					</thead>

					<tfoot>

						<tr>

							<td><input type="number" value="1" max="7" min="1" /></td>

							<td><input type="time" value="19:00" /></td>

							<td>

								<button href="#" class="button green mini simple align add-new-event" product-id="1" type-id="1"> 

									<i class="fa fa-plus" title="Добавить"></i>

								</button>

							</td>

						</tr>

					</tfoot>

					<tbody></tbody>

				</table>

			</div>

		</div>	



		<div class="span5 events-edit-tables">

			<h4>Бизнес-тренинг UDS Game</h4>

			<div class="custom-table custom-table-2">

				<table id="table-bt-uds" width="100%">

					<thead>

						<tr>

							<th>День</th>

							<th>Время</th>

							<th style="width: 90px;"></th>

						</tr>

					</thead>

					<tfoot>

						<tr>

							<td><input type="number" value="1" max="7" min="1" /></td>

							<td><input type="time" value="19:00" /></td>

							<td>

								<button href="#" class="button green mini simple align add-new-event" product-id="1" type-id="2"> 

									<i class="fa fa-plus" title="Добавить"></i>

								</button>

							</td>

						</tr>

					</tfoot>

					<tbody></tbody>

				</table>

			</div>

		</div>	



	</div>



	<div class="row">

		

		<div class="span5 events-edit-tables">

			<h4>Гостевая встреча YOKE</h4>

			<div class="custom-table custom-table-2">

				<table id="table-gm-yoke" width="100%">

					<thead>

						<tr>

							<th>День</th>

							<th>Время</th>

							<th style="width: 90px;"></th>

						</tr>

					</thead>

					<tfoot>

						<tr>

							<td><input type="number" value="1" max="7" min="1" /></td>

							<td><input type="time" value="19:00" /></td>

							<td>

								<button href="#" class="button green mini simple align add-new-event" product-id="2" type-id="1"> 

									<i class="fa fa-plus" title="Добавить"></i>

								</button>

							</td>

						</tr>

					</tfoot>

					<tbody></tbody>

				</table>

			</div>

		</div>	



		<div class="span5 events-edit-tables">

			<h4>Бизнес-тренинг YOKE</h4>

			<div class="custom-table custom-table-2">

				<table id="table-bt-yoke" width="100%">

					<thead>

						<tr>

							<th>День</th>

							<th>Время</th>

							<th style="width: 90px;"></th>

						</tr>

					</thead>

					<tfoot>

						<tr>

							<td><input type="number" value="1" max="7" min="1" /></td>

							<td><input type="time" value="19:00" /></td>

							<td>

								<button href="#" class="button green mini simple align add-new-event" product-id="2" type-id="2"> 

									<i class="fa fa-plus" title="Добавить"></i>

								</button>

							</td>

						</tr>

					</tfoot>

					<tbody></tbody>

				</table>

			</div>

		</div>	



	</div>



</div>





<script type="text/javascript">



$(document).ready(function(){



	workActivateUser();

	updateAllEventTables();

	workAddNewEvent();

	workEditEvent();



});



function sendAjax(action, data, callback){



	data.action = action;

	$.ajax({

		type: "POST",

		url: "/wp-content/themes/Richer/php/ajax.php",

		data: data,

		success: function(res){



			//console.log(res);

			if(callback!=null)

				callback(res);

		}

	})

}



function updateAllEventTables(){



	sendAjax('getEvents', {type_id: 1,product_id: 1}, fill_event_table);

	sendAjax('getEvents', {type_id: 2,product_id: 1}, fill_event_table);

	sendAjax('getEvents', {type_id: 1,product_id: 2}, fill_event_table);

	sendAjax('getEvents', {type_id: 2,product_id: 2}, fill_event_table);



}





function workActivateUser(){



	$("#activate-user").click(function(){



		var user_id = $("#activate-user-form input[name=user_id]").val();

		var date = $("#activate-user-form input[name=date]").val();



		if( user_id.length>0 && date.length>0){



			var data = { user_id: user_id, date: date };

			

			var callback = function(){

				$("#activate-user-form input").val("");

			}



			sendAjax('activateUser', data, callback);

		}



		

	});



}





function workAddNewEvent(){



	$(".add-new-event").click(function(e){

		e.preventDefault();

		var $row = $(this).closest('tr');



		var data = {

			product_id: $(this).attr("product-id"),

			type_id: $(this).attr("type-id"),

			day: $row.find('input[type=number]').val(),

			time: $row.find('input[type=time]').val()

		};



		var callback = function(){

			var cb_data = { type_id: data.type_id , product_id: data.product_id};

			sendAjax('getEvents', cb_data, fill_event_table);

		}



		sendAjax('editEvent', data, callback);

	});



}



function workEditEvent(){



	$(".event-update, .event-remove").click(function(e){

		e.preventDefault();

		var $row = $(this).closest('tr');

		var event_id = $row.attr("event-id");



		var data = {

			event_id: event_id,

			product_id: $row.attr("product-id"),

			type_id: $row.attr("type-id")

		};



		if( $(this).hasClass('event-remove') ){

			data.remove = 1;

		}

		else{

			data.day = $row.find('input[type=number]').val();

			data.time = $row.find('input[type=time]').val();

		}		



		var callback = function(){

			var cb_data = { type_id: data.type_id , product_id: data.product_id};

			sendAjax('getEvents', cb_data, fill_event_table);

		}



		sendAjax('editEvent', data, callback);

	});



}





function fill_event_table(res){



	var result = JSON.parse(res);

	var table_id;



	switch(result.product_id){

		case 1:

			if(result.type_id == 1) table_id = '#table-gm-uds';

			if(result.type_id == 2) table_id = '#table-bt-uds';

		break;



		case 2:

			if(result.type_id == 1) table_id = '#table-gm-yoke';

			if(result.type_id == 2) table_id = '#table-bt-yoke';

		break;

	}



	var tb_html;

	var events = result.events;



	for(var i = 0; i<events.length; i++){



		tb_html += '<tr event-id="' + events[i].id + '" product-id="'+result.product_id+'" type-id="'+result.type_id+'">\
						<td> <input type="number" value="' + events[i].day + '" max="7" min="1" /> </td>\
						<td> <input type="time" value="' + events[i].time + '" /> </td>\
						<td>\
							<button event-id="' + events[i].id + '" class="button  orange mini simple align event-update">\
								<i class="fa fa-floppy-o" title="Сохранить"></i>\
							</button>\
							<button event-id="' + events[i].id + '" class="button  red mini simple align event-remove">\
								<i class="fa fa-times" title="Удалить"></i>\
							</button>\
						</td>\
					</tr>';



	}



	$(table_id + " tbody").html( tb_html );



	workEditEvent();



}



</script>