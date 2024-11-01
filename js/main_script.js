
//facebook connection pop-up window
function socialpost_fb_con(site_url, type){
	var win = window.open( 'http://wpeacock.com/socialpost-server/fb-connect.php?local_url='+site_url+'&type='+type, 
	'SocialPost Facebook Connect', 
	'width=800, \
	height=800, \
	directories=no, \
	location=no, \
	menubar=no, \
	resizable=no, \
	scrollbars=1, \
	status=no, \
	toolbar=no' );
   var win_timer = setInterval(function() {   
      if(win.closed) {
          window.location.reload();
          clearInterval(win_timer);
      } 
    }, 100);
}

//twitter connectin pop-up window
function socialpost_tw_con(site_url, type){
	var win = window.open( 'http://wpeacock.com/socialpost-server/tw-connect.php?local_url='+site_url+'&type='+type, 
	'SocialPost Facebook Connect', 
	'width=800, \
	height=800, \
	directories=no, \
	location=no, \
	menubar=no, \
	resizable=no, \
	scrollbars=1, \
	status=no, \
	toolbar=no' );
   var win_timer = setInterval(function() {   
      if(win.closed) {
          window.location.reload();
          clearInterval(win_timer);
      } 
    }, 100);
}

//linkedin connection
function socialpost_li_con(site_url, type){
	var win = window.open( 'http://wpeacock.com/socialpost-server/li-connect.php?local_url='+site_url+'&type='+type, 
	'SocialPost Facebook Connect', 
	'width=800, \
	height=800, \
	directories=no, \
	location=no, \
	menubar=no, \
	resizable=no, \
	scrollbars=1, \
	status=no, \
	toolbar=no' );
   var win_timer = setInterval(function() {   
      if(win.closed) {
          window.location.reload();
          clearInterval(win_timer);
      } 
    }, 100);	
}

function socialpost_con_ch(check, en_ds_check, post_id){
	if(en_ds_check == 'dl'){
		var check_del = confirm("Want to delete?");
		if (check_del == false) {
			//Logic to delete the item
			return true;
		}
	}else{
		check_del = false;
	}
	jQuery(document).ready(function($) {

		var data = {
			'action': 'socialpost_con_status',
			'en_ds_check': en_ds_check,
			'post_id': post_id
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			if(check_del){
				location.reload();
			}
			//alert('Got this from the server: ' + response);
		});
	});	
}


//for metabox options
    jQuery(document).ready(function(){
		
		jQuery('#socialpost_fbmbc').change(function(){
		
			if(jQuery('#socialpost_fbmbc').prop("checked") == true){
				jQuery('#socialpost_fbcm').show( );
				
			}else{
				jQuery('#socialpost_fbcm').hide( );
			
			}
		});
		
		
		jQuery('#socialpost_twmbc').change(function(){
		
			if(jQuery('#socialpost_twmbc').prop("checked") == true){
				jQuery('#socialpost_twcm').show( );
				
			}else{
				jQuery('#socialpost_twcm').hide( );
			
			}
		});
		
		
		jQuery('#socialpost_limbc').change(function(){
		
			if(jQuery('#socialpost_limbc').prop("checked") == true){
				jQuery('#socialpost_licm').show( );
				
			}else{
				jQuery('#socialpost_licm').hide( );
			
			}
		});

    });
	
	jQuery( "#socialpost_tabs1" ).tabs();
	jQuery( ".socialpost_con_endsr" ).buttonset();