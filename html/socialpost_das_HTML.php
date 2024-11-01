<div class="wpeacock_container">
  <h1 class="socialpost_Headers1"><?php echo esc_html( 'SocialPost Dashboard' ); ?></h1>
  <br/>
  <div class="ui-tabs ui-corner-all ui-widget ui-widget-content">
    <div class="ui-tabs-panel ui-corner-bottom ui-widget-content">
      <h2 class="socialpost_Headers2"><?php echo esc_html( 'Welcome to SocialPost!' ); ?></h2>
      <?php echo esc_html( 'Here you can automatically post your posts, pages, products on social media in two steps.' ); ?>
      <!-- Accordion -->
      <h3 class="socialpost_Headers3"><?php echo esc_html( 'Follow the steps' ); ?></h3>
      <div id="socialpost_tabs1">
        <ul>
          <li><a href="#tabs-1"><?php echo esc_html( 'First' ); ?></a></li>
          <li><a href="#tabs-2"><?php echo esc_html( 'Second' ); ?></a></li>
        </ul>
        <div id="tabs-1"><?php echo esc_html( "Go to "); ?>  <b> <?php echo esc_html("SocialPost"); ?> >> <?php echo esc_html("Connections"); ?> </b> <?php echo esc_html("and connect your social media accounts using your logns." ); ?> 
          <br/><br/>
          <a href="<?php echo admin_url('admin.php?page=socialpost_con'); ?>"><button class="button button-primary button-hero load-customize" ><?php echo esc_html( "Get Started" ); ?></button></a>
          <br/>
        </div>
        <div id="tabs-2"><?php echo esc_html( "Go to Posts, Pages, Products and publish your content on social medis." ); ?>
          <br/><br/>
          <button class="button button-primary button-hero load-customize" ><?php echo esc_html( "Get Started" ); ?></button>
          <br/>
        </div>
      </div>
    </div>
  </div>
</div>

