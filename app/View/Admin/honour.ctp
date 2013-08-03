<div class="well">
<form class="form-horizontal" action="/admin/addhonour" method="post">
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

<table class="table table-bordered table-hover responsive-utilities">
	<thead>
		<tr>
			<th class="student">考生姓名</th>
			<th class="school">通过学校</th>
			<th class="school">考试年</th>
			<th class="school">删除</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($honours as $stu): ?>
		<tr>
			<td class="student"><?php echo $stu['name']; ?></td>
			<td class="school"><p><?php echo $stu['school']; ?></p></td>
			<td class="school"><p><?php echo $stu['year']; ?></p></td>
			<td class="school"><p><?php 
				echo "<button class='btn btn-danger' onclick=\"deleteHonour('{$stu['_id']}', '{$stu['name']}')\">删除</button>";
				?></p></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
