 /*#########################################
   ### Desenvolvido por: Caique Portella ###
   ###  Email: caiqueportella@gmail.co   ###
   ########  Skype: caique-portela  ########
   ## MSN: caiqueportella@hotmail.com.br  ##
   #########################################*/
   
function addPlayer() {
	var player = $('#player_name').val();
	var oldText = $('#add_button').val();
	$('#add_button').val('...');
	$('#add_error').html('');
	
	$.getJSON('/playerticket/addplayer?player=' + encodeURIComponent(player) + '&rs=' + $('#report_session').val(), function(data) {
		if(data.error) {
			$('#add_error').html(data.error);
			$('#add_button').val(oldText);
			return;
		}
		
		$('#players_string').html(data.players);
		$('#player_name').val('');
		$('#add_button').val(oldText);
		$('#submit_btn').removeClass('confirm_disabled').addClass('confirm_green').attr('disabled', false);
	});
}

function validateSubmitForm() {
	form = $('#submit_form');
	subject = form.find('input[name=subject]');
	body = form.find('textarea[name=text]');
	
	if(subject.val().length < 8) {
		alert(lang['error_title']);
		return false;
	}
	
	if(body.val().length < 8) {
		alert(lang['error_body']);
		return false;
	}
	
	return true;
}

function liveValidateReplyForm(textarea) {
	btn = $('#submit_button');
	if($(textarea).val().length < 10 && btn.hasClass('confirm_green')) {
		btn.addClass('confirm_disabled').removeClass('confirm_green');
	}
	else if($(textarea).val().length >= 10 && btn.hasClass('confirm_disabled')) {
		btn.addClass('confirm_green').removeClass('confirm_disabled');
	}
}

function validateReplyForm(form) {
	if($(form).find('textarea').val().length < 10) {
		alert(lang['error_longer_reply']);
		return false;
	}
	
	return true;
}

function insertBBcode(textareaID, startTag, endTag) {
	var input = document.getElementById(textareaID);
	input.focus();

	/* für Internet Explorer */
	if(typeof document.selection != 'undefined') {
		 /* Einfügen */
		var range = document.selection.createRange();
		var insText = range.text;
		range.text = startTag + insText + endTag;

		/* Cursorposition anpassen */
		range = document.selection.createRange();
		if (insText.length == 0) {
			range.move('character', -endTag.length);
		} else {
			range.moveStart('character', startTag.length + insText.length + endTag.length);
		}
		range.select();
	}

	/* für neuere auf Gecko basierende Browser */
	else if(typeof input.selectionStart != 'undefined') {
		/* Einfügen */
		var start = input.selectionStart;
		var end = input.selectionEnd;
		var insText = input.value.substring(start, end);
		input.value = input.value.substr(0, start) + startTag + insText + endTag + input.value.substr(end);

		/* Cursorposition anpassen */
		var pos;
		if (insText.length == 0) {
			pos = start + startTag.length;
		} else {
			pos = start + startTag.length + insText.length + endTag.length;
		}
		input.selectionStart = pos;
		input.selectionEnd = pos;
	}
}