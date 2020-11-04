(function(){

	$ = jQuery.noConflict();

	$(document).ready(function(){
		console.log("work");

		setRefID();
		showEmptyRegFields();

		workShowEventButton();
		workStartEventButton();




	});
	
	
	document.getElementById("user_login-10985").value!=0;
	


	function get_url_var(key) {
	    var s = window.location.search;
	    s = s.match(new RegExp(key + '=([^&=]+)'));
	    return s ? s[1] : false;
	}

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


	// ПОДСТАВЛЯЕМ РЕФ ID В ФОРМУ РЕГИ
	function setRefID(){

		var ref_id = $("#refferer-id").html();
		var reg_site_id = $("#reg-site-id").html();
		var reg_site_url = $("#reg-site-url").html();

		console.log(reg_site_id);

		if( ref_id.length ){
			$('input[data-key="referer_id"]').val(ref_id);
		}	

		if( reg_site_id.length ){
			$('input[data-key="reg_site_id"]').val(reg_site_id);
		}	

		if( reg_site_url.length ){
			$('input[data-key="reg_site_url"]').val(reg_site_url);
		}	

	}

	// заполняем сладеры расписаний мероприятий
	this.fill_events_slider = function(){

		var $rasp_gm_uds = $(".rasp-gm-uds:not(.loaded)");
		var $rasp_gm_yoke = $(".rasp-gm-yoke:not(.loaded)");
		var $rasp_bt_uds = $(".rasp-bt-uds:not(.loaded)");
		var $rasp_bt_yoke = $(".rasp-bt-yoke:not(.loaded)");

		if( $rasp_gm_uds.length ){
			sendAjax('getEvents', {type_id: 1,product_id: 1}, fill_event_slider);
			$rasp_gm_uds.addClass('loaded');
		}

		if( $rasp_gm_yoke.length ){
			sendAjax('getEvents', {type_id: 1,product_id: 2}, fill_event_slider);
			$rasp_gm_yoke.addClass('loaded');
		}

		if( $rasp_bt_uds.length ){
			sendAjax('getEvents', {type_id: 2,product_id: 1}, fill_event_slider);
			$rasp_bt_uds.addClass('loaded');
		}

		if( $rasp_bt_yoke.length ){
			sendAjax('getEvents', {type_id: 2,product_id: 2}, fill_event_slider);
			$rasp_bt_yoke.addClass('loaded');
		}

	}

	// callback аякса заполнения слайдеров
	function fill_event_slider(data){
		var res = JSON.parse(data);
		var elem_class = '.' + getRaspElemClass( res.product_id, res.type_id );
		var html_inner = '';

		

		for(var i = 0; i<res.events.length; i++){
			var dayName = getDayName(res.events[i].day);
			html_inner +=	'<tr>\
								<td>' + dayName + '</td>\
								<td>' + res.events[i].time + ' <span>МСК</span></td>\
								<td>' + getTimePlus(res.events[i].time, 3)+ ' <span>Астана</span></td>\
							</tr>';
		}

		var head_table = '<thead><th colspan="3">' + $(elem_class).text() + '</thead>';

		$(elem_class).addClass('custom-table custom-table-2').html( '<table class="event-slider-table">' + head_table + html_inner + '</table>');

	}

	function getTimePlus(time, plus_hours){

		var time_split = time.split(':');
		var h = time_split[0];
		var now = new Date();
		now.setHours(parseInt(h, 10) + plus_hours);
		h = now.getHours();
		h = ('00'+h).substr(('00'+h).length-2, ('00'+h).length);
		return h + ':' + time_split[1];

	}

	function getRaspElemClass(product_id, type_id){
		if(product_id == 1 && type_id == 1) return 'rasp-gm-uds';
		if(product_id == 1 && type_id == 2) return 'rasp-bt-uds';
		if(product_id == 2 && type_id == 1) return 'rasp-gm-yoke';
		if(product_id == 2 && type_id == 2) return 'rasp-bt-yoke';
	}

	function getDayName(num){
		if(num == 1) return 'Понедельник';
		if(num == 2) return 'Вторник';
		if(num == 3) return 'Среда';
		if(num == 4) return 'Четверг';
		if(num == 5) return 'Пятница';
		if(num == 6) return 'Суббота';
		if(num == 7) return 'Воскресенье';
	}



	function showEmptyRegFields(){

		//скрываем поля Логина и почты, если заполнены

		var input_keys = ['user_login', 'user_email'];

		for(var i=0; i<input_keys.length; i++){
			var key = input_keys[i];
			var inputCont = $(".um-field-text[data-key='"+key+"']");
			var inputVal = inputCont.find('input').val();

			var errorInput = inputCont.find('input').hasClass('um-error');

			if( (typeof inputVal!='undefined' && inputVal.length==0) || errorInput ){
				inputCont.addClass("active");
			}

		}

		$(".um-field-error").each(function(){
			var $par = $(this).closest( '.um-field-text' );
			$par.addClass('active');
		});

	}


	function workShowEventButton(){
		updateEventButton();

		setInterval(function(){
			updateEventButton();
		}, 1000*30);
	}


	var sliders_btns = '.event-btn-uds-gm, .event-btn-yoke-gm, .event-btn-uds-bt, event-btn-yoke-bt';

	function workStartEventButton(){
		
		$(".start-event-button, " + sliders_btns ).click(function(e){

			e.preventDefault();				
			var link = $(this).attr("href");				

			if(typeof link == 'undefined' || link=="#"){
				showAlert();
			}
			else{
				window.location = link;
			}			

		});
	}
	



	// ОТОБРАЖЕНИЕ УВЕДОМЛЕНИЯ О ТОМ, ЧТО МЕРОПРИЯТИЯ ЕЩЕ НЕ НАЧАЛИСЬ
	function showAlert(){		

		$("#event_alert_guest").show(500);

		setTimeout(function(){
			$("#event_alert_guest").hide(800);
		},10000);
	}


	function updateEventButton(){

		var data={
			action: 'updateEventButton',
			role: $("#sb-user-role").html()
		}


		$.ajax({
			type:"POST",
			url: '/wp-content/themes/Richer/php/ajax.php',
			data: data,
			success: function(res){					

				var resData = JSON.parse(res);
				console.log(resData);				

				var types = ['yoke', 'game'];

				$(".start-event-button").addClass('disabled');
				$(".start-event-button").attr('href', '#');
				$(sliders_btns).attr('href', '#');

				for(var i=0; i<resData.length; i++){

					console.log(resData[i]);

					var event = resData[i];
					var type = resData[i].type;

					if(event.enable==1){

						var role = resData[i].role.split('-')[0];
						console.log(role);

						if( role == 'guest' || role == 'partner' ){
							window.location = event.href;
						}

						$(".start-event-button[type="+type+"]").removeClass('disabled');
						$(".start-event-button[type="+type+"]").attr('href', event.href);	

						// кнопки в слайдерах
						if(type == 'game'){
							if(resData[i].event_type == 1) $('.event-btn-uds-gm').attr('href', event.href);
							if(resData[i].event_type == 2) $('.event-btn-uds-bt').attr('href', event.href);
						}

						if(type == 'yoke'){
							if(resData[i].event_type == 1) $('.event-btn-yoke-gm').attr('href', event.href);
							if(resData[i].event_type == 2) $('.event-btn-yoke-bt').attr('href', event.href);
						}


					}

				}	
				
			}
		});		
	}


})();