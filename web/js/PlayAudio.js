
$(document).on("pageinit","#mobilePage",function( event ){

 	var audioSrc = document.audioFiles.split(";");
 	if(document.audioFiles != "" && audioSrc.length > 0)
 	{
 		$('<div><a id="playbookaudio" data-role="button" class="ui-btn">绘本试听(English)</a><audio id="bookaudio"></audio></div>').appendTo('#audioArea');
 		for (var i = audioSrc.length - 1; i >= 0; i--) {
 		var source = $("<source></source>");
 		source.attr('src',audioSrc[i]);
 		$("#bookaudio").append(source);
 		};
 	}
 		

 	audioSrc = document.audioFiles_cn.split(";");
 	if(document.audioFiles_cn != "" && audioSrc.length > 0)
 	{
 		$('<div><a id="playbookaudio_cn" data-role="button" class="ui-btn">绘本试听(Chinese)</a><audio id="bookaudio_cn"></audio></div>').appendTo('#audioArea');
 		for (var i = audioSrc.length - 1; i >= 0; i--) {
 		var source = $("<source></source>");
 		source.attr('src',audioSrc[i]);
 		$("#bookaudio_cn").append(source);
 		};
 	}


 	$("#playbookaudio").click(function() {
 		song = document.getElementById("bookaudio");

 		if(song.ended||song.paused){
 			song.play();   
 		}else{
 			song.pause();
 		}
 	});

 	 	$("#playbookaudio_cn").click(function() {
 		song = document.getElementById("bookaudio_cn");

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
