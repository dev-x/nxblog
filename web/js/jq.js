$(document).ready(function(){

    //$('#CommentNew').off('submit');
    $('#CommentNew').submit( function (e) {
        e.preventDefault();
        
        var m_method=$(this).attr('method');
        var m_action=$(this).attr('action');
        var m_data=$(this).serialize();
        
        $.ajax({
            type: m_method,
            url: m_action,
            data: m_data,
            dataType: "html",
            success: function(result){
                document.getElementById("CommentNew").reset();
             //   alert($('#commetslist  blockquote:last-child').attr('id'));
         $('#commetslist').append(result);
                                    }
                                });
        //alert('111111111');
        return false;a
    });
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