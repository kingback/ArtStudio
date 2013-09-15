<?php $this->Html->script('/editor/kindeditor-all-min.js', array('inline' => false)); ?>
<?php $this->Html->script('/editor/lang/zh_CN.js', array('inline' => false)); ?>
<?php $this->Html->css('/min?b=publisher/css&f=publisher-min.css',null, array('inline' => false)); ?>
<?php $this->Html->script('/admin/js/publisher.js', array('inline' => false)); ?>

<?php $this->Html->script('/admin/js/article.js', array('inline' => false)); ?>
<?php $this->Html->css('/admin/css/article.css',null, array('inline' => false)); ?>

<div class="publisher">
	<form action="/adminapi/modifyNews<?php if (isset($id)) echo "?id=$id";?>" method="post" target="self" id="publish-form" enctype="multipart/form-data">
		<legend>新闻管理</legend>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9">
					<div class="article-title">
						<label for="article-title">标题</label>
						<input class="span3" type="text" id="article-title" name="title" placeholder="文章标题" value="<?php echo $title;?>" />
					</div>
					<div class="article-title">
                        <label for="article-title">日期</label>
                        <input class="span3" type="date" id="article-date" name="date" placeholder="发布时间" value="<?php echo $date;?>" />
                    </div>
					<div>
						<label for="summary">简介</label>
						<textarea rows="6" class="span12" name="summary"><?php echo $summary; ?></textarea>
					</div>
				</div>
				<div class="span3">
					<?php if ($image != false): ?>
					<img id="previewCover" style="width:300px; height:225px" class="img-polaroid" src="<?php echo $base_url, $image; ?>"/>
					<?php else: ?>
					<img id="previewCover" style="width:300px; height:225px" class="img-polaroid"  data-src="holder.js/300x225" alt=""/>
					<?php endif; ?>
					<div class="form-inline" class="span6">
						<label for="cover" style="margin:10px">封面图片</label>
						<a class="btn btn-info" onclick="$('input[id=Filedata]').click();">Browse</a>
					</div>
				</div>
			</div>
			<div>
				<input id="Filedata" type="file" name="Filedata" style="display:none" multiple />
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
		</div>
	</form>
</div>
