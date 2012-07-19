$(document).ready(function(){

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
					anima($("#header ul"),"fadeInRight",0.5,1);
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
});