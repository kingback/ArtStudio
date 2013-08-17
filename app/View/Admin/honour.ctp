<?php $this->Html->script('/admin/js/honour.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/honour.css',null, array('inline' => false)); ?>

<div class="well">
<form class="form-horizontal" action="/adminapi/addhonour" method="post">
	<legend>添加新学生</legend>
	<div class="control-group">
		<label class="control-label" for="name">姓名</label>
		<div class="controls">
			<input type="text" name="name">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="school">学校</label>
		<div class="controls">
			<input type="text" name="school">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="year">考试年</label>
		<div class="controls">
			<select name="year">
				<option>2013</option>
				<option>2012</option>
				<option>2011</option>
				<option>2010</option>
				<option>2009</option>
				<option>2008</option>
				<option>2007</option>
				<option>2006</option>
				<option>2005</option>
				<option>2004</option>
				<option>2003</option>
				<option>2002</option>
				<option>2001</option>
				<option>2000</option>
			</select>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input class="btn btn-info" type="submit" value="提交" />
		</div>
	</div>
</form>
</div>

<div class="well">
<form class="form-inline" id="addHonours"  method="POST" enctype="multipart/form-data" action="/adminapi/addHonours">
	<legend>批量添加新学生(Excel)</legend>
	<input type="file" name="file" multiple/>
	<button type="submit" class="btn btn-info">确定上传</button>
</div>
<p>
<a target='_blank' class='btn btn-danger' onclick="deleteHonour()">删除选中学生</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
		<tr>
			<th></th>
			<th>考生姓名</th>
			<th>通过学校</th>
			<th>考试年</th>
			<th>加星</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($honours as $stu): ?>
		<tr>
			<td><input type="checkbox" name="checkbox" value="<?php echo $stu['_id'];?>"></td>
			<td><?php echo $stu['name']; ?></td>
			<td><?php echo $stu['school']; ?></td>
			<td><?php echo $stu['year']; ?></td>
			<td>
				<?php if (isset($stu['mark']) && $stu['mark'] > 0): ?>
				<span class="badge badge-important">Star</span>
				<?php endif?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
