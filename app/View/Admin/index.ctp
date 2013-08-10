<div class="well">
	<form class="form-horizontal" action="/adminapi/modifyIndex" method="post">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#lA" data-toggle="tab">焦点图</a></li>
				<li><a href="#lB" data-toggle="tab">素描相册</a></li>
				<li><a href="#lC" data-toggle="tab">色彩相册</a></li>
				<li><a href="#lD" data-toggle="tab">创作相册</a></li>
				<li><a href="#lE" data-toggle="tab">平面相册</a></li>
				<li><a href="#lF" data-toggle="tab">速写相册</a></li>
				<li><a href="#lG" data-toggle="tab">老师</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="lA">
					<div id="forcusImage">
						<legend>焦点图</legend>
						<div class="control-group">
							<label class="control-label" for="url">URL </label>
							<input type="text" name="url" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">URL </label>
							<input type="text" name="url" class="span6" /> 
						</div>
						<div class="control-group">
							<label class="control-label" for="url">URL </label>
							<input type="text" name="url" class="span6" />
						</div>
					</div> 
				</div><!-- 焦点图-->

				<div class="tab-pane" id="lB">
					<div id="drawing">
						<legend>素描相册</legend>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
					</div>
				</div><!-- 素描-->

				<div class="tab-pane" id="lC">
					<div id="color">
						<legend>色彩相册</legend>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
					</div>
				</div><!-- color album-->

				<div class="tab-pane" id="lD">
					<div id="creation">
						<legend>创作相册</legend>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
					</div>
				</div><!-- creation album-->

				<div class="tab-pane" id="lE">
					<div id="graphic">
						<legend>平面相册</legend>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
					</div>
				</div><!-- graphic album-->

				<div class="tab-pane" id="lF">
					<div id="sketch">
						<legend>速写相册</legend>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
						<div class="control-group">
							<label class="control-label" for="url">相册ID</label>
							<input type="text" name="albumId" class="span6" />
						</div>
					</div>
				</div><!-- sketch album-->

				<div class="tab-pane" id="lG">
					<div id="teacher">
						<legend>教师管理</legend>
						<div class="well">
							<div class="control-group">
								<label class="control-label" for="url">url</label>
								<input type="text" name="albumId" class="span6" />
							</div>
							<div class="control-group">
								<label class="control-label" for="url"></label>
								<input type="text" name="albumId" class="span6" />
							</div>
							<div class="control-group">
								<label class="control-label" for="url">相册ID</label>
								<input type="text" name="albumId" class="span6" />
							</div>
						</div>
					</div>
				</div><!-- teacher-->
			</div>
		</div> <!-- /tabbable -->

		<input class="span9 btn btn-info" type="submit" name="submit" value="submit">
	</form>
</div>
