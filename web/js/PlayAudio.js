

$(document).on("pageinit","#mobilePage",function( event ){

	$(".page").on("collapsibleexpand",function(event,ui){
 		audioId = $(this).jqmData("page");
 		song = document.getElementById(audioId);
 		//alert(song.getAttribute("played"));
 		if((song.getAttribute("played")=="false")||song.ended||song.paused){
			if(song.getAttribute("played")=="false"){
				song.setAttribute("src",song.getAttribute("presrc"));
 				song.setAttribute("played",true);
			}
			song.play();   
		}
 	}).on("collapsiblecollapse",function(event,ui){
 		audioId2 = $(this).jqmData("page");
 		song2 = document.getElementById(audioId2)
		song2.pause();
 	});
 		
 

	
	


   $("audio").bind("loadstart",function () {
	theme = $.mobile.loader.prototype.options.theme;
   	$.mobile.loading( "show", {text: "音频载入中...",textVisible: true , theme: "b" , textonly: true, html: ""});
	});
	$("audio").bind("canplay",function () {
		$.mobile.loading("hide");
	}); 	
});
