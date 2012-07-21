$(function(){

	anima = function anima(elemento,efecto,delay,duracion){
	
		/*
		---------------------------------------
		EFECTOS ANIMACIÓN. (daneden.me/animate)
		---------------------------------------
		
		Attention seekers
		- flash bounce shake tada swing wobble wiggle pulse
		Flippers (currently Webkit, Firefox, & IE10 only)
		- flip flipInX flipOutX flipInY flipOutY
		Fading entrances
		- fadeIn fadeInUp fadeInDown fadeInLeft fadeInRight fadeInUpBig fadeInDownBig fadeInLeftBig fadeInRightBig
		Fading exits
		- fadeOut fadeOutUp fadeOutDown fadeOutLeft fadeOutRight fadeOutUpBig fadeOutDownBig fadeOutLeftBig fadeOutRightBig
		Bouncing entrances
		- bounceIn bounceInDown bounceInUp bounceInLeft bounceInRight
		Bouncing exits
		- bounceOut bounceOutDown bounceOutUp bounceOutLeft bounceOutRight
		Rotating entrances
		- rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight
		Rotating exits
		- rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight
		Lightspeed
		- lightSpeedIn lightSpeedOut
		Specials
		- hinge rollIn rollOut
		*/
		
		if(delay==null){delay=0;}
		if(duracion==null){duracion=1;}
	
		elemento.attr("class","")
				.addClass(efecto)
				.addClass("animated")
				.css("-webkit-animation-duration",duracion+"s")
				.css("-webkit-animation-delay",delay+"s");
	}
	
	resize = function resize(window){
		var header = $("#header");
		var footer = $("#reproductor");
		var sidebar = $("#sidebar");

		sidebar.css("max-height",window.height()-header.height()-footer.height()+"px");
	}
	$(window).resize(function(){
		resize($(window));
	});

	display = function display(que){
		var display = $("#display");
		if(que=="on"){
			display.css("box-shadow","inset 0px 0px 4px rgba(0,0,0,0.6),0px 0px 0px 1px rgba(0,0,0,0.7),0px 2px 0px 0px rgba(255,255,255,0.3),0px 0px 10px rgba(50,163,239,0.9)");
			display.animate({backgroundColor:'#32a3ef'}, 300);
			display.children('*').css("color","");
		}else if(que=="off"){
			display.css("box-shadow","inset 0px 0px 4px rgba(0,0,0,0.6),0px 0px 0px 1px rgba(0,0,0,0.7),0px 2px 0px 0px rgba(255,255,255,0.3)");
			display.animate({backgroundColor:'#000'}, 300);
			display.children('*').css("color","transparent");
		}
	}

	$("form#login").live("submit",function(){
		var data		= $(this).serialize();
		var href		= $(this).attr("action");
		var method		= $(this).attr("method");
		var form		= $(this);
		var inputUser	= $('form#login input[name="user"]');
		var inputPass	= $('form#login input[name="pass"]');
		
		inputUser.removeClass("error");
		inputPass.removeClass("error");
		
		$.ajax(href,{
			type:method,
			data:data
		}).done(function(data){
			switch(data){
				case 'OK':
					inputUser.addClass("correcto");
					inputPass.addClass("correcto");
					$("#header ul").show();
					anima($("form#login"),"bounceOutDown",0.5,2);
					anima($("#header ul"),"fadeInRight",2.5,0.5);
					$.ajax("reproductor.php",{
						
					}).done(function(data){
						$("#main").append(data);
						anima($("#reproductor"),"fadeInUp",2.5,0.5);
						anima($("#sidebar"),"fadeInLeft",3,0.5);
						setTimeout(function(){
							$("form#login").remove();
						},3000);
					});
				break;
				case 'KOuser':
					inputUser.addClass("error").focus();
				break;
				case 'KOpass':
					inputPass.addClass("error").focus();
				break;
				default:
					inputUser.addClass("error");
					inputPass.addClass("error");
					console.log(data);
			}
		});
		return false;
	});
	$("#logout").live("click",function(){
		if(!confirm("&iquest;Seguro que quieres salir?")){
			return false;	
		}
	});
	
	$(".nano").nanoScroller();
});