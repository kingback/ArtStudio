$(document).ready(function() {
	$('#publish-form').ajaxForm({
		success: function() {
			alert("添加成功");
			//window.location.href='/admin/listArticles';
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			//var msg = JSON.parse(XMLHttpRequest.responseText).msg;
			var msg = XMLHttpRequest.responseText;
			alert("添加失败: " + msg);
		}
	});

	$('input[id=Filedata]').change(function() {
		var fobj = document.getElementById("Filedata");
		var file = fobj.files[0];
		var file_url = window.URL.createObjectURL(file);
		document.getElementById("previewCover").src = file_url;
	});
});

function deleteArticle() {
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
		url: '/adminapi/deleteArticle',
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

function markNews(mark) {
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
		url: '/adminapi/markNews',
		data: {
			'ids': ids,
			'mark': mark
		},
		success: function(e) {
			alert("操作成功");
			window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("操作失败");
		}
	});
	return false;
}
