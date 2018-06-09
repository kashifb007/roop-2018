<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="format-detection" content="telephone=no"/>
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <!--[if lt IE 9]>
  <html class="lt-ie9">
  <div style=' clear: both; text-align:center; position: relative;'>
    <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
      <img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820"
           alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
    </a>
  </div>
  <script src="<?php echo get_template_directory_uri().'/js/html5shiv.js'.''; ?>"></script>
  <![endif]-->
 <?php wp_head(); ?>  
</head>
<body>
<div class="page">
  <!--========================================================
                            HEADER
  =========================================================-->
  <header>
    <div id="stuck_container" class="stuck_container">
      <div class="container">
        <nav class="nav">
          <ul class="sf-menu" data-type="navbar">
            <li>
              <a href="<?php echo get_site_url(); ?>/">Home</a>              
            </li>
            <li>
              <a href="<?php echo get_site_url(); ?>/contact">Contact Us</a>
            </li>
            <li>
              <a href="<?php echo get_site_url(); ?>/gallery">Gallery</a>
            </li>
            <li>
              <a href="<?php echo get_site_url(); ?>/service">Services</a>
            </li>
            <li>
              <a href="<?php echo get_site_url(); ?>/products">Products</a>
            </li>
          </ul>
        </nav>
        <div class="brand wow fadeIn animated">
          <h1 class="brand_name">
            <a href="./">roop</a>
          </h1>
          <p class="brand_slogan">
            hair &amp; beauty
          </p>
        </div>
      </div>
    </div>
  </header>