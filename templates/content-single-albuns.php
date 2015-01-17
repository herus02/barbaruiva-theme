<?php while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?>>
		<!-- Slider -->
        <div class="row">
            <div class="col-xs-12" id="slider">
<?php
$attachments = new Attachments( 'attachments_field', get_the_ID() );
if( $attachments->exist() ) : 
?>
                <!-- Top part of the slider -->
                <div class="row">
                    <div class="col-md-8" id="carousel-bounding-box">
                        <div class="carousel slide" id="album_gallery">
                            <div class="carousel-inner">
                            <!-- Carousel items -->
<?php
	$i = 0;
	while( $attachments->get() ) : 
?>
                                <div class="<?php echo ($i == 0) ? "active " : "";?>item" data-slide-number="<?php echo $i;?>">
                                	<img src="<?php echo $attachments->src( 'full' ); ?>">
                                </div>
<?php
		$i++;
	endwhile; 
?>
                            </div><!-- Carousel nav -->
                            <a class="carousel-control left" data-slide="prev" href="#album_gallery">‹</a> <a class="carousel-control right" data-slide="next" href="#album_gallery">›</a>
                        </div>
                    </div>

                    <div class="col-md-4" id="carousel-text"></div>

                    <div id="slide-content" style="display: none;">
<?php
	$i = 0;
	$attachments = new Attachments( 'attachments_field', get_the_ID() );
	while( $attachments->get() ) : 
?>
                        <div id="slide-content-<?php echo $i;?>">
                            <h2><?php echo $attachments->field( 'title' ); ?></h2>
                            <p><?php echo $attachments->field( 'caption' ); ?></p>
                            <p class="sub-text"><?php echo $attachments->field( 'copyright' ); ?></p>
                        </div>
<?php
		$i++;
	endwhile; 
?>
                    </div>
                </div>
<?php 
endif;
?>

            </div>
        </div><!--/Slider-->

        <div class="row hidden-xs" id="slider-thumbs">
<?php
$attachments = new Attachments( 'attachments_field', get_the_ID() );
if( $attachments->exist() ) : 
?>
            <div class="span12">
                <!-- Bottom switcher of slider -->

                <ul class="hide-bullets thumbnails">
<?php
	$i = 0;
	while( $attachments->get() ) : 
?>
                    <li class="col-xs-1">
                        <a class="thumbnail" id="carousel-selector-<?php echo $i;?>"><?php echo $attachments->image( 'thumbnail' ); ?></a>
                    </li>
<?php
		$i++;
	endwhile;
endif;
?>
	           </ul>
            </div>
        </div>

        <div class="content">
        	<p><i><?php echo the_excerpt();?></i></p>
        	<div class="content">
        		 <?php echo the_content();?>
        	</div>
        </div>
	</article>
<?php endwhile; ?>