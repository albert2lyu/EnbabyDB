
$(document).on("pageinit","#mobilePage",function( event ){

	// $(".page").on("collapsibleexpand",function(event,ui){
	// 	audioId = $(this).jqmData("page");
	// 	song = document.getElementById(audioId);
 // 		//alert(song.getAttribute("played"));
 // 		if((song.getAttribute("played")=="false")||song.ended||song.paused){
 // 			if(song.getAttribute("played")=="false"){
 // 				song.setAttribute("src",song.getAttribute("presrc"));
 // 				song.setAttribute("played",true);
 // 			}
 // 			song.play();   
 // 		}
 // 	}).on("collapsiblecollapse",function(event,ui){
 // 		audioId2 = $(this).jqmData("page");
 // 		song2 = document.getElementById(audioId2)
 // 		song2.pause();
 // 	});


 	audioSrc = document.audioFiles.split(";");
 	for (var i = audioSrc.length - 1; i >= 0; i--) {
 		var source = $("<source></source>");
 		source.attr('src',audioSrc[i]);
 		$("#bookaudio").append(source);
 	};


 	$("#playbookaudio").click(function() {
 		song = document.getElementById("bookaudio");

 		if(song.ended||song.paused){
 			song.play();   
 		}else{
 			song.pause();
 		}
 		
 	});


 	$("audio").bind("loadstart",function () {
 		theme = $.mobile.loader.prototype.options.theme;
 		$.mobile.loading( "show", {text: "音频载入中...",textVisible: true , theme: "b" , textonly: true, html: ""});
 	});
 	$("audio").bind("canplay",function () {
 		$.mobile.loading("hide");
 	});

});
