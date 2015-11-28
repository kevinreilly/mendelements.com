<?php
  /**
   * configure your admin page
   */
  $config = array(    
    'menu'=> array('top' => 'memegen'),             //sub page to settings page
    'page_title' => 'Meme Generator',       //The name of this page 
    'capability' => 'edit_themes',         // The capability needed to view the page 
    'option_group' => 'memegen_options',       //the name of the option to create in the database
    'id' => 'memegen',            // meta box id, unique per page
    'fields' => array(),            // list of fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );

  /**
   * Initiate your admin page
   */
  $memegen_admin = new memegenAdmin($config);
  $memegen_admin->OpenTabs_container('');
  $memegen_admin->SelfPath = plugins_url( 'admin', plugin_basename( dirname( __FILE__ ) ) );
  
  /**
   * define your admin page tabs listing
   */
  $memegen_admin->TabsListing(array(
    'links' => array(
    'options_1' =>  __('Getting Started', 'memegen'),
    'options_2' =>  __('General Settings', 'memegen')
    )
  ));
  
  /**
   * Open admin page 1st tab
   */
  $memegen_admin->OpenTab('options_1');
  $memegen_admin->Title(__('Getting Started','memegen'));
  $memegen_admin->addParagraph(__('When you\'re working with new software, we understand that getting started is often the hardest part. That\'s why we\'ve provided an overview of Meme Generator to help you do just that. If you have any additional questions, please feel free to contact wpgoods.com for support. Thank you!','memegen')."<br /><img class='memegen-img-guide' src='" . $memegen_admin->SelfPath . "/images/memegen_guide.png' alt='" . esc_attr__('Meme Generator - Getting Started Guide', 'memegen') . "' />");
  $memegen_admin->CloseTab();

  /**
   * Open admin page 2nd tab
   */
  $memegen_admin->OpenTab('options_2');
  $memegen_admin->Title(__('General Settings','memegen'));
  $memegen_admin->addRadio('submission_policy',array('pending'=>__('Wait for Approval','memegen'),'publish'=>__('Publish Immediately','memegen')),array('name'=> __('Submission Policy','memegen'), 'std'=> array('pending')));
  $memegen_admin->addParagraph(__('Would you like to publish user submissions immediately or wait for an administrator\'s approval?','memegen'));
  $memegen_admin->addRadio('require_registration',array('yes'=>__('Yes','memegen'),'no'=>__('No','memegen')),array('name'=> __('Require Registration','memegen'), 'std'=> array('no')));
  $memegen_admin->addParagraph(__('Do you want to require users to register and login before they can submit a meme?','memegen'));
  $memegen_admin->addRadio('admin_notification',array('yes'=>__('Yes','memegen'),'no'=>__('No','memegen')),array('name'=> __('Admin Notification','memegen'), 'std'=> array('yes')));
  $memegen_admin->addParagraph(__('Would you like an email whenever a user submission is held for moderation or published immediately?','memegen'));
  $memegen_admin->addRadio('user_notification',array('yes'=>__('Yes','memegen'),'no'=>__('No','memegen')),array('name'=> __('User Notification','memegen'), 'std'=> array('yes')));
  $memegen_admin->addParagraph(__('Do you want to send emails to users when their submissions are published?','memegen'));
  $memegen_admin->addRadio('watermark_image',array('yes'=>__('Yes','memegen'),'no'=>__('No','memegen')),array('name'=> __('Watermark Image','memegen'), 'std'=> array('yes')));
  $memegen_admin->addParagraph(__('Is it okay for a watermark image to appear at the bottom of each meme generated?','memegen'));
  $memegen_admin->addText('max_width',array('name'=> __('Max Image Width','memegen'), 'std'=> '500', 'desc'=> __('Enter the maximum width in pixels that are allowed for an image without being automatically resized.','memegen')));
  $memegen_admin->addText('max_height',array('name'=> __('Max Image Height','memegen'), 'std'=> '500', 'desc'=> __('Enter the maximum height in pixels that are allowed for an image without being automatically resized.','memegen')));
  $memegen_admin->CloseTab();

  //Help tab
  $memegen_admin->HelpTab(array(
    'id'=>'tab_id',
    'title'=>__('Customer Support','memegen'),
    'content'=>'<p>'.__('Thank you for purchasing Meme Generator. I really hope you\'re enjoying the product. Customer support is a top priority for WP Goods. Your enquiries will receive a personal response within 48 hours (2 working days).','memegen').'</p><p>'.__('If you need help for any reason, please feel free to contact support through the WP Goods Ticksy support system. Just sign in with your Facebook or Twitter account (or register manually) and give us a shout at','memegen').' <a href="http://wpgoods.ticksy.com">http://wpgoods.ticksy.com</a>. '.__('Once again, thank you!','memegen').'</p>'
  ));
?>