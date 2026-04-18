function setVisibility(id, visibility){
	if(document.getElementById(id).style.display == visibility)
		document.getElementById(id).style.display = '';
	else
		document.getElementById(id).style.display = visibility; 
}
jQuery.fn.center = function(){
	this.css('position','absolute');
	this.css('top', (($(window).height()-this.outerHeight())/4)+$(window).scrollTop()+'px');
	this.css('left', (($(window).width()-this.outerWidth())/2)+$(window).scrollLeft()+'px');
	return this;
}
var TWLan = {
	'go':function(url){
		return document.location.href=url;
	},
	'selectw':function(world){
		return TWLan.go('login.php?world='+world);
	},
	'selectsts':function(world){
		return TWLan.go('?screen=stats&world='+world);
	},
	'json':function(str){
		try{
			jQuery.parseJSON(str);
		}catch(e){
			return false;
		}
		return true;
	},
	'print_info':function(message,type,debug,stay,sms){
		var keep = stay && true;
		if(typeof type == 'undefined')
			type = 'error';
		$('.autoHideBox').stop(true,true).fadeOut(200, function(){
			$(this).remove();
		});

		var seed = Math.floor(Math.random()*500);
		$('<div id="box'+seed+'">'+message+'</div>')
		.insertBefore('.principal')
		.addClass('autoHideBox '+type)
		.fadeIn(200)
		.on('click', function(){
			if(!keep)
				$(this).stop(true,true).fadeOut(200, function(){
					$(this).remove();
				})
		}).center();
		setTimeout(function(){
			if(!keep && $('#box'+seed))
				$('#box'+seed).fadeOut(200,function(){
					$(this).remove();
				})
		},3000)
	},
	'fetch':function(opts){
		opt = opts || false;
		if(opt.length > 0)
			message = opt;
		else
			message = 'Een ogenblik geduld terwijl wij je aanvraag verwerken!';
		TWLan.print_info(message,'info',false,true);
	},
	'request':function(data,opts){
		opt = opts || false;
		if(opt.length)
			message = opt;
		else
			message = 'Een ogenblik geduld, we verwerken uw aanvraag!';
		this.print_info(message,'info',false,true);

		$.ajax({
			type:"POST",
			url:"process.php",
			data:data,
			dataType:"text",
			statusCode:{
				404:function(){
					TWLan.print_info('Ficheiro pedido n&atilde;o encontrado !');
				}
			},
			success:function(msg){
				if(TWLan.json(msg)){
					var msg = jQuery.parseJSON(msg);
					TWLan.print_info(msg.message,msg.type,msg.debug);
					return true;
				}else{
					TWLan.print_info(msg,'error','debug');
					return false;
				}
			}
		});
	},
	'login':function(){
		TWLan.fetch();
		$("#login").ajaxForm({
			dataType:'json',
			success:function(data){
				if(data.type == 'error'){
					$('#username').removeClass('disabled').animate({
						color:"#000000"
					},500).removeAttr('disabled');
					$('#password').removeClass('disabled').animate({
						color:"#000000"
					},500).removeAttr('disabled');
					$('#do_login').switchClass('gray','green',0).removeAttr('disabled');
		
					if(data.sms == 'username')
						$('#username').css('border','1px solid red').focus().stop(true,true).effect("highlight", {
							color: '#FF0000'
						}, 1000);
					else if(data.sms == 'password')
						$('#password').css('border','1px solid red').focus().stop(true,true).effect("highlight", {
							color: '#FF0000'
						}, 1000);
					TWLan.print_info(data.message,'error');
				}else{
					setTimeout(function(){
						document.location.href = 'index.php';
					},3000)
					TWLan.print_info(data.message,'success'); 
				}
			}
		}).submit()
		$('#do_login').switchClass('green','gray',0).attr('disabled',true);
		$('#username').stop(true,true).addClass('disabled').animate({
			color:"#000000"
		},500).attr('disabled',true).css('border','1px solid #c19665');
		$('#password').stop(true,true).addClass('disabled').animate({
			color:"#000000"
		},500).attr('disabled',true).css('border','1px solid #c19665');
	},
	'register':function(){
		TWLan.fetch();
		$('#register').ajaxForm({
			dataType:'json',
			success:function(data){
				if(data.type == 'error'){
					$('#reg_username').removeClass('disabled').animate({
						color:"#000000"
					},500).removeAttr('disabled');
					$('#reg_password').removeClass('disabled').animate({
						color:"#000000"
					},500).removeAttr('disabled');
					$('#reg_email').removeClass('disabled').animate({
						color:"#000000"
					},500).removeAttr('disabled');
					$('#reg_captcha').removeClass('disabled').animate({
						color:"#000000"
					},500).removeAttr('disabled');
					$('#do_reg').switchClass('gray','green',0).removeAttr('disabled');
		
					if(data.sms == 'username')
						$('#reg_username').css('border','1px solid red').focus().stop(true,true).effect("highlight", {
							color:'#FF0000'
						}, 1000);
					if(data.sms == 'password')
						$('#reg_password').css('border','1px solid red').focus().stop(true,true).effect("highlight", {
							color:'#FF0000'
						}, 1000);
					if(data.sms == 'mail')
						$('#reg_email').css('border','1px solid red').focus().stop(true,true).effect("highlight", {
							color:'#FF0000'
						}, 1000);
					if(data.sms == 'captcha')
						$('#reg_captcha').css('border','1px solid red').focus().stop(true,true).effect("highlight", {
							color:'#FF0000'
						}, 1000);
		
					TWLan.print_info(data.message,'error');
				}else{
					setTimeout(function(){
						document.location.href = 'index.php';
					},3000)
					TWLan.print_info(data.message,'success'); 
				}
			}
		}).submit();
		$('#do_reg').switchClass('green','gray',0).attr('disabled',true);
		$('#reg_username').stop(true,true).addClass('disabled').animate({
			color:"#000000"
		},500).attr('disabled',true).css('border','1px solid #c19665');
		$('#reg_password').stop(true,true).addClass('disabled').animate({
			color:"#000000"
		},500).attr('disabled',true).css('border','1px solid #c19665');
		$('#reg_email').stop(true,true).addClass('disabled').animate({
			color:"#000000"
		},500).attr('disabled',true).css('border','1px solid #c19665');
		$('#reg_captcha').stop(true,true).addClass('disabled').animate({
			color:"#000000"
		},500).attr('disabled',true).css('border','1px solid #c19665');
	},

	'logout':function(){
		TWLan.fetch();
		$("#logout").ajaxForm({
			dataType:'json',
			success:function(data){
				if(data.type == 'error'){
					$('#do_logout').switchClass('gray','red',0).removeAttr('disabled');
					TWLan.print_info(data.message,'error');
				}else{
					setTimeout(function(){
						document.location.href = 'index.php';
					},3000)
					TWLan.print_info(data.message,'success'); 
				}
			}
		}).submit()
		$('#do_logout').switchClass('red','gray',0).attr('disabled',true);
	},
	
	'configs':function(screen){
		TWLan.fetch();
		$("#configs").ajaxForm({
			dataType:'json',
			success:function(data){
				if(data.type == 'error'){
					TWLan.print_info(data.message,'error');
				}else{
					setTimeout(function(){
						document.location.href = '?screen='+screen;
					},3000)
					TWLan.print_info(data.message,'success'); 
				}
			}
		}).submit();
	},
	
	'team':function(){
		TWLan.fetch();
		$("#team").ajaxForm({
			dataType:'json',
			success:function(data){
				if(data.type == 'error'){
					TWLan.print_info(data.message,'error');
				}else{
					setTimeout(function(){
						document.location.href = '?screen=team';
					},3000)
					TWLan.print_info(data.message,'success'); 
				}
			}
		}).submit();
	}
}



