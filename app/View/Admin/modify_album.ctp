<form method="POST" action="/admin/modifyAlbum?id=<?php echo $id; ?>">
	<legend>修改相册</legend>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span3">
				<label>相册班级</label>
				<select name="category" multiple="multiple">
					<?php foreach ($categories as $category): ?>
					<option <?php if ($category['name'] == $album_category) echo "selected=selected"; ?>><?php echo $category['name']; ?></option>
					<?php endforeach;?>
				</select>
				<label>相册属性</label>
				<select style="height:100px" name="type" multiple="multiple">
					<option value="drawing">素描</option>
					<option value="color">色彩</option>
					<option value="creation">命题创作</option>
					<option value="graphic">设计</option>
					<option value="sketch">速写</option>
					<option value="studioEnv">画室环境</option>
					<option value="zd">周达作品</option>
				</select>
			</div>
			<div class="span9">
				<label>相册名字</label>
				<input name ="title" type="text" value="<?php echo $title; ?>"></input>
				<label>相册描述</label>
				<textarea rows="10" class="span9" name="desc"><?php echo $desc; ?></textarea>
				<div class="form-actions">
					<button type="submit" class="btn-large btn-info span6">创建</button>
				</div>
			</div>
		</div>
		<div>
		</div>
	</div>
</form>
