<link rel="stylesheet" href="/min?b=publisher/css&f=publisher-min.css" />
<script src="/editor/kindeditor-all.js"></script>
<script src="/editor/lang/zh_CN.js"></script>

<div class="publisher">
	<form action="/adminapi/modifyArticle<?php if (isset($id)) echo "?id=$id";?>" method="post" target="self" id="publish-form">
		<legend>文章管理</legend>
		<div class="article-title">
		<label for="article-title">文章标题：</label><input type="text" id="article-title" name="title" placeholder="文章标题" value="<?php echo $title;?>" />
		</div>
		<div>
			<label for="type">文章类型：</label>
			<select name="type">
				<option>主页</option>
				<option>招生简章</option>
			</select>
		</div>
		<div class="article-content">
			<label for="content">内容</label>
			<textarea id="editor" name="content" style="width:900px;height:400px;">
			<?php echo $content; ?>
			</textarea>
		</div>
		<div class="form-button">
			<button type="button" id="preview-btn">预览</button>
			<button type="button" id="submit-btn">提交</button>
		</div>
	</form>
</div>
<script src="/admin/js/publisher.js"></script>
