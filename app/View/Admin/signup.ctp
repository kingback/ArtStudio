<table class="table table-bordered table-hover responsive-utilities">
	<thead>
	<tr>
		<th>姓名</th>
		<th>性别</th>
		<th>生日</th>
		<th>高中</th>
		<th>电话</th>
		<th>qq</th>
		<th>email</th>
		<th>民族</th>
		<th>户籍</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($students as $stu): ?>
		<tr>
		<td><?php echo $stu['name']; ?></td>
		<td><?php echo $stu['sex']; ?></td>
		<td><?php echo $stu['birthday']; ?></td>
		<td><?php echo $stu['highschool']; ?></td>
		<td><?php echo $stu['telephone']; ?></td>
		<td><?php echo $stu['qq']; ?></td>
		<td><?php echo $stu['email']; ?></td>
		<td><?php echo $stu['volk']; ?></td>
		<td><?php echo $stu['household']; ?></td>
		</tr>
	<?php endforeach; ?>
	</body>
</table>
