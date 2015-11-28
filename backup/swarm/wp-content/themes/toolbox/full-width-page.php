<?php
/**
 * Template Name: Full-width, no sidebar
 * Description: A full-width template with no sidebar
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

		<div id="primary" class="full-width">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php /* get_template_part( 'content', 'page');*/ ?>
                	<div class="excerpt">
                		<?php  the_excerpt(); ?>
                    </div>
                    
                	<div class="contents">
                		<?php the_content(); ?>
                    </div>
                    
                	<div class="squares">
                    	<?php
						$pages = array(
						'post_type' => 'page',
						'meta_key' => 'square',
						'order' => 'asc'
						);
						$queryObject = new WP_Query($pages);
						?>
						<?php if ( $queryObject->have_posts() )
							$last=3;
							$count=1;
							$color=array("f96c6c","6cbff9","f9b86c","6c6cf9","f96c6c","6cbff9");
							$i=0;
							
						while (
						$queryObject->have_posts() ) :
						$queryObject->the_post();
						?>
                        <?php 
							$no_margin='';
							$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
							if($count==$last){
								$no_margin=' margin-right:0px;';
								$count=0;
							}
						?>
                        
							<div style="background-image:url(<?php echo $thumb_url; ?>);<?php echo $no_margin; ?>" class="square">
                        		<div class="cover" style="background:#<?php echo $color[$i]; ?>;">
                            		<div class="text">
                            			<a href="<?php echo $permalink = get_permalink( $post->ID ); ?>"><span><?php the_title(); ?></span></a>
                                	</div>
                            	</div>
                        	</div> 
                        <?php 
							$count++; $i++; 
						?>
						<?php endwhile; ?>
                    </div>
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>