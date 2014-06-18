$(document).ready(function(){
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
              
        $('#newComment').focus(function(){
            $(this).attr('rows','3');
        });
        
        $('#newComment').focusout(function(){
            if( $(this).val() == "" ){
                $(this).attr('rows','1');
            }
            
        });
        
        $('#newPostTitle').focus(function(){
            
                $('#newPostContent').show(1000);
                //$('#newPostContent').css('display','block');
    
		});
		
		$('#kartinka img').click(function(){
			alert('dvsvfvs');
		})
});

 $(document).click( function(event){
      if( $(event.target).closest("#qw").length ) 
        return;
      $('#newPostContent').hide(1000);
      event.stopPropagation();
    });

$('document').ready(function(){
        $('#galleri img').click(function(){
            //alert("dhjhdbv");
            $("#photoqwer img").attr("src",this.src);
        });
        
 });

var CommentModel = Backbone.Model.extend({});

var CommentView = Backbone.View.extend({
   // initialize:function(){
   //     this.render();
   // },
    render: function(){
        this.$el.html( _.template($('#template-comment-element').html(), this.model.toJSON()));
    }
});

var PostModel = Backbone.Model.extend({});

var PostView = Backbone.View.extend({
   // initialize:function(){
   //     this.render();
   // },
    render: function(){
        var s;
        this.collection.each(function(image) {
            console.log(image);
            //var imageView = new ImageView({ model: person });
            s += _.template($('#template-image-element').html(), image.toJSON());
        });
        this.model.set({images: s});
        this.$el.html( _.template($('#template-post-element').html(), this.model.toJSON()));
    }
});

var ImageModel = Backbone.Model.extend({});

var ImagesCollection = Backbone.Collection.extend({
//    model: ImageModel
});

function submitPost($form) {
    var m_method=$form.attr('method');
    var m_action=$form.attr('action');
    var m_data=$form.serialize();

    $.ajax({
        type: m_method,
        url: m_action,
        data: m_data,
        dataType: "json",
        success: function(response){
            document.getElementById("PostNew").reset();
            var postModel = new PostModel(response.data);
                      
           var imagesCollection = new ImagesCollection();
           imagesCollection.add(response.data_childs);
           
           var postView = new PostView({model: postModel, collection: imagesCollection});
           postView.render();
           $('#postsl').prepend(postView.el);
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
        dataType: "json",
        success: function(response){
            if (response.status == 'ok'){
                document.getElementById("CommentNew").reset();
                var commentModel = new CommentModel(response.data);
                var commentView = new CommentView({model: commentModel});
                commentView.render();
                $('#commetslist').append(commentView.el);
                $('#createdcomment').slideDown().removeAttr('id');
            }    
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
        forimage.innerHTML = '<img style="border-radius: 4px; width:260px; box-shadow:0px 0px 5px #9d9d9d;" src="'+url+'" />';
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
    Backbone.ajax  ({
        url: url,
        method: 'get',
        dataType: "json",
        success: function(result){
            if (result.id != 0)
                $('#divimage'+result.id).remove();
        }
    });
}