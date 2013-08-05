$(document).ready(function() {
	// bind 'myForm' and provide a simple callback function 
	$('#uploadImage').ajaxForm(function() {
		alert("上传成功");
		window.location.reload();
	});

	$('#add_album').ajaxForm(function() {
		alert("添加成功");
		window.location.reload();
	});
});

function modifyAlbumPics(albumId) {
	var ids = new Array();
	var names = new Array();
	var descs = new Array();
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		if (box[i].checked) {
			var id = box[i].value;
			var name = document.getElementById(id + "_name").value;
			var desc = document.getElementById(id + "_desc").value;
			ids.push(id);
			names.push(name);
			descs.push(desc);
		}
	}
	var json_ids = JSON.stringify(ids);
	var json_names = JSON.stringify(names);
	var json_descs = JSON.stringify(descs);
	$.ajax({
		type: 'POST',
		url: '/adminapi/modifyAlbumPics',
		data: {
			'id': albumId,
			'ids': json_ids,
			'names': json_names,
			'descs': json_descs
		},
		success: function(e) {
			alert("修改图片成功");
			window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("修改图片失败");
		}
	});
	return false;
}

function deleteAlbumPics(albumId) {
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
		url: '/adminapi/deleteAlbumPics',
		data: {
			'id': albumId,
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

function setAlbumCover(albumId) {
	var box = document.getElementsByName("checkbox");
	var cnt = 0;
	for (i = 0; i < box.length; ++i) {
		if (box[i].checked) {
			pic_id = box[i].value;
			++ cnt;
		}
	}
	if (cnt != 1) {
		alert("请设置一个照片作为封面");
		return false;
	}
	$.ajax({
		type: 'POST',
		url: '/adminapi/setAlbumCover',
		data: {
			'id': albumId,
			'picid': pic_id
		},
		success: function(e) {
			alert("设置成功");
			window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("设置失败");
		}
	});
	return false;
}

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
		url: '/adminapi/deletePics',
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

function deleteImages() {
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

function selectAll() {
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		box[i].checked = true;
	}
	return false;
}

function dselectAll() {
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		box[i].checked = false;
	}
	return false;
}

function rselectAll() {
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		box[i].checked = !box[i].checked;
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

function deleteAlbumCategory() {
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
		url: '/adminapi/deleteAlbumCategory',
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

function modifyAlbumCategory() {
	var ids = new Array();
	var names = new Array();
	var descs = new Array();
	var box = document.getElementsByName("checkbox");
	for (i = 0; i < box.length; ++i) {
		if (box[i].checked) {
			var id = box[i].value;
			var name = document.getElementById(id + "_name").value;
			var desc = document.getElementById(id + "_desc").value;
			ids.push(id);
			names.push(name);
			descs.push(desc);
		}
	}
	var json_ids = JSON.stringify(ids);
	var json_names = JSON.stringify(names);
	var json_descs = JSON.stringify(descs);
	$.ajax({
		type: 'POST',
		url: '/adminapi/modifyAlbumCategory',
		data: {
			'ids': json_ids,
			'names': json_names,
			'descs': json_descs
		},
		success: function(e) {
			alert("修改相册类型成功");
			//window.location.reload();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("修改相册类型失败");
		}
	});
	return false;
}

