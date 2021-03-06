<?php 
	global $post;
	$postid = get_the_ID();
	$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	
	if(! empty( $featured_image_url )){
		if(!empty($layout) && $layout=='grid'){
			$featured_image=get_the_post_thumbnail_url(get_the_ID(),'tp-image-grid');
			$featured_image='<img src="'.esc_url($featured_image).'" alt="'.esc_attr(get_the_title()).'">';
			
		}else if(!empty($layout) && $layout=='masonry'){
			$featured_image=get_the_post_thumbnail_url(get_the_ID(),'full');
			$featured_image='<img src="'.esc_url($featured_image).'" alt="'.esc_attr(get_the_title()).'">';
			
		}else{			
			$featured_image=get_the_post_thumbnail_url(get_the_ID(),'full');
			$featured_image='<img src="'.esc_url($featured_image).'" alt="'.esc_attr(get_the_title()).'">';		
			
		}
	}else{
		$featured_image=l_theplus_get_thumb_url();
		$featured_image=$featured_image='<img src="'.esc_url($featured_image).'" alt="'.esc_attr(get_the_title()).'">';
	}
	
?>
	<div class="team-profile">
	<span class="thumb-wrap">
		<?php echo $featured_image; ?>
	</span>
	</div>