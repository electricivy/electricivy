jQuery(document).ready(function(){
	var pathname = window.location.pathname;
	var pos = pathname.indexOf('wp-admin');
	var theme_url = pathname.substr(0,pos) + 'wp-content/themes/pureline/';
	
	jQuery('.color-picker').jPicker({
		images:{
			clientPath: theme_url+'js/jpicker/images/'
		},
		window:{
			effects:{
				type: 'slide',
				speed: {
					show : 'fast',
					hide : 'fast'
				}
			},
			position:{
				x:0,
				y:0
			}
		}
	}, function(color, context){
		var all = color.val('all');
		jQuery('#current-color-scheme').css('background-color','#'+ all.hex);
	});
	
	
	var my_original_editor = window.send_to_editor;
	jQuery('.upload_button').live("click",function() {
		uploadID = jQuery(this).prev('input'); 
		uploaded_image = jQuery(this).parent().parent().find('.uploaded_image');
		tb_show('', 'media-upload.php?TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery(html).attr('href');
			uploadID.val(imgurl);
			uploaded_image.attr('src',imgurl);
			tb_remove();
			window.send_to_editor = my_original_editor;
		};
		return false;
	});
	
	//option tabs
	jQuery('#option-tab-buttons div').click(function(){
		var button_id = jQuery(this).attr('id');
		if(jQuery(this).hasClass('tab-current')	){
		}else{
			jQuery('#option-tab-buttons').find('div').removeClass('tab-current');
			jQuery(this).addClass('tab-current');
		}
		jQuery('.option-tab').hide();
		jQuery('#'+button_id+'-content').show();
	});
	
	//get #tab from url
	var query = location.href.split('#');
	
	
	if(query[1] != undefined){
		//active current tab buttons
		jQuery('#option-tab-buttons').find('div').removeClass('tab-current');
		jQuery('#option-tab-buttons').find('#option-tab-'+query[1]).addClass('tab-current');
		
		//show the current tab content
		jQuery('.option-tab').hide();
		jQuery('#option-tab-'+query[1]+'-content').show();
	};
	
	var total_subslide = parseInt(jQuery('#total_subslide').val());
	
	
	jQuery('#add-subslide').click(function(){
		var new_subslide = total_subslide + 1;
		jQuery('#subslide-container').append('<div class="subslide" id="subslide'+new_subslide+'"><div class="subslide-thumb"><img src=""></div><div class="subslide-image"><input class="upload_field" type="text" size="24"  name="subslide'+new_subslide+'_image"  value="" /><input class="upload_slide" type="button" value="Upload Image" /></div><div class="subslide-action"><select name="subslide'+new_subslide+'_action"><option value="right">Right</option><option value="left">Left</option><option value="top">Top</option><option value="bottom">Bottom</option><option value="fade">Fade</option><option value="faderight">Fade Right</option><option value="fadeleft">Fade Left</option><option value="fadedown">Fade Top</option><option value="fadeup">Fade Bottom</option></select></div><div class="subslide-easing"><select name="subslide'+new_subslide+'_easing"><option value="easeInExpo">easeInExpo</option><option value="easeOutExpo">easeOutExpo</option><option value="easeInOutExpo">easeInOutExpo</option><option value="easeInElastic">easeInElastic</option><option value="easeOutElastic">easeOutElastic</option><option value="easeInOutElastic">easeInOutElastic</option><option value="easeInBack">easeInBack</option><option value="easeOutBack">easeOutBack</option><option value="easeInOutBack">easeInOutBack</option><option value="easeInBounce">easeInBounce</option><option value="easeOutBounce">easeOutBounce</option><option value="easeInOutBounce">easeInOutBounce</option><option value="linear">linear</option><option value="swing">swing</option><option value="easeInQuad">easeInQuad</option><option value="easeOutQuad">easeOutQuad</option><option value="easeInOutQuad">easeInOutQuad</option><option value="easeInCubic">easeInCubic</option><option value="easeOutCubic">easeOutCubic</option><option value="easeInOutCubic">easeInOutCubic</option><option value="easeInQuart">easeInQuart</option><option value="easeOutQuart">easeOutQuart</option><option value="easeInOutQuart">easeInOutQuart</option><option value="easeInQuint">easeInQuint</option><option value="easeOutQuint">easeOutQuint</option><option value="easeInOutQuint">easeInOutQuint</option><option value="easeInSine">easeInSine</option><option value="easeOutSine">easeOutSine</option><option value="easeInOutSine">easeInOutSine</option><option value="easeInCirc">easeInCirc</option><option value="easeOutCirc">easeOutCirc</option><option value="easeInOutCirc">easeInOutCirc</option></select></div><div class="subslide-delay"><input type="text" name="subslide'+new_subslide+'_delay" value="1000"></div><div class="subslide-time"><input type="text" name="subslide'+new_subslide+'_time" value="1000"></div><div class="subslide-task"><button class="button remove-subslide">Remove</button></div><div class="cleared"></div></div>');
		
		jQuery('#slider-test').append('<img id="subslide'+new_subslide+'-test" class="subslide-test">');
		
		total_subslide++;
		
		return false;
	});
	
	jQuery('.remove-subslide').live("click",function(){
		var parent = jQuery(this).parent().parent();
		var parent_id = jQuery(parent).attr('id');
		jQuery(parent).remove();
		jQuery('#'+parent_id+'-test').remove();
		return false;
	});
	
	jQuery('#subslide-container').sortable({
		revert: true,
		placeholder: "ui-state-highlight3",
		update : function( event, ui ) {
			//remove all current test layer
			jQuery('#slider-test').html('');
			
			jQuery('#subslide-container').find('.subslide').each(function(){
				var this_id = jQuery(this).attr('id');
				var this_image = jQuery(this).find('.upload_field').val();
				
				jQuery('#slider-test').append('<img id="'+this_id+'-test" class="subslide-test"src="'+this_image+'" > ' );
			});
		}
	});
	
	//upload slide image
	var my_original_editor = window.send_to_editor;
	jQuery('.upload_slide').live("click",function() {
		uploadID = jQuery(this).prev('input'); 
		parent_id = jQuery(this).parent().parent().attr('id');
		thumb_id = jQuery(this).parent().parent().find('.subslide-thumb img');
		tb_show('', 'media-upload.php?TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery(html).attr('href');
			uploadID.val(imgurl);
			jQuery('#'+parent_id+'-test').attr('src',imgurl);
			jQuery(thumb_id).attr('src',imgurl);
			tb_remove();
			window.send_to_editor = my_original_editor;
		};
		return false;
	});
	
	var test_slide = 0;
	
	
	jQuery('#test_slide').click(function(){
		
		var slide_data = new Array();
		
		if(test_slide == 0){
		
			var slide_time = parseInt(jQuery.trim(jQuery('#slide_time').val()));
			
			setTimeout(function(){
				test_slide = 0;
				jQuery('#slider-test').find('.subslide-test').each(function(){
					jQuery(this).stop(true,true);
				});
			} , slide_time );
		
			test_slide = 1;

			jQuery('#subslide-container').find('.subslide').each(function(){
				var slide_id = jQuery(this).attr('id');
				slide_data[slide_id+'-test'] = new Array();
				slide_data[slide_id+'-test']['img'] = jQuery(this).find('.upload_field').val();
				slide_data[slide_id+'-test']['slide_id'] = slide_id;
				slide_data[slide_id+'-test']['action'] = jQuery(this).find('.subslide-action select').val();
				slide_data[slide_id+'-test']['easing'] = jQuery(this).find('.subslide-easing select').val();
				slide_data[slide_id+'-test']['delay'] = jQuery(this).find('.subslide-delay input').val();
				slide_data[slide_id+'-test']['time'] = jQuery(this).find('.subslide-time input').val();
			});
			
			jQuery('#slider-test').find('.subslide-test').each(function(){
				var current_width = 960;
				var current_height = jQuery('#slider-test').height();
				
				var data = slide_data[jQuery(this).attr('id')];
			
				jQuery(this).stop(true,true);
				jQuery(this).css('opacity','1');
				if(data['action'] == 'left'){				
					jQuery(this).css('left','-'+current_width+'px');
					jQuery(this).css('top','0px');
				}else if(data['action'] == 'right'){
					jQuery(this).css('left',''+current_width+'px');
					jQuery(this).css('top','0px');
				}else if(data['action'] == 'top'){
					jQuery(this).css('top','-'+current_height+'px');
					jQuery(this).css('left','0px');
				}else if(data['action'] == 'bottom'){
					jQuery(this).css('top',''+current_height+'px');
					jQuery(this).css('left','0px');
				}else if(data['action'] == 'fade'){
					jQuery(this).css('top','0px');
					jQuery(this).css('left','0px');
					jQuery(this).css('opacity','0');
				}else if(data['action'] == 'fadeup'){
					jQuery(this).css('top','50px');
					jQuery(this).css('left','0px');
					jQuery(this).css('opacity','0');
				}else if(data['action'] == 'fadedown'){
					jQuery(this).css('top','-50px');
					jQuery(this).css('left','0px');
					jQuery(this).css('opacity','0');
				}else if(data['action'] == 'fadeleft'){
					jQuery(this).css('top','0px');
					jQuery(this).css('left','-50px');
					jQuery(this).css('opacity','0');
				}else if(data['action'] == 'faderight'){
					jQuery(this).css('top','0px');
					jQuery(this).css('left','50px');
					jQuery(this).css('opacity','0');
				}
			});
			
			//move the next slide
			setTimeout(function() { 
				jQuery('#slider-test').find('.subslide-test').each(function(){
					var current_width = 960;
					var current_height = jQuery('#slider-test').height();
					
					var data = slide_data[jQuery(this).attr('id')];
					
					if(data['action'] == 'left'){
						var _left = current_width;
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								left: '+='+_left
							}, parseInt(data['time']) , data['easing'] );
						} , data['delay']);
					}else if(data['action'] == 'right'){
						var _right = current_width;
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								left: '-='+_right
							},  parseInt(data['time']) ,  data['easing']  );
						} , data['delay']);
					}else if(data['action'] == 'top'){
						var _top = current_height;
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								top: '+='+_top
							},  parseInt(data['time']) ,  data['easing']  );
						} , data['delay']);
					}else if(data['action'] == 'bottom'){
						var _top = current_height;
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								top: '-='+_top
							},  parseInt(data['time']) ,  data['easing']  );
						} , data['delay']);
					}else if(data['action'] == 'fade'){
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								left : 0,
								opacity : 1
							},  parseInt(data['time']) );
						} , data['delay']);
					}else if(data['action'] == 'fadeup'){
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								top: '-='+50,
								opacity : 1
							},  parseInt(data['time']) ,  data['easing']  );
						} , data['delay']);
					}else if(data['action'] == 'fadedown'){
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								top: '+='+50,
								opacity : 1
							},  parseInt(data['time']) ,  data['easing']  );
						} , data['delay']);
					}else if(data['action'] == 'fadeleft'){
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								left: '+='+50,
								opacity : 1
							},  parseInt(data['time']) ,  data['easing']  );
						} , data['delay']);
					}else if(data['action'] == 'faderight'){
						var _this = this;
						timeout = setTimeout(function(){
							jQuery(_this).animate({
								left: '-='+50,
								opacity : 1
							},  parseInt(data['time']) ,  data['easing']  );
						} , data['delay']);
					}
				});
			}, 100);
		}

		return false;
	});
	
	jQuery('#save-slide').click(function(){
		var id_string = "";
		jQuery('#subslide-container').find('.subslide').each(function(){
			var this_id = jQuery(this).attr('id').substring(8);
			id_string = id_string + this_id + "," ;
		});
		
		jQuery('#id_subslide').val(id_string);
	});
	
	jQuery('#slide-container').sortable({
		revert: true,
		placeholder: "ui-state-highlight4",
	});
	
	jQuery('#save-slide-order').click(function(){
		var slide_order = "";
		jQuery('#slide-container').find('.slide-line').each(function(){
			var this_id = jQuery(this).find('.slide_id').val();
			slide_order = this_id + "," + slide_order ;
		});
		jQuery('#slide_order').val(slide_order);
	});
	
	//resize static content editor
	jQuery('#static_content_editor_tbl').css("height","300px");
	jQuery('#static_content_editor_ifr').css("height","300px");
	
	jQuery('.color-scheme').click(function(){
		if(jQuery(this).attr('id') != 'current-color-scheme'){
			var current_color = jQuery(this).find('.color-code').html();
			jQuery.jPicker.List[0].color.active.val('hex', current_color, this);
			jQuery('#current-color-scheme').attr("class",jQuery(this).attr('class'));
			jQuery('#current-color-scheme').css("background-color",'#'+current_color);
		}
	});
	
	jQuery('.bg-pattern-select').click(function(){
		jQuery('#option-tab-background-content').find('.bg-pattern-select').removeClass("bg-pattern-selected");
		jQuery(this).addClass("bg-pattern-selected");
		jQuery('#bg-pattern').val(jQuery(this).attr("id"));
	});

});

