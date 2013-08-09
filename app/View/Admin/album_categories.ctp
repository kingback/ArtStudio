<div class="well">
<form  id="add_album" class="form-horizontal" action="/adminapi/addAlbumCategory" method="post">
	<legend>添加新类型</legend>
	<div class="control-group">
		<label class="control-label" for="name">类型名称</label>
		<div class="controls">
			<input type="text" name="name">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="desc">类型介绍</label>
		<div class="controls">
			<textarea rows="5" class="span6" name="desc"></textarea>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input class="btn btn-info" type="submit" value="提交" />
		</div>
	</div>
</form>
</div>

<p>
<a target='_blank' class='btn btn-danger' onclick="deleteAlbumCategory()">删除选中类型</a>&nbsp;
<a target='_blank' class='btn btn-warning' onclick="modifyAlbumCategory()">修改选中类型</a>&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn ' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
		<tr>
			<th>选择</th>
			<th>类型名称</th>
			<th>类型介绍</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $category): ?>
		<tr>
			<td>
				<input type="checkbox" name="checkbox" value="<?php echo $category['_id'];?>">
			</td>
			<td><input disabled id='<?php echo $category['_id'];?>_name' name ="name" type="text" value="<?php echo $category['name'];?>"></input></td>
			<td><textarea rows="5" class="span6" id='<?php echo $category['_id'];?>_desc' name ="desc"><?php echo $category['desc'];?></textarea></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
