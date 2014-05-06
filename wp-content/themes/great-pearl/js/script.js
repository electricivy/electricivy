jQuery(document).ready(function(){

		
	var show_menu = false;
	var recent_slider_each = 245;
	
	//resize the slider
	jQuery(window).resize(function(){
		//recent slidier
		jQuery(document).find('.recent-slider').each(function(){
			var thumb_rate = jQuery(this).find('.recent-thumb-rate').html();
			var total_slider_width = jQuery(this).width();
			if(total_slider_width <= 225){
				var total_slide = 1;
				var image_width = total_slider_width ;
			}else if(total_slider_width <= 470){
				var total_slide = 2;
				var image_width = (total_slider_width - 20)/2 ;
			}else if(total_slider_width <= 715){
				var total_slide = 3;
				var image_width = (total_slider_width - 40)/3;
			}else{
				var total_slide = 4;
				var image_width = (total_slider_width - 60)/4 ;
			}
			var recent_slider_each = image_width+20; 
			
			//changes images width
			jQuery(this).find('.recent-each img').css('width',image_width+'px');
			//change each slide width
			jQuery(this).find('.recent-each').css('width',image_width+'px');
			
			//change new container width
			var total_slider_slide = parseInt(jQuery(this).find('.recent-total').html());
			var recent_container_width = total_slider_slide*recent_slider_each;
			jQuery(this).find('.recent-container').css('width',recent_container_width+'px');
			
			//change new slider height
			if(thumb_rate == '1'){
				var image_height = image_width;
			}else if(thumb_rate == '2'){
				var image_height = (image_width*2)/3;
			}else if(thumb_rate == '3'){
				var image_height = (image_width*9)/16;
			}else if(thumb_rate == '4'){
				var image_height = (image_width*3)/4;
			}
			
			//change image height
			var slide_height = image_height;
			jQuery(this).find('.recent-each img').css('height',image_height+'px');
			
			//change each slide height and container 
			jQuery(this).find('.recent-each').css('height',slide_height+'px');
			jQuery(this).find('.recent-container').css('height',slide_height+'px');
			
			//change slider height
			var new_slider_height = slide_height+57;
			jQuery(this).height(new_slider_height);
			
			//set slide begin to 0
			jQuery(this).find('.recent-container').css('left','0px');
			jQuery(this).find('.recent-current').html(total_slide);
			
			//update information
			jQuery(this).find('.recent-number-show').html(total_slide);
			jQuery(this).find('.recent-slide-each').html(recent_slider_each);
		});
		
	});

	
	//RECENT SLIDER
	//check broswer size
	jQuery(document).find('.recent-slider').each(function(){
		var thumb_rate = jQuery(this).find('.recent-thumb-rate').html();
		var total_slider_width = jQuery(this).width();
		if(total_slider_width <= 225){
			var total_slide = 1;
			var image_width = total_slider_width ;
		}else if(total_slider_width <= 470){
			var total_slide = 2;
			var image_width = (total_slider_width - 20)/2 ;
		}else if(total_slider_width <= 715){
			var total_slide = 3;
			var image_width = (total_slider_width - 40)/3;
		}else{
			var total_slide = 4;
			var image_width = (total_slider_width - 60)/4 ;
		}
		var recent_slider_each = image_width+20; 
		
		//changes images width
		jQuery(this).find('.recent-each img').css('width',image_width+'px');
		//change each slide width
		jQuery(this).find('.recent-each').css('width',image_width+'px');
		
		//change new container width
		var total_slider_slide = parseInt(jQuery(this).find('.recent-total').html());
		var recent_container_width = total_slider_slide*recent_slider_each;
		jQuery(this).find('.recent-container').css('width',recent_container_width+'px');
		
		//change new slider height
		if(thumb_rate == '1'){
			var image_height = image_width;
		}else if(thumb_rate == '2'){
			var image_height = (image_width*2)/3;
		}else if(thumb_rate == '3'){
			var image_height = (image_width*9)/16;
		}else if(thumb_rate == '4'){
			var image_height = (image_width*3)/4;
		}
		
		//change image height
		var slide_height = image_height;
		jQuery(this).find('.recent-each img').css('height',image_height+'px');
		
		//change each slide height and container 
		jQuery(this).find('.recent-each').css('height',slide_height+'px');
		jQuery(this).find('.recent-container').css('height',slide_height+'px');
		
		//change slider height
		var new_slider_height = slide_height+57;
		jQuery(this).height(new_slider_height);
		
		//set slide begin to 0
		jQuery(this).find('.recent-container').css('left','0px');
		jQuery(this).find('.recent-current').html(total_slide);
		
		//update information
		jQuery(this).find('.recent-number-show').html(total_slide);
		jQuery(this).find('.recent-slide-each').html(recent_slider_each);
		
		//prev button
		jQuery(this).find('.recent-button-prev').click(function(){
			var root 				= jQuery(this).parent().parent().parent();
			var current_id 			= parseInt( jQuery(root).find('.recent-current').html() );
			var total 				= parseInt( jQuery(root).find('.recent-total').html() );
			var recent_slider_each  = parseInt( jQuery(root).find('.recent-slide-each').html() );
			if(current_id < total){
				jQuery(root).find('.recent-container').animate({
					left: '-='+recent_slider_each
				}, 200, function() {
					// Animation complete.
				});
				var next_current_id = current_id + 1;
				jQuery(root).find('.recent-current').html(next_current_id);
			}
		});
		
		//next button
		jQuery(this).find('.recent-button-next').click(function(){
			var root 				= jQuery(this).parent().parent().parent();
			var current_id 			= parseInt( jQuery(root).find('.recent-current').html() );
			var total 				= parseInt( jQuery(root).find('.recent-total').html() );
			var recent_number_show	= parseInt( jQuery(root).find('.recent-number-show').html() );
			var recent_slider_each  = parseInt( jQuery(root).find('.recent-slide-each').html() );
			if(current_id > recent_number_show){
				jQuery(root).find('.recent-container').animate({
					left: '+='+recent_slider_each
				}, 200, function() {
					// Animation complete.
				});
				var next_current_id = current_id - 1;
				jQuery(root).find('.recent-current').html(next_current_id);
			}
		});
	});
		
	//ACCORDION
	jQuery('.accordion').accordion({
		
		header: '.accor-title',
		autoHeight: false
	});
	
	//TAB
	jQuery('.tab-title').click(function(){
		var tab_id = jQuery(this).find('.tab-id').html();
		var parent_top = jQuery(this).parent();
		var parent_tab = jQuery(parent_top).parent();
		jQuery(parent_top).find('.tab-title').removeClass("tab-current");
		jQuery(this).addClass("tab-current");
		jQuery(parent_tab).find('.tab-content').hide();
		jQuery(parent_tab).find('.tab-content'+tab_id).show();
	});
	
	//TESTIMONIALS
	jQuery('.testimonials-button-next').click(function(){
		var root 				= jQuery(this).parent().parent().parent();
		var current_id 			= parseInt( jQuery(root).find('.testimonials-current-id').html() );
		var total 				= parseInt( jQuery(root).find('.testimonials-total').html() );
		var next_currennt_id 	= 1;
		if(current_id == total ){
			next_current_id = 1;
		}else{
			next_current_id = current_id + 1;
		}
		jQuery(root).find('.testimonials-current-id').html(next_current_id);
		
		jQuery(root).find('.testimonials-each').each(function(){
			var this_id = parseInt( jQuery(this).find('.testimonials-id').html() );
			if( this_id == next_current_id){
				jQuery(this).fadeIn(1000);
			}else{
				jQuery(this).hide();
			}
		});
	});
	
	jQuery('.testimonials-button-prev').click(function(){
		var root 				= jQuery(this).parent().parent().parent();
		var current_id 			= parseInt( jQuery(root).find('.testimonials-current-id').html() );
		var total 				= parseInt( jQuery(root).find('.testimonials-total').html() );
		var next_currennt_id 	= 1;
		if(current_id == 1 ){
			next_current_id = total;
		}else{
			next_current_id = current_id - 1;
		}
		jQuery(root).find('.testimonials-current-id').html(next_current_id);
		
		jQuery(root).find('.testimonials-each').each(function(){
			var this_id = parseInt( jQuery(this).find('.testimonials-id').html() );
			if( this_id == next_current_id){
				jQuery(this).fadeIn(1000);
			}else{
				jQuery(this).hide();
			}
		});
	});
	
	//recent projects widgets
	jQuery('.recent-project-button-next').click(function(){
		var root 				= jQuery(this).parent().parent().parent();
		var current_id 			= parseInt( jQuery(root).find('.recent-project-current-id').html() );
		var total 				= parseInt( jQuery(root).find('.recent-project-total').html() );
		var next_currennt_id 	= 1;
		if(current_id == total ){
			next_current_id = 1;
		}else{
			next_current_id = current_id + 1;
		}
		jQuery(root).find('.recent-project-current-id').html(next_current_id);
		
		jQuery(root).find('.recent-project-each').each(function(){
			var this_id = parseInt( jQuery(this).find('.recent-project-id').html() );
			if( this_id == next_current_id){
				jQuery(this).fadeIn(1000);
			}else{
				jQuery(this).hide();
			}
		});
	});
	
	jQuery('.recent-project-button-prev').click(function(){
		var root 				= jQuery(this).parent().parent().parent();
		var current_id 			= parseInt( jQuery(root).find('.recent-project-current-id').html() );
		var total 				= parseInt( jQuery(root).find('.recent-project-total').html() );
		var next_currennt_id 	= 1;
		if(current_id == 1 ){
			next_current_id = total;
		}else{
			next_current_id = current_id - 1;
		}
		jQuery(root).find('.recent-project-current-id').html(next_current_id);
		
		jQuery(root).find('.recent-project-each').each(function(){
			var this_id = parseInt( jQuery(this).find('.recent-project-id').html() );
			if( this_id == next_current_id){
				jQuery(this).fadeIn(1000);
			}else{
				jQuery(this).hide();
			}
		});
	});
	
	
	jQuery('#back_top').click(function(){
		jQuery('html, body').animate({scrollTop:0}, 'normal');
		 return false;
	});
	
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#back_top').fadeIn();	
		} else {
			jQuery('#back_top').fadeOut();
		}
	});
	
	if(jQuery(window).scrollTop() != 0) {
		jQuery('#back_top').show();	
	} else {
		jQuery('#back_top').hide();
	}
});