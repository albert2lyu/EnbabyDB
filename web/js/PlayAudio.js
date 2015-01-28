
$(document).on("pageinit","#mobilePage",function( event ){

 	var audioSrc = document.audioFiles.split(";");
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


 	// $("audio").bind("loadstart",function () {
 	// 	theme = $.mobile.loader.prototype.options.theme;
 	// 	$.mobile.loading( "show", {text: "音频载入中...",textVisible: true , theme: "b" , textonly: true, html: ""});
 	// });
 	// $("audio").bind("canplay",function () {
 	// 	$.mobile.loading("hide");
 	// });

});
