<?php
use yii\widgets\ActiveForm;
use yii\helpers\HTML;
$this->title = $modelUser->username;
//$this->some_var;
?>
<script type="text/template" id="template-image-element">
	<span align="center" class="imgPicture">
        <img src="<%= src %>" alt="Картинка 1" border="0">
    </span>
</script>
<script type="text/template" id="template-post-element">
    <div id="createdpost" class="col-cm-12">
        <h2 style="margin-left:10px;"><a href="<%= titleUrl %>"><%= titlePost %></a></h2>
            <div class="post_images" >
                <%= images %>
            </div> 
            <div class="col-sm-12"><%= contentPost %></div>
            <ul class="list-inline">
                <li><img style="width:20px;" src="<%= avatarurl %>"></img></li>
                <li><a href="<%= autorUrl %>"><%= autorName %></a></li>
                <li><a href=""><span class="glyphicon glyphicon-time"></span><i><%= timePost %></i></a></li>
                <li><a href=""><i class="glyphicon glyphicon-comment"></i><%= comentCountPost %> - Коментарів </a></li>
              </ul>
        <button type="submit" class="btn btn-default pull-right"><a href="<%= titleUrl %>">Дочитати</a></button>
    </div>	
</script>
<div class="row wrap">
	<div class="col-sm-9">
			<?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
			<?php
				if (!Yii::$app->user->isGuest && (Yii::$app->user->id == $modelUser->id) && ($modelUser->dozvil == 1)) {
					$edit_action = Html::url('post/edit');
					if ($modelNewPost->id)
						$action =  Html::url(['post/edit', 'id' => $modelNewPost->id]);
					else
						$action =  Html::url('post/create');
					?>
                <div style="padding:20px;margin-top:50px; background-color:#F7FFFE;" class="well bs-component" id="qw">
                        <?php $form = ActiveForm::begin(['id' => 'PostNew', 'action' => $action, 'options' => ['data-edit' => $edit_action], 'beforeSubmit' => new \yii\web\JsExpression('submitPost')]); ?>  
                            <?= $form->field($modelNewPost, 'title')->textInput(['placeholder' => 'Заголовок нового поста', 'id' => 'newPostTitle']); ?>
                        <div id="newPostContent" style="display:none;">
                            <?= $form->field($modelNewPost, 'content')->textArea(['rows' => 6 , 'placeholder' => 'Текст нового поста', 'id'=>'textNewPost']); ?>
							<!--'class'=>'widgEditor nothing-->
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
                        <?php ActiveForm::end(); ?>
                    <?php \app\lib\LoadImageWidget::myRun($modelImage, 'image/create', 'form_upload_post_image', 'post', $modelNewPost->id?$modelNewPost->id:0 /*$modelNewPost->id*/); ?>
                    <div id="post_images" data-delurl="<?php echo Html::url('image/delete'); ?>">
                        <?php if ($modelNewPost->id): ?>
                            <?php if ($modelNewPost->images) foreach($modelNewPost->images as $postImage): ?>
                                <div id="divimage<?php echo $postImage->id; ?>"><img src="<?php echo $postImage->getImageUrl('small'); ?>">
                                    <span class="delete_button" onClick="deleteImage(<?php echo $postImage->id; ?>);"><span class="delete"></span></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <a href="#" class="upload_button" onClick="$('#form_upload_post_image .file_input').trigger('click'); return false;"><b>Добавити фото</b></a>
                    </div>
                </div>        
                        <?php } ?>
                
                <div class="col-sm-12">
                    <div class="postsProfil">
                        <?php  echo $this->render('/site/_posts', array('data' => $modelUser->publishPosts/*,'pagination'=>$pagination*/)); ?>
                    </div>
                </div>
	</div>
	<div class="avatar">
		<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
	</div>
</div>