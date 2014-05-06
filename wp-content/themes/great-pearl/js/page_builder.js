jQuery(document).ready(function(){

	var editor_object = "";
	
	
	
	jQuery('.content_editor').live("click",function(){
		//resize editor
		jQuery('#wope_editor_tbl').css("height","300px");
		jQuery('#wope_editor_ifr').css("height","300px");
		
		
		editor_object = jQuery(this);
		var field_content = jQuery(this).val();
		if (tinyMCE.getInstanceById('wope_editor')) {
			tinyMCE.getInstanceById('wope_editor').setContent(field_content);
		}else{
			jQuery("textarea#wope_editor").html();
		}
		jQuery('#wope_editor_container').show();
		jQuery('#wope_overlay').show();
		
		var window_width = jQuery(window).width();
		
		var editor_left = (window_width-800)/2;
		
		if(window_width > 800){
			jQuery('#wope_editor_container').css('left',editor_left+'px');
		}else{
			jQuery('#wope_editor_container').css('left','0px');
			jQuery('#wope_editor_container').css('width',window_width+'px')
		}
	});
	
	jQuery('#update_wope_editor').click(function(){
		jQuery('#wope_editor_container').hide();
		var editor_content = tinyMCE.getInstanceById('wope_editor').getContent();
		jQuery(editor_object).val(editor_content);
		jQuery('#wope_overlay').hide();
		
		switchEditors.switchto('#wope_editor-tmce');
	});
	
	jQuery('#close_wope_editor').click(function(){
		jQuery('#wope_editor_container').hide();
		jQuery('#wope_overlay').hide();
		switchEditors.switchto('#wope_editor-tmce');
	});

	//page builder
	jQuery('<div id="page-builder-container" ><button class="button-primary" id="use-page-builder" >Switch to Page Builder</button> <button class="button-primary"  id="use-default-editor" >Switch to Default Editor</button></div>').insertAfter('#titlediv');
	
	if(jQuery('#current-editor').val() == '0'){ //last update is using default editor
		//buttons
		jQuery('#use-page-builder').show();
		jQuery('#use-default-editor').hide();
		//editor
		jQuery('#postdivrich').show();
		jQuery('#wope-page-builder').hide();
	}else{ 									//page builder
		jQuery('#use-page-builder').hide();
		jQuery('#use-default-editor').show();
		//editor
		jQuery('#postdivrich').hide();
		jQuery('#wope-page-builder').show();
	}
	
	jQuery('#use-page-builder').click(function(){
		//buttons
		jQuery(this).hide();
		jQuery('#use-default-editor').show();
		//editor
		jQuery('#postdivrich').hide();
		jQuery('#wope-page-builder').show();
		//hidden field
		jQuery('#current-editor').val('1');
		
		return false;
	});
	
	jQuery('#use-default-editor').click(function(){
		//buttons
		jQuery(this).hide();
		jQuery('#use-page-builder').show();
		//editor
		jQuery('#postdivrich').show();
		jQuery('#wope-page-builder').hide();
		//hidden field
		jQuery('#current-editor').val('0');
		
		return false;
	});
	
	//index page builder
	jQuery('#create-index-section').click(function(){
		jQuery('#index-page').append('<div id="created-index-section" class="index-section-box"><div class="index-section-remove"></div><div class="index-section-buttons"><span class="index-section-title">Content Section</span><select class="index-section-layout" name="layout"><option value="0"> -- Change Layout -- </option><option value="1"> 1/1 </option><option value="2"> 1/2 + 1/2 </option><option value="3"> 1/3 + 1/3 + 1/3 </option><option value="4"> 1/3 + 2/3 </option><option value="5"> 2/3 + 1/3 </option><option value="6"> 1/4 + 1/4 + 1/4 + 1/4 </option><option value="7"> 2/4 + 1/4 + 1/4</option><option value="8"> 1/4 + 2/4 + 1/4</option><option value="9"> 1/4 + 1/4 + 2/4</option><option value="10"> 1/4 + 3/4</option><option value="11"> 3/4 + 1/4</option></select></div><div class="index-page-box-container"><div class="index-page-box"><div class="index-box-column">1</div></div><div class="cleared"></div></div></div>');	
		jQuery('#created-index-section').find( ".index-page-box" ).sortable({
			revert: true,
			connectWith:  ".index-page-box",
			placeholder: "ui-state-highlight2",
		});
		jQuery('#created-index-section').attr('id','');
	});
	
	//index section
	jQuery('.index-section-layout').live("change",function(){
		var layout = jQuery(this).val();
		if(layout != '0'){
			var html  = '';
			
			//store old widgets
			var box_container = jQuery(this).parent().parent().find('.index-page-box-container');
			var old_widgets = [];
			old_widgets[0] = [];
			old_widgets[1] = [];
			old_widgets[2] = [];
			old_widgets[3] = [];
			var number = 0;
			jQuery(box_container).find('.index-page-box').each(function(){
				var number_widget = 0;
				jQuery(this).find('.index-widget').each(function(){
					old_widgets[number][number_widget] = jQuery(this).clone();
					number_widget++;
				});
				number++;
			});
			
			//change the layout
			switch(layout){
				case '1':
					html = '<div class="index-page-box index-page-box1"><div class="index-box-column">1</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '2': 
					html = '<div class="index-page-box column2_1 index-page-box1"><div class="index-box-column">2_1</div></div><div class="index-page-box column2_1 column-last index-page-box2"><div class="index-box-column">2_1</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '3': 
					html = '<div class="index-page-box column3_1 index-page-box1"><div class="index-box-column">3_1</div></div><div class="index-page-box column3_1 index-page-box2"><div class="index-box-column">3_1</div></div><div class="index-page-box column3_1 column-last index-page-box3"><div class="index-box-column">3_1</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					
					break;
				case '4': 
					html = '<div class="index-page-box column3_1 index-page-box1"><div class="index-box-column">3_1</div></div><div class="index-page-box column3_2 column-last index-page-box2"><div class="index-box-column">3_2</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '5':
					html = '<div class="index-page-box column3_2 index-page-box1"><div class="index-box-column">3_2</div></div><div class="index-page-box column3_1 column-last index-page-box2"><div class="index-box-column">3_1</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '6':
					html = '<div class="index-page-box column4_1 index-page-box1"><div class="index-box-column">4_1</div></div><div class="index-page-box column4_1 index-page-box2"><div class="index-box-column">4_1</div></div><div class="index-page-box column4_1 index-page-box3"><div class="index-box-column">4_1</div></div><div class="index-page-box column4_1 column-last index-page-box4"><div class="index-box-column">4_1</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '7':
					html = '<div class="index-page-box column4_2 index-page-box1"><div class="index-box-column">4_2</div></div><div class="index-page-box column4_1 index-page-box2"><div class="index-box-column">4_1</div></div><div class="index-page-box column4_1 column-last index-page-box3"><div class="index-box-column">4_1</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '8':
					html = '<div class="index-page-box column4_1 index-page-box1"><div class="index-box-column">4_1</div></div><div class="index-page-box column4_2 index-page-box2"><div class="index-box-column">4_2</div></div><div class="index-page-box column4_1 column-last index-page-box3"><div class="index-box-column">4_1</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '9':
					html = '<div class="index-page-box column4_1 index-page-box1"><div class="index-box-column">4_1</div></div><div class="index-page-box column4_1 index-page-box2"><div class="index-box-column">4_1</div></div><div class="index-page-box column4_2 column-last index-page-box3"><div class="index-box-column">4_2</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '10':
					html = '<div class="index-page-box column4_1 index-page-box1"><div class="index-box-column">4_1</div></div><div class="index-page-box column4_3 column-last index-page-box2"><div class="index-box-column">4_3</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
				case '11':
					html = '<div class="index-page-box column4_3 index-page-box1"><div class="index-box-column">4_3</div></div><div class="index-page-box column4_1 column-last index-page-box2"><div class="index-box-column">4_1</div></div><div class="cleared"></div>';
					jQuery(box_container).html(html);
					break;
			}
			
			//restore old widgets
			switch(layout){
				case '1': /* 1/1 */
					for(var i = 0 ; i < 4 ; i++){
						if(old_widgets[i].length > 0){
							for(var j = 0 ; j < old_widgets[i].length ; j++){
								jQuery(box_container).find('.index-page-box1').append(old_widgets[i][j]);
							}
						}
					}
					break;
				case '2': /* 1/2 + 1/2 */
				case '4': /* 1/3 + 2/3 */
				case '5': /* 2/3 + 1/3 */
				case '10': /* 1/4 + 3/4 */
				case '11': /* 3/4 + 1/4 */
					for(var i = 0 ; i < 4 ; i++){
						if(old_widgets[i].length > 0){
							for(var j = 0 ; j < old_widgets[i].length ; j++){
								//store old widgets of column 1 to new column 1 , the rest store in column 2
								if(i == 0){
									jQuery(box_container).find('.index-page-box1').append(old_widgets[i][j]);
								}else{
									jQuery(box_container).find('.index-page-box2').append(old_widgets[i][j]);
								}
							}
						}
					}
					break;
				case '3': /* 1/3 + 1/3 + 1/3 */
				case '7': /* 2/4 + 1/4 + 1/4 */
				case '8': /* 1/4 + 2/4 + 1/4 */
				case '9': /* 1/4 + 1/4 + 2/4 */
					for(var i = 0 ; i < 4 ; i++){
						if(old_widgets[i].length > 0){
							for(var j = 0 ; j < old_widgets[i].length ; j++){
								//store old widgets of column 1 to new column 1 , the rest store in column 2
								if(i == 0){
									jQuery(box_container).find('.index-page-box1').append(old_widgets[i][j]);
								}else if(i == 1){
									jQuery(box_container).find('.index-page-box2').append(old_widgets[i][j]);
								}else{
									jQuery(box_container).find('.index-page-box3').append(old_widgets[i][j]);
								}
							}
						}
					}
					break;
				case '6': /* 1/4 + 1/4 + 1/4 + 1/4 */
					for(var i = 0 ; i < 4 ; i++){
						if(old_widgets[i].length > 0){
							for(var j = 0 ; j < old_widgets[i].length ; j++){
								//store old widgets of column 1 to new column 1 , the rest store in column 2
								if(i == 0){
									jQuery(box_container).find('.index-page-box1').append(old_widgets[i][j]);
								}else if(i == 1){
									jQuery(box_container).find('.index-page-box2').append(old_widgets[i][j]);
								}else if(i == 2){
									jQuery(box_container).find('.index-page-box3').append(old_widgets[i][j]);
								}else{
									jQuery(box_container).find('.index-page-box4').append(old_widgets[i][j]);
								}
							}
						}
					}
					break;
			}
			
			//remove numbered class
			jQuery(box_container).find('.index-page-box1').removeClass('index-page-box1');
			jQuery(box_container).find('.index-page-box2').removeClass('index-page-box2');
			jQuery(box_container).find('.index-page-box2').removeClass('index-page-box3');
			jQuery(box_container).find('.index-page-box2').removeClass('index-page-box4');
					
			//restore the sortable
			jQuery(box_container).find( ".index-page-box" ).sortable({
				revert: true,
				connectWith:  ".index-page-box",
				placeholder: "ui-state-highlight2",
			});
		}
	});
	
	jQuery('#index-page').sortable({
		revert: true,
		placeholder: "ui-state-highlight"
	});
	
	jQuery( ".index-page-box" ).sortable({
		revert: true,
		connectWith:  ".index-page-box",
		placeholder: "ui-state-highlight2",
	});
		
	jQuery( "#widget-containers").find(".index-widget" ).draggable({ 
		revert: "invalid",
		connectToSortable: ".index-page-box",
		helper: "clone",
		start : function(event,ui){
			jQuery(ui.helper).addClass("ui-draggable-helper");
		},
		drag : function(event,ui){
			jQuery('.index-page-box').find('.index-widget-note').remove();
		}
	});
	
	jQuery('.index-widget-title').live("click",function(){
		var parent = jQuery(this).parent();
		var index_section_container = jQuery(parent).parent();
		if( jQuery(index_section_container).hasClass('index-page-box') ){
			if ( jQuery(parent).find('.index-widget-content').css('display') == 'block'){
				jQuery(parent).find('.index-widget-content').hide();
			}else{
				jQuery(parent).find('.index-widget-content').show();
			}
		}
	});
	
	jQuery('.index-section-remove').live("click",function(){
		jQuery(this).parent().remove();
	});
	
	jQuery('.index-widget-remove').live("click",function(){
		jQuery(this).parent().remove();
	});
	
	jQuery('#post').submit(function(){
		//reset data html
		jQuery('#index-hidden-data').html("");
		var total_index_section = 0;
		var total_index_box = 0;
		var total_index_widget = 0;
		var total_index_field = 0;
		jQuery('#index-page').find('.index-section-box').each(function(){ //each index section
			total_index_section++;
			var current_index_box = 0;
			var section_layout = jQuery(this).find('.index-section-layout').val();
			
			jQuery(this).find('.index-page-box').each(function(){ //each index box
				current_index_box++;
				total_index_box++;
				var current_index_widget = 0;
				var column = jQuery(this).find(".index-box-column").html();
				
				jQuery(this).find('.index-widget').each(function(){ //each widget
					current_index_widget++;
					total_index_widget++;
					var current_index_field = 0;
					var widget_type = jQuery(this).find(".index-widget-type").html();
					
					jQuery(this).find('.widget-field').each(function(){
						current_index_field++;
						total_index_field++;
						var input_value = jQuery(this).val();
						
						
						
						//convert double quotes
						var input_value2 = input_value.replace(/"/g, "&quot;");
						
						
						
						//save input value
						jQuery('#index-hidden-data').append('<input type="hidden" name="field'+total_index_field+'" value="'+input_value2+'" >'); 
					});
					
					//save widget's type
					jQuery('#index-hidden-data').append('<input type="hidden" name="widget'+total_index_widget+'" value="'+widget_type+'" >'); 
					
					//save total field
					jQuery('#index-hidden-data').append('<input type="hidden" name="widget'+total_index_widget+'_total" value="'+current_index_field+'" >'); 
				});
				
				//save box's column
				jQuery('#index-hidden-data').append('<input type="hidden" name="box'+total_index_box+'" value="'+column+'" >'); 
				
				//save total widget
				jQuery('#index-hidden-data').append('<input type="hidden" name="box'+total_index_box+'_total" value="'+current_index_widget+'" >'); 
			});
			
			//save total box
			jQuery('#index-hidden-data').append('<input type="hidden" name="section'+total_index_section+'_total" value="'+current_index_box+'" >'); 
			
			//save section layout
			jQuery('#index-hidden-data').append('<input type="hidden" name="section'+total_index_section+'_layout" value="'+section_layout+'" >');
		});
		
		
		jQuery('#index-hidden-data').append('<input type="hidden" name="total_section" value="'+total_index_section+'" >');

		//return false;
	});
	
	jQuery('#wope_editor_container').draggable();
	
	
	//hide all widget content as init
	jQuery('.index-page-box').find('.index-widget-content').hide();
});