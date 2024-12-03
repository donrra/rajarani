(function ($) {

    function galleryManager(el, options) {
        //Defaults:
        this.defaults = {
            csrfToken:null,
            csrfTokenName:null,
            nameLabel:'Name',
            descriptionLabel:'Description',

            hasName:false,
            hasDesc:false,
	
            uploadUrl:'',
            deleteUrl:'',
            updateUrl:'',
            arrangeUrl:'',
			updateprofileUrl:'',
			updateRightsUrl:''
        };

        //Extending options:
        var opts = $.extend({}, this.defaults, options);
        //code
        var $gallery = $(el);
        opts.wId = $gallery.attr('id');
		var tmpconformtxt='Are you sure you want to delete?';
		var tmpdeletetxt='Delete Image';
		var uploadsuccesstxt='image uploaded successfully.';
		//for getting translated text
		 opts.deleteConfirmation='';
		 opts.deletetxt='';
		 opts.uploadsuccesstxt='';
		 
		 $('.succes_msg').hide();
		  $.ajax({
                type:'POST',
                url:opts.translateUrl,
                data:'tmpconformtxt=' + tmpconformtxt + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                success:function (t) {
                  //  console.log(t);
					 opts.deleteConfirmation =t;
					}});
		 $.ajax({
                type:'POST',
                url:opts.translateUrl,
                data:'tmpconformtxt=' + tmpdeletetxt + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                success:function (t) {
                //    console.log(t);
					 opts.deletetxt =t;
					}});
		$.ajax({
                type:'POST',
                url:opts.translateUrl,
                data:'tmpconformtxt=' + uploadsuccesstxt + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                success:function (t) {
                    console.log(t);
					 opts.uploadsuccesstxt =t;
					}});
					
					
					
					/**/
		 // opts.deleteConfirmation ='Are you sure you want to delete?';
          console.log(opts.deleteConfirmation);
        
		var $sorter = $('.sorter', $gallery);
        var $images = $('.images', $sorter);
        var $editorModal = $('.editor-modal', $gallery);
        var $editorForm = $('.form', $editorModal);


        function photoEditorTemplate(id, src, name, description) {
			
            return '<div class="photo-editor">' +
                '<div class="preview"><img src="' + src + '" alt=""/></div>' +
                '<div>' +
                (opts.hasName
                    ? '<label for="photo_name_' + id + '">' + opts.nameLabel + ':</label>' +
                    '<input type="text" name="photo[' + id + '][name]" class="input-xlarge" value="' + name + '" id="photo_name_' + id + '"/>'
                    : '') +
                (opts.hasDesc
                    ? '<label for="photo_description_' + id + '">' + opts.descriptionLabel + ':</label>' +
                    '<textarea name="photo[' + id + '][description]" rows="3" cols="40" class="input-xlarge" id="photo_description_' + id + '">' + description + '</textarea>'
                    : '') +
                '</div>' +
                '</div>';
        }

        function photoTemplate(id, src, name, description, rank,original) {
            var res = '<div id="' + opts.wId + '-' + id + '" class="photo">' +
                ' <span class="rightsalert" id="alert_' + id +'"></span><div class="image-preview"><a class="lightbox" href="' + original + '"><img src="' + src + '"/></a></div><div class="caption">';
            if (opts.hasName)res += '<h5>' + name + '</h5>';
            if (opts.hasDesc)res += '<p>' + description + '</p>';
            res += '</div><input type="hidden" name="order[' + id + ']" value="' + rank + '"/>';
			
			
			res += '<div class="caption">';
			res += '<h5>Visible to:</h5>';
			res += '<ul class="bullet_radio">';
			res += '<li><input type="radio" name="'+id+'" checked="checked"  value="1" /><span>All</span></li><li><input type="radio" name="'+id+'"  value="2" /><span>Only approved profiles</span></li></ul></div>';
			
			
			res += '<div class="actions">' +

                ((opts.hasName || opts.hasDesc)
                    ? '<span data-photo-id="' + id + '" class="editPhoto btn btn-primary"><i class="icon-edit icon-white"></i></span> '
                    : '') +
                '<span data-photo-id="' + id + '" class="deletePhoto btn btn-danger"><i class="icon-remove icon-white" title="' + opts.deletetxt + '"></i></span>' +
                '</div><input type="checkbox" class="photo-select"/></div>';
            return res;
        }

        function deleteClick(e) {
            e.preventDefault();
            var id = $(this).data('photo-id');
			var deleteConfirmation = opts.deleteConfirmation;
		    if (!confirm(deleteConfirmation)) return false;
            $.ajax({
                type:'POST',
                url:opts.deleteUrl,
                data:'id=' + id + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                success:function (t) {
                    if (t == 'OK')
					{
					console.log($('div').filter('.photo').length);
					//window.location.href="/user/album";
						 
							if($('div').filter('.photo').length==1)
							{
							window.location.href=window.location.href;
							}else
							{
								$('#' + opts.wId + '-' + id).remove();
							}
							
						 
					}else alert(t);
                }});
            return false;
        }

        function editClick(e) {
            e.preventDefault();
            var id = $(this).data('photo-id');
            var photo = $(this).parents('.photo');
            var src = $('img', photo[0]).attr('src');
            var name = $('.caption h5', photo[0]).text();
            var description = $('.caption p', photo[0]).text();
            $editorForm.html(photoEditorTemplate(id, src, name, description));
           //$('.editor-modal').show();
		   	 $editorModal.modal('show');
            return false;
        }

        function updateButtons() {
            var selectedCount = $('.photo.selected', $sorter).length;
            $('.select_all', $gallery).prop('checked', $('.photo', $sorter).length == selectedCount);
            
			console.log(selectedCount);
			
			if(selectedCount == 1)
			{
	
			$('.profile_selected', $gallery).removeClass('disabled');	
			}else
			{
			$('.profile_selected', $gallery).addClass('disabled');	
			}
			
			if (selectedCount == 0) {
                //$('.edit_selected, .remove_selected, .profile_selected', $gallery).addClass('disabled');
			  //  $('.edit_selected', $gallery).addClass('disabled');
			    $('.remove_selected', $gallery).addClass('disabled');
			    $('.profile_selected', $gallery).addClass('disabled');
            } else {
              //  $('.edit_selected, .remove_selected', $gallery).removeClass('disabled');
				  $('.remove_selected', $gallery).removeClass('disabled');
				//  $('.edit_selected', $gallery).removeClass('disabled');
            }
			
        }

        function selectChanged() {
            var $this = $(this);
            if ($this.is(':checked'))
                $this.parent().addClass('selected');
            else
                $this.parent().removeClass('selected');
            updateButtons();
        }
     
	   function statusChanged()
	   {
			var rphotoid= $(this).attr('name');
		    var rphotorighsval= $(this).val();
		   console.log('clcick'+$(this).attr('name'));
		  console.log('clcick'+ $(this).val());
			
			
			if(rphotoid!='' && rphotorighsval!='')
			{
					//console.log('clcick'+ $(this).attr('name'));
				//	console.log('clcick'+ $(this).val());
					$("[name='"+rphotoid+"']").removeAttr("checked");
					$(this).attr('checked',true);
					// send ajax call to update in db
					var alertid='alert_'+rphotoid;
					  $.ajax({
                type:'POST',
                url:opts.updateRightsUrl,
                data:'photoid=' + rphotoid +'&accesslevel=' + rphotorighsval  + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                success:function (t) {
            	    $('#'+alertid).html(t).show('slow');
					setTimeout(function() { $('#'+alertid).fadeOut('slow'); }, 5000);	
					return false;
				   
                }});
			
				
	   		}
	   }
	 
        function bindPhotoEvents(newOne) {
            $('.deletePhoto', newOne).click(deleteClick);
            $('.editPhoto', newOne).click(editClick);
            $('.photo-select', newOne).change(selectChanged);
			$('.bullet_radio input:radio', newOne).change(statusChanged);
			
			  
        }

        $('.photo', $gallery).each(function () {
            bindPhotoEvents(this);
        });

        $('.images', $sorter).sortable().disableSelection().bind("sortstop", function () {
            $.post(opts.arrangeUrl, $('input', $sorter).serialize() + '&ajax=true' + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''), function () {
                // order saved!
            }, 'json');
        });


        if (typeof window.FormData == 'function') {   // if XHR2 available
		 	
		   $('.afile', $gallery).attr('multiple', 'true').on('change', function (e) {
			    e.preventDefault();
                var filesCount = this.files.length;
                var uploadedCount = 0;
                $editorForm.html('');
                var progress=0;
				var styleprogress='';
                for (var i = 0; i < filesCount; i++) {
                    
					var fd = new FormData();
                   fd.append(this.name, this.files[i]);
                   if (opts.csrfToken) {
                      fd.append(opts.csrfTokenName, opts.csrfToken);
                    }
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', opts.uploadUrl, true);
                    xhr.onload = function () {
                        uploadedCount++;
                        if (this.status == 200) {
                            var resp = JSON.parse(this.response);
							
							if(resp['id']=='xx')
							{
							
							console.log('Error:'+resp['description']);
							$('.succes_msg').show();
							$('.succes_msg').html('<p>'+ resp['description'] +'</p>').show('slow');
							progress=0;
							return false;
							}else
							{
							
                            var newOne = $(photoTemplate(resp['id'], resp['preview'], resp['name'], resp['description'], resp['rank'],resp['original']));
							bindPhotoEvents(newOne);
							$images.append(newOne);
                           // if (opts.hasName || opts.hasDesc)
                           //     $editorForm.append($(photoEditorTemplate(resp['id'], resp['preview'], resp['name'], resp['description'])));
							progress=(100/filesCount)*uploadedCount;
							styleprogress='width:'+progress+'%';
							console.log(styleprogress);
							$('div .progress_bar').show();
							$('div .complite').attr('style','width:'+progress+'%');
							}
							
								
                        }
                      
					  if(progress==100)
						{
							$('div .complite').attr('style','width:99.70%');
							$('div .progress_bar').show();
							$('.succes_msg').show();
							 $('.succes_msg').html('<p>'+ opts.uploadsuccesstxt +'</p>').show('slow');
							setTimeout(function() { $('div .progress_bar').fadeOut('slow');
							$('.succes_msg').fadeOut('slow'); }, 5000);
							return false;
						//	history.go(0);
						}
					 					   
							
					 /* */  if (uploadedCount == filesCount) // && (opts.hasName || opts.hasDesc)
						{ 
						//console.log('copmeple');
						$('div .complite').attr('style','width:99.70%');
					 	$('div .progress_bar').hide();
						
						//	history.go(0);
					//	$editorModal.modal('show');
					//  $editorModal.modal('show');
						}
                    };
                    xhr.send(fd);
					
                }
				
			});
			
			
        } else {
            $('.afile', $gallery).on('change', function (e) {

                e.preventDefault();
                $editorForm.html('');
                alert('test');
                $.ajax(
                    opts.uploadUrl,
                    {
                        data:(opts.csrfToken ? opts.csrfTokenName + '=' + opts.csrfToken : ''),
                        files:$(this),
                        iframe:true,
                        dataType:"json"
                    }).done(function (resp) {
                        var newOne = $(photoTemplate(resp['id'], resp['preview'], resp['name'], resp['description'], resp['rank']));
                        bindPhotoEvents(newOne);
                        $images.append(newOne);
                        if (opts.hasName || opts.hasDesc)
                            $editorForm.append($(photoEditorTemplate(resp['id'], resp['preview'], resp['name'], resp['description'])));

                        if (opts.hasName || opts.hasDesc)
						{
							 $editorModal.modal('show');
						}
                    });


            });
        }

        $('.save-changes', $editorModal).click(function (e) {
            e.preventDefault();
            $.post(opts.updateUrl, $('input, textarea', $editorForm).serialize() + '&ajax=true' + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''), function (data) {
				
				if($('div').filter('.photo').length>4)
				{
				console.log($('div').filter('.photo').length);
				history.go(0);
				}
				
                var count = data.length;
                for (var key = 0; key < count; key++) {
                    var p = data[key];
                    var photo = $('#' + opts.wId + '-' + p.id);
                    $('img', photo).attr('src', p['src']);
                    if (opts.hasName)
                        $('.caption h5', photo).text(p['name']);
                    if (opts.hasDesc)
                        $('.caption p', photo).text(p['description']);
                }
                $editorModal.modal('hide');  //pp
                //deselect all items after editing
                $('.photo.selected', $sorter).each(function () {
                    $('.photo-select', this).prop('checked', false)
                }).removeClass('selected');
                $('.select_all', $gallery).prop('checked', false);
                updateButtons();
				
				
				
            }, 'json');
			
						


        });

        $('.edit_selected', $gallery).click(function (e) {
			
            e.preventDefault();
            var cc = 0;
            var form = $editorForm.html('');
            $('.photo.selected', $sorter).each(function () {
                cc++;
                var photo = $(this),
                    id = photo.attr('id').substr((opts.wId + '-').length),
                    src = $('img', photo[0]).attr('src'),
                    name = $('.caption h5', photo[0]).text(),
                    description = $('.caption p', photo[0]).text();
                form.append(photoEditorTemplate(id, src, name, description));
            });
            if (cc > 0)$editorModal.modal('show');
            return false;
        });

		
		
		 $('.bullet_radio input:radio', $gallery).click(function (e) {
		//	  e.preventDefault();
			 
		   var rphotoid= $(this).attr('name');
		    var rphotorighsval= $(this).val();
			if(rphotoid!='' && rphotorighsval!='')
			{
					//console.log('clcick'+ $(this).attr('name'));
				//	console.log('clcick'+ $(this).val());
					$("[name='"+rphotoid+"']").removeAttr("checked");
					$(this).attr('checked',true);
					// send ajax call to update in db
					var alertid='alert_'+rphotoid;
					  $.ajax({
                type:'POST',
                url:opts.updateRightsUrl,
                data:'photoid=' + rphotoid +'&accesslevel=' + rphotorighsval  + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                success:function (t) {
            	    $('#'+alertid).html(t).show('slow');
					setTimeout(function() { $('#'+alertid).fadeOut('slow'); }, 5000);	
					return false;
				   
                }});
            	//	return false;
					
					
					
			}
		  

		  });
		  


        $('.remove_selected', $gallery).click(function (e) {
            e.preventDefault();
			var deleteConfirmation =opts.deleteConfirmation;
		    if (!confirm(deleteConfirmation)) return false;
            $('.photo.selected', $sorter).each(function () {
                var id = $(this).attr('id').substr((opts.wId + '-').length);
                $.ajax({
                    type:'POST',
                    url:opts.deleteUrl,
                    data:'id=' + id + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                    success:function (t) {
                        if (t == 'OK')
						{
						history.go(0);
						//	 $('#' + opts.wId + '-' + id).remove();
						}else alert(t);
                    }});
            });
			
        });
	
		$('.profile_selected', $gallery).click(function (e) {
            e.preventDefault();
		    console.log($('.photo.selected', $sorter).length);
			 
			 if($('.photo.selected', $sorter).length == 1)
			 {
				// alert($('.photo.selected').attr('id').substr((opts.wId+'-').length));
				 var id= $('.photo.selected').attr('id').substr((opts.wId+'-').length);
				  $.ajax({
                    type:'POST',
                    url:opts.updateprofileUrl,
                    data:'id=' + id + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                    success:function (t) {
                        if (t == 'OK')
						{
						history.go(0);
						//	 $('#' + opts.wId + '-' + id).remove();
						}else alert(t);
                    }});
				 
			 }
			
		    $('.photo.selected', $sorter).each(function () {
			
			/*	
                var id = $(this).attr('id').substr((opts.wId + '-').length);
                $.ajax({
                    type:'POST',
                    url:opts.deleteUrl,
                    data:'id=' + id + (opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : ''),
                    success:function (t) {
                        if (t == 'OK')
						{
						history.go(0);
						//	 $('#' + opts.wId + '-' + id).remove();
						}else alert(t);
                    }});
             */
			
			});
			
        });


        $('.select_all', $gallery).change(function () {
            if ($(this).prop('checked')) {
                $('.photo', $sorter).each(function () {
                    $('.photo-select', this).prop('checked', true)
                }).addClass('selected');
            } else {
                $('.photo.selected', $sorter).each(function () {
                    $('.photo-select', this).prop('checked', false)
                }).removeClass('selected');
            }
            updateButtons();
        });
    }

    // The actual plugin
    $.fn.galleryManager = function (options) {
        if (this.length) {
            this.each(function () {
                galleryManager(this, options);
            });
        }
    };
})(jQuery);