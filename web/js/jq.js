$(document).ready(function(){

    //$('#CommentNew').off('submit');
    //$('#CommentNew').submit( );
    //alert('asassasasasazsasassasa');sert
	
		
		$('#disp').click(function(){
				if($('#disp').text() == "Відкрити"){
					$("#infoTwo").slideDown(500);
					$('#disp').text("Закрити");
				}else{
					$("#infoTwo").slideUp(500);
					$('#disp').text("Відкрити");
				}
			//
		});
});
function submitPost($form) {
    var m_method=$form.attr('method');
    var m_action=$form.attr('action');
    var m_data=$form.serialize();

    $.ajax({
        type: m_method,
        url: m_action,
        data: m_data,
        dataType: "html",
        success: function(response){
            document.getElementById("PostNew").reset();
            //   alert($('#commetslist  blockquote:last-child').attr('id'));
            $('#postslist').prepend(response);
            $('#createdpost').slideDown().removeAttr('id');
            return false;
        },
        error: function(response) {
            return false;
        }
    });
    return false;
}
    

function submitComment($form) {
    //e.preventDefault();

    //var m_method=$(this).attr('method');
    //var m_action=$(this).attr('action');
    //var m_data=$(this).serialize();
    var m_method=$form.attr('method');
    var m_action=$form.attr('action');
    var m_data=$form.serialize();

    $.ajax({
        type: m_method,
        url: m_action,
        data: m_data,
        dataType: "html",
        success: function(response){
            document.getElementById("CommentNew").reset();
            //   alert($('#commetslist  blockquote:last-child').attr('id'));
            $('#commetslist').append(response);
            $('#createdcomment').slideDown().removeAttr('id');
            return false;
        },
        error: function(response) {
            return false;
        }
    });
    return false;
}

(function() {

    $('form.upload_image').on('submit', function (){
        console.log('onsubmit');
        DoUpload($(this).find('.file_input'));
    });

    $('form.upload_image .file_input').on('change', function (){
        console.log('onchange');
        DoUpload(this);
    });

    function DoUpload(file_element) {
        //$(form).find('.file_input')
        //var file = upload_input.files[0];
        var file = file_element.files[0];
        console.log(file);

        if (file) {
            var xhr = new XMLHttpRequest();
            xhr.onload = xhr.onerror = function() {

                if (this.status == 200) {
                    respObj = eval('('+this.responseText+')');
                    if ((typeof respObj === 'object') && (respObj.status != "")) {
                        if (respObj.status == 'ok') {
                            //alert(respObj.img);
                            if (respObj.type == 'user')
                                afterLoadImageAvatar(respObj.img);
                            if (respObj.type == 'post')
                                afterLoadImagePost(respObj.img, respObj.id, respObj.parent_id);
                        } else {
                            console.log('Error: '+respObj.code)
                        }
                    } else console.log('Error: -2');
                } else console.log('Error: -1');
            };

            xhr.upload.onprogress = function(event) {
                //onProgress(event.loaded, event.total);
            }

            form = $(file_element).parents('form')[0];
            console.log(form);
            console.log(form.action);
            //return false;

            if (form.action != undefined) {

                xhr.open("POST", form.action, true);

                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                var formData = new FormData(form);

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
    }

    function afterLoadImageAvatar(url) {
        console.log(url);
        var forimage = document.getElementById("forimage");
        forimage.innerHTML = '<img src="'+url+'" />';
    }

    function afterLoadImagePost(url, id, post_id) {
        console.log(url, id);
        $('#post_images').append('<div id="divimage'+id+'"><img src="'+url+'"><span class="delete_button" onClick="deleteImage('+id+');"><span class="delete"></span></span></div>');
        $('#PostNew').attr('action', $('#PostNew').data('edit')+'?id='+post_id);
    }



})();

function deleteImage(id) {
//    alert(url); return;
    url = $('#post_images').attr('data-delurl')+'?id='+id;
    $.ajax  ({
        url: url,
        method: 'get',
        dataType: "json",
        success: function(result){
            if (result.id != 0)
                $('#divimage'+result.id).remove();
        }
    });
}