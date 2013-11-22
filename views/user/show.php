<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<style>
    .field-image-file_name {
        display: none;
    }
</style>
<?= $modelUser->username; ?><br/>
<?php $form = ActiveForm::begin([
    'action' => '/nxblog/web/image/create',
    'id' => 'form_upload',
    'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
<input type=hidden name="Image[parent_type]" value="user" id="image-parent_type" >
<input type=hidden name="Image[parent_id]" value="<?= $modelUser->id; ?>" id="image-parent_id" >
<?php echo $form->field($modelImage, 'file_name')->fileInput(); /*ActiveForm::fileInput();*/ ?>
<?php /*echo Html::submitButton('Submit', ['class' => 'btn btn-primary']); */ ?>
<?php ActiveForm::end(); ?>
<button id="upload_button">Upload Image</button>
<script>

    (function() {
        var upload_button = document.getElementById("upload_button");
        var upload_input = document.getElementById("image-file_name");
        var upload_form = document.getElementById("form_upload");

        upload_button.addEventListener("click", function (){
            upload_input.click();
        }, false);
        upload_input.addEventListener("change", function (){
            //upload_form.submit();
            DoUpload();
        }, false);
        upload_form.onsubmit = function() {

            DoUpload();

            return false;
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
                                forimage.innerHTML = '<img src="/nxblog/web/'+respObj.img+'" />';
                            } else {
                                alert('Error: '+respObj.code)
                            }
                        } else alert('Error: -2');
                    } else alert('Error: -1');
                };

                xhr.upload.onprogress = function(event) {
                    //onProgress(event.loaded, event.total);
                }

                xhr.open("POST", "/nxblog/web/image/create", true);

				xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                var formData = new FormData();

                formData.append("_csrf", upload_form.elements._csrf.value);
                formData.append("Image[parent_id]", document.getElementById("image-parent_id").value);
                formData.append("Image[parent_type]", document.getElementById("image-parent_type").value);
                formData.append("Image[file_name]", file);
                xhr.send(formData);

                //xhr.send(file);
            }
        }
    })();

</script>
<div id="forimage"></div>