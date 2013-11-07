 <div class="hero-unit">
		<div class="container">
			<div class="carousel slide" id="myCarousel">
                <div class="carousel-inner">
                     <?php  
						
						
					$images = array ();
					$captions = array();
					
					
				$query = new WP_Query( array( 'post_type' => 'post') ); 
						
						$c=0;
					while($query->have_posts() ){
							$query->the_post();
							
							
								if(get_post_meta( get_the_ID(), '_meta_image', true ) != '' || get_post_meta( get_the_ID(), '_meta_caption', true ) != '')
								{
								
								$images[$c]=get_post_meta( get_the_ID(), '_meta_image', true );
								$captions[$c]=get_post_meta( get_the_ID(), '_meta_caption', true );
								$c++; 
								}
								 
						} 	
						
						 
					 
			if(count($images)!=0 || count($captions)!=0 ){  
		           
				                     $img_count=0;
			                   
										
												
										$img_cap=0;  
						 foreach ($images as $image)
						      {
								
							  if($img_count==0){$active='active';}else{$active=''; } ?>
					    <div class="item <?php echo $active;?>">
						 
                    <img alt="" src=" <?php echo $image;?>">
                    <div class="carousel-caption">
                      <h4><?php //the_title(); ?></h4>
                      <p> <?php  echo  $captions[$img_cap] ?></p>
                    </div>
                  </div>
				<?php  $img_count++; $img_cap++;}/*close forech*/ 
			
				?>		
			
<?php } else { ?>
 <!-- Slider -->
	
                  <div class="item active">
                    <img alt="" src=" <?php echo get_template_directory_uri();?>/images/banner1.png">
                    <div class="carousel-caption">
                      <h4>First Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/banner2.png">
                    <div class="carousel-caption">
                      <h4>Second Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                  <div class="item ">
                    <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/banner3.png">
                    <div class="carousel-caption">
                      <h4>Third Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
               
	<!-- /Slider -->
<?php } ?>
</div>
			  </div>
			  <a data-slide="prev" href="#myCarousel" class="left carousel-control"></a>
              <a data-slide="next" href="#myCarousel" class="right carousel-control"></a>
		</div>
	</div>			
