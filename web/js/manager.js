// var dev = "";
var dev = "/app_dev.php";

function joinAudioFiles()
{
	var audios = $("#AudioFiles").find("audio");
	var source = new Array();
	for(var i=0;i<audios.length;i++)
	{
		if(audios[i].getAttribute('data-valid') == 'true')
		{
			source[i] = audios[i].getAttribute('data-src');
		}  		
	}
	return source.join(';');
}

function expandAudioFiles(parent,sources)
{
	var source = sources.split(';');
	for (var i = 0; i < source.length; i++) 
	{
		addAudio(parent,source[i]);
	}
}

function addAudio(parent,source)
{
	if(source!=''){
		var container = $("<div style='position:relative'></div>");
		var removeBtn = $("<button type='button' class='remove-audio-btn btn-xs btn-primary' style='position:absolute;top:0;right:0'><span class='glyphicon glyphicon-trash'></span></button>");
		var audio = $("<audio data-valid='true' controls='controls'></audio>");
		audio.attr('src',source);
		audio.attr('data-src',source);
		container.append(audio);
		container.append(removeBtn);
		parent.append(container);
	}
}

function ajaxFileUpload(fileElementId,successFunc)
{
	//starting setting some animation when the ajax starts and completes
	// $("#loading")
	// .ajaxStart(function(){
	// 	$(this).show();
	// })
	// .ajaxComplete(function(){
	// 	$(this).hide();
	// });
	$.ajaxFileUpload
	({
		url: dev + '/manager/upload', 
		secureuri:false,
		fileElementId:fileElementId,
		dataType: 'json',
		success: function (data, status)
		{
			if(typeof(data.MSG) != 'undefined')
			{
				if(data.MSG == '1')
				{
					successFunc(data.File);
				}else
				{
					alert("Upload failed!");
				}
			}
		},
		error: function (data, status, e)
		{
			alert(e);
		}
	})
	return false;
}

function refreshBookSnapshot(file)
{
	$.post(dev + '/manager/book/snapshotupload', 
	{
		File : file,
		ISBN : $("#ISBN").val(),
	}, function(data, textStatus, xhr) {
		/*optional stuff to do after success */
		if(data.MSG =='1')
		{
			// alert("Snapshot upload successfully!");
			$("#Snapshotimg").attr('src',data.Location);
		}else{
			alert("Snapshot upload failed!");
		}
	});
}

function uploadBookAudio(file)
{
	$.post(dev + '/manager/book/audioupload', 
	{
		File : file,
		ISBN : $("#ISBN").val(),
		Lang : 'en',
	}, function(data, textStatus, xhr) {
		/*optional stuff to do after success */
		if(data.MSG =='1')
		{
			// alert("Audio upload successfully!");
			addAudio($("#AudioFiles"),data.Location);
		}else{
			alert("Audio upload failed!");
		}
	});
}

function uploadBookAudio_cn(file)
{
	$.post(dev + '/manager/book/audioupload', 
	{
		File : file,
		ISBN : $("#ISBN").val(),
		Lang : 'cn',
	}, function(data, textStatus, xhr) {
		/*optional stuff to do after success */
		if(data.MSG =='1')
		{
			// alert("Audio upload successfully!");
			addAudio($("#AudioFiles_cn"),data.Location);
		}else{
			alert("Audio upload failed!");
		}
	});
}

function removeBookAudio(removeLocation,lang,removeItem)
{
	$.post(dev + '/manager/book/audioremove', 
	{
		remvoeLocation : removeLocation,
		ISBN : $("#ISBN").val(),
		Lang : lang,
	}, function(data, textStatus, xhr) {
		/*optional stuff to do after success */
		if(data.MSG =='1')
		{
			// alert("Audio remove successfully!");
			removeItem.remove();
		}else{
			alert("Audio remove failed!");
		}
	});
}



function refreshSeriesSnapshot(file)
{
	$.post(dev + '/manager/series/snapshotupload', 
	{
		File : file,
		Id : $("#Id").html(),
	}, function(data, textStatus, xhr) {
		/*optional stuff to do after success */
		if(data.MSG =='1')
		{
			// alert("Snapshot upload successfully!");
			$("#Snapshotimg").attr('src',data.Location);
		}else{
			alert("Snapshot upload failed!");
		}
	});
}









