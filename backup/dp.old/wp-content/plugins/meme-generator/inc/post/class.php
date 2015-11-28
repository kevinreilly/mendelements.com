<?php
if (!class_exists('memegenPost')) {

	class memegenPost {
    
        /**
         * Constructor
         */
        function __construct() {           
            // Hook up to the init action
            add_action( 'init', array( $this, 'init_post' ) );          
        }
        
        public function init_post() {
            global $Meme_Generator_Data;
            
            // Notify user of published post
            if (is_array($Meme_Generator_Data) && array_key_exists('user_notification',$Meme_Generator_Data)) {
                $user_notify = $Meme_Generator_Data['user_notification'];
            } else {
                $user_notify = 'yes';
            }
                
            if ($user_notify == 'yes') {
                add_action('publish_post', array( $this, 'user_notify'));
            }
            
            // Verify all calls to Post class with nonce
            if (isset($_REQUEST['verify']) && wp_verify_nonce($_REQUEST['verify'], 'memegen_verify')) {
                // Calls to Post class
                if (isset($_GET['run'],$_GET['file'],$_GET['name']) && method_exists($this,$_GET['run'])) {
                    if (isset($_GET['category'],$_GET['tag'])) {
                        $this->$_GET['run']($_GET['file'],$_GET['name'],$_GET['category'],$_GET['tag']);
                    } else if(isset($_GET['category'])) {
                        $this->$_GET['run']($_GET['file'],$_GET['name'],$_GET['category']);
                    } else if(isset($_GET['tag'])) {
                        $this->$_GET['run']($_GET['file'],$_GET['name'],false,$_GET['tag']);
                    } else {
                        $this->$_GET['run']($_GET['file'],$_GET['name']);
                    }
                }
                if (isset($_GET['run'],$_GET['file'],$_GET['postid']) && method_exists($this,$_GET['run'])) {
                    $this->$_GET['run']($_GET['file'],$_GET['postid']);
                }
            }
        }
	
		public function meme_post($image,$title,$category=false,$tag=false) {
			global $Meme_Generator_Data;
			
			$title = wp_strip_all_tags($title);
			$path = wp_upload_dir();
			$src = $path['url'].'/'.$image.'.png';
            $home_url = get_home_url(null,'/');
			$content = '<a href="'.$src.'"><img src="'.$src.'" alt="'.$title.'"  title="'.$title.'" /></a><br/><a href="'.$home_url.'">'.get_bloginfo('name').'</a>';
			
			if (is_array($Meme_Generator_Data) && array_key_exists('submission_policy',$Meme_Generator_Data)) {
				$status = $Meme_Generator_Data['submission_policy'];
			} else {
				$status = 'pending';
			}
			
			if ( is_user_logged_in() ) {
				global $user_ID;
				$post_author = $user_ID;
			} else {
				$user_info = get_user_by('email', get_bloginfo('admin_email'));
				$post_author = $user_info->ID;
			}
			
			// Create post object
			$post = array(
			  'post_title' => $title,
			  'post_content' => $content,
			  'post_status' => $status,
			  'post_author' => $post_author,
			  'post_type' => 'post'
			);

			// Insert the post into the database
			$post_id = wp_insert_post($post);
			
			// Add custom field to the post
			add_post_meta($post_id, '_memegen', $status);
			
			// Insert attachment into media library
			$image_data = file_get_contents($src);
			$filename = $path['path'].'/'.$image.'.png';
			file_put_contents($filename, $image_data);
			$filetype = 'image/png';

			$attachment = array(
				'guid' => $src,
				'post_mime_type' => $filetype,
				'post_title' => $image,
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
			
			if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once( ABSPATH . 'wp-admin/includes/image.php' );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
			
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
			set_post_thumbnail( $post_id, $attach_id );

			// Set terms for the post
			if($category) {
				$taxonomy = 'category';
				
				if (preg_match('/,/', $category)) {
					$cats = explode(',', $category);
					$count = 0;
					foreach($cats as $term) {
						if (term_exists($term, $taxonomy)) {
							if ($count == 0) {
								wp_set_object_terms( $post_id, $term, $taxonomy );
							} else {
								wp_set_object_terms( $post_id, $term, $taxonomy, true );
							}
							$count++;
						}
					}
				} else {
					if (term_exists($category, $taxonomy)) {
						wp_set_object_terms( $post_id, $category, $taxonomy );
					}
				}
			}

			if($tag) {
				$taxonomy = 'post_tag';
				
				if (preg_match('/,/', $tag)) { 
					$tags = explode(',', $tag);
					foreach($tags as $term) {
						if (term_exists($term, $taxonomy)) {
							wp_set_post_terms( $post_id, $term, $taxonomy, true );
						}
					}
				} else {
					if (term_exists($tag, $taxonomy)) {
						wp_set_post_terms( $post_id, $tag, $taxonomy, true );
					}
				}
			}
						
			// Send admin notification, if option enabled
			if (is_array($Meme_Generator_Data) && array_key_exists('admin_notification',$Meme_Generator_Data)) {
				$notify = $Meme_Generator_Data['admin_notification'];
			} else {
				$notify = 'yes';
			}
			
			if ($notify == 'yes') {
				$email = get_bloginfo('admin_email');
				$site_title = get_bloginfo( 'name' );
				$subject = '['.$site_title.'] '.__('Meme:','memegen').' "'.html_entity_decode($title).'"';
				
				if ($status == 'pending') {
					$message = '<p>'.__('Hi,','memegen').'</p><p>'.__('A new meme has been submitted for approval.','memegen').'</p><p>'.__('You can check it out here:','memegen').'</p><p><a href="'.get_permalink($post_id).'">'.get_permalink($post_id).'</a></p>';
				} else {
					$message = '<p>'.__('Hi,','memegen').'</p><p>'.__('A new meme has been published on','memegen').' '.$site_title.'.</p><p>'.__('You can check it out here:','memegen').'</p><p><a href="'.get_permalink($post_id).'">'.get_permalink($post_id).'</a></p>';
				}
				
				add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
				
				wp_mail($email, $subject, $message);
			}

			// Redirect to post, if published immediatley
			if($status == 'publish'){
				echo post_permalink($post_id);
				exit;
			} else {
				header('HTTP/1.0 200 OK');
				header('Content-Length: 0',true);
				header('Content-Type: text/html',true);
				exit;
			}
		}
		
		public function meme_insert($image,$post_id) {
			$path = wp_upload_dir();
			$src = $path['url'].'/'.$image.'.png';
		
			// Insert attachment into media library
			$image_data = file_get_contents($src);
			$filename = $path['path'].'/'.$image.'.png';
			file_put_contents($filename, $image_data);
			$filetype = 'image/png';

			$attachment = array(
				'guid' => $src,
				'post_mime_type' => $filetype,
				'post_title' => $image,
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
			
			if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once( ABSPATH . 'wp-admin/includes/image.php' );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
			
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
			set_post_thumbnail( $post_id, $attach_id );
			
			header('HTTP/1.0 200 OK');
			header('Content-Length: 0',true);
			header('Content-Type: text/html',true);
			flush();
		}
		
		public function user_notify($post_id) {
			$post = get_post($post_id);
			$author = get_userdata($post->post_author);
			$post_meta = get_post_meta($post_id, '_memegen', true);
			
			if($post_meta == 'pending') {
				$email = $author->user_email;
				$site_title = get_bloginfo( 'name' );
				$subject = '['.$site_title.'] '.__('Meme:','memegen').' "'.html_entity_decode($post->post_title).'"';

				$message = '<p>'.__('Hi ','memegen'). $author->display_name .__(',','memegen').'</p><p>'.__('Your meme, "','memegen'). $post->post_title .__('"','memegen').'<br/>'.__('has just been published on','memegen').' '.$site_title.'.</p><p>'.__('You can check it out here:','memegen').'</p><p><a href="'.get_permalink($post_id).'">'.get_permalink($post_id).'</a></p><p>Remember to share this with your friends!</p>';
					
				add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
					
				wp_mail($email, $subject, $message);
				
				update_post_meta($post_id, '_memegen', 'publish');
			}
		}
	} // end class
    
    $memegen_post = new memegenPost();
}
?>