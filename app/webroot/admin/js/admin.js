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
		box[i].checked = ! box[i].checked;
	}
	return false;
}
