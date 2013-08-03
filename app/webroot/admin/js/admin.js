$(document).ready(function() {
	// bind 'myForm' and provide a simple callback function 
	$('#uploadImage').ajaxForm(function() {
		alert("上传成功");
		window.location.reload();
	});
});

function deletePics() {
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
		url: '/adminapi/deleteImages',
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

function selectAllPics() {
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		box[i].checked = true;
	}
	return false;
}

function deleteHonour(id, name) {
	if (window.confirm("确定删除" + name + "吗?")) {
		$.ajax({
			type: 'POST',
			url: '/adminapi/deletehonour ',
			data: {
				'id': id
			},
			success: function(e) {
				alert("删除成功");
				window.location.reload();
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert("删除失败");
			}
		});
	}
}

