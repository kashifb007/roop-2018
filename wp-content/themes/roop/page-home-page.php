<?php
/**
 *
 * @package WordPress
 * @subpackage Roop
 * Template Name:Home Page
 */
get_header(); ?>
<!--========================================================
                            CONTENT
  =========================================================-->
   <main>
    <section class="well">
      <div class="camera_container">
        <div id="camera" class="camera_wrap"> 

<!-- Main Carousel Loop Begin -->
<?php if (function_exists(DreamSitesCarousel)) echo DreamSitesCarousel(); ?>
<!-- Main Carousel Loop End -->

        </div>
      </div>
    </section>  
<section class="well-1">
      <div class="container">
        <div class="row">
          <div class="grid_5">

<?php
if ( have_posts() ) while ( have_posts() ) : the_post();

$content = get_the_content();
if(has_post_thumbnail()) 
   {
        $thumb   = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url( $thumb,'full'); //get img URL        
   }
   $my_meta = get_post_meta($post->ID,'_my_meta',true);
   $my_meta = !empty($my_meta['header_text']) ? get_post_meta($post->ID,'_my_meta',true) : null;

endwhile; // end of the loop.

wp_reset_postdata(); 
?>

            <h3><?php echo sanitize_text_field($my_meta['header_text']); ?></h3>
            <hr>
            <?php echo $content; ?>
          </div>
          <div class="grid_6 preffix_1"><img src="<?php echo $img_url; ?>" alt="<?php echo get_post_meta($thumb, '_wp_attachment_image_alt', true); ?>" title="<?php echo get_post_meta($thumb, '_wp_attachment_image_alt', true); ?>"></div>
        </div>
      </div>
    </section>
<section class="well__ins bg-white">
      <div class="container center">
        <h2>Our Services</h2>
        <p>A select few services that Roop Hair &amp; Beauty provide</p>
        <div class="row">

<!-- Services Loop Begin -->
<?php 
{
  $content = DreamSitesGetServices('services', 3);
  echo $content[0];
}
?>        
<!-- Services Loop End -->

        </div>
      </div>
    </section>
<section class="well-2">
      <div class="container center">
        <h2>photo gallery</h2>

        <?php 
$homegallery = get_post_meta( $post->ID, 'homegallery', true );

if ( have_posts() ) while ( have_posts() ) : the_post();

        echo do_shortcode($homegallery); 

endwhile;
        ?>

    </section>
<section class="well-4 parallax" data-url="<?php echo get_template_directory_uri().'/images/parallax01.jpg'; ?>" data-mobile="true">
      <div class="container">
        <h2>contact form</h2>
        <?php 
$contact = get_post_meta( $post->ID, 'contact', true );

if ( have_posts() ) while ( have_posts() ) : the_post();

        echo do_shortcode($contact); 

endwhile;
        ?>
      </div>
    </section>
  </main> 
  <?php get_footer(); ?>

<?php
if (is_front_page())
{
  ?>
  <script>

  $( document ).ready(function() {

<?php
$counter = $content[1]+1;
for($x=1; $x<$counter; $x++)
{
?>
  document.getElementById('flip<?php echo $x; ?>').addEventListener( 'click', function(){
    $( "div#card<?php echo $x; ?>" ).toggleClass( "flipped" );
    $( "div#card<?php echo $x; ?> .back" ).toggleClass( "show" );
    $( "div#card<?php echo $x; ?> .front" ).toggleClass( "hide" );
  }, false);

  <?php } ?>

$('.wpcf7-form').attr('id', 'contact-form');
$( ".wpcf7-form-control.wpcf7-submit" ).addClass( "btn-3" );


});
</script>
<?php
}
?>