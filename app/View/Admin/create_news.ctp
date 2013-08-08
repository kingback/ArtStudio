<link rel="stylesheet" href="/min?b=publisher/css&f=publisher-min.css" />
<script src="/editor/kindeditor-all.js"></script>
<script src="/editor/lang/zh_CN.js"></script>

<div class="publisher">
	<form action="/adminapi/modifyNews<?php if (isset($id)) echo "?id=$id";?>" method="post" target="self" id="publish-form" enctype="multipart/form-data">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9">
					<div class="article-title" class="span6">
						<label for="article-title">文章标题</label>
						<input class="span3" type="text" id="article-title" name="title" placeholder="文章标题" value="<?php echo $title;?>" />
					</div>
					<div>
						<label for="summary">文章简介</label>
						<textarea rows="6" class="span12" name="summary"><?php echo $summary; ?></textarea>
					</div>
				</div>
				<div class="span3">
					<?php if ($image != false): ?>
					<img id="previewCover" style="width:300px; height:225px" src="<?php echo $base_url, $image; ?>"/>
					<?php else: ?>
					<img id="previewCover" style="width:300px; height:225px" data-src="holder.js/300x225" alt=""/>
					<?php endif; ?>
					<div class="form-inline" class="span6">
						<label for="cover">选择新闻介绍图片</label>
						<a class="btn btn-info" onclick="$('input[id=Filedata]').click();">Browse</a>
					</div>
				</div>
			</div>
		</div>
		<div>
			<input id="Filedata" type="file" name="Filedata" style="display:none" multiple />
			<div class="alert alert-info" id="photoCover" style="display:none" >
			</div>
		</div>
		<div class="article-content">
			<textarea id="editor" name="content" style="width:900px;height:400px;">
				<?php echo $content; ?>
			</textarea>
		</div>
		<div class="form-button">
			<button type="button" id="preview-btn">预览</button>
			<button type="button" id="submit-btn">提交</button>
			<button type="button" id="cancel-btn">取消</button>
		</div>
	</form>
</div>
</div>
<script src="/admin/js/publisher.js"></script>
<script>
	$('input[id=Filedata]').change(function() {
		$('#photoCover').html($(this).val());
		$('#photoCover').css("display", "block");
		var fobj = document.getElementById("Filedata");
		var file = fobj.files[0];
		var file_url = window.URL.createObjectURL(file);
		document.getElementById("previewCover").src = file_url;
	});
</script>
