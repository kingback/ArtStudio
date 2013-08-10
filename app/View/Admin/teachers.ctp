<div class="well">
	<form class="form-inline" id = "addTeacher" method="POST" enctype="multipart/form-data" action="/adminapi/addTeacher">
		<legend>添加教师</legend>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="name">教师姓名</label>
						<input type="text" name="name" />
					</div>
					<div class="control-group">
						<label class="control-label" for="title">教师头衔</label>
						<input type="text" name="title" />
					</div>
					<div class="control-group">
						<label class="control-label" for="desc">教师描述</label>
						<textarea rows="7" class="span10" name="desc"></textarea>
					</div>
				</div>
				<div class="span3 offset1">
					<div class="">
						<img id="previewImg" style="width:300px; height:225px" class="img-polaroid"  data-src="holder.js/300x225" alt=""/>
					</div>
					<div class="form-inline" class="span3 offset1" style="margin:10px" >
						<label for="imgFile">选择头像</label>
						<a class="btn btn-info" onclick="$('input[id=imgFile]').click();">Browse</a>
					</div>
				</div>
				<div class="span12" >
					<input style="display:none" id="imgFile" type="file" name="imgFile" multiple/>
					<div class="span6 offset2">
						<button style="width:200px;" type="submit" class="btn btn-info">添加</button>
					</div>
				</div>
			</div>
		</div>
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
			<th></th>
			<th>头像</th>
			<th>姓名</th>
			<th>头衔</th>
			<th>描述</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($teachers as $teacher): ?>
		<tr>
			<td><input type="checkbox" name="checkbox" value="<?php echo $teacher['_id'];?>"></td>
			<td class="span3"><img src='<?php echo $base_url, $teacher['image']?>' style='max-height:210px'/></td>
			<td><input class="span1"  id='<?php echo $teacher['_id'];?>_name' name ="name" type="text" value="<?php echo $teacher['name'];?>"></input></td>
			<td><input class="span2"  id='<?php echo $teacher['_id'];?>_title' name ="title" type="text" value="<?php echo $teacher['title'];?>"></input></td>
			<td><textarea rows="5" class="span5" id='<?php echo $teacher['_id'];?>_desc' name ="desc"><?php echo $teacher['desc'];?></textarea></td>
		</tr>
		<?php endforeach; ?>
	</body>
</table>

<?php $this->Html->script('/admin/js/teacher.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/teacher.css',null, array('inline' => false)); ?>
