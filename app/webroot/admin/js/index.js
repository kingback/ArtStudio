$(document).ready(function() {
	$('input[id=imgFile]').change(function() {
		var fobj = document.getElementById("imgFile");
		var file = fobj.files[0];
		var file_url = window.URL.createObjectURL(file);
		document.getElementById("previewImg").src = file_url;
	});
});


