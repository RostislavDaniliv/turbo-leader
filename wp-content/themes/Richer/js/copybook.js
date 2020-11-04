var $ =  jQuery.noConflict();





$(document).ready(function(){

	workLoadButton();
	workFilter();
	workSearchFilter();
	workSerchButton();
	workToCartButton();
	workCartLoadButton();
	workFromCartButton();
	workRefreshButton();
	workComapnyRegBtn();
	workExportContactsButton();
	workIsOnlineButton();

	// загружаем данные на 1й вкладке

	$("#panel1 .big-loader-down .load-button").click();

});



// функция отправления аякс-запроса

function sendAjax(action, data, callback){

	data.action = action;

	$.ajax({
		type: "POST",
		url: "/wp-content/themes/Richer/php/ajax.php",
		data: data,

		success: function(res){

			if(callback!=null)

				callback(res);

		}

	})

}



// подгрузка людей на вкладке Контакты (offset - смещение для аякс подгрузки)

function loadUsers(offset){

	var data = {
		offset: offset,
		filter: $("#role-filter").val()
	};

	sendAjax("cp_getUsers", data, res_loadUsers);

}

// результат загрузки пользователей

function res_loadUsers(data){

	var users = JSON.parse(data);
	console.log(users);

	if(users.length>0){

		var usersHTML = '';

		for(var i=0; i<users.length; i++){

			var htmlBlock = getUserHTML(users[i]);
			usersHTML += htmlBlock;

		}

		var old_offset = parseInt($("#panel1 .big-loader-down .load-button").attr("offset"));

		$("#panel1 .big-loader-down .load-button").attr("offset", old_offset + users.length);
		$("#copybook_usersContainer").append(usersHTML);
		

		$("#copybook_usersContainer .acc-group").show();

		/*$("#copybook_usersContainer .acc-group").each(function(){

			$(this).show(500);

		})*/

		accordionWorkFunctions("panel1");

		workNoteButtons();
	}

	disactivateLoader("panel1");

	if(users.length<30){

		$("#panel1 .load-button").addClass('disactive');

	}	

}


// составляем верстку элемента аккордеона пользователя

function getUserHTML(user){

	var vk='',
		fb='',
		insta='',
		youtube='';

	//console.log(user);

	if(user.facebook.length!=0){

		fb = '<a href="'+user.facebook+'" style="background: #3B5999;" target="_blank" class="s-icon" original-title="Facebook"><i class="um-faicon-facebook"></i></a>';

	}

	if(user.vkontakte.length!=0){

		vk = '<a href="'+user.vkontakte+'" style="background: #597da3;" target="_blank" class="s-icon" original-title="Vkontakte"><i class="um-faicon-vk"></i></a>';

	}

	if(user.youtube.length!=0){

		youtube = '<a href="'+user.youtube+'" style="background: #e52d27;" target="_blank" class="s-icon" original-title="Youtube"><i class="um-faicon-youtube"></i></a>';

	}

	if(user.instagram.length!=0){

		insta = '<a href="'+user.instagram+'" style="background: #3f729b;" target="_blank" class="s-icon" original-title="Instagram"><i class="um-faicon-instagram"></i></a>';

	} 

	var user_titlename = user.username;

	if(user.city!="Не указан"){
		user_titlename = user.username + ' (' + user.city + ')';
	}

	var socialogin = {
		href: '',
		text: ''
	};

	if(user.vk_link.length>0){
		socialogin.text = 'vkontakte';
		socialogin.href = user.vk_link;
	} 

	if(user.fb_link.length>0){
		socialogin.text = 'facebook';
		socialogin.href = user.fb_link;
	}

	var user_socialogin_html = '';

	if(socialogin.href.length>0){

		user_socialogin_html = '<tr><td>Регистрация через:</td><td><a target="_blank" href="'+socialogin.href+'">'+socialogin.text+'</a></td></tr>';

	}

	var html = '<div class="acc-group" user-id="'+user.userID+'" style="display:none"><div class="accordion-title"><div class="acc-icon fright"><i class="fa fa-minus"></i></div>';
	html += '<span class="user-titleName"><div class="user_checkbox" rel="'+user.userID+'"><div></div></div>';
	html +=	'<i class="icon fa '+user.role_icon+'"></i>'+user_titlename+'</span>';
	html += '<div class="status-icons"><div class="user-regDate">'+user.regdate+'</div>';
	html += '<i class="icon fa fa-lightbulb-o mini circle '+user.onlinestatus+'" title="'+user.onlinetitle+'"></i>';
	html += '<i class="icon fa fa-eye mini circle '+user.viewGMstatus+'" title="'+user.viewGMtitle+'"></i>';
	html += '<i class="icon fa fa-hand-o-up mini circle '+user.clickSBstatus+'" title="'+user.clickSBtitle+'"></i>';
	html += '</div></div><div class="accordion-inner" style="">';
	html += '<div class="row"><div class="span4"><div class="client_avatar"><img width="250" alt="" src="'+user.userAva+'"></div>';
	html +='<div class="social-box">'+fb+insta+youtube+'</div>';
	html += '<a data-message_to="'+user.userID+'" class="um-message-btn button  blue mini three_d align" href="#"><span>НАПИСАТЬ</span></a></div><div class="span8">';
	html += '<table><tr><td>Имя:</td><td>'+user.username+'</td></tr><tr><td>Регистрация:</td><td> '+user.regdate+'</td></tr>';
	html += '<tr><td>Последний вход:</td><td>'+user.lastlogin+'</td></tr><tr><td>Логин:</td><td>'+user.login+'</td></tr>';
	html += '<tr><td>Email-адрес:</td><td><a href="mailto:'+user.email+'">'+user.email+'</a></td></tr>';
	html += '<tr><td>Телефон:</td><td>'+user.mobile_number+'</td></tr><tr><td>Город:</td><td>'+user.city+'</td></tr><tr><td>Telegram:</td><td>'+user.skype+'</td></tr>'
	html +=  user_socialogin_html;
	html +='</table></div>';
	html += '<div class="row" style="padding: 0 10px;">';
	html += '<div class="span11"><div class="note-container"><textarea rows="3" disabled="disabled" placeholder="Заметка отсутствует">'+user.note+'</textarea></div></div>';
	html +='<div class="span1"><div class="note-buttons">';
	html += '<div class="button  turquoise small  three_d align note-redactor active"><i class="fa fa-pencil" title="Создать/редактировать заметку"></i></div>';
	html += '<div class="button  red  small  three_d align note-cancel"><i class="fa fa-times" title="Отмена"></i></div>';
	html += '<div class="button  green  small  three_d align note-save"><i class="fa fa-floppy-o" title="Сохранить заметку"></i></div></div></div></div>';
	html += '</div></div></div></div>';

	return html;

}


// включаем в работу компонент аккордеона

function accordionWorkFunctions(idPanel){

	

	$('.accordion .accordion-title').click(function() {

	    if($(this).next().is(':hidden')) {

	        $(this).parent().parent().find('.accordion-title').removeClass('active').find('.acc-icon i').removeClass('fa-minus').addClass('fa-plus').parent().parent().next().slideUp(200);

	        $(this).toggleClass('active').find('.acc-icon i').addClass('fa-minus').removeClass('fa-plus').parent().parent().next().slideDown(200);

	    }

	    return false;

	});



	workUserCheckbox(idPanel);



}



function activateLoader(idPanel){



	$("#"+idPanel+" .big-loader-down .load-button.active").removeClass("active");

	$("#"+idPanel+" .big-loader-down .loader-bar").addClass("active");

	$("#"+idPanel+" .big-loader-down .bar-percentage").addClass("striped");



}



function disactivateLoader(idPanel){



	$("#"+idPanel+" .big-loader-down .loader-bar").removeClass("active");

	$("#"+idPanel+" .big-loader-down .load-button").addClass("active");	

	$("#"+idPanel+" .big-loader-down .bar-percentage").removeClass("striped");



}



//обрботка клика по кнопке "Загрузить" на вкладке Контакты

function workLoadButton(){



	$("#panel1 .load-button").click(function(){



		if(!$(this).hasClass('disactive')){



			var offset = $(this).attr("offset");

		

			activateLoader("panel1");

			loadUsers(offset);



		}		



	});



}





// обработка изменения селекта с ролями

function workFilter(){



	$("#role-filter").change(function(){



		$("#panel1 .load-button").attr("offset", 0);

		$("#panel1 .load-button").removeClass('disactive');



		var count = $("#copybook_usersContainer .acc-group").length;



		$("#panel1 .load-button").click();



		if(count>0){



			clearAccordeonContainer({

					container_id: "copybook_usersContainer"

			});



		}



	});



}





// очистка содержимого аккордеона и клик по элементу, если требуется

function clearAccordeonContainer(data){



	var id = data.container_id;



	var count = $("#"+id+" .acc-group").length;



	$("#"+id+" .acc-group").each(function(i){



		//$(this).hide(500);



		if(i==count-1){

			$("#"+id).html('');	

			/*setTimeout(function(){

				

				$("#"+id).html('');						



			}, 500);*/

		}

	});



}



// изменение селекта и инпута в панели поиска

function workSearchFilter(){



	$("#search-type").change(function(){



		var value = $(this).val();



		if(value=="lastname"){



			$("#value-sf").attr("placeholder", "Фамилия");



		}

		else{



			$("#value-sf").attr("placeholder", "Email");



		}



		$("#value-sf").keyup();



	});





	$("#value-sf").keyup(function(){



		$("#panel2 .load-button.disactive").removeClass('disactive');

		$("#panel2 .load-button").attr("offset", 0);



	});



}



// клик по кнопкам "Поиск"

function workSerchButton(){



	$("#panel2 .load-button").click(function(){



		if(!$(this).hasClass('disactive')){



			var sval = $.trim($("#value-sf").val());

			var stype = $("#search-type").val();

			var offset = $(this).attr("offset");





			if(sval.length>0){



				var data = {

					type: stype,

					value: sval,

					offset: $(this).attr("offset")

				}



				if(offset==0){



					clearAccordeonContainer({

							container_id: "copybook_sf_usersContainer"

					});



				}				



				activateLoader("panel2");



				sendAjax("cp_getUsers", data, res_searchUsers);



			}

		}		



	});



	$("#search-user-button").click(function(){



		$("#panel2 .load-button").click();



	})



}





// Обработка результата Аякса по поиску людей (по мейлу, по фамилии)

function res_searchUsers(data){

	var users = JSON.parse(data);

	disactivateLoader("panel2");

	if(users.length>0){

		var usersHTML = '';

		for(var i=0; i<users.length; i++){

			var htmlBlock = getUserHTML(users[i]);
			usersHTML += htmlBlock;

		}

		var old_offset = parseInt($("#panel2 .big-loader-down .load-button").attr("offset"));

		$("#panel2 .big-loader-down .load-button").attr("offset", old_offset + users.length);

		$("#copybook_sf_usersContainer").append(usersHTML);

		$("#copybook_sf_usersContainer .acc-group").show();

		accordionWorkFunctions("panel2");

		workNoteButtons();

	}

	else{

		$("#copybook_sf_usersContainer").append("<div class='acc-group'>Поиск не дал результатов</div>");

	}

	if(users.length<30){

		$("#panel2 .load-button").addClass('disactive');

	}	
}



// работа кастомного чекбокса

function workUserCheckbox(idPanel){

	$("#"+idPanel+" .user_checkbox").unbind('click');

	$("#"+idPanel+" .user_checkbox").bind('click', function(e){

		e.stopPropagation ? e.stopPropagation() : (e.cancelBubble=true);

		var val = $(this).hasClass("checked");
		var parElem = $(this).closest('.acc-group');

		if(val){

			$(this).removeClass("checked");
			parElem.removeClass("checked");

		}

		else{

			$(this).addClass("checked");
			parElem.addClass("checked");

		}

	})

}





// обработка клика по кнопке "В корзину"

function workToCartButton(){

	$(".cart-button").click(function(){

		var id_panel = $(this).attr("id-panel");
		var str_ids = '';

		// собираем айдишники в строку

		$("#"+id_panel+" .acc-group.checked").each(function(){

			var uID = $(this).attr("user-id");

			if(str_ids.length>0) str_ids+=',';

			str_ids+= uID;

			$(this).hide();

			var el = $(this);



			setTimeout(function(){

				el.remove();

			}, 1000);



		});



		if(str_ids.length>0){



			var data={

				values: str_ids

			};



			sendAjax("cp_addToCart", data, res_addToCart);



		}





	});



}



// Обработка кнопки "Убрать из корзины"

function workFromCartButton(){



	$("#remove-from-cart").click(function(){



		var str_ids = '';



		// собираем айдишники в строку

		$("#panel3 .acc-group.checked").each(function(){



			var uID = $(this).attr("user-id");

			

			if(str_ids.length>0) str_ids+=',';

			str_ids+= uID;



			//$(this).hide(500);

			var el = $(this);
			el.remove();


			/*setTimeout(function(){

				el.remove();

			}, 1000); */



		});



		if(str_ids.length>0){



			var data={

				values: str_ids

			};



			sendAjax("cp_removeFromCart", data, null);



		}



	});



}



// обработка результата успешного добавления людей в корзину 

function res_addToCart(data){



	var ids = JSON.parse(data);



}





// обработка клика по кнопке "Загрузить" в корзине

function workCartLoadButton(){



	$("#panel3 .load-button").click(function(){



		if(!$(this).hasClass('disactive')){



			var data = {

				cart: 1,

				offset: $(this).attr("offset")

			};



			activateLoader("panel3");



			sendAjax("cp_getUsers", data, res_loadCartUsers);



		}	

	});



}



// обработка результата загрузки людей в корзине

function res_loadCartUsers(data){



	var users = JSON.parse(data);



	if(users.length>0){



		var usersHTML = '';



		for(var i=0; i<users.length; i++){



			var htmlBlock = getUserHTML(users[i]);



			usersHTML += htmlBlock;





		}



		var old_offset = parseInt($("#panel3 .big-loader-down .load-button").attr("offset"));



		$("#panel3 .big-loader-down .load-button").attr("offset", old_offset + users.length);



		$("#copybook_cart_usersContainer").append(usersHTML);


		$("#copybook_cart_usersContainer .acc-group").show();

		/*$("#copybook_cart_usersContainer .acc-group").each(function(){

			$(this).show(500);

		})*/

		accordionWorkFunctions("panel3");

		workNoteButtons();



	}



	disactivateLoader("panel3");

	

	if(users.length<30){

		$("#panel3 .load-button").addClass('disactive');

	}	



}





function workRefreshButton(){



	$(".refresh-cart").click(function(){



		var id_panel = $(this).attr('id-panel');



		var cont_id = "copybook_cart_usersContainer"



		if(id_panel=="panel1")

			cont_id = "copybook_usersContainer";





		clearAccordeonContainer({

			container_id: cont_id

		})



		var button = $("#"+id_panel+" .load-button");

		button.removeClass("disactive");

		button.attr("offset", 0);

		button.click();



	})



}



// обработка кнопки Регистрация компании

function workComapnyRegBtn(){



	$("#reg-company-btn").click(function(){



		$("#register-company-form").addClass("active");



	});



	$("#register-company-form .closeform").click(function(){



		$("#register-company-form").removeClass("active");



	});



}



// обработка функционала кнопок для заметок

function workNoteButtons(){



	var old_value = '';



	$(".note-buttons .note-redactor").click(function(){



		var container = $(this).closest(".acc-group");

		var id_user = container.attr("user-id");



		$(".acc-group[user-id="+id_user+"] .note-cancel, .acc-group[user-id="+id_user+"] .note-save").addClass("active");

		$(this).removeClass("active");





		var textarea = $(".acc-group[user-id="+id_user+"] .note-container textarea");

		textarea.removeAttr("disabled");

		old_value = '';

		old_value = textarea.val();



	});



	$(".note-buttons .note-cancel").click(function(){



		var container = $(this).closest(".acc-group");

		var id_user = container.attr("user-id");



		$(".acc-group[user-id="+id_user+"] .note-redactor").addClass("active");

		$(".acc-group[user-id="+id_user+"] .note-save").removeClass("active");

		$(this).removeClass("active");



		var textarea = $(".acc-group[user-id="+id_user+"] .note-container textarea");

		textarea.attr("disabled", true);

		textarea.val(old_value);

		old_value = '';

		

	});



	$(".note-buttons .note-save").click(function(){



		var container = $(this).closest(".acc-group");

		var id_user = container.attr("user-id");



		$(".acc-group[user-id="+id_user+"] .note-redactor").addClass("active");

		$(".acc-group[user-id="+id_user+"] .note-cancel").removeClass("active");

		$(this).removeClass("active");



		var textarea = $(".acc-group[user-id="+id_user+"] .note-container textarea");

		var text = $.trim(textarea.val());



		if(text.length>0 || (old_value!='' && text.length==0) ){



			var data ={

				value : text,

				user_id : id_user

			}



			//console.log(data);



			sendAjax("cp_addNote", data, null);

		}		



		textarea.attr("disabled", true);

		

	});



}



// работа кнопки экспорта

function workExportContactsButton(){



	$("#export-contacts-btn").click(function(){



		var data = {};



		$("#export-contacts-btn").addClass("loading");



		sendAjax("cp_exportContacts", data, res_exportContactButton);



	});



	$("#cp-link-export").click(function(){



		$("#export-contacts-btn").addClass("active");

		$("#cp-link-export").removeClass("active");

		

	});



}



function res_exportContactButton(data){



	var res = JSON.parse(data);



	if(res.length>0){



		var html_table = ''



		for(var i=0; i<res.length; i++){



			html_table += '<tr><td>'+res[i].first_name+'</td><td>'+res[i].last_name+'</td><td>'+res[i].email+'</td><td>'+res[i].role+'</td></tr>';



		}



		html_table += '<table>' + html_table + '</table>';



		$("#copybook_export").html(html_table);



		$("#export-contacts-btn").removeClass("loading");

		$("#export-contacts-btn").removeClass("active");

		$("#cp-link-export").addClass("active");



	}



	//console.log(data);



}


function workIsOnlineButton(){

	$("#is-online-button").click(function(){

		var data = {
			only_online: 1
		};

		var cont_id = "copybook_usersContainer";

		clearAccordeonContainer({
			container_id: cont_id
		});

		sendAjax("cp_getUsers", data, res_loadUsers);

	});

}



