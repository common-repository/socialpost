<div class="wpeacock_container">
  <h1 class="socialpost_Headers1"><?php echo esc_html( 'SocialPost Log Data!' ); ?></h1>
  <br/>
  <br/>
  <div   class="ui-tabs ui-corner-all ui-widget ui-widget-content">
    <div style="padding:4px 4px;" class="ui-widget-header"><?php echo esc_html( 'Your Recent Posts on Social Media' ); ?></div>
    <div class="ui-tabs-panel ui-corner-bottom ui-widget-content">
      <?php
        global $wpdb;
        	$sw_args = array(
            'post_type' => array( 'post', 'page', 'product' ),
            'meta_query' => array(
                array(
                    'key' => 'socialpost_pstring',
        			'value'   => 0,
                    'compare' => '!='
                )
            ),
        	'posts_per_page' => 10
        	);
        $query = new WP_Query( $sw_args );
        		if( $query->have_posts() ) {
        ?>
      <table class="socialpost_tables">
        <tr>
          <th style="width:50%;"><?php echo esc_html( 'Title' ); ?></th>
          <th><?php echo esc_html( 'Type' ); ?></th>
          <th><?php echo esc_html( 'Posted on' ); ?></th>
        </tr>
        <?php
          while ( $query->have_posts() ){
          	$query->the_post();
          	$this_post_ID = get_the_ID();
          	$this_post_meta = get_post_meta($this_post_ID);
          	$socialpost_pstring = $this_post_meta['socialpost_pstring'][0];
          ?>
        <tr>
          <td><?php echo esc_html(get_the_title()); ?></td>
          <td><?php echo esc_html(get_post_type()); ?></td>
          <td><?php 
            if (strpos($socialpost_pstring, 'fb') !== false) {
              echo "<img src='".esc_url($socialPost_pluginUrl.'img/facebook.png')."' class='socialpost_con_icons' />";
            }
            if (strpos($socialpost_pstring, 'tw') !== false) {
              echo "<img src='".esc_url($socialPost_pluginUrl.'img/twitter.png')."' class='socialpost_con_icons' />";
            }
            if (strpos($socialpost_pstring, 'li') !== false) {
              echo "<img src='".esc_url($socialPost_pluginUrl.'img/linkedin.png')."' class='socialpost_con_icons' />";
            }
            
            ?></td>
        </tr>
        <?php
          }
          wp_reset_postdata();
          ?>
      </table>
      <?php
        }
        ?>
    </div>
  </div>
</div>

