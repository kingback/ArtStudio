<?php $this->Html->script('/admin/js/video.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/video.css',null, array('inline' => false)); ?>

<div class="well">
	<form class="form-horizontal" id = "addVideo" method="POST" enctype="multipart/form-data" action="/adminapi/addVideo">
		<legend>添加视频</legend>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span7">
					<div class="control-group">
						<label class="control-label" for="name">视频名称</label>
						<div class="controls">
							<input class="span6" type="text" name="name" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="type">视频类型</label>
						<div class="controls">
							<select class="span6" style="height:100px" name="type" multiple="multiple">
								<option value="drawing">素描教学</option>
								<option value="color">色彩教学</option>
								<option value="creation">创作教学</option>
								<option value="sketch">速写教学</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="url">播放链接</label>
						<div class="controls">
							<input class="span10" type="text" name="url" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="desc">视频描述</label>
						<div class="controls">
							<textarea rows="7" class="span10" name="desc"></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button style="width:200px;" type="submit" class="btn btn-info">添加</button>
					</div>
				</div>
				<div class="span3">
					<div class="">
						<img id="previewImg" style="width:300px; height:225px" class="img-polaroid"  data-src="holder.js/300x225" alt=""/>
					</div>
					<div class="form-inline" class="span3 offset1" style="margin:10px" >
						<label for="imgFile">视频封面</label>
						<a class="btn btn-info" onclick="$('input[id=imgFile]').click();">Browse</a>
					</div>
				</div>
				<input style="display:none" id="imgFile" type="file" name="imgFile" multiple/>
			</div>
		</div>
	</form>
</div>

<?php 
$types = array(
'drawing' => '素描教学',
'color' => '色彩教学',
'creation' => '创作教学',
'graphic' => '平面教学',
'sketch' => '速写教学',
);
$colors = array(
'drawing' => 'important',
'color' => 'warning',
'creation' => 'info',
'graphic' => 'success',
'sketch' => 'inverse',
);
?>
<p>
<a target='_blank' class='btn btn-danger' onclick="deleteVideo()">删除选中视频</a> &nbsp;
<a target='_blank' class='btn btn-info' onclick="modifyVideo()">修改选中视频</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a target='_blank' class='btn' onclick="selectAll()">全选</a>&nbsp;
<a target='_blank' class='btn' onclick="dselectAll()">全部取消</a>&nbsp;
<a target='_blank' class='btn' onclick="rselectAll()">反选</a>&nbsp;
</p>
<table class="table table-bordered table-hover responsive-utilities">
	<thead>
		<tr>
			<th></th>
			<th>类型</th>
			<th>封面</th>
			<th>名称</th>
			<th>播放链接</th>
			<th>描述</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($videos as $video): ?>
		<tr>
			<td><input type="checkbox" name="checkbox" value="<?php echo $video['_id'];?>"></td>
			<td>
				<span class="label label-<?php echo $colors[$video['type']];?>"><?php echo $types[$video['type']]; ?></span>
			</td>
			<td><img src='<?php echo $base_url, $video['image']?>' style='max-width:100px'/></td>
			<td><input class="span2"  id='<?php echo $video['_id'];?>_name' name ="name" type="text" value="<?php echo $video['name'];?>"></input></td>
			<td><textarea class="span2" rows="5" id='<?php echo $video['_id'];?>_url' name ="url"><?php echo $video['url'];?></textarea></td>
			<td><textarea rows="5" class="span3" id='<?php echo $video['_id'];?>_desc' name ="desc"><?php echo $video['desc'];?></textarea></td>
		</tr>
		<?php endforeach; ?>
	</body>
</table>
