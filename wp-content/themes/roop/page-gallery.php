<?php
/**
 *
 * @package WordPress
 * @subpackage Roop
 * Template Name:Gallery
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
          <div class="grid_12">

          	<!-- List Galleries -->
<div id="accordion">
<?php
$meta_headings = array();
$custom_field_keys = get_post_custom_keys();
foreach ( $custom_field_keys as $key => $value ) 
{
    $valuet = trim($value);
    if ( '_' == $valuet{0} )
        continue;
    $meta_headings[] = $value;
}	

foreach ($meta_headings as $key => $arr_value)
{
	$key_value = get_post_custom_values($arr_value);
	
			echo "<h3>".$arr_value."</h3><div>";
            echo do_shortcode($key_value[0]);
            echo "</div>";
            
}

?>        
  
</div>

          </div>
        </div>
	  </div>
	 </section>
  </main> 
  <script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>
  <?php get_footer(); ?>