<?php
if (!class_exists('memegenShortcode')) {
	class memegenShortcode {
    
        /**
         * Constructor
         */
        function __construct() {
        
            // Add the WordPress shortcode
            add_shortcode('meme_generator', array( $this, 'shortcode'));
            
        }
        
		public function shortcode($atts) {
			extract(shortcode_atts(array(
				'category' => '',
				'color' => '',
				'image' => '',
				'tag' => '',
				'title' => __('Meme Generator','memegen')
				), $atts));
			
			global $Meme_Generator_Path, $Meme_Generator_Data;
			
			static $x = 0;
			
			if($x == 0) {
				$title = $this->add_title('h2',$title);
				$preview = $this->add_image($Meme_Generator_Path.'img/preview.png',__('Create A Meme','memegen'));
				$size = $this->select_option('meme-text-size-0','meme-form-select',__('Text Size','memegen'),range(0, 150),'35');
				$style = $this->select_option('meme-text-style-0','meme-form-select',__('Text Style','memegen'),array('heavycapswhite' => __('Heavy White Capital text','memegen'),'heavywhite' => __('Heavy White text','memegen'),'capswhite' => __('White Capital text','memegen'),'white' => __('White text','memegen'),'heavycapsblack' => __('Heavy Black Capital text','memegen'),'heavyblack' => __('Heavy Black text','memegen'),'capsblack' => __('Black Capital text','memegen'),'black' => __('Black text','memegen')),'heavycapswhite'); 
				if (is_array($Meme_Generator_Data) && array_key_exists('submission_policy',$Meme_Generator_Data)) {
					$status = $Meme_Generator_Data['submission_policy'];
				} else {
					$status = 'pending';
				}
				if ($status == 'pending') {
					$success = '<p><strong>'.__('Good News','memegen').'</strong><br/>'.__('Your newly created meme is pending approval to be published on','memegen').' '.get_bloginfo('name').'.</p>';
				} else {
					$success = '<p><strong>'.__('Good News','memegen').'</strong><br/>'.__('Your meme has just been published on','memegen').' '.get_bloginfo('name').'.</p>';
				}
				$error = '<p><strong>'.__('Bad News','memegen').'</strong><br/>'.__('You forgot to fill out one or more of the required fields.','memegen').'</p>';
				
				if (is_array($Meme_Generator_Data) && array_key_exists('require_registration',$Meme_Generator_Data)) {
					$login = $Meme_Generator_Data['require_registration'];
				} else {
					$login = 'no';
				}
				if($login == 'no' || is_user_logged_in()) {
					$content = '';
					$content .= $this->text_option('meme-post-name-0','meme-form-input',__('Name Your Meme','memegen'),true);
					if($image == '') {
						$content .= $this->text_option('meme-image-url-0','meme-form-input',__('Enter An Image URL','memegen'),true);
					}
					$content .= $this->text_option('meme-top-text-0','meme-form-input',__('Top Text','memegen'),true);
					$content .= $this->text_option('meme-bottom-text-0','meme-form-input',__('Bottom Text','memegen'),true);
					$content .= $this->add_div('meme-select-float',$size,'float:left;');
					$content .= $this->add_div('meme-select-float',$style,'float:right;');
					$content .= $this->add_div(false,'&nbsp;','clear:both;height:1px;');
                    if ( is_multisite() ) {
                        $content .= $this->hidden_option('meme-home-url-0',network_home_url('/'));
                    } else {
                        $content .= $this->hidden_option('meme-home-url-0',home_url('/'));
                    }
					$content .= $this->hidden_option('meme-plugin-url-0',$Meme_Generator_Path);
					$content .= $this->hidden_option('meme-category-0',$category);
					$content .= $this->hidden_option('meme-tag-0',$tag);
					if($image) {
						$content .= $this->hidden_option('meme-image-url-0',$image);
					}
					$content .= $this->button_option('meme-submit-btn-0','meme-form-btn','button',__('Create Meme','memegen'));
					$content .= $this->add_div('meme-form-success',$success,'display:none;','meme-form-success-0');
					$content .= $this->add_div('meme-form-error',$error,'display:none;','meme-form-error-0');
				} else {
					$content = '';
					$content .= wp_login_form(array('echo' => false));
					$content .= $this->add_div('meme-form-error','<p>'.__('You must be logged in to create a meme.','memegen').'</p>','text-align:center;','meme-form-error-0');
                    if($image) {
                        $preview = '';
                        $preview .= '<div class="grayscale">';
                        $preview .= $this->add_image($image,$title);;
                        $preview .= '</div>';
                    }
				}
				
				$form = '';
				$form .= $this->add_div('meme-title',$title);
				$form .= $this->add_div('meme-live-preview',$preview,false,'meme-live-preview-0');
				$form .= $this->add_div('meme-content',$content,false,'meme-content-0');
			} else {
				$title = $this->add_title('h2',$title);
				$preview = $this->add_image($Meme_Generator_Path.'img/preview.png',__('Create A Meme','memegen'));
				$size = $this->select_option('meme-text-size-'.$x,'meme-form-select',__('Text Size','memegen'),range(0, 150),'35');
				$style = $this->select_option('meme-text-style-'.$x,'meme-form-select',__('Text Style','memegen'),array('heavycapswhite' => __('Heavy White Capital text','memegen'),'heavywhite' => __('Heavy White text','memegen'),'capswhite' => __('White Capital text','memegen'),'white' => __('White text','memegen'),'heavycapsblack' => __('Heavy Black Capital text','memegen'),'heavyblack' => __('Heavy Black text','memegen'),'capsblack' => __('Black Capital text','memegen'),'black' => __('Black text','memegen')),'heavycapswhite');
				if (is_array($Meme_Generator_Data) && array_key_exists('submission_policy',$Meme_Generator_Data)) {
					$status = $Meme_Generator_Data['submission_policy'];
				} else {
					$status = 'pending';
				}
				if ($status == 'pending') {
					$success = '<p><strong>'.__('Good News','memegen').'</strong><br/>'.__('Your newly created meme is pending approval to be published on','memegen').' '.get_bloginfo('name').'.</p>';
				} else {
					$success = '<p><strong>'.__('Good News','memegen').'</strong><br/>'.__('Your meme has just been published on','memegen').' '.get_bloginfo('name').'.</p>';
				}
				$error = '<p><strong>'.__('Bad News','memegen').'</strong><br/>'.__('You forgot to fill out one or more of the required fields.','memegen').'</p>';
				
				if (is_array($Meme_Generator_Data) && array_key_exists('require_registration',$Meme_Generator_Data)) {
					$login = $Meme_Generator_Data['require_registration'];
				} else {
					$login = 'no';
				}
				if($login == 'no' || is_user_logged_in()) {
					$content = '';
					$content .= $this->text_option('meme-post-name-'.$x,'meme-form-input',__('Name Your Meme','memegen'),true);
					if($image == '') {
						$content .= $this->text_option('meme-image-url-'.$x,'meme-form-input',__('Enter An Image URL','memegen'),true);
					}
					$content .= $this->text_option('meme-top-text-'.$x,'meme-form-input',__('Top Text','memegen'),true);
					$content .= $this->text_option('meme-bottom-text-'.$x,'meme-form-input',__('Bottom Text','memegen'),true);
					$content .= $this->add_div('meme-select-float',$size,'float:left;');
					$content .= $this->add_div('meme-select-float',$style,'float:right;');
					$content .= $this->add_div(false,'&nbsp;','clear:both;height:1px;');
                    if ( is_multisite() ) {
                        $content .= $this->hidden_option('meme-home-url-'.$x,network_home_url('/'));
                    } else {
                        $content .= $this->hidden_option('meme-home-url-'.$x,home_url('/'));
                    }
					$content .= $this->hidden_option('meme-plugin-url-'.$x,$Meme_Generator_Path);
					$content .= $this->hidden_option('meme-category-'.$x,$category);
					$content .= $this->hidden_option('meme-tag-'.$x,$tag);
					if($image) {
						$content .= $this->hidden_option('meme-image-url-'.$x,$image);
					}
					$content .= $this->button_option('meme-submit-btn-'.$x,'meme-form-btn','button',__('Create Meme','memegen'));
					$content .= $this->add_div('meme-form-success',$success,'display:none;','meme-form-success-'.$x);
					$content .= $this->add_div('meme-form-error',$error,'display:none;','meme-form-error-'.$x);
				} else {
					$content = '';
					$content .= wp_login_form(array('echo' => false));
					$content .= $this->add_div('meme-form-error','<p>'.__('You must be logged in to create a meme.','memegen').'</p>','text-align:center;','meme-form-error-'.$x);
                    if($image) {
                        $preview = '';
                        $preview .= '<div class="grayscale">';
                        $preview .= $this->add_image($image,$title);;
                        $preview .= '</div>';
                    }
				}
				
				$form = '';
				$form .= $this->add_div('meme-title',$title);
				$form .= $this->add_div('meme-live-preview',$preview,false,'meme-live-preview-'.$x);
				$form .= $this->add_div('meme-content',$content,false,'meme-content-'.$x);
			}
			
			$html = '';
			$html .= $this->add_div('meme-wrapper',$form);
			
			$x++;
			
			return $html;
		}
		
		private function text_option($id,$class,$label,$required=false) {
			if($required){$span = ' <span>'.__('(required)','memegen').'</span>';$required = 'required ';} else {$span = ' <span>'.__('(optional)','memegen').'</span>';$required = '';}
			
			$html = '';
			$html .= '<label for="'.$id.'">'.$label.''.$span.'</label>';
			$html .= '<input type="text" id="'.$id.'" class="'.$class.'" '.$required.'/>';
			return $html;
		}
		
		private function select_option($id,$class,$label,$options,$selected=false) {
			$html = '';
			$html .= '<label for="'.$id.'">'.$label.'</label>';
			$html .= '<select id="'.$id.'" class="'.$class.'">';
			if (is_array($options)) {
				foreach ($options as $value=>$option) {
					$html .= '<option value="'.$value.'"'.($value == $selected ? ' selected="selected"':'').'>'.$option.'</option>';
				}
			}
			$html .= '</select>';
			return $html;
		}
		
		private function hidden_option($id,$value) {
			$html = '';
			$html .= '<input type="hidden" id="'.$id.'" value="'.$value.'" />';
			return $html;
		}
		
		private function button_option($id,$class,$type,$content) {
			$html = '';
			$html .= '<button type="'.$type.'" id="'.$id.'" class="'.$class.'">'.$content.'</button>';
			return $html;
		}
		
		private function add_image($src,$alt) {
			$html = '';
			$html .= '<img src="'.$src.'" alt="'.$alt.'" />';
			return $html;
		}
		
		private function add_title($tag,$text) {
			$html = '';
			$html .= '<'.$tag.'>'.$text.'</'.$tag.'>';
			return $html;
		}
		
		private function add_div($class=false,$content,$style=false,$id=false) {
			if($id){$id = ' id="'.$id.'"';}
			if($class){$class = ' class="'.$class.'"';}
			if($style){$style = ' style="'.$style.'"';}
			
			$html = '';
			$html .= '<div'.$id.''.$class.''.$style.'>'.$content.'</div>';
			return $html;
		}
	} // end class

    $memegen_shortcode = new memegenShortcode();
}
?>