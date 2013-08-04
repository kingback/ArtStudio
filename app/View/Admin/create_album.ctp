<form method="POST" action="/admin/createAlbum">
	<fieldset>
		<legend>新建相册</legend>
		<label>相册名字</label>
		<input name ="title" type="text"></input>
		<label>相册类型</label>
		<input name ="category" type="text"></input>
		<br/>
		<label>相册描述</label>
		<textarea rows="10" class="span9" name="desc"></textarea>
		<br/>
		<button type="submit" class="btn btn-info">创建</button>
	</fieldset>
</form>
