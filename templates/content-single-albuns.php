<?php while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?>>
		<!-- Slider -->
        <div class="row">
            <div class="col-xs-12">
<?php
$attachments = new Attachments( 'attachments_field', get_the_ID() );
if( $attachments->exist() ) : 
?>
                <!-- Top part of the slider -->
                <div class="row">
                    <div class="col-md-12" id="carousel-bounding-box">
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

            </div>
        </div><!--/Slider-->

        <div class="row hidden-xs" id="slider-thumbs">
            <div class="col-md-12">
                <div class="carousel slide media-carousel" id="media">
                <div class="carousel-inner">
<?php
    
    // 
    function num($t, $c, $total = null) {
        $r = intval(($t % $c));
        return ($r == 0) ? 3 : intval($c);
        return $r;
    }

    $attachments = new Attachments( 'attachments_field', get_the_ID() );
    $total = intval($attachments->total());

    $col = intval(($total / 3));

    // Attatchment loop
    for ($i = 0; $i < $col; $i++) {

?>
                    <div class="item<?php echo ($i == 0) ? " active" : "";?>">
                       <div class="row">

<?php
        //echo (($i * num($total, 3)));
            //echo num($total, 3);
        $z = intval($i * 3);
        echo num($z,3);
        for ($x = ($i * num($total, 3)); $x < num($z, 3); $x++) {
            //echo $x;
            if( $attachment = $attachments->get_single( $x ) ) { 
            //$attachment = $attachments->get_single( $x );
            //print_r($attachment);
            /*
?>
                            <div class="col-md-3 <?php echo ($z == 0) ? "active " : "";?>item" data-slide-number="<?php echo $z;?>">
                                <a class="thumbnail" href="#" id="carousel-selector-<?php echo $z;?>"><img class="img-responsive" alt="" src="<?php echo $attachments->src( 'thumbnail', $x ); ?>"></a>
                            </div>
<?php
            */
            }
        }
?>
                        </div>
                    </div>

<?php
    }
?>
                </div>
                <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
                <a data-slide="next" href="#media" class="right carousel-control">›</a>
            </div>
        </div>
<?php 
endif;
?>

        <div class="content">
        	<p><i><?php echo the_excerpt();?></i></p>
        	<div class="content">
        		 <?php echo the_content();?>
        	</div>
        </div>
	</article>
<?php endwhile; ?>