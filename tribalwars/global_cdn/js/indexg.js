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
			message = 'Please wait until server processes your request!';
		TWLan.print_info(message,'info',false,true);
	},
	'request':function(data,opts){
		opt = opts || false;
		if(opt.length)
			message = opt;
		else
			message = 'Please wait until server processes your request!';
		this.print_info(message,'info',false,true);

		$.ajax({
			type:"POST",
			url:"process.php",
			data:data,
			dataType:"text",
			statusCode:{
				404:function(){
					TWLan.print_info('Request file not found !');
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
	'configs':function(){
		TWLan.fetch();
		$("#configs").ajaxForm({
			dataType:'json',
			success:function(data){
				if(data.type == 'error'){
					TWLan.print_info(data.message,'error');
				}else{
					setTimeout(function(){
						document.location.href = 'game.php';
					},3000)
					TWLan.print_info(data.message,'success'); 
				}
			}
		}).submit();
	}
}