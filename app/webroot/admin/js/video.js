$(document).ready(function() {
	$('#addVideo').ajaxForm({
		success: function() {
			alert("添加视频成功");
			window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			var msg = JSON.parse(XMLHttpRequest.responseText).msg;
			alert("添加视频失败: " + msg);
		}
	});

	$('input[id=imgFile]').change(function() {
		var fobj = document.getElementById("imgFile");
		var file = fobj.files[0];
		var file_url = window.URL.createObjectURL(file);
		document.getElementById("previewImg").src = file_url;
	});
});

function deleteVideo() {
	var ids = "";
	var cnt = 0;
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		if (box[i].checked) {
			if (cnt > 0) {
				ids += ",";
			}
			ids += box[i].value; ++cnt;
		}
	}
	$.ajax({
		type: 'POST',
		url: '/adminapi/deleteVideo',
		data: {
			'ids': ids
		},
		success: function(e) {
			alert("删除成功");
			window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("删除失败");
		}
	});
	return false;
}

function modifyVideo() {
	var ids = new Array();
	var names = new Array();
	var urls = new Array();
	var descs = new Array();
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		if (box[i].checked) {
			var id = box[i].value;
			var name = document.getElementById(id + "_name").value;
			var desc = document.getElementById(id + "_desc").value;
			var url = document.getElementById(id + "_url").value;
			ids.push(id);
			names.push(name);
			urls.push(url);
			descs.push(desc);
		}
	}
	var json_ids = JSON.stringify(ids);
	var json_names = JSON.stringify(names);
	var json_urls = JSON.stringify(urls);
	var json_descs = JSON.stringify(descs);
	$.ajax({
		type: 'POST',
		url: '/adminapi/modifyVideo',
		data: {
			'ids': json_ids,
			'names': json_names,
			'urls': json_urls,
			'descs': json_descs
		},
		success: function(e) {
			alert("修改视频成功");
			window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			var msg = XMLHttpRequest.responseText;
			alert("修改视频失败: " + msg);
		}
	});
	return false;
}
