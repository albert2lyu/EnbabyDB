

$(document).on("pageinit","#mobilePage",function( event ){

	$(".page").on("collapsibleexpand",function(event,ui){
 		audioId = $(this).jqmData("page");
 		song = document.getElementById(audioId);
 		//alert(song.getAttribute("played"));
 		if((song.getAttribute("played")==false)||song.ended||song.paused){
 			song.setAttribute("played",true);
			song.play();   
		}
 	}).on("collapsiblecollapse",function(event,ui){
 		audioId2 = $(this).jqmData("page");
 		song2 = document.getElementById(audioId2)
		song2.pause();
 	});
 		
 

	
	


   $("audio").bind("process",function () {
   	$.mobile.loading( "show", {text: "音频载入中...",textVisible: true, theme: "b", textonly: false, html: ""});
	});
	$("audio").bind("canplay",function () {
		$.mobile.loading("hide");
	}); 	
});
