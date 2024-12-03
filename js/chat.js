
var windowFocus = true;
var username;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 1000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();

var sitelink ='http://rajarani.dk';

$(document).ready(function(){
	originalTitle = document.title;
	startChatSession();
	
	$([window, document]).blur(function(){
		windowFocus = false;
	}).focus(function(){
		windowFocus = true;
		document.title = originalTitle;
	});
	
	
});

function restructureChatBoxes() {
	align = 0;
	for (x in chatBoxes) {
		chatboxtitle = chatBoxes[x];

		if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {
			if (align == 0) {
				$("#chatbox_"+chatboxtitle).css('right', '20px');
			} else {
				width = (align)*(225+7)+20;
				$("#chatbox_"+chatboxtitle).css('right', width+'px');
			}
			align++;
		}
	}
}

function chatWith(chatuser) {
	createChatBox(chatuser);
	$("#chatbox_"+chatuser+" .chatboxtextarea").focus();
}

function createChatBox(chatboxtitle,minimizeChatBox) {
	
	if ($("#chatbox_"+chatboxtitle).length > 0) {
		if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
			$("#chatbox_"+chatboxtitle).css('display','block');
			restructureChatBoxes();	
		}
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		return;
	}

	$(" <div />" ).attr("id","chatbox_"+chatboxtitle)
	.addClass("chatbox")
	.html('<div class="chatboxhead"><div class="chatboxtitle">'+chatboxtitle+'</div><div class="chatboxoptions"><a href="javascript:void(0)" onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')">-</a> <a href="javascript:void(0)" onclick="javascript:closeChatBox(\''+chatboxtitle+'\')">X</a></div><br clear="all"/></div><div class="chatboxcontent"></div><div class="chatboxinput"><textarea class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\');"></textarea><div class="emoticonsPanel openToggler" style="left: 200px;"><a rel="toggle" id=\'chatemotion_'+chatboxtitle+'\'  class="emoteTogglerImg" tabindex="0"></a><div id=\'chatemotionlist_'+chatboxtitle+'\' class="panelFlyout uiToggleFlyout"><div id="smiley"><span class="emotion"><a class="smile">&nbsp;</a></span><span class="emotion"><a class="frown">&nbsp;</a></span><span class="emotion"><a class="tongue">&nbsp;</a></span><span class="emotion"><a class="grin">&nbsp;</a></span><span class="emotion"><a class="gasp">&nbsp;</a></span><span class="emotion"><a class="wink">&nbsp;</a></span><span class="emotion"><a class="glasses">&nbsp;</a></span><span class="emotion"><a class="grumpy">&nbsp;</a></span><span class="emotion"><a class="unsure">&nbsp;</a></span><span class="emotion"><a class="cry">&nbsp;</a></span><span class="emotion"><a class="devil">&nbsp;</a></span><span class="emotion"><a class="angel">&nbsp;</a></span><span class="emotion"><a class="kiss">&nbsp;</a></span><span class="emotion"><a class="sheart">&nbsp;</a></span><span class="emotion"><a class="kiki">&nbsp;</a></span><span class="emotion"><a class="squint">&nbsp;</a></span><span class="emotion"><a class="confused">&nbsp;</a></span><span class="emotion"><a class="upset">&nbsp;</a></span><span class="emotion"><a class="pacman">&nbsp;</a></span><span class="emotion"><a class="curly_lips">&nbsp;</a></span><div class="clr"></div></div></div></div></div>')
	.appendTo($( "body" ));
			   
	$("#chatbox_"+chatboxtitle).css('bottom', '0px');
	
	$(".chatboxcontent").click(function(){
		var chatid=$("#chatemotion_"+chatboxtitle).attr('id').substring(12);
		console.log(chatid);
			   $("#chatemotionlist_"+chatid).hide();
		})
		
	$(".emoteTogglerImg").click(function()
			{
				var chatid=$(this).attr('id').substring(12);
			   $("#chatemotionlist_"+chatid).toggle();
			});

		
	
	chatBoxeslength = 0;

	for (x in chatBoxes) {
		if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
			chatBoxeslength++;
		}
	}

	if (chatBoxeslength == 0) {
		$("#chatbox_"+chatboxtitle).css('right', '20px');
	} else {
		width = (chatBoxeslength)*(225+7)+20;
		$("#chatbox_"+chatboxtitle).css('right', width+'px');
	}
	
	chatBoxes.push(chatboxtitle);

	if (minimizeChatBox == 1) {
		minimizedChatBoxes = new Array();

		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}
		minimize = 0;
		for (j=0;j<minimizedChatBoxes.length;j++) {
			if (minimizedChatBoxes[j] == chatboxtitle) {
				minimize = 1;
			}
		}

		if (minimize == 1) {
			$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
			$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
		}
	}

	chatboxFocus[chatboxtitle] = false;
		$(".chatboxtextarea").blur(function(){
		chatboxFocus[chatboxtitle] = false;
	}).focus(function(){
		chatboxFocus[chatboxtitle] = true;
		newMessages[chatboxtitle] = false;
		$('.chatboxhead').removeClass('chatboxblink');
	});

	$("#chatbox_"+chatboxtitle).click(function() {
		if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') != 'none') {
			$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		}
	});

	$("#chatbox_"+chatboxtitle).show();
	
 $('.emotion').click(function()
 {
/*
smile :-),:),:],=)
frown :-(,:(,:[,=(
tongue  :-P,:P,:-P ,:p,=P
grin :-D,:D,=D
gasp :-O,:O,:-O,:o
wink ;-), ;)
glasses 8-),8),B-),B)
grumpy >:( >:-(
unsure :/ :-/ :\ :-\
cry   ;-(
devil  3:) 3:-)
angel O:) O:-)
kiss  :-* :*
heart  <3
kiki ^_^
squint -_-
confused o.O O.o
upset >:O >:-O >:o >:-o
pacman :v
curly_lips :3
*/	
	var smilearr = new Array();
	smilearr['smile'] = ":)";smilearr['frown'] = ":-(";smilearr['tongue'] = ":-P";
	smilearr['grin'] = "-D";smilearr['gasp'] = ":-O";smilearr['wink'] = ";-)";
	smilearr['glasses'] = "8-)";smilearr['grumpy'] = ">:(";smilearr['unsure'] = ":/";
	smilearr['cry'] = ";-(";smilearr['devil'] = "3:)";smilearr['angel'] = "O:)";
	smilearr['kiss'] = ":-*";smilearr['sheart'] = "<3";smilearr['kiki'] = "^_^";
	smilearr['squint'] = "-_-";smilearr['confused'] = "o.O";smilearr['upset'] = ">:O";// ">:O";
	smilearr['pacman'] = ":v";smilearr['curly_lips'] = ":3";	
	 var chatid = $(this).parent().parent().attr('id').substring(16);;
	 var shortcode = $(this).children('a').attr('class');
 console.log(shortcode);
 $("#chatbox_"+chatboxtitle+" .chatboxtextarea").val($("#chatbox_"+chatboxtitle+" .chatboxtextarea").val()+' '+smilearr[shortcode]);	 
 });	
}


function chatHeartbeat(){

	var itemsfound = 0;
	
	if (windowFocus == false) {
 
		var blinkNumber = 0;
		var titleChanged = 0;
		for (x in newMessagesWin) {
			if (newMessagesWin[x] == true) {
				++blinkNumber;
				if (blinkNumber >= blinkOrder) {
					document.title = x+' says...';
					titleChanged = 1;
					break;	
				}
			}
		}
		
		if (titleChanged == 0) {
			document.title = originalTitle;
			blinkOrder = 0;
		} else {
			++blinkOrder;
		}

	} else {
		for (x in newMessagesWin) {
			newMessagesWin[x] = false;
		}
	}

	for (x in newMessages) {
		if (newMessages[x] == true) {
			if (chatboxFocus[x] == false) {
				//FIXME: add toggle all or none policy, otherwise it looks funny
				$('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
			}
		}
	}
	
	$.ajax({
	  url: sitelink+"/user/talk/chatheartbeat",
	  cache: false,
	  dataType: "json",
	  success: function(data) {

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;
				if ($("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle);
				}
				if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
					$("#chatbox_"+chatboxtitle).css('display','block');
					restructureChatBoxes();
				}
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					newMessages[chatboxtitle] = true;
					newMessagesWin[chatboxtitle] = true;
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><div class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</div><div class="chatboxmessagecontent">'+item.m+'</div></div>');
				}

				$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				itemsfound += 1;
			}
		});

		chatHeartbeatCount++;

		if (itemsfound > 0) {
			chatHeartbeatTime = minChatHeartbeat;
			chatHeartbeatCount = 1;
		} else if (chatHeartbeatCount >= 10) {
			chatHeartbeatTime *= 2;
			chatHeartbeatCount = 1;
			if (chatHeartbeatTime > maxChatHeartbeat) {
				chatHeartbeatTime = maxChatHeartbeat;
			}
		}
		
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
	}});
}

function closeChatBox(chatboxtitle) {
	$('#chatbox_'+chatboxtitle).css('display','none');
	restructureChatBoxes();

	$.post(sitelink+"/user/talk/closechat", { chatbox: chatboxtitle} , function(data){	
	});
}

function toggleChatBoxGrowth(chatboxtitle) {
	if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {  
		
		var minimizedChatBoxes = new Array();
		
		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}

		var newCookie = '';

		for (i=0;i<minimizedChatBoxes.length;i++) {
			if (minimizedChatBoxes[i] != chatboxtitle) {
				newCookie += chatboxtitle+'|';
			}
		}

		newCookie = newCookie.slice(0, -1)


		$.cookie('chatbox_minimized', newCookie);
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
		$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
	} else {
		
		var newCookie = chatboxtitle;

		if ($.cookie('chatbox_minimized')) {
			newCookie += '|'+$.cookie('chatbox_minimized');
		}


		$.cookie('chatbox_minimized',newCookie);
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
	}
	
}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle) {
	
	if(event.keyCode == 13 && event.shiftKey == 0)  {
		message = $(chatboxtextarea).val();
		message = message.replace(/^\s+|\s+$/g,"");

		$(chatboxtextarea).val('');
		$(chatboxtextarea).focus();
		$(chatboxtextarea).css('height','44px');
		if (message != '') {
			$.post(sitelink+"/user/talk/sendchat", {to: chatboxtitle, message: message} , function(data){
			
				
			
				message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
				
				message = message.replace("&gt;:(","<span class='grumpy'></span>");
				message = message.replace("&lt;3","<span class='sheart'></span>");
				message = message.replace("&gt;:O","<span class='upset'></span>");
				message = message.replace('O:)',"<span class='angel'></span>");
				message = message.replace('3:)',"<span class='devil'></span>");
				message = message.replace(':)',"<span class='smile'></span>");
			
				message = message.replace(':-(',"<span class='frown'></span>");
				message = message.replace(':-P',"<span class='tongue'></span>");
				message = message.replace('-D',"<span class='grin'></span>");
				message = message.replace(':-O',"<span class='gasp'></span>");
				message = message.replace(';-)',"<span class='wink'></span>");
				message = message.replace('8-)',"<span class='glasses'></span>");
				message = message.replace(':/',"<span class='unsure'></span>");
				message = message.replace(";-(","<span class='cry'></span>");
				
				
				message = message.replace(':-*',"<span class='kiss'></span>");
				message = message.replace('^_^',"<span class='kiki'></span>");
				message = message.replace('-_-',"<span class='squint'></span>");
				message = message.replace('o.O',"<span class='confused'></span>");
				
				message = message.replace(':v',"<span class='pacman'></span>");
				message = message.replace(':3',"<span class='curly_lips'></span>");
				
				$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><div class="chatboxmessagefrom">'+username+':&nbsp;</div><div class="chatboxmessagecontent">'+message+'</div></div>');
				$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			});
		}
		chatHeartbeatTime = minChatHeartbeat;
		chatHeartbeatCount = 1;

		return false;
	}

	var adjustedHeight = chatboxtextarea.clientHeight;
	var maxHeight = 94;

	if (maxHeight > adjustedHeight) {
		adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
		if (maxHeight)
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
		if (adjustedHeight > chatboxtextarea.clientHeight)
			$(chatboxtextarea).css('height',adjustedHeight+8 +'px');
	} else {
		$(chatboxtextarea).css('overflow','auto');
	}
	 
}

function startChatSession(){  
	$.ajax({
	  url: sitelink + '/user/talk/startchatsession',
	  cache: false,
	  dataType: "json",
	  success: function(data) {
 
		username = data.username;

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;

				if ($("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle,1);
				}
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><div class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</div><div class="chatboxmessagecontent">'+item.m+'</div></div>');
				}
			}
		});
		
		for (i=0;i<chatBoxes.length;i++) {
			chatboxtitle = chatBoxes[i];
			$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
		}
	
	setTimeout('chatHeartbeat();',chatHeartbeatTime);
		
	}});
}

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
