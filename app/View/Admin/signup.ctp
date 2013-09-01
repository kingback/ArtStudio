<?php $this->Html->script('/admin/js/signup.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/signup.css',null, array('inline' => false)); ?>

<p>
<a target='_blank' class='btn btn-danger' onclick="deleteSignup()">删除选中学生</a> &nbsp;
<a target='_blank' class='btn btn-info' href="/admin/downloadSignupXls" >下载注册列表</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
		<tr>
			<th></th>
			<th>姓名</th>
			<th>性别</th>
			<th>生日</th>
			<th>高中</th>
			<th>电话</th>
			<th>qq</th>
			<th>email</th>
			<th>民族</th>
			<th>户籍</th>
			<th>照片</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($students as $stu): ?>
		<tr>
			<td><input type="checkbox" name="checkbox" value="<?php echo $stu['_id'];?>"></td>
			<td><?php echo $stu['name']; ?></td>
			<td><?php echo $stu['sex']; ?></td>
			<td><?php echo $stu['birthday']; ?></td>
			<td><?php echo $stu['highschool']; ?></td>
			<td><?php echo $stu['telephone']; ?></td>
			<td><?php echo $stu['qq']; ?></td>
			<td><?php echo $stu['email']; ?></td>
			<td><?php echo $stu['volk']; ?></td>
			<td><?php echo $stu['household']; ?></td>
			<td>
			   <img src='<?php if (isset($stu['image'])) echo $base_url, $stu['image']; ?>' style='max-height:210px'/>
			</td>
		</tr>
		<?php endforeach; ?>
	</body>
</table>
