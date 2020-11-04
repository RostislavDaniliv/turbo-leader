$(document).ready(function(){

	workUrikMsg();

	workTopMenu();

	$("#main-menu-block li").addClass("material-ripple").addClass("custom-ripple");

});

document.getElementById("user_login-10985").value!=0;

// работа обратной связи для юрика
function workUrikMsg(){

	var ref_id = $("#refferer-id-field").html();

	$(".um-message-btn").attr("data-message_to", ref_id);

}

// работа меню
function workTopMenu(){

	var nav_height = $("#menu-block .navbar-menu").height();
	var height = $("#menu-block").height() - 1;
	$("#nav-sub-menu").show();

	$("#nav-sub-menu").css({
		top: -(nav_height-height+2)+"px"
	})


	$("#user-profile-block").hover(function(){

		var nav_sum = $("#nav-sub-menu");
		TweenMax.to(nav_sum, 0.3, { top: height+"px"});

	});

	$("#nav-sub-menu").mouseleave(function(){

		var nav_sum = $("#nav-sub-menu");
		TweenMax.to(nav_sum, 0.3, {top: -nav_height+"px"});

	});

}




