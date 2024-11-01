<?php
function  socialpost_add_custom_box()
{
    $screens = ['post', 'page', 'product'];
    foreach ($screens as $screen) {
        add_meta_box(
            'wporg_box_id',           // Unique ID
            'SocialPost Options',  // Box title
            'socialpost_custom_box_html',  // Content callback, must be of type callable
            $screen,                 // Post type
			'side',
			'high'
        );
    }
}
add_action('add_meta_boxes', 'socialpost_add_custom_box');
function  socialpost_custom_box_html($post)
{
	
	$args = array(
		'post_type' => 'socialpost_fb_cons'
	);  
	$fb_query = new WP_Query( $args );
	
	$args = array(
		'post_type' => 'socialpost_fbp_cons'
	);  
	$fbp_query = new WP_Query( $args );
	
	$args = array(
		'post_type' => 'socialpost_tw_cons'
	);  
	$tw_query = new WP_Query( $args );
	
	$args = array(
		'post_type' => 'socialpost_li_cons'
	);  
	$li_query = new WP_Query( $args );
	
	$args = array(
		'post_type' => 'socialpost_lip_cons'
	);  
	$lip_query = new WP_Query( $args );
	
	$post_status = get_post_status($post->ID);
	
    ?>
	
	<?php 
	if($fb_query->post_count || $fbp_query->post_count): 
		$fb_check = get_post_meta($post->ID, 'socialpost_fbmbc', true);
		$fb_val = get_post_meta($post->ID, 'socialpost_fbcm', true);
	?>
	<br/>
    <div class="socialpost_metabox"><label ><input id="socialpost_fbmbc" name="socialpost_fbmbc" type="checkbox" value='1'  <?php 
	if($post_status != 'auto-draft' && $post_status != 'draft'){
		checked($fb_check, '1'); 	
	}else{
		echo "checked='checked'";
	}
	?> >Facebook:</label>
	<textarea placeholder="Custom Message" cols="20" id="socialpost_fbcm" name="socialpost_fbcm" rows="1" <?php if(checked($fb_check, '1', false) == false && $post_status != 'auto-draft' && $post_status != 'draft') echo "style='display:none;'"; ?> ><?php echo $fb_val; ?></textarea>

	</div>
	<?php endif; ?>
	
	<?php 
	if($tw_query->post_count): 
		$tw_check = get_post_meta($post->ID, 'socialpost_twmbc', true);
		$tw_val = get_post_meta($post->ID, 'socialpost_twcm', true);
	?>
	<div class="socialpost_metabox"><label ><input id="socialpost_twmbc" name="socialpost_twmbc"  type="checkbox" value='1' <?php 
	if($post_status != 'auto-draft' && $post_status != 'draft'){
		checked($tw_check, '1'); 	
	}else{
		echo "checked='checked'";
	}
	?> >Twitter:</label>
	<textarea placeholder="Custom Message" cols="20" id="socialpost_twcm" name="socialpost_twcm" rows="1" <?php if(checked($tw_check, '1', false ) == false && $post_status != 'auto-draft' && $post_status != 'draft') echo "style='display:none;'"; ?> ><?php echo $tw_val; ?></textarea>
	</div>
	<?php endif; ?>
	
	
	<?php 
	if($li_query->post_count || $lip_query->post_count): 
		$li_check = get_post_meta($post->ID, 'socialpost_limbc', true);
		$li_val = get_post_meta($post->ID, 'socialpost_licm', true);
	?>
	<div class="socialpost_metabox"><label ><input id="socialpost_limbc" name="socialpost_limbc"  type="checkbox" value='1' <?php 
	if($post_status != 'auto-draft' && $post_status != 'draft'){
		checked($li_check, '1'); 	
	}else{
		echo "checked='checked'";
	}
	?> >LinkedIn:</label>
	<textarea placeholder="Custom Message" cols="20" id="socialpost_licm" name="socialpost_licm" rows="1" <?php if(checked($li_check, '1', false) == false && $post_status != 'auto-draft' && $post_status != 'draft') echo "style='display:none;'"; ?>><?php echo $li_val; ?></textarea>

	</div>
	<?php endif;
	//this is to disable localhost in development mode
	$whitelist = array(
        '127.0.0.1',
        '::1'
    );
    if(in_array($_SERVER['REMOTE_ADDR'], $whitelist))
       echo "<span style='color:red;'> Localhost will not post on social media! </span>";
}

function socialpost_save_post_met($post_id)
{
	$post_social_string = '';
	
	//to udpate facebook datas
	if (array_key_exists('socialpost_fbmbc', $_POST)) {
		$socialpost_fbmbc = sanitize_text_field( $_POST['socialpost_fbmbc'] );
        update_post_meta(
            $post_id,
            'socialpost_fbmbc',
            $socialpost_fbmbc
        );
		$post_social_string .= 'fb*';
    }else{
		update_post_meta(
		$post_id,
		'socialpost_fbmbc',
		'0'
		);
	}
	
    if (array_key_exists('socialpost_fbcm', $_POST)) {
		$socialpost_fbcm = sanitize_textarea_field( $_POST['socialpost_fbcm'] );
        update_post_meta(
            $post_id,
            'socialpost_fbcm',
            $socialpost_fbcm
        );
    }
	
	//to udpate twitter datas
	if (array_key_exists('socialpost_twmbc', $_POST)) {
		$socialpost_twmbc = sanitize_text_field( $_POST['socialpost_twmbc'] );
        update_post_meta(
            $post_id,
            'socialpost_twmbc',
            $socialpost_twmbc
        );
		$post_social_string .= 'tw*';
    }else{
		update_post_meta(
		$post_id,
		'socialpost_twmbc',
		'0'
		);
	}
	
    if (array_key_exists('socialpost_twcm', $_POST)) {
		$socialpost_twcm = sanitize_textarea_field( $_POST['socialpost_twcm'] );
        update_post_meta(
            $post_id,
            'socialpost_twcm',
            $socialpost_twcm
        );
    }
	
	//to udpate linkedin datas
	if (array_key_exists('socialpost_limbc', $_POST)) {
		$socialpost_limbc = sanitize_text_field( $_POST['socialpost_limbc'] );
        update_post_meta(
            $post_id,
            'socialpost_limbc',
            $socialpost_limbc
        );
		$post_social_string .= 'li';
    }else{
		update_post_meta(
		$post_id,
		'socialpost_limbc',
		'0'
		);
	}
	
    if (array_key_exists('socialpost_licm', $_POST)) {
		$socialpost_licm = sanitize_textarea_field( $_POST['socialpost_licm'] );
        update_post_meta(
            $post_id,
            'socialpost_licm',
            $socialpost_licm
        );
    }
	
	update_post_meta(
		$post_id,
		'socialpost_pstring',
		$post_social_string
	);
}
add_action('save_post', 'socialpost_save_post_met');



add_action('draft_to_publish', 'socialpost_publish_post_on_social');
function socialpost_publish_post_on_social($post){
	
	//this is to disable localhost in development mode
	$whitelist = array(
        '127.0.0.1',
        '::1'
    );
    if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
		$_SESSION['socialpost_admin_notices'] = array('type'=>'err', 'msg'=>'Localhost will not post on social media!!');
       return; 	
	}
		
   
   
	

   //------------------- code to send post on facebook -----------------//
   $fb_check = array_key_exists('socialpost_fbmbc', $_POST);
   if ($fb_check) {
	   $fb_val = sanitize_textarea_field($_POST['socialpost_fbcm']);
	   
	   $args = array(
			'post_type' => 'socialpost_fb_cons'
		); 
		global $wpdb;
		 $querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE $wpdb->posts.post_type = 'socialpost_fb_cons'
			AND $wpdb->posts.post_status = 'publish'
			AND $wpdb->posts.post_date < NOW()
			ORDER BY $wpdb->posts.post_date DESC
		 ";

		$pageposts = $wpdb->get_results($querystr, object);
		if ( $pageposts ) {
			foreach ($pageposts as $this_loop_post){
				$this_post_ID  = $this_loop_post->ID;
				$msg = $fb_val;
				$this_post_meta_data = get_post_meta($this_post_ID);
				$accesstoken = $this_post_meta_data['access_token'][0];
				$post_lnk = get_permalink($post->ID);

				$results = wp_safe_remote_post(	
					'http://wpeacock.com/socialpost-server/fb-post.php', array(
					'method' => 'POST',
					'timeout' => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array( 'accessToken' => $accesstoken, 'link' => $post_lnk, 'msg' => $msg ),
					'cookies' => array()
					)
				);
				
				//var_dump($accesstoken);
				//exit;
			}
		}
		
		//------------------- code to send post on facebook pagess -----------------//
		$args = array(
			'post_type' => 'socialpost_fbp_cons'
		); 
		global $wpdb;
		 $querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE $wpdb->posts.post_type = 'socialpost_fbp_cons'
			AND $wpdb->posts.post_status = 'publish'
			AND $wpdb->posts.post_date < NOW()
			ORDER BY $wpdb->posts.post_date DESC
		 ";

		$pageposts = $wpdb->get_results($querystr, object);
		if ( $pageposts ) {
			foreach ($pageposts as $this_loop_post){
				$this_post_ID  = $this_loop_post->ID;
				$msg = $fb_val;
				$this_post_meta_data = get_post_meta($this_post_ID);
				$accesstoken = $this_post_meta_data['access_token'][0];
				$page_id = $this_post_meta_data['page_id'][0];
				$post_lnk = get_permalink($post->ID);

				$results = wp_safe_remote_post(	
					'http://wpeacock.com/socialpost-server/fb-post-pg.php', array(
					'method' => 'POST',
					'timeout' => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array( 'accessToken' => $accesstoken, 'link' => $post_lnk, 'msg' => $msg, 'page_id' => $page_id ),
					'cookies' => array()
					)
				);
				
				//var_dump($accesstoken);
				//exit;
			}
		}
	}
	
	//------------------- code to send post on facebook -----------------//
   $tw_check = array_key_exists('socialpost_twmbc', $_POST);
   if ($tw_check) {
	   $tw_val = sanitize_textarea_field($_POST['socialpost_twcm']);
	   $args = array(
			'post_type' => 'socialpost_tw_cons'
		); 
		global $wpdb;
		 $querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE $wpdb->posts.post_type = 'socialpost_tw_cons'
			AND $wpdb->posts.post_status = 'publish'
			AND $wpdb->posts.post_date < NOW()
			ORDER BY $wpdb->posts.post_date DESC
		 ";

		$pageposts = $wpdb->get_results($querystr, object);
		if ( $pageposts ) {
			foreach ($pageposts as $this_loop_post){
				$this_post_ID  = $this_loop_post->ID;
				$msg = $tw_val;
				$this_post_meta_data = get_post_meta($this_post_ID);
				$oauth_token = $this_post_meta_data['oauth_token'][0];
				$oauth_token_secret = $this_post_meta_data['oauth_token_secret'][0];
				$post_lnk = get_permalink($post->ID);

				$results = wp_safe_remote_post(	
					'http://wpeacock.com/socialpost-server/tw-post.php', array(
					'method' => 'POST',
					'timeout' => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array( 'oauth_token' => $oauth_token, 'oauth_token_secret' => $oauth_token_secret, 'link' => $post_lnk, 'msg' => $msg ),
					'cookies' => array()
					)
				);
				
				//var_dump($results);
				//exit;
			}
		}
	}
	
	//------------------- code to send post on facebook -----------------//
	$li_check = array_key_exists('socialpost_limbc', $_POST);
	if ($li_check) {
	   $li_val = sanitize_textarea_field($_POST['socialpost_licm']);
	   $args = array(
			'post_type' => 'socialpost_li_cons'
		); 
		global $wpdb;
		 $querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE $wpdb->posts.post_type = 'socialpost_li_cons'
			AND $wpdb->posts.post_status = 'publish'
			AND $wpdb->posts.post_date < NOW()
			ORDER BY $wpdb->posts.post_date DESC
		 ";

		$pageposts = $wpdb->get_results($querystr, object);
		if ( $pageposts ) {
			foreach ($pageposts as $this_loop_post){
				$this_post_ID  = $this_loop_post->ID;
				$msg = $li_val;
				$this_post_meta_data = get_post_meta($this_post_ID);
				$accesstoken = $this_post_meta_data['access_token'][0];
				$post_lnk = get_permalink($post->ID);

				$results = wp_safe_remote_post(	
					'http://wpeacock.com/socialpost-server/li-post.php', array(
					'method' => 'POST',
					'timeout' => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array( 'accessToken' => $accesstoken, 'link' => $post_lnk, 'msg' => $msg ),
					'cookies' => array()
					)
				);
				
				//var_dump($results);
				//exit;
			}
		}
		
		//------------------- code to send post on facebook pagess -----------------//
		$args = array(
			'post_type' => 'socialpost_lip_cons'
		); 
		global $wpdb;
		 $querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE $wpdb->posts.post_type = 'socialpost_lip_cons'
			AND $wpdb->posts.post_status = 'publish'
			AND $wpdb->posts.post_date < NOW()
			ORDER BY $wpdb->posts.post_date DESC
		 ";

		$pageposts = $wpdb->get_results($querystr, object);
		if ( $pageposts ) {
			foreach ($pageposts as $this_loop_post){
				$this_post_ID  = $this_loop_post->ID;
				$msg = $li_val;
				$this_post_meta_data = get_post_meta($this_post_ID);
				$accesstoken = $this_post_meta_data['access_token'][0];
				$page_id = $this_post_meta_data['page_id'][0];
				$post_lnk = get_permalink($post->ID);

				$results = wp_safe_remote_post(	
					'http://wpeacock.com/socialpost-server/li-post-pg.php', array(
					'method' => 'POST',
					'timeout' => 45,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array( 'accessToken' => $accesstoken, 'link' => $post_lnk, 'msg' => $msg, 'page_id' => $page_id ),
					'cookies' => array()
					)
				);
				
				//var_dump($results);
				//exit;
			}
		}
	}
	
}