 <?php
/**
 * The main template file
 *
 *
 * @package WordPress
 * @subpackage Roop
 * @since 1.0
 * @version 1.0
 */
get_header(); 

      if ( have_posts() ) :

        /* Start the Loop */
        while ( have_posts() ) : the_post();

        endwhile;

      endif;
 
get_footer();