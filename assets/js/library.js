$(document).ready(function() {

	// input values
	
	$('input[name=custom]').focus(function() {
		if($(this).val() == "custom path") { $(this).val(''); } else {}
	}).blur(function() {
		if($(this).val() == "") { $(this).val('custom path'); } else {}
	});
	
	// table over
	
	$('#history tr').mouseover(function() {
		$(this).find('.delete_icon').show();
		$(this).css('background','#EFF2F9');
	}).mouseout(function() {
		$(this).css('background','white');
		$(this).find('.delete_icon').hide();
	});
	
	// custom 
	
	$('.doit_smaller').click(function() { short_ussualy(); });
	$('.doit_custom').click(function() { custom('custom'); });
	$('.img_check').click(function() { short_custom(); });
	
	// delete 
	$('.delete_icon').click(function() {
		if(confirm('Are you sure?')) {
			var delete_link = $(this).attr("rel");
			$.ajax({
			   type: "POST",
			   url: "index.php?act=ajax",
			   data: "delete="+delete_link,
			   success: function(msg){
					var exp = msg.split('|');
					if(exp[0] == 0) {
						$('#error').html(exp[1]);
						$('#error').show();
					}
					else {
						$('#error').hide();
						$('#l'+delete_link+'').remove();
					}
					
			   }
			 });
		}
		else {}
	});
});

function custom(what) {
	switch(what) {
		case'smaller':
		$('.doit_custom').val(String.fromCharCode(187));
		$('.doit_custom').css('z-index','1');
		$('.doit_smaller').val('make it smaller');
		$('.doit_smaller').css('z-index','2');
		$('#custom_hide').hide();
		$('.doit_smaller').unbind();
		$('.doit_custom').unbind();
		$('.doit_smaller').bind('click',function() { short_ussualy(); });
		$('.doit_custom').bind('click',function() { custom('custom'); });
		break;
		
		case'custom':
		$('.doit_smaller').val(String.fromCharCode(171));
		$('.doit_smaller').css('z-index','1');
		$('.doit_custom').val('make it custom');
		$('.doit_custom').css('z-index','2');
		$('.doit_custom').css('margin-left','-7px');
		$('#custom_hide').show();
		$('.doit_smaller').unbind();
		$('.doit_custom').unbind();
		$('.doit_smaller').bind('click',function() { custom('smaller'); });
		break;
	}
}

function short_ussualy() {
	var url = $('input[name=url]').val();
	if(url == "") {}
	else {
		$.ajax({
		   type: "POST",
		   url: "index.php?act=ajax",
		   data: "url="+url,
		   success: function(msg){
				var exp = msg.split('|');
				if(exp[0] == 0) {
					$('#error').html(exp[1]);
					$('#error').show();
				}
				else {
					$('#error').hide();
					$('input[name=url]').val('http://');
					prompt("Your short URL is:", exp[1]);
				}
				
		   }
		 });
	}
}

function short_custom() {
	var url = $('input[name=url]').val();
	var custom = $('input[name=custom]').val();
	
	if(url == "" || custom == "") {}
	else {
		$.ajax({
		   type: "POST",
		   url: "index.php?act=ajax",
		   data: "url="+url+"&custom="+custom+"",
		   success: function(msg){
				var exp = msg.split('|');
				if(exp[0] == "0") {
					$('#error').html(exp[1]);
					$('#error').show();
				}
				else {
					$('#error').hide();
					$('input[name=url]').val('http://');
					$('input[name=custom]').val('');
					prompt("Your short URL is:", exp[1]);
				}
		   }
		 });
	}
	
}