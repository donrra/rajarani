// JavaScript Document
$(document).ready(function() {
	
	
	$('#confdelete').live('click',function()	{
	if($('#agree').is(':checked'))
	{
     
	 
	
	  var rating = $('input:radio[name=rateinput]:checked').val();
	
	 var whydelete1,whydelete2,whydelete3,whydelete4,whydelete5,whydelete6;
	 var checked1 = $('#whydelete1').attr("checked");
	 if(checked1)
	 whydelete1 =  $('#whydelete1').val();
	 else
	 whydelete1 =  '';
	 
	 var checked2 = $('#whydelete2').attr("checked");
	 if(checked2)
	 whydelete2 =  $('#whydelete2').val();
	 else
	 whydelete2 =  '';
	 /////////////////////////
	  var checked3 = $('#whydelete3').attr("checked");
	 if(checked3)
	 whydelete3 =  $('#whydelete3').val();
	 else
	 whydelete3 =  '';
	 /////////////////////////
	  var checked4 = $('#whydelete4').attr("checked");
	 if(checked4)
	 whydelete4 =  $('#whydelete4').val();
	 else
	 whydelete4 =  '';
	 //////////////////////////
	  var checked5 = $('#whydelete5').attr("checked");
	 if(checked5)
	 whydelete5 =  $('#whydelete5').val();
	 else
	 whydelete5 =  '';
	 //////////////////////////
	 if($('#whydelete6').attr("checked"))
	 {
		 if($('#otherswhydelete').val().trim().length<1)
		 {
		 alert('Please select Why do you wish to delete your account?');
		 return false;
		 }
		 else
	 	{
		  whydelete6 =  $('#otherswhydelete').val(); 
		}
	 }
	  
	 console.log('rating:'+rating);
	 console.log('\n');
	 console.log('whydelete1:'+whydelete1);
	  console.log('\n');
	 console.log('whydelete2:'+whydelete2);
	  console.log('\n');
	 console.log('whydelete3:'+whydelete3);
	  console.log('\n');
	 console.log('whydelete4:'+whydelete4);
	  console.log('\n');
	 console.log('whydelete5:'+whydelete5);
	  console.log('\n');
	 console.log('whydelete6:'+whydelete6);
	 
	
	
	 $('#showmesage').html("<p><strong>Your profile being deleted.....</strong></p>").show('slow');
	$('#confdelete').attr("disabled","disabled");
	
	 var baseDir = $('#baseurl').val();
	//  var baseDir = 'http://localhost/rr1.norvida.dk';
		$.ajax({
		type : 'GET', 
		url: baseDir + "/user/profile/Deleteconfirm",
		datatype: "json",
		data: { actiontype:'ajax',rating:rating,whydelete1:whydelete1,whydelete2:whydelete2,whydelete3:whydelete3,whydelete4:whydelete4,whydelete5:whydelete5,whydelete6:whydelete6},
		success: function(complete){
		if(complete=='success')
		{
			$('#showmesage').html('<p><strong>Your profile has been deleted successfully.</strong>').show('slow');
		setTimeout(function() { 
		
		$('#showmesage').fadeOut('slow'); 
		$(".popup_block .popupbg").fadeOut("fast");
		$(".popup_block .open_popup").animate({top: 'hide'}, 200);
		window.location=window.location; 
		
		}, 1000);

		}else
		{
			$('#showmesage').html('<p><strong>Your profile could not be deleted.</strong>').show('slow');
		setTimeout(function() { $('#showmesage').fadeOut('slow'); }, 5000);

		}
		
		 return false;
			},
		
		})
	
	
	
		
	}else
	{
	$('#showmesage').html('<p><strong>Please select the check box.</strong>').show('slow');
	}
	
	});
	
	
	$('.choose').live('click',function() {
	  
	    $('.choose_block').find('.block').removeClass('active');
		$(this).find('.block').toggleClass('active');
		$('#txtTotal').val($(this).find('.block').find('input.price').val());
		$('#txtDesc').val($(this).find('.block').find('input.duration').val());
		
		
    });
	
	
	
	//languagedropdown
	$('#choose_lang').append('<em class="right"></em>');
	$("#choose_lang").click(function () 
	{ 
		$('footer').attr('height','150px');
		window.scrollTo(0, document.body.scrollHeight);
		$(this).children().eq(1).slideToggle(200); 
		return false; 
	
	}
	);
	$(document).click(function () { $("#choose_lang ul").slideUp(200); });
	$("#choose_lang ul").click(function () { 

	return false; 
	});
	$('#choose_lang ul span').click(function () {
	if($(this).find('a').length>0)
	{ 
	location.href=$(this).find('a').attr('href');
	}
	$("#choose_lang ul").slideUp(200)
	})
   //End
   
   
     //Language
  	$(".drop_new").hide();
  	$(".lang").click(function () 
	{ 
 		$(".drop_new").slideToggle(200); return false; 
	}
	);
	$(".drop_new ul a").click(function () 
	{ 
		
		if($(this).attr('href').length>0)
		{ 
		location.href=$(this).attr('href');
		}
 		$(".drop_new").slideUp(200); return false; 
	}
	);
	$(document).click(function () { $(".drop_new").slideUp(200); });
	$(".drop_new").click(function () { return false; });
  //End
   
   //dropdown
	$('.dropdown').append('<em class="right"></em>');
	$(".dropdown").click(function () 
	{ 
 		$(this).children().eq(1).slideToggle(200); return false; 
	}
	);
	$(document).click(function () { $(".dropdown ul").slideUp(200); });
	$(".dropdown ul").click(function () { return false; });
	$('.dropdown ul span').click(function () {
	$(this).parent().parent().parent().find(".select").get(0).innerHTML = $(this)[0].innerHTML;
		$(".dropdown ul").slideUp(200)
	})
   //End
   
   
  //Slider btn
  	$('.drag_btn').append('<span class="left"></span><span class="right"></span>');
 	$('.drag_btn .right').click(function () {
		$(this).parent().children(":first").animate({"left":"15px"}, "fast").parent().parent().addClass('active');
		$('#profileimage').val(0);	
	})
 	$('.drag_btn .left').click(function () {
		$(this).parent().children(":first").animate({"left":"-1px"}, "fast").parent().parent().removeClass('active');
		$('#profileimage').val(1);
	})
  //End
  
  	$('#drag').append('<a class="WithPhotos" title="With Photos"></a><a class="WithoutPhotos" title="Without Photos"></a>');
 	$('.leftcam').click(function () {
	$('#drag .WithoutPhotos').parent().children(":first").animate({"left":"-1px"}, "fast").parent().parent().removeClass('active');	
	$('#profileimage').val(1);
		
	})
 	$('.rightcam').click(function () {
		
		$('#drag .WithPhotos').parent().children(":first").animate({"left":"15px"}, "fast").parent().parent().addClass('active');
		$('#profileimage').val(0);
	})
  
  $('.textbox').append('<em></em>');
  
  //succes msg
  $('.succes_msg p').append('<a href="javascript:void(0)" class="close_msg"></a>');
  $(".succes_msg a.close_msg").click(function () 
		{ 
			$(".succes_msg").fadeOut(200)
		}
	);
   //End
  
  $('.navigation a').aToolTip({fixed: true});
 $('.cam_body a').aToolTip1({fixed: true});
  
  $('.pro_details .left_side p:last, .msg_lists li:last, .buttons p:last').addClass("last");
  
  
  	//Textarea animation
  	$(".textarea").focus(function() {
		$(this).animate({height: 100}, "normal");
	}).blur(function() {
		$(this).animate({height: 50}, "normal");
	});
	//End
  
  //popup script
  $(".popup_block .popupbg").hide();
  $(".popup_block .open_popup").hide();
  
	//end
	
	
	//popup deny block

  $(".popupopen").click(function () {
	  $('.popup_body').html('');
$(".popup_block .popupbg").fadeIn("fast");
$(".popup_block .open_popup").animate({top: 'show'}, 200);
});
$(".popup_block .close, .popupbody .popupbg").click(function () {
$(".popup_block .popupbg").fadeOut("fast");
$(".popup_block .open_popup").animate({top: 'hide'}, 200);
});
});


function showpopup(action_type,user_id, friend_id)
{
	 var baseDir = $('#baseurl').val();
		///alert(baseDir + '/user/popup/fetchdata');
	$('.popup_body').html('');
	$.ajax({
	type: 'GET',
	url: baseDir + '/user/popup/fetchdata',
	async: true,
	cache: false,
	data: 'action_type=' +action_type +'&user_id=' + user_id+'&friend_id='+friend_id,
	dataType : "json",
	success: function(jsonData) {

	if (jsonData.messages) {
		$('.popup_body').html('');
		$('.popup_body').html(jsonData.messages);
	}
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {
	alert("TECHNICAL ERROR: unable to view more product.\n\nDetails:\nError thrown: " + 
	
	XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
	}
	});

}

function buymembership()
{
	alert('Buy membership');
}

//Columns with jquery same height script
$(document).ready(function() {
});
 
var maxHeight = 0;
function setHeight(column) {
    column = $(column);
    column.each(function() {       
     	if($(this).height() > maxHeight) {
            maxHeight = $(this).height();;
        }
    });
    column.height(maxHeight);
}
//End


