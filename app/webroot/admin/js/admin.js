function deleteHonour(id, name) {
	if (window.confirm("确定删除" + name + "吗?")) {
		$.ajax({
			type: 'POST',
			url: '/admin/deletehonour',
			data: {
				'id' : id
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
