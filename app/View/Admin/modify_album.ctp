<form method="POST" action="/admin/modifyAlbum?id=<?php echo $id; ?>">
	<fieldset>
		<legend>修改相册</legend>
		<label>相册名字</label>
		<input name ="title" type="text" value="<?php echo $title; ?>"></input>
		<label>相册班级</label>
		<select name="category" multiple="multiple">
			<?php foreach ($categories as $category): ?>
			<option <?php if ($category['name'] == $album_category) echo "selected=selected"; ?>><?php echo $category['name']; ?></option>
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
		<textarea rows="10" class="span9" name="desc"><?php echo $desc; ?></textarea>
		<br/>
		<button type="submit" class="btn btn-info">修改相册</button>
	</fieldset>
</form>
