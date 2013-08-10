<form method="POST" action="/admin/createAlbum">
	<fieldset>
		<legend>新建相册</legend>
		<label>相册名字</label>
		<input name ="title" type="text"></input>
		<label>相册班级</label>
		<select name="category" multiple="multiple">
			<?php foreach ($categories as $category): ?>
			<option><?php echo $category['name']; ?></option>
			<?php endforeach;?>
		</select>
		<label>相册属性</label>
		<select name="type" multiple="multiple">
			<option>drawing</option>
			<option>color</option>
			<option>creation</option>
			<option>graphic</option>
			<option>sketch</option>
		</select>
		<br/>
		<label>相册描述</label>
		<textarea rows="10" class="span9" name="desc"></textarea>
		<br/>
		<button type="submit" class="btn btn-info">创建</button>
	</fieldset>
</form>
