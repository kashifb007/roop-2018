<?php
/*
Plugin Name: Dream Sites Roop Main Plug In
Plugin URI: http://www.dreamsites.co.uk
Description: Dream Sites Roop Main Functionality, custom post types and loops
Version: 1.0
Author: Dream Sites Ltd
Author URI: http://www.kashifbhatti.co.uk
*/


function DreamSitesCarousel()
{
	global $post;
	$img_array = array();
	$query = new WP_Query( array('post_type' => 'home-page-images') );

	while ($query->have_posts() ) : $query->the_post();

	  get_template_part( 'content', 'home-page-images' );  

	   if(has_post_thumbnail()) 
	   {
	        $thumb   = get_post_thumbnail_id();
	        $img_url = esc_url(wp_get_attachment_url( $thumb,'full')); //get img URL        
	   }
	  
	  $sort_order = !empty(get_post_meta($post->ID, '_sort_order', true)) ? esc_html(get_post_meta($post->ID, '_sort_order', true)) : null;

	  $img_array[] = array('title' => get_the_title(), 'url' => esc_url($img_url), 'sort' => $sort_order, 'content' => get_the_content());

	endwhile; 

	wp_reset_postdata(); 

	$sort = array();

	foreach ($img_array as $key => $row) 
	{
	    $sort[$key]  = $row['sort'];
	}

	  array_multisort($sort, SORT_ASC, $img_array);

	$display_format = '<div data-src="%s">
	            <div class="camera_caption fadeIn">
	              <p>%s</p>
	              <p>%s</p>
	            </div>
	          </div>';

	$carousel_array = null;

	foreach ($img_array as $key => $row) 
	{
	    $carousel_array .= sprintf($display_format, $row['url'], $row['title'], $row['content']);
	}

	return $carousel_array;
}

function DreamSitesContactMeta()
{
	$content = null;
	$meta_headings = array();
	$hours = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
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
		if(!in_array($arr_value, $hours) && ($arr_value !== 'contact'))
		{	
		
				$content.='<dl>
	              <dt>'.$arr_value.':</dt>
	              <dd>'.$key_value[0].'</dd>
	            </dl>';
		
		}
	}


	            $content .= '<p>E-mail: <span class="mailme">info at roopbeauty dot co dot uk</span></p>
	            <h6>Opening Hours</h6>';

	
	foreach ($meta_headings as $key => $arr_value)
	{
	  $key_value = get_post_custom_values($arr_value);
	  if(in_array($arr_value, $hours))
	  { 
	      $content.='<dl>
	              <dt>'.$arr_value.':</dt>
	              <dd>'.$key_value[0].'</dd>
	            </dl>';
 
  }
}
	return $content;
}

function DreamSitesGetServices($post_type, $category_id)
{
define('SERVICES', 4 );
define('BRIDAL', 2 );
define('HOME', 3 );

$content = null;
global $post;
$bridal_count = 1;
$services_array = array();

$query = new WP_Query( array('post_type' => $post_type, 'cat' => $category_id) );

while ($query->have_posts() ) : $query->the_post();

if($category_id == BRIDAL || $category_id == SERVICES || $category_id == HOME)
{
  get_template_part( 'content', 'services' );  
}
else
{
  get_template_part( 'content', 'products' );  
}

   if(has_post_thumbnail()) 
   {
        $thumb   = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url( $thumb,'full'); //get Featured Image URL        
   }

  $my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
  $my_meta = !empty($my_meta['header_text']) ? get_post_meta($post->ID,'_my_meta',TRUE) : "0";

  $full_desc = get_the_content();
  $short_desc = preg_replace("/<img[^>]+\>/i", "", $full_desc);
  $short_desc = substr($short_desc, 0, strpos($short_desc, ".")+1);    

  $full_desc = preg_replace("/<img[^>]+\>/i", "", $full_desc);
  $sort_order = !empty(get_post_meta($post->ID, '_sort_order', true)) ? esc_html(get_post_meta($post->ID, '_sort_order', true)) : null;	

if($category_id == HOME)
{
	$services_array[] = array('title' => get_the_title(), 'url' => $img_url, 'sort' => $sort_order, 'short_content' => $short_desc, 'content' => $full_desc);
}
else if($category_id == SERVICES || $post_type == 'products')
{
  $services_array[] = array('title' => get_the_title(), 'url' => $img_url, 'sort' => $my_meta['header_text'], 'short_content' => $short_desc, 'content' => $full_desc);
}
else if($category_id == BRIDAL)
{
	$services_array[] = array('title' => get_the_title(), 'url' => $img_url, 'sort' => $bridal_count, 'short_content' => $short_desc, 'content' => $full_desc, 'cost' => $my_meta['header_text']);
	$bridal_count++;
}

  endwhile;


wp_reset_postdata(); 
$sort = array();

foreach ($services_array as $key => $row) 
{
	if($category_id == BRIDAL)
	{	
		$sort[$key]  = $row['cost'];
    }
    else
    {
    	$sort[$key]  = $row['sort'];
    }
}

	array_multisort($sort, SORT_ASC, $services_array);
	

if($category_id == SERVICES)
	{
		$display_format = '<div class="grid_6">
		          <div id="card%d">
		            <div class="front">
		            <div class="box-1">
		              <div class="box-1_bg">
		                <img src="%s" alt="">
		              </div>
		              <div class="box-1_cnt" data-equal-group="1">
		                <h4>%s</h4>
		                %s
		                <a id="flip%d" href="javascript:void(0);" class="btn-1 services">more</a>
		              </div>
		            </div>
		          </div>
		          <div class="back">
		              <h5>%s</h5>
		               %s
		              </div>
		          </div>
		          </div>';
	}
	else if($category_id == BRIDAL)
	{
		$display_format = '<div class="grid_6">
          <div id="bridal_card%d">
            <div class="front">
            <div class="box-1">
              <div class="box-1_bg">
                <img src="%s" alt="">
              </div>
              <div class="box-1_cnt" data-equal-group="1">
                <h4>%s</h4>
                %s
                <strong>&pound;%d</strong><a id="bridal_flip%d" href="javascript:void(0);" class="btn-1 services">more</a>
              </div>
            </div>
          </div>
          <div class="back">
              <h5>%s</h5>
               %s
               <strong>&pound;%d</strong>
              </div>
          </div>
          </div>';
	}
	else if($post_type == 'products')
	{
		$display_format = '<article class="post">
		          <div id="card%d">
		            <div class="front">
		              <img class="post_aside-%s" src="%s" alt="">
		              <div class="post_cnt__no-flow">
		              <h5>%s</h5>
		                %s
		                <a id="flip%d" href="javascript:void(0);" class="btn-1 services">more</a>
		              </div>
		              </div>
		              <div class="back">
		              <h5 class="grey">%s</h5>
		               %s
		              </div>
		          </div>
		            </article>';
	}
	else if($category_id == HOME)
	{
		$display_format = '<div class="grid_3 box" data-equal-group="1">
	            <div id="card%d">
	            <div class="front">
	              <img src="%s" alt="">
	              <div class="box_cnt">
	                <h5>%s</h5>
	                %s
	                <a id="flip%d" href="javascript:void(0);" class="btn-1">more</a>
	                </div>
	              </div>
	              <div class="back">
	              <h5>%s</h5>
	                %s
	              </div>
	            </div>
	          </div>';
	}

$count = 0;
$oddrows = 1;
$counter = count($services_array);

foreach ($services_array as $key => $row) 
{
	if($category_id !== HOME)
	{
		if($post_type == 'services')
		{
	    if($count % 2 == 0)
	      {
	        if($oddrows==1)
	        {
	          $content .= '<div class="row offset-3">';
	          $oddrows=0;
	        }
	        else
	        {
	          $content .= '<div class="row">';          
	          $oddrows = 1;
	        }        
	      }
	  	}
	  	else if($post_type == 'products')
	  	{
	  	if($count % 2 == 0)
	      {
	        if($oddrows==1)
	        {
	          $content .= '<div class="grid_6 right">';
	          $right_image = "r";
	          $oddrows=0;
	        }
	        else
	        {
	          $content .= '<div class="grid_6">';          
	          $oddrows = 1;
	          $right_image = "1";
	        }  

	      }
	  	}
  	}
      	if($category_id == SERVICES || $category_id == HOME)
		{
	    	$content .= sprintf($display_format, $row['sort'], $row['url'], $row['title'], $row['short_content'], $row['sort'], $row['title'], $row['content']);     
	    }
	    else if($category_id == BRIDAL)
	    {
	    	    $content .= sprintf($display_format, $row['sort'], $row['url'], $row['title'], $row['short_content'], $row['cost'], $row['sort'], $row['title'], $row['content'], $row['cost']);     
	    }
	    else if($post_type == 'products')
	    {
	     	$content .= sprintf($display_format, $row['sort'], $right_image, $row['url'], $row['title'], $row['short_content'], $row['sort'], $row['title'], $row['content']);     
	    }
    $count++;
	
	if($category_id !== HOME)
	{
	    if($count % 2 == 0)
	      {
	          $content .= '</div>';
	      } 
	}

}

	if($category_id !== HOME)
	{
		if($count % 2 == 0)
		{}
		else
		{
		  $content .= "</div>";
		}
	}
	
	$return_array = array();
	$return_array[] = $content;
	$return_array[] = $counter;
	return $return_array;
}
