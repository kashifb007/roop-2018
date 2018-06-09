<?php
/**
 *
 * @package WordPress
 * @subpackage Roop
 * Template Name:Services
 */
get_header(); ?>
<!--========================================================
                            CONTENT
  =========================================================-->
   <main>
    <section class="well-8">
      <div class="container">
        <hr>
        <h2 class="center offset-3"><?php the_title(); ?></h2>
        <div class="row">
          <div class="grid_5"><img src="<?php echo get_template_directory_uri(); ?>/images/page-4_img01.jpg" alt="">
          </div>
          <div class="grid_7">
            <?php echo get_the_content(); ?>
          </div>
        </div>
      </div>
    </section>
   	<section class="well-6">
      <div class="container"> 
      <hr>                 

<?php


   ?>
<!-- Services Loop Begin -->
<?php if (function_exists(DreamSitesGetServices))
{
  $content = DreamSitesGetServices('services', 4);
  echo $content[0];
}
?>        
<!-- Services Loop End -->   
      </div>     
	 </section>
	 <section class="well-4__ins parallax parallax4" data-url="<?php echo get_template_directory_uri(); ?>/images/parallax04.jpg" data-mobile="true" data-speed="0.3" data-direction="inverse">
      <div class="container">
        <h2>roop product range</h2>
        <a href="<?php echo get_site_url(); ?>/products" class="btn">view now</a>
      </div>
    </section>
    <section class="well-6__ins">
      <div class="container">
        <hr>
        <h2 class="center offset-3">Bridal Packages</h2>
        
<?php
if (function_exists(DreamSitesGetServices))
{
  $bridal_content = DreamSitesGetServices('services', 2);
  echo $bridal_content[0];
}
   ?>
        <hr class="offset-4">
      </div>
    </section>
  </main> 
  <?php get_footer(); ?>
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

  <?php } 
$bridal_counter = $bridal_content[1]+1;
for($x=1; $x<$bridal_counter; $x++)
{
  ?>

  document.getElementById('bridal_flip<?php echo $x; ?>').addEventListener( 'click', function(){
    $( "div#bridal_card<?php echo $x; ?>" ).toggleClass( "flipped" );
    $( "div#bridal_card<?php echo $x; ?> .back" ).toggleClass( "show" );
    $( "div#bridal_card<?php echo $x; ?> .front" ).toggleClass( "hide" );
  }, false);
<?php
}
?>

});
</script>