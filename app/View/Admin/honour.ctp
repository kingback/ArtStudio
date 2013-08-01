<div class="g-bd">
	<h2>添加新学生</h2>
	<form action="/admin/addhonour" method="post">
		<table>
			<tr>
				<td>姓名</td> 
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<td>学校</td> 
				<td><input type="text" name="school" /></td>
			</tr>
			<tr>
				<td>考试年</td> 
				<td><input type="text" name="year" /></td>
			</tr>
			<tr>
				<td><input type="submit" value="Submit" /></td>
			</tr>
		</table>
	</form>

<table class="table table-bordered table-striped responsive-utilities">
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
			echo "<button class='button_blue r3px' onclick=\"deleteHonour('{$stu['_id']}', '{$stu['name']}')\">删除</button>";
			 ?></p></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>
