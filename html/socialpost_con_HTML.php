<div class="wpeacock_container">
  <h1 class="socialpost_Headers1"><?php echo esc_html( 'SocialPost Connections' ); ?></h1>
  <br/>
  <div class="ui-tabs ui-corner-all ui-widget ui-widget-content">
    <div class="ui-tabs-panel ui-corner-bottom ui-widget-content">
      <h2 class="socialpost_Headers2"><?php echo esc_html( 'Social Media Accounts!' ); ?></h2>
      <p><?php echo esc_html( 'Here you can connect your social media accounts' ); ?></P>
      <table class="socialpost_tables">
        <tr>
          <th style="width: 66%;"><?php echo esc_html( 'Social Media' ); ?></th>
          <th><?php echo esc_html( 'Connection' ); ?></th>
        </tr>
        <tr>
          <td>
            <img src="<?php echo esc_url($socialPost_pluginUrl.'img/facebook.png'); ?>" class="socialpost_con_icon" />
			<h3 class="socialpost_con_title"><?php echo esc_html( 'Facebook Connections ( '.($fb_query->post_count + $fbp_query->post_count)); ?> ) </h3>
            <div class="socialpost_con_pros">
              <?php
                if ( $fb_query->have_posts() ) {
                	while ( $fb_query->have_posts() ) {
                		$fb_query->the_post();
                		$this_post_ID = get_the_ID();
                		$this_post_status = get_post_status();
                		$this_post_title = get_the_title();
                		
                		$this_post_meta = get_post_meta($this_post_ID);
                		$type = $this_post_meta['type'][0];
                ?>		
              <p> <span class="socialpost_con_name"> <?php echo esc_html( 'Profile:' ); ?> <b><?php echo $this_post_title; ?></b></span>  &nbsp; | &nbsp;  <span><?php echo esc_html( 'Enable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'en', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'publish') echo "checked='checked'"; ?> />
                </span> &nbsp; <span><?php echo esc_html( 'Disable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'ds', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'pending') echo "checked='checked'"; ?> /></span> &nbsp; <span><a href="#" onclick="socialpost_con_ch( this.checked, 'dl', '<?php echo $this_post_ID; ?>')" class="socialpost_del_link" ><?php echo esc_html( 'Delete' ); ?></a></span> 
              </p>
              <?php 
                } wp_reset_postdata(); }
                ?>
              <?php
                if ( $fbp_query->have_posts() ) {
                	while ( $fbp_query->have_posts() ) {
                		$fbp_query->the_post();
                		$this_post_ID = get_the_ID();
                		$this_post_title = get_the_title();
                		$this_post_status = get_post_status();
                		$this_post_meta = get_post_meta($this_post_ID);
                		$type = $this_post_meta['type'][0];
                ?>		
              <p> <span class="socialpost_con_name"> <?php echo esc_html( 'Profile:' ); ?> <b><?php echo $this_post_title; ?></b></span>  &nbsp; | &nbsp;  <span><?php echo esc_html( 'Enable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'en', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'publish') echo "checked='checked'"; ?> />
                </span> &nbsp; <span><?php echo esc_html( 'Disable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'ds', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'pending') echo "checked='checked'"; ?> /></span> &nbsp; <span><a href="#" onclick="socialpost_con_ch( this.checked, 'dl', '<?php echo $this_post_ID; ?>')" class="socialpost_del_link" ><?php echo esc_html( 'Delete' ); ?></a></span> 
              </p>
              <?php 
                } wp_reset_postdata(); }
                ?>	
            </div>
          </td>
          <td>
            <input name="socialpost_add_fb_pro" id="socialpost_add_fb_pro" class="button button-primary button-large" value="<?php echo esc_html( '+ Profile'); ?>" type="button" onclick="socialpost_fb_con('<?php echo urlencode(site_url()); ?>', '<?php echo urlencode('pro'); ?>');" >
            <input name="socialpost_add_fb_pg" id="socialpost_add_fb_pg" class="button button-primary button-large" value="<?php echo esc_html( '+ Page'); ?>" type="button" onclick="socialpost_fb_con('<?php echo urlencode(site_url()); ?>', '<?php echo urlencode('pg'); ?>');" >
          </td>
        </tr>
        <tr>
          <td>
            <img src="<?php echo esc_url($socialPost_pluginUrl.'img/twitter.png'); ?>" class="socialpost_con_icon" />
  
			<h3 class="socialpost_con_title"><?php echo esc_html( 'Twitter Connections ( '.$tw_query->post_count); ?> ) </h3>
            <div class="socialpost_con_pros">
              <?php
                if ( $tw_query->have_posts() ) {
                	while ( $tw_query->have_posts() ) {
                		$tw_query->the_post();
                		$this_post_ID = get_the_ID();
                		$this_post_title = get_the_title();
                		$this_post_status = get_post_status();
                		$this_post_meta = get_post_meta($this_post_ID);
                		$type = $this_post_meta['type'][0];
                ?>		
              <p> <span class="socialpost_con_name"> <?php echo esc_html( 'Profile:' ); ?> <b><?php echo $this_post_title; ?></b></span>  &nbsp; | &nbsp;  <span><?php echo esc_html( 'Enable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'en', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'publish') echo "checked='checked'"; ?> />
                </span> &nbsp; <span><?php echo esc_html( 'Disable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'ds', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'pending') echo "checked='checked'"; ?> /></span> &nbsp; <span><a href="#" onclick="socialpost_con_ch( this.checked, 'dl', '<?php echo $this_post_ID; ?>')" class="socialpost_del_link" ><?php echo esc_html( 'Delete' ); ?></a></span> 
              </p>
              <?php 
                } wp_reset_postdata(); }
                ?>		
            </div>
          </td>
          <td>
            <input name="socialpost_add_fb_pro" id="socialpost_add_fb_pro" class="button button-primary button-large" value="<?php echo esc_html( '+ Profile'); ?>" type="button" onclick="socialpost_tw_con('<?php echo urlencode(site_url()); ?>', '<?php echo urlencode('pro'); ?>');" >
          </td>
        </tr>
        <tr>
          <td>
            <img src="<?php echo esc_url($socialPost_pluginUrl.'img/linkedin.png'); ?>" class="socialpost_con_icon" />
            <h3 class="socialpost_con_title"><?php echo esc_html( 'LinkedIn Connections ( '.($li_query->post_count + $lip_query->post_count)); ?> ) </h3>
            <div class="socialpost_con_pros">
              <?php
                if ( $li_query->have_posts() ) {
                	while ( $li_query->have_posts() ) {
                		$li_query->the_post();
                		$this_post_ID = get_the_ID();
                		$this_post_title = get_the_title();
                		$this_post_status = get_post_status();
                		$this_post_meta = get_post_meta($this_post_ID);
                		$type = $this_post_meta['type'][0];
                ?>		
              <p> <span class="socialpost_con_name"> <?php echo esc_html( 'Profile:' ); ?> <b><?php echo $this_post_title; ?></b></span>  &nbsp; | &nbsp;  <span><?php echo esc_html( 'Enable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'en', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'publish') echo "checked='checked'"; ?> />
                </span> &nbsp; <span><?php echo esc_html( 'Disable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'ds', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'pending') echo "checked='checked'"; ?> /></span> &nbsp; <span><a href="#" onclick="socialpost_con_ch( this.checked, 'dl', '<?php echo $this_post_ID; ?>')" class="socialpost_del_link" ><?php echo esc_html( 'Delete' ); ?></a></span> 
              </p>
              <?php 
                } wp_reset_postdata(); }
                ?>
              <?php
                if ( $lip_query->have_posts() ) {
                	while ( $lip_query->have_posts() ) {
                		$lip_query->the_post();
                		$this_post_ID = get_the_ID();
                		$this_post_title = get_the_title();
                		$this_post_status = get_post_status();
                		$this_post_meta = get_post_meta($this_post_ID);
                		$type = $this_post_meta['type'][0];
                ?>		
              <p> <span class="socialpost_con_name"> <?php echo esc_html( 'Profile:' ); ?> <b><?php echo $this_post_title; ?></b></span>  &nbsp; | &nbsp;  <span><?php echo esc_html( 'Enable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'en', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'publish') echo "checked='checked'"; ?> />
                </span> &nbsp; <span><?php echo esc_html( 'Disable' ); ?> <input type="radio" name="con_status_<?php echo $this_post_ID; ?>" onchange="socialpost_con_ch( this.checked, 'ds', '<?php echo $this_post_ID; ?>')" <?php if($this_post_status == 'pending') echo "checked='checked'"; ?> /></span> &nbsp; <span><a href="#" onclick="socialpost_con_ch( this.checked, 'dl', '<?php echo $this_post_ID; ?>')" class="socialpost_del_link" ><?php echo esc_html( 'Delete' ); ?></a></span> 
              </p>
              <?php 
                } wp_reset_postdata(); }
                ?>		
            </div>
          </td>
          <td>
            <input name="socialpost_add_li_pro" id="socialpost_add_li_pro" class="button button-primary button-large" value="<?php echo esc_html( '+ Profile'); ?>" type="button" onclick="socialpost_li_con('<?php echo urlencode(site_url()); ?>', '<?php echo urlencode('pro'); ?>');" >
            <input name="socialpost_add_li_pg" id="socialpost_add_li_pg" class="button button-primary button-large" value="<?php echo esc_html( '+ Company Page'); ?>" type="button" onclick="socialpost_li_con('<?php echo urlencode(site_url()); ?>', '<?php echo urlencode('pg'); ?>');" >
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

