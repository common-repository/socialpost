<?php

add_action( 'wp_ajax_socialpost_con_status', 'socialpost_con_status' );
function socialpost_con_status(){
	
	$post_id = intval( $_POST['post_id'] );
	if ( ! $post_id ) {
	  echo "0";
	}
	
	$post_id = sanitize_text_field( $post_id );
	$en_ds_check = sanitize_text_field( $_POST['en_ds_check'] );
	$post_insert_arr = array(
					'ID'=>$post_id
					);
	if($en_ds_check == 'en'){
		$post_insert_arr['post_status'] = 'publish';
	}elseif($en_ds_check == 'ds'){
		$post_insert_arr['post_status'] = 'pending';
	}elseif($en_ds_check == 'dl'){
		$post_insert_arr['post_status'] = 'trash';
	}
	$check_return = wp_update_post( $post_insert_arr );
	//var_dump($check_return);
}	

function socialpost_con(){
	global $socialPost_pluginUrl;
	
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
	
	//including the html content
	include('html/socialpost_con_HTML.php');
}

function socialpost_con_save(){
	//only for facebook ////////////////////////////------------------------------
	$social_type = sanitize_text_field($_GET['social_type']);
	if($social_type == 'fb'){
		$post_title = sanitize_text_field($_GET['username']);
		$accessToken = sanitize_text_field($_GET['accessToken']);
		$userid = sanitize_text_field($_GET['userid']);
		$email = sanitize_email($_GET['email']);	
		$type = 'facebook_profile';
		
		$args = array(
            'post_type' => 'socialpost_fb_cons',
            'meta_query' => array(
            'relation' => 'AND',
                array(
                    'key' => 'user_id',
                    'value' => $userid,
                    'compare' => '='
                )
			)
		);  
		$query = new WP_Query( $args );
		
		//prepare data for update or insert
		$post_insert_meta = array(
								'access_token'=>$accessToken, 
								'user_id'=>$userid,
								'type'=>$type,
								'email'=>$email
								);
		$post_insert_arr = array(
							'post_title'=>$post_title, 
							'post_type'=>'socialpost_fb_cons',
							'post_status' => 'publish',
							'meta_input'=>$post_insert_meta
							);
		if($query->have_posts()){
			$post_id = $query->post->ID;
			$post_insert_arr['ID'] = $post_id;
			$post_id = wp_update_post( $post_insert_arr );
			echo "<script> window.close(); </script>"; 
		}else{
			
			$post_id = wp_insert_post($post_insert_arr);
			echo "<script> window.close(); </script>"; 
		}
		//var_dump($post_id);
	}
	
	//to save facebook pages
	if($social_type == 'fbp'){
		$page_data = sanitize_text_field($_GET['page_data']);
		$post_title = explode('*', $page_data)[0];
		$page_id = explode('*', $page_data)[1];
		$userid = sanitize_text_field($_GET['userid']);
		$email = sanitize_email($_GET['email']);	
		$page_token = explode('*', $page_data)[2];
		$type = 'facebook_page';
		
		$args = array(
            'post_type' => 'socialpost_fbp_cons',
            'meta_query' => array(
            'relation' => 'AND',
                array(
                    'key' => 'page_id',
                    'value' => $page_id,
                    'compare' => '='
                )
			)
		);  
		$query = new WP_Query( $args );
		
		//prepare data for update or insert
		$post_insert_meta = array(
								'access_token'=>$page_token,
								'page_id'=>$page_id,
								'user_id'=>$userid,
								'type'=>$type,
								'email'=>$email
								);
		$post_insert_arr = array(
							'post_title'=>$post_title, 
							'post_type'=>'socialpost_fbp_cons',
							'post_status' => 'publish',
							'meta_input'=>$post_insert_meta
							);
		if($query->have_posts()){
			$post_id = $query->post->ID;
			$post_insert_arr['ID'] = $post_id;
			$post_id = wp_update_post( $post_insert_arr );
			echo "<script> window.close(); </script>"; 
		}else{
			
			$post_id = wp_insert_post($post_insert_arr);
			echo "<script> window.close(); </script>"; 
		}
		//var_dump($post_id);
	}
	
	
	//only for twitter ////////////////////////////------------------------------
	if($social_type == 'tw'){
		$post_title = sanitize_text_field($_GET['screen_name']);
		$oauth_token = sanitize_text_field($_GET['oauth_token']);
		$oauth_token_secret = sanitize_text_field($_GET['oauth_token_secret']);
		
		$user_id = sanitize_text_field($_GET['user_id']);
		$type = 'twitter_profile';
		
		$args = array(
            'post_type' => 'socialpost_tw_cons',
            'meta_query' => array(
            'relation' => 'AND',
                array(
                    'key' => 'user_id',
                    'value' => $user_id,
                    'compare' => '='
                )
			)
		);  
		$query = new WP_Query( $args );
		
		//prepare data for update or insert
		$post_insert_meta = array(
								'oauth_token'=>$oauth_token, 
								'oauth_token_secret'=>$oauth_token_secret, 
								'user_id'=>$user_id,
								'type'=>$type
								);
		$post_insert_arr = array(
							'post_title'=>$post_title, 
							'post_type'=>'socialpost_tw_cons',
							'post_status' => 'publish',
							'meta_input'=>$post_insert_meta
							);
		if($query->have_posts()){
			$post_id = $query->post->ID;
			$post_insert_arr['ID'] = $post_id;
			$post_id = wp_update_post( $post_insert_arr );
			echo "<script> window.close(); </script>"; 
		}else{
			
			$post_id = wp_insert_post($post_insert_arr);
			echo "<script> window.close(); </script>"; 
		}
		//var_dump($post_id);
	}
	
	
	//only for linkedin ////////////////////////////------------------------------
	if($social_type == 'li'){
		$post_title = sanitize_text_field($_GET['name']);
		$access_token = sanitize_text_field($_GET['access_token']);
		$userid = sanitize_text_field($_GET['userid']);
		$email = sanitize_email($_GET['email']);
		$type = 'linkedin_profile';
		
		$args = array(
            'post_type' => 'socialpost_li_cons',
            'meta_query' => array(
            'relation' => 'AND',
                array(
                    'key' => 'user_id',
                    'value' => $userid,
                    'compare' => '='
                )
			)
		);  
		$query = new WP_Query( $args );
		
		//prepare data for update or insert
		$post_insert_meta = array(
								'access_token'=>$access_token, 
								'user_id'=>$userid,
								'type'=>$type,
								'email'=>$email
								);
		$post_insert_arr = array(
							'post_title'=>$post_title, 
							'post_type'=>'socialpost_li_cons',
							'post_status' => 'publish',
							'meta_input'=>$post_insert_meta
							);
							var_dump($post_title);
		if($query->have_posts()){
			$post_id = $query->post->ID;
			$post_insert_arr['ID'] = $post_id;
			$post_id = wp_update_post( $post_insert_arr );
			echo "<script> window.close(); </script>"; 
		}else{
			
			$post_id = wp_insert_post($post_insert_arr);
			echo "<script> window.close(); </script>"; 
		} 
		//var_dump($post_id);
	}
	
	if($social_type == 'lip'){
		$post_title = sanitize_text_field($_GET['page_name']);
		$access_token = sanitize_text_field($_GET['access_token']);
		$userid = sanitize_text_field($_GET['userid']);
		$page_id = sanitize_text_field($_GET['page_id']);
		$email = sanitize_email($_GET['email']);
		$type = 'linkedin_page';
		
		$args = array(
            'post_type' => 'socialpost_lip_cons',
            'meta_query' => array(
            'relation' => 'AND',
                array(
                    'key' => 'page_id',
                    'value' => $page_id,
                    'compare' => '='
                )
			)
		);  
		$query = new WP_Query( $args );
		
		//prepare data for update or insert
		$post_insert_meta = array(
								'access_token'=>$access_token, 
								'page_id'=>$page_id,
								'user_id'=>$userid,
								'type'=>$type,
								'email'=>$email
								);
		$post_insert_arr = array(
							'post_title'=>$post_title, 
							'post_type'=>'socialpost_lip_cons',
							'post_status' => 'publish',
							'meta_input'=>$post_insert_meta
							);
							var_dump($post_title);
		if($query->have_posts()){
			$post_id = $query->post->ID;
			$post_insert_arr['ID'] = $post_id;
			$post_id = wp_update_post( $post_insert_arr );
			echo "<script> window.close(); </script>"; 
		}else{
			
			$post_id = wp_insert_post($post_insert_arr);
			echo "<script> window.close(); </script>"; 
		} 
		//var_dump($post_id);
	}
	
}

