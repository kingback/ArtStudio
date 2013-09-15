<?php $this->Html->script('/editor/kindeditor-all-min.js', array('inline' => false)); ?>
<?php $this->Html->script('/editor/lang/zh_CN.js', array('inline' => false)); ?>
<?php $this->Html->css('/min?b=publisher/css&f=publisher-min.css',null, array('inline' => false)); ?>
<?php $this->Html->script('/admin/js/publisher.js', array('inline' => false)); ?>

<?php $this->Html->script('/admin/js/article.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/article.css',null, array('inline' => false)); ?>

<div class="publisher">
	<form action="/adminapi/modifyArticle<?php if (isset($id)) echo "?id=$id";?>" method="post" target="self" id="publish-form">
		<legend>文章管理</legend>
		<div class="article-title">
		<label for="article-title">文章标题：</label><input type="text" id="article-title" name="title" placeholder="文章标题" value="<?php echo $title;?>" />
		</div>
		<div>
			<label for="type">文章类型：</label>
			<input disabled type="text" value="<?php echo $type; ?>"></input>
			<input style="display:none" type="text" name="type" value="<?php echo $type; ?>"></input>
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

