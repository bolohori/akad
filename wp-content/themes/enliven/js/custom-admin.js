(function($) {
	
	$(document).on( 'ready widget-updated widget-added', function() {
	    $('.enl-drcn-head').toggle(function() {
	    	$(this).next().slideDown(200);
	    },function(){
			$(this).next().slideUp(200);
		});
	});

	$('body').on('click','.upload_image_button',function(e) {
		e.preventDefault();
		var image = wp.media({ 
			title: 'Upload Image',
			// mutiple: true if you want to upload multiple files at once
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// Convert uploaded_image to a JSON object to make accessing it easier
			var image_url = uploaded_image.toJSON().url;
			// Assign the url value to the input field
			$('.cta-url').val(image_url);
		});
	});

	$(document).ready( function(){
		function media_upload( button_class ) {
		    var _custom_media = true,
		    _orig_send_attachment = wp.media.editor.send.attachment;
		    $('body').on('click',button_class, function(e) {
		        var button_id ='#'+$(this).attr('id');
		        var self = $(button_id);
		        var send_attachment_bkp = wp.media.editor.send.attachment;
		        var button = $(button_id);
		        var id = button.attr('id').replace('_button', '');
		        _custom_media = true;
		        wp.media.editor.send.attachment = function(props, attachment){
		            if ( _custom_media  ) {
		               $('.custom_media_id').val(attachment.id); 
		               $('.custom_media_url').val(attachment.url);
		               $('.custom_media_image').attr('src',attachment.url).css('display','block');   
		            } else {
		                return _orig_send_attachment.apply( button_id, [props, attachment] );
		            }
		        }
		        wp.media.editor.open(button);
		        return false;
		    });
		}
		media_upload( '.custom_media_upload' );
	});

})(jQuery);

function mediaPicker(pickerid) {
	var custom_uploader;
	var row_id 
    //e.preventDefault();
	row_id = jQuery('#'+pickerid).prev().attr('id');

    //If the uploader object has already been created, reopen the dialog
    if (custom_uploader) {
    	custom_uploader.open();
    	return;
    }

    //Create the media window.
    custom_uploader = wp.media.frames.file_frame = wp.media({
        title: 'Insert Images',
        button: {
            text: 'Insert Images'
        },
		type: 'image',
        multiple: false
    });

    //Insert Media Action. Preview image and insert values to image
	custom_uploader.on('select', function(){
	var selection = custom_uploader.state().get('selection');
		selection.map( function( attachment ) {
			attachment = attachment.toJSON();
			//INSERT THE SRC IN INPUT FIELD
			jQuery('#' + row_id).val(""+attachment.url+"").trigger('change');
				//APPEND THE PREVIEW IMAGE
				jQuery('#' + row_id).parent().find('.media-picker-preview, .media-picker-remove').remove();
				if(attachment.sizes.medium){
					jQuery('#' + row_id).parent().prepend('<img class="media-picker-preview" src="'+attachment.sizes.medium.url+'" /><span class="media-picker-remove">X</span>');
				}else{
					jQuery('#' + row_id).parent().prepend('<img class="media-picker-preview" src="'+attachment.url+'" /><span class="media-picker-remove">X</span>');
				}

		});
		jQuery(".media-picker-remove").on('click',function(e) {
			console.log("hi");
			jQuery(this).parent().find('.media-picker').val('').trigger('change');
			jQuery(this).parent().find('.media-picker-preview, .media-picker-remove').remove();
		});
	});
    //OPEN THE MEDIA WINDOW
    custom_uploader.open();

}   

jQuery(document).on( 'ready widget-updated widget-added', function() {
	
	jQuery(".media-picker-remove").on('click',function(e) {
		jQuery(this).parent().find('.media-picker').val('').trigger('change');
		jQuery(this).parent().find('.media-picker-preview, .media-picker-remove').remove();
	});

});