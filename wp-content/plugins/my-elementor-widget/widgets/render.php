<?php

 
	
	$mywe_values = $this->get_settings_for_display();
	$testimonial_array = $mywe_values['testimonials'];
	
	if( $mywe_values['layout'] == 'carousel' ) :

		$layout_wrap = "carousel_wrap";
		$this->slider_settings();
		elseif( $mywe_values['layout'] == 'slideshow' ) :

			$layout_wrap = "slideshow_wrap";
			$this->slider_settings();
		else:
			$layout_wrap = "grid_wrap";
		endif;	
     
    ?>

			<div class="gtco-testimonials">
				<h2>Testimonials Carousel - Cards Comments</h2>
	
                
					<div id="testimonial_carousel" class="test-carousel  <?php echo esc_attr( $layout_wrap ); ?>">
						<div class="swiper-wrapper">
						<?php  foreach ($testimonial_array as $testimonial_element) : 
							$author_img = $testimonial_element['image']['url']
							?>

							<div class="card text-center swiper-slide">
                                <img  class="img" src="<?php echo $author_img;?>"/>
								<div class="card-body">
								<h5 class="card-name"><?php echo $testimonial_element['name']?> <br />
								
									<span class="card-position"><?php echo $testimonial_element['position'] ?></span>
						
								</h5>
								<p class="card-text"><?php echo $testimonial_element['content']?> </p>
									
                                </div>
							</div>

				<?php endforeach;  ?>
				
						</div>
						<?php if(( $mywe_values['layout'] == 'carousel' )||( $mywe_values['layout'] == 'slideshow' )) :?>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
      					<div class="swiper-button-prev"></div>
						  <?php endif;?>
			</div>
	</div>
						</div>
						  
    

                                       

                    



                                      				

