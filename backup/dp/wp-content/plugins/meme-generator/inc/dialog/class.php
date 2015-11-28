<?php
if (!class_exists('memegenDialog')) {

	class memegenDialog {
    
        /**
         * Constructor
         */
        function __construct() {
            // Ajax request for all users
            add_action('wp_ajax_nopriv_ajax_memegen_dialog', array( $this, 'ajax_memegen_dialog' ));
            add_action('wp_ajax_nopriv_ajax_memegen_nonce', array( $this, 'ajax_memegen_nonce' ));
            // Ajax request for logged in users
            add_action('wp_ajax_ajax_memegen_dialog', array( $this, 'ajax_memegen_dialog' ));
            add_action('wp_ajax_ajax_memegen_nonce', array( $this, 'ajax_memegen_nonce' ));
        }
	
		public function ajax_memegen_dialog() {
			global $Meme_Generator_Data;
			global $Meme_Generator_Path;
			
			if (!wp_verify_nonce( $_REQUEST['memegen_dialog_nonce'], 'memegen_dialog')) {
				die(__('We\'re sorry, something went wrong with your request. Please contact support for further assistance.','memegen'));
			}
			
			?>
			<!DOCTYPE HTML>
			<html lang="en-US">
				<head>
					<title><?php _e('Meme Generator','memegen'); ?></title>
					<meta charset="UTF-8">
					<!-- StyleSheets -->
					<link href="<?php echo $Meme_Generator_Path . '/css/dialog.css' ?>" rel="stylesheet" type="text/css" />
					<link href="<?php echo $Meme_Generator_Path . '/css/display.css' ?>" rel="stylesheet" type="text/css" />
					<!-- JavaScript -->
					<script type="text/javascript" src="<?php echo $Meme_Generator_Path . '/js/libs/jquery-1.8.3.min.js' ?>"></script>
					<script type="text/javascript" src="<?php echo $Meme_Generator_Path . '/js/libs/tiny_mce_popup.js' ?>"></script>
					<script type="text/javascript">
						/* <![CDATA[ */
						var MemeGen = { ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>' };
						/* ]]> */
					</script>					
					<script type="text/javascript" src="<?php echo $Meme_Generator_Path . '/js/dialog.min.js' ?>"></script>
				</head>
				<body class="memegenWindow">
					<form id="memegen_Form">
						<p class="header-form">
							<label><?php _e('CREATE A MEME CHARACTER','memegen'); ?></label>
						</p>
						<div id="memegen_Options">
						<?php
							$html = '';
							$html .= $this->text_option('memegen_fileName',__('NAME YOUR MEME:','memegen'),'');
							/*
							$html .= $this->upload_option('memegen_imgUpload',__('UPLOAD AN IMAGE:','memegen'));
							*/
							$html .= $this->text_option('memegen_imgURL',__('ENTER AN IMAGE URL:','memegen'),'');
							$html .= $this->text_option('memegen_topText',__('TOP TEXT:','memegen'),'');
							$html .= $this->text_option('memegen_btmText',__('BOTTOM TEXT:','memegen'),'');
							$html .= $this->select_option('memegen_textSize',__('SIZE OF TEXT:','memegen'),range(0, 150),'35');
							$html .= $this->select_option('memegen_textStyle',__('STYLE OF TEXT:','memegen'),array('heavycapswhite' => __('Heavy White Capital text','memegen'),'heavywhite' => __('Heavy White text','memegen'),'capswhite' => __('White Capital text','memegen'),'white' => __('White text','memegen'),'heavycapsblack' => __('Heavy Black Capital text','memegen'),'heavyblack' => __('Heavy Black text','memegen'),'capsblack' => __('Black Capital text','memegen'),'black' => __('Black text','memegen')),'heavycapswhite');
                            if ( is_multisite() ) {
                                $html .= $this->hidden_option('memegen_dialogPreview',network_home_url('/'));
                            } else {
                                $html .= $this->hidden_option('memegen_dialogPreview',home_url('/'));
                            }
							$path = wp_upload_dir();
							$html .= $this->hidden_option('memegen_uploadPath',$path['url']);
							$html .= $this->start_footer();
							$html .= $this->button('memegen_cancelMeme','cancel',__('Cancel','memegen'),'#');
							$html .= $this->button('memegen_insertMeme','insert',__('Create Meme','memegen'),'#');
							$html .= $this->end_footer();
							echo $html;
						?>
						</div>
					</form>
					<form id="memegen_Preview">
						<div id="memegen_Live">
							
						</div>
					</form>
					<div style="clear:both;height:1px;">&nbsp;</div>
				</body>
			</html>
			<?php
			die();
		}
		
		public function start_footer() {				
			$html = '';
			$html .= '<p class="footer-form">';
			return $html;
		}
		
		public function end_footer() {				
			$html = '';
			$html .= '</p>';
			return $html;
		}
		
		public function button($id,$class,$label,$href) {			
			$html = '';
			$html .= '<button id="'.$id.'" class="'.$class.'" href="'.$href.'">'.$label.'</button>';
			return $html;
		}
		
		public function upload_option($id,$label) {
			$html = '';
			$html .= '<p class="content-form">';
			$html .= '<label for="'.$id.'">'.$label.'</label><br/>';
			$html .= '<input id="'.$id.'" class="upload" type="text" name="image" value="" size="45" />';
			$html .= '<input class="upload-button" type="button" name="wsl-image-add" value="'.esc_attr__('Upload Image','memegen').'" />';
			$html .= '</p>';
			return $html;
		}
		
		public function hidden_option($id,$value) {
			$html = '';
			$html .= '<input id="'.$id.'" type="hidden" value="'.$value.'" />';
			return $html;
		}
		
		public function text_option($id,$label,$value,$default=false) {
			//set optional default value
			if($default){
				$default = ' onfocus="if(this.value == this.defaultValue) { this.value = \'\'; }" onblur="if(this.value==\'\')this.value=this.defaultValue" ';
			} else {
				$default = ' ';
			}
			
			$html = '';
			$html .= '<p class="content-form">';
			$html .= '<label for="'.$id.'">'.$label.'</label><br/>';
			$html .= '<input id="'.$id.'" type="text"'.$default.'value="'.$value.'" size="45" />';
			$html .= '</p>';
			return $html;
		}
		
		public function select_option($id,$label,$options,$selected=false) {			
			$html = '';
			$html .= '<p class="content-form">';
			$html .= '<label for="'.$id.'">'.$label.'</label><br/>';
			$html .= '<select id="'.$id.'">';
			
			if (is_array($options)) {
				foreach ($options as $val=>$value) {
					$html .= '<option value="' . $val . '" ' . ($val == $selected ? 'selected="selected"':'') . '>' . $value . '</option>';
				}
			}
			
			$html .= '</select></p>';

			return $html;
		}
	
		public function ajax_memegen_nonce() {
			echo wp_create_nonce('memegen_dialog');
			die();
		}
		
	} // end class
	
    $memegen_dialog = new memegenDialog();
}
?>