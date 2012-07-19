$(document).ready(function(){
	$("form#login").live("submit",function(){
		$(this)	.attr("class","shake")
				.css("-webkit-animation-duration","1s")
				.css("-webkit-animation-delay","0");
		return false;
	});
});