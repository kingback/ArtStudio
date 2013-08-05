<div class="well">
<form class="form-inline" id = "addTeacher" method="POST" enctype="multipart/form-data" action="/adminapi/addTeacher">
	<fieldset>
	<legend>添加教师</legend>
	<div class="control-group">
		<label class="control-label" for="imgFile">选择头像</label>
		<div class="controls">
			<input type="file" name="imgFile" multiple/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="name">教师姓名</label>
		<div class="controls">
			<input type="text" name="name" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="title">教师头衔</label>
		<div class="controls">
			<input type="text" name="title" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="desc">教师描述</label>
		<div class="controls">
			<textarea rows="3" class="span9" name="desc"></textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-info">添加</button>
	</fieldset>
</form>
</div>

<p>
<a target='_blank' class='btn btn-danger' onclick="deleteTeacher()">删除选中教师</a> &nbsp;
<a target='_blank' class='btn btn-info' onclick="modifyTeacher()">修改选中教师</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
	<tr>
		<th>选择</th>
		<th>教师头像</th>
		<th>教师姓名</th>
		<th>教师头衔</th>
		<th>教师描述</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($teachers as $teacher): ?>
		<tr>
		<td><input type="checkbox" name="checkbox" value="<?php echo $teacher['_id'];?>"></td>
		<td><img src='<?php echo $base_url, $teacher['image']?>' style='max-height:100px'/></td>
		<td><input  id='<?php echo $teacher['_id'];?>_name' name ="name" type="text" value="<?php echo $teacher['name'];?>"></input></td>
		<td><input  id='<?php echo $teacher['_id'];?>_title' name ="title" type="text" value="<?php echo $teacher['title'];?>"></input></td>
		<td><textarea rows="3" class="span6" id='<?php echo $teacher['_id'];?>_desc' name ="desc"><?php echo $teacher['desc'];?></textarea></td>
		</tr>
	<?php endforeach; ?>
	</body>
</table>
