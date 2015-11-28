<?php
if (!class_exists('memegenPreview')) {

	class memegenPreview {
    
        /**
         * Constructor
         */
        function __construct() {
            // Hook up to the init action
            add_action( 'init', array( $this, 'init_preview' ) );
        }
        
        public function init_preview() {
            // Verify all calls to Preview class with nonce
            if (isset($_REQUEST['verify']) && wp_verify_nonce($_REQUEST['verify'], 'memegen_verify')) {
                // Calls to Preview class
                if (isset($_GET['run'],$_GET['picture'],$_GET['color'],$_GET['stroke'],$_GET['text0'],$_GET['text1'],$_GET['style'],$_GET['size']) && method_exists($this,$_GET['run'])) {
                    if (isset($_GET['insert'],$_GET['file'])) {
                        $this->$_GET['run']($_GET['picture'],$_GET['color'],$_GET['stroke'],$_GET['text0'],$_GET['text1'],$_GET['style'],$_GET['size'],$_GET['insert'],$_GET['file']);
                    } else {
                        $this->$_GET['run']($_GET['picture'],$_GET['color'],$_GET['stroke'],$_GET['text0'],$_GET['text1'],$_GET['style'],$_GET['size']);
                    }
                }
            }
        }

		public function meme_preview($picture,$color,$stroke,$text0,$text1,$style,$size,$insert=false,$file=false) {
			global $Meme_Generator_Data,$Meme_Generator_Path;
			
			if( !ini_get('safe_mode') ){ set_time_limit(0); }
			if ( !defined('__DIR__') ) define('__DIR__', dirname(__FILE__));

			if(isset($picture) && empty($picture)) {
				$picture = __DIR__ . '/error.gif';
				$img = imagecreatefromgif($picture);
			} else {
				$picture = 'http://' . $picture;
                $picture = esc_url($picture);
				if(filter_var($picture, FILTER_VALIDATE_URL)) {
					if( preg_match('/\.(jpg|jpeg)(?:[\?\#].*)?$/i', $picture) ) {
						$img = imagecreatefromjpeg($picture);
						$limit_size = true;
					} elseif ( preg_match('/\.(png)(?:[\?\#].*)?$/i', $picture) ) {
						$img = imagecreatefrompng($picture);
						$limit_size = true;
					} elseif ( preg_match('/\.(gif)(?:[\?\#].*)?$/i', $picture) ) {
						$img = imagecreatefromgif($picture);
						$limit_size = true;
					} else {
						$picture = __DIR__ . '/error.gif';
						$img = imagecreatefromgif($picture);
					}
				} else {
					exit('<div class="meme-form-error" style="background:#f2dede;border-radius:3px;color:#b94a48;display:block;font:14px Helvetica,Arial,sans-serif;line-height:26px;margin:0;padding:10px;text-align:left;"><p style="margin:10px 0;font:14px Helvetica,Arial,sans-serif;line-height:26px;"><strong style="background:url('.$Meme_Generator_Path.'img/x.png) no-repeat;font-size:16px;font-weight:bold;padding-left:29px;text-transform:capitalize;">'.__('Bad News','memegen').'</strong><br/>'.__('The IMAGE URL is not valid. Please enter a new IMAGE URL and try again.','memegen').'</p></div>');
				}
			}
			
			// Get the picture size
			list($width, $height) = getimagesize($picture);
			
			// Limit image size, if set
			if(isset($limit_size)) {
				// Get the aspect ratio
				$img_ratio = $width/$height;
				
				if (is_array($Meme_Generator_Data) && array_key_exists('max_width',$Meme_Generator_Data)) {
					$max_width = $Meme_Generator_Data['max_width'];
				} else {
					$max_width = 450;
				}

				if (is_array($Meme_Generator_Data) && array_key_exists('max_height',$Meme_Generator_Data)) {
					$max_height = $Meme_Generator_Data['max_height'];
				} else {
					$max_height = 450;
				}
				
				if($width > $height) {
					if($width > $max_width) {
						$new_width = $max_width;
						$new_height = $new_width/$img_ratio;
						
						$new_img = imagecreatetruecolor($new_width, $new_height);
						imagecopyresampled($new_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						
						$img = $new_img;
						$width = $new_width;
						$height = $new_height;
					}			
				} else {
					if($height > $max_height) {
						$new_height = $max_height;
						$new_width = $new_height*$img_ratio;
						
						$new_img = imagecreatetruecolor($new_width, $new_height);
						imagecopyresampled($new_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						
						$img = $new_img;
						$width = $new_width;
						$height = $new_height;
					}
				}
			}

			$font = __DIR__ . '/fonts/impact.ttf';
			$font_size = $size;
			$color = $this->convert_color($color);
			$font_color = imagecolorallocate($img, $color[0], $color[1], $color[2]);

			if ($stroke) {
				$stroke = $this->convert_color($stroke);
				$stroke_color = imagecolorallocate($img, $stroke[0], $stroke[1], $stroke[2]);
				if($font_size >= 100) {
					$stroke_size = 5;
				} else if($font_size >= 70) {
					$stroke_size = 4;
				} else if($font_size >= 35) {
					$stroke_size = 3;
				} else if($font_size >= 15) {
					$stroke_size = 2;
				} else if($font_size >= 0) {
					$stroke_size = 1;
				}
			}

			$start_y = $font_size+($font_size/2);
			
			if(isset($text0) && !empty($text0)) {
				if($style == 'ALLCAPS') {
					$top_text = strtoupper($text0);
				} else if($style == 'NORMAL') {
					$top_text = $text0;
				}
				$top_words = explode(" ", $top_text);
				$top_string = "";
				$top_temp = "";

				for($i = 0; $i < count($top_words); $i++) {
					$top_temp .= $top_words[$i]." ";
					
					$top_size = imagettfbbox($font_size, 0, $font, $top_temp);
					$top_length = $top_size[2]+$top_size[0];
					$start_x = ($width-$top_length)/2;
					
					if($top_size[4] < $width) {
						$top_string = $top_temp;
					} else {
						$i--;
						$top_temp = "";
						
						$top_size = imagettfbbox($font_size, 0, $font, $top_string);
						$top_length = $top_size[2]+$top_size[0];
						$start_x = ($width-$top_length)/2;
						
						if ($stroke) {
							$this->add_stroke($img, $font_size, 0, $start_x, $start_y, $font_color, $stroke_color, $font, $top_string, $stroke_size);
						} else {
							imagettftext($img, $font_size, 0, $start_x, $start_y, $font_color, $font, $top_string);
						}
						
						$top_string = "";
						$start_y += $font_size+($font_size/2);
					}
				}

				if ($stroke) {
					$this->add_stroke($img, $font_size, 0, $start_x, $start_y, $font_color, $stroke_color, $font, $top_string, $stroke_size);
				} else {
					imagettftext($img, $font_size, 0, $start_x, $start_y, $font_color, $font, $top_string);
				}		
			}
			
			if(isset($text1) && !empty($text1)) {
				if($style == 'ALLCAPS') {
					$bottom_text = strtoupper($text1);
				} else if($style == 'NORMAL') {
					$bottom_text = $text1;
				}
				$bottom_words = explode(" ", $bottom_text);
				$bottom_string = "";
				$bottom_temp = "";
				$row = 0;
				
				// Count the number of rows
				for($i = 0; $i < count($bottom_words); $i++) {
					$bottom_temp .= $bottom_words[$i]." ";			
					$bottom_size = imagettfbbox($font_size, 0, $font, $bottom_temp);				
					if($bottom_size[4] < $width) {
						$bottom_string = $bottom_temp;
					} else {
						$i--;
						$bottom_temp = "";					
						$bottom_size = imagettfbbox($font_size, 0, $font, $bottom_string);					
						$bottom_string = "";
						$row++;
					}
				}
				
				$bottom_string = "";
				$bottom_temp = "";
				
				for($i = 0; $i < count($bottom_words); $i++) {
					$bottom_temp .= $bottom_words[$i]." ";
					
					$bottom_size = imagettfbbox($font_size, 0, $font, $bottom_temp);
					$bottom_length = $bottom_size[2]+$bottom_size[0];
					$end_x = ($width-$bottom_length)/2;
					
					if($bottom_size[4] < $width) {
						$bottom_string = $bottom_temp;
						$end_y = $height-$font_size+($font_size/2);
					} else {
						$i--;
						$bottom_temp = "";
						
						$bottom_size = imagettfbbox($font_size, 0, $font, $bottom_string);
						$bottom_length = $bottom_size[2]+$bottom_size[0];
						$end_x = ($width-$bottom_length)/2;
						$end_y -= ($font_size+($font_size/2))*$row;
						
						if ($stroke) {
							$this->add_stroke($img, $font_size, 0, $end_x, $end_y, $font_color, $stroke_color, $font, $bottom_string, $stroke_size);
						} else {
							imagettftext($img, $font_size, 0, $end_x, $end_y, $font_color, $font, $bottom_string);
						}
						
						$bottom_string = "";
						$row--;
					}
				}

				if ($stroke) {
					$this->add_stroke($img, $font_size, 0, $end_x, $end_y, $font_color, $stroke_color, $font, $bottom_string, $stroke_size);
				} else {
					imagettftext($img, $font_size, 0, $end_x, $end_y, $font_color, $font, $bottom_string);
				}
			}
			
			// Only show watermark if image is saved.
			if($insert && $file) {
				if (is_array($Meme_Generator_Data) && array_key_exists('watermark_image',$Meme_Generator_Data) && $Meme_Generator_Data['watermark_image'] == 'yes') {
					// Add Watermark featuring Website Name
                    if ( is_multisite() ) {
                        $home_url = network_home_url();
                    } else {
                        $home_url = home_url();
                    }
					$search = array('http://','https://');
					$site_name = str_ireplace($search, '', $home_url);
					$watermark = imagecreatetruecolor($width, $height+15);
					$text_color = imagecolorallocate($watermark, 255, 255, 255);
					imagestring($watermark, 5, 5, $height, $site_name, $text_color);
					imagecopy($watermark, $img, 0, 0, 0, 0, $width, $height);
					$img = $watermark;
				}
			}
			
			// Reduce image to 256 colors
			$img = $this->color_palette($img,false,256);
			
            // set content type header
            header( "Content-type: image/png" );

			$dir = wp_upload_dir();

			if($insert && $file && $dir) {
				if (is_writable($dir['path'])) {
					// make sure file name is unique
					$filename = wp_unique_filename($dir['path'],$file.'.png');
					$save = $dir['path'].'/'.$filename;
					// save file
					imagepng($img,$save,9);
				} else {
					exit('<div class="meme-form-error" style="background:#f2dede;border-radius:3px;color:#b94a48;display:block;font:14px Helvetica,Arial,sans-serif;line-height:26px;margin:0;padding:10px;text-align:left;"><p style="margin:10px 0;font:14px Helvetica,Arial,sans-serif;line-height:26px;"><strong style="background:url('.$Meme_Generator_Path.'img/x.png) no-repeat;font-size:16px;font-weight:bold;padding-left:29px;text-transform:capitalize;">'.__('Bad News','memegen').'</strong><br/>'.__('WordPress is not properly configured on your server. The upload directory path '.$dir['path'].' is not writable. As a result, your Meme character was not saved. Please contact wpgoods.com for further assistance.','memegen').'</p></div>');
				}
			} else {
				imagepng($img,NULL,9);
			}

			imagedestroy($img);
			exit;
		}
		
		function color_palette($image, $dither, $ncolors) {
			$width = imagesx( $image );
			$height = imagesy( $image );
			$colors_handle = ImageCreateTrueColor( $width, $height );
			ImageCopyMerge( $colors_handle, $image, 0, 0, 0, 0, $width, $height, 100 );
			ImageTrueColorToPalette( $image, $dither, $ncolors );
			ImageColorMatch( $colors_handle, $image );
			ImageDestroy($colors_handle);
			return $image;
		}

		private function add_stroke(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {

			for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
				for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
					$bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
					
		   return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
		}

		private function convert_color($hexValue) {
			if(strlen(trim($hexValue))==6) {
				return array(
							 hexdec(substr($hexValue,0,2)), // R
							 hexdec(substr($hexValue,2,2)), // G
							 hexdec(substr($hexValue,4,2))  // B
							);
			}
			else return array(0, 0, 0);
		}
		
	} // end class

    $memegen_preview = new memegenPreview();
}
?>