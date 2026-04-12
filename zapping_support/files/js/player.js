 /*#########################################
   ### Desenvolvido por: Caique Portella ###
   ###  Email: caiqueportella@gmail.co   ###
   ########  Skype: caique-portela  ########
   ## MSN: caiqueportella@hotmail.com.br  ##
   #########################################*/
   
var Support = {
	Ticket: {
		init: function() {
			$('#upload_button').click(Support.Ticket.showUploadAttachment);
			$('#message').keyup(Support.Ticket.validate);
		},
		
		showUploadAttachment: function() {
			$('#upload_button').remove();
			$('#upload').fadeIn();
		},
		
	},
	
	New: {
		didAddReportedPlayer: false,
		submitOkay: true,
		
		init: function() {
			$('#submit').click(Support.New.validate);
			$('#add').click(Support.New.addPlayer);
			$('#player_name').keyup(function(e) {
				if(e.which == 13) {
					Support.New.addPlayer();
				}
			});
			
			$('#inputTitle').change(Support.New.validateTitle);
			$('#message').change(Support.New.validateBody);
			
			// flash version
			var fv = swfobject.getFlashPlayerVersion();
			
			if (fv && fv.major > 0) {
				$('#fv').val(fv.major + '.' + fv.minor + '.' + fv.release);
			}
		},
		
		validateTitle: function() {
			var $title = $('#inputTitle');
			
			if($title.length && $title.val().length < 8) {
				Support.New.submitOkay = false;
				$('#subject_group').addClass('error').find('.help-inline').show();
			}
			else {
				$('#subject_group').removeClass('error').find('.help-inline').hide();
			}			
		},
		
		validateReported: function() {
			var $reported_players = $('#players_string');
			
			if($reported_players.length && !Support.New.didAddReportedPlayer) {
				Support.New.submitOkay = false;
				$('#report_group').addClass('error').find('.help-inline').show();				
			}
			else {
				$('#report_group').removeClass('error').find('.help-inline').hide();	
			}			
		},
		
		validateBody: function() {
			var $body = $('#message');
			
			if($body.val().length < 8) {
				Support.New.submitOkay = false;
				$('#message_group').addClass('error').find('.help-inline').show();				
			}
			else {
				$('#message_group').removeClass('error').find('.help-inline').hide();	
			}
		},
		
		validate: function() {
			Support.New.submitOkay = true;
			
			Support.New.validateTitle();
			Support.New.validateReported();
			Support.New.validateBody();
			
			return Support.New.submitOkay;
		},
		
		addPlayer: function() {
			var $player_name = $('#player_name');
			var $add = $('#add');
			var $error = $('#add_error');
			
			var player = $player_name.val();
			var oldText = $add.text();
			$add.text('...').attr('disabled', 'disabled');
			$error.html('');
			
			$.getJSON('/playerticket/addplayer?player=' + encodeURIComponent(player) + '&rs=' + $('#report_session').val(), function(data) {
				if(data.error) {
					$error.html(data.error);
					$add.text(oldText).removeAttr('disabled');
					return;
				}
				
				$('#players_string').html(data.players);
				Support.New.didAddReportedPlayer = true;
				Support.New.validateReported();
				
				$player_name.val('');
				$add.text(oldText).removeAttr('disabled');
			});
		}
	}
};

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