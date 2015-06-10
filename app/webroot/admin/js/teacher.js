$(document).ready(function() {
	$('#addTeacher').ajaxForm({
		success: function() {
			alert("添加教师成功");
			window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			var msg = JSON.parse(XMLHttpRequest.responseText).msg;
			alert("添加教师失败: " + msg);
		}
	});

	$('input[id=imgFile]').change(function() {
		var fobj = document.getElementById("imgFile");
		var file = fobj.files[0];
		var file_url = window.URL.createObjectURL(file);
		document.getElementById("previewImg").src = file_url;
	});
});

function deleteTeacher() {
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
		url: '/adminapi/deleteTeacher',
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

function modifyTeacher() {
	var ids = new Array();
	var names = new Array();
	var titles = new Array();
	var descs = new Array();
	var indexes = new Array();
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		if (box[i].checked) {
			var id = box[i].value;
			var name = document.getElementById(id + "_name").value;
			var desc = document.getElementById(id + "_desc").value;
			var title = document.getElementById(id + "_title").value;
			var index = document.getElementById(id + "_index").value;
			ids.push(id);
			names.push(name);
			titles.push(title);
			descs.push(desc);
			indexes.push(index);
		}
	}
	var json_ids = JSON.stringify(ids);
	var json_names = JSON.stringify(names);
	var json_titles = JSON.stringify(titles);
	var json_descs = JSON.stringify(descs);
	var json_indexes = JSON.stringify(indexes);
	$.ajax({
		type: 'POST',
		url: '/adminapi/modifyTeacher',
		data: {
			'ids': json_ids,
			'names': json_names,
			'titles': json_titles,
			'descs': json_descs,
			'indexes': json_indexes
		},
		success: function(e) {
			alert("修改教师成功");
			window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			var msg = JSON.parse(XMLHttpRequest.responseText).msg;
			alert("修改教师失败: " + msg);
		}
	});
	return false;
}
