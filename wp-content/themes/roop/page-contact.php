<?php
/**
 *
 * @package WordPress
 * @subpackage Roop
 * Template Name:Contact
 */
get_header(); ?>
<!--========================================================
                            CONTENT
  =========================================================-->
   <main>
    <section class="map">
      <div class="container">
        <hr />
        <h2 class="center offset-3"><?php the_title(); ?></h2>
        <div class="row offset-3">                
     </div>
   </div>
    </section>
    <section class="map">
      <iframe width="100%" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=roop%20beauty&key=AIzaSyDXxKeuZWmGtCWneShuGPjCuRzDYEb6DR8" allowfullscreen></iframe>
    </section>  
    <section class="well-6">
      <div class="container">
        <hr>
        <div class="row">
          <div class="grid_6">
            <address class="wow fadeIn animated">
<?php
if ( have_posts() ) while ( have_posts() ) : the_post();

$content = get_the_content();
echo $content;

endwhile; // end of the loop.

wp_reset_postdata(); 
?>
            </address>
          </div>
          <div class="grid_3 preffix_1 wow fadeIn animated">
<!-- begin pull in custom meta boxes for contact numbers and opening hours -->            
<?php if (function_exists(DreamSitesContactMeta)) echo DreamSitesContactMeta(); ?>
<!-- end pull in custom meta boxes for contact numbers and opening hours -->            
          </div>
        </div>
      </div>
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
        <script>
	        $('.wpcf7-form').attr('id', 'contact-form');
			$( ".wpcf7-form-control.wpcf7-submit" ).addClass( "btn-3" );
		</script>
      </div>
    </section>
  </main> 
  <?php get_footer(); ?>