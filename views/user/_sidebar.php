<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = $modelUser->username;
?>
</div>
<style>
    .field-image-file_name {
        display: none;
    }
</style>
<div class="avatar">
<p style='font-size:25px' class='text-primary'><?= $modelUser->username; ?></p>
<div class="forimage">
	<img src="<?= Yii::$app->homeUrl; ?><?= str_replace('.', '_ib.', $modelUser->avatar); ?>">
</div>
<?php if (!Yii::$app->user->isGuest && ($modelUser->id == Yii::$app->user->id)) : ?>
<?php $form = ActiveForm::begin([
    'action' => Yii::$app->homeUrl.'image/create',
    'id' => 'form_upload',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
<input type=hidden name="Image[parent_type]" value="user" id="image-parent_type" >
<input type=hidden name="Image[parent_id]" value="<?= $modelUser->id; ?>" id="image-parent_id" >
<?php echo $form->field($modelImage, 'file_name')->fileInput(); /*ActiveForm::fileInput();*/ ?>
<?php /*echo Html::submitButton('Submit', ['class' => 'btn btn-primary']); */ ?>
<?php ActiveForm::end(); ?>
<a href="#" id="upload_button"><b>Змінити аватар</b></a>
<!--<button id="upload_button">Upload Image</button>-->
<?php endif; ?>
<script>
    var homeUrl = '<?= Yii::$app->homeUrl; ?>';
    (function() {
        var upload_button = document.getElementById("upload_button");
        var upload_input = document.getElementById("image-file_name");
        var upload_form = document.getElementById("form_upload");
/*
        upload_button.addEventListener("click", function (){
            upload_input.click();
            return false;
        }, true);*/
        upload_button.onclick = function () {
            upload_input.click();
            return false;
        }
        upload_input.addEventListener("change", function (){
            //upload_form.submit();
            DoUpload();
        }, false);
        upload_form.onsubmit = function() {
           // event.preventDefault()
            DoUpload();

//            return false;
        }

        function DoUpload() {
            var file = upload_input.files[0];
            if (file) {
                var xhr = new XMLHttpRequest();
                xhr.onload = xhr.onerror = function() {

                    if (this.status == 200) {
                        respObj = eval('('+this.responseText+')');
                        if ((typeof respObj === 'object') && (respObj.status != "")) {
                            if (respObj.status == 'ok') {
                                //alert(respObj.img);
                                var forimage = document.getElementById("forimage");
                                forimage.innerHTML = '<img src="'+homeUrl+respObj.img+'" />';
                            } else {
                                alert('Error: '+respObj.code)
                            }
                        } else alert('Error: -2');
                    } else alert('Error: -1');
                };

                xhr.upload.onprogress = function(event) {
                    //onProgress(event.loaded, event.total);
                }

                xhr.open("POST", homeUrl+"image/create", true);

                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                var formData = new FormData(upload_form);
                /*

                 var formData = new FormData();
                formData.append("_csrf", upload_form.elements._csrf.value);
                formData.append("Image[parent_id]", document.getElementById("image-parent_id").value);
                formData.append("Image[parent_type]", document.getElementById("image-parent_type").value);
                formData.append("Image[file_name]", file);
                alert(1);*/
                xhr.send(formData);

                //xhr.send(file);
            }
        }
    })();

</script>
</div>