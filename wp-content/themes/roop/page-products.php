<?php
/**
 *
 * @package WordPress
 * @subpackage Roop
 * Template Name:Products
 */
get_header(); ?>
<!--========================================================
                            CONTENT
  =========================================================-->
   <main>
   	<section class="well-6">
      <div class="container"> 
      <hr>     
      <h2 class="center offset-3"><?php the_title(); ?></h2>
        <div class="row">
<?php if (function_exists(DreamSitesGetServices))
{
  $content = DreamSitesGetServices('products', null);
  echo $content[0];
}
?> 
      </div>    
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
?>

});
</script>