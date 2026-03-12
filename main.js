function del(){
		$('.delete').click(function(e){
			var line = $(this).parents('div.line_link');
			$.ajax({
				type: "post",
				url: "ajax-note.php",
				data: "id="+$(this).val()+"&note=-1",
				success: function(retour){
					line.remove();
				}
			});
			return false;
		});
	}
	
	
	function calclwidth(){
	//récupère la hauteur de la page
	  var zi_width= document.getElementById('preview_frame').contentWindow.document.body.scrollWidth;
		  //change la hauteur de l'iframe
		//document.getElementById('preview_frame').width= zi_width;
	}
	
	$(document).ready(function(){
		//$('a:visited').find('span.note').show();
		$('#i_link').focus(function(){ if($(this).val()=='link') $(this).val(''); });
		$('#i_link').blur(function(){ if($(this).val()=='') $(this).val('link'); });
		$('#i_name').focus(function(){ if($(this).val()=='name') $(this).val(''); });
		$('#i_name').blur(function(){ if($(this).val()=='') $(this).val('name'); });
		
		$('img.btn_edit').click(function(){
			var link = $(this).parent().find('a');
			if($('.added').length){
				$('.added').remove();
				link.show();
			}else{
			link.hide();
			var name = $('#i_name').clone(); name.addClass('added'); name.val(link.text());
			var fold = $('#sel_folder').clone(); fold.addClass('added');
			
			$(this).parent().append('<form class="added" method="post" action=""></form>');
			$('form.added').append(name).append(fold).append('<input type="submit" name="send" value="ok" class="added"/>').append('<input type="hidden" name="id" value="'+link.attr('rel')+'" class="added"/>').append( '<input type="image" src="suppr.png" name="del" title="Supprimer" value="'+link.attr('rel')+'" class="delete added"/>');
			del();
			}
		});
		
		$('div.line_link span.note').mousemove(function(e){
			var offset = $(this).offset();
			var x = parseInt( e.pageX - offset.left);
			//var y = e.pageY - this.offsetTop;
			//$('#status').html(x+' '+e.pageX+' '+this.offsetLeft);
			if(x<21){
				$(this).addClass('n1').removeClass('n2').removeClass('n3').removeClass('n4').removeClass('n5');
			}else if(x >21 && x<=42){
				$(this).addClass('n2').removeClass('n1').removeClass('n3').removeClass('n4').removeClass('n5');
			}else if(x >42 && x<=63){
				$(this).addClass('n3').removeClass('n1').removeClass('n2').removeClass('n4').removeClass('n5');
			}else if(x >63 && x<=84){
				$(this).addClass('n4').removeClass('n1').removeClass('n2').removeClass('n3').removeClass('n5');
			}else if(x >84 && x <=125){
				$(this).addClass('n5').removeClass('n1').removeClass('n2').removeClass('n3').removeClass('n4');
			}else{
				$(this).removeClass('n1').removeClass('n2').removeClass('n3').removeClass('n4').removeClass('n5');
			}
		});
		$('div.line_link span.note').click(function(e){
			var offset = $(this).offset();
			var x = e.pageX - offset.left;
			var note=0;
			if(x<21){
				var note=1;
			}else if(x >21 && x<=42){
				var note=2;
			}else if(x >42 && x<=63){
				var note=3;
			}else if(x >63 && x<=84){
				var note=4;
			}else if(x >84 && x<=125){
				var note=5;
			}
			var elm = $(this);
			$.ajax({
				type: "post",
				url: "ajax-note.php",
				data: "id="+$(this).parent().attr('rel')+"&note="+note,
				success: function(retour){
					elm.removeClass('not1').removeClass('not2').removeClass('not3').removeClass('not4').removeClass('not5').addClass('not'+note);
				
					
				}
			});
			return false;
		});
		
		$('div.line_link span.note').mouseout(function(){
			$(this).removeClass('n1').removeClass('n2').removeClass('n3').removeClass('n4').removeClass('n5');
		});
		
		$('div.line_link a.deprecated .preview').mousemove(function(e){
			var offset = $(this).offset();
			var x = parseInt( offset.left);
			var y = parseInt( offset.top);
			$('#miniature').css({'top':y,'left':x+250}).show().find('img').attr('src','min/'+$(this).attr('id')+'.gif' );
		});
		var curent = '';
		$('div.line_link a .preview').mousemove(function(e){
			//$('#preview').show();
			if(curent != $(this).parent().attr('rel') ){
				curent = $(this).parent().attr('rel');
				$('#preview').empty().append( '<h2>'+$(this).parent().text()+'</h2>').append( '<iframe src="'+$(this).parent().attr('href')+'">Link Preview</iframe>' );
			}
		});
		$('div.line_link a .preview').mouseout(function(e){
				//$('#preview').hide();
		});
		$('div.line_link a .miniature').mousemove(function(e){
			var offset = $(this).offset();
			var x = parseInt( offset.left);
			var y = parseInt( offset.top);
			if(curent = $(this).attr('rel') ){
				curent = $(this).attr('rel'); 
				if(x>700){ x = x-550;}
				$('#miniature').css({'top':y,'left':x+250}).empty().show().append( '<iframe src="'+$(this).attr('href')+'"></iframe>' );
			}
		});
		$('div.line_link a .miniature').mouseover(function(){
			$('#miniature').show();
		});
		$('#miniature').mouseout(function(){
			$('#miniature').hide();
		});
		$('#miniature').hide();
		
		
		$('div.block_link h3').click(function(){
			$(this).parent().toggleClass('close');
		});
	});