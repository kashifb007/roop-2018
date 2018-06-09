<!--========================================================
                            FOOTER
  =========================================================-->
  <?php wp_footer(); ?> 
  <footer <?php if (is_front_page()) {?> style="padding: 42px 0 0 0 !important;" <?php } ?>>
    <div class="container">
      <div class="row">
        <div class='verta-box'>
          <div class='verta-box_wr'>
            <div class='verta-box_cnt'>
              <div class="grid_4">
                © <span id="copyright-year"></span>
                Website by <a href="http://www.dreamsites.co.uk" target="_blank">Dream Sites Ltd</a>
              </div>
            </div>
            <div class='verta-box_cnt'>
              <div class="grid_4">
                <address>
                  ROOP HAIR &amp; BEAUTY LTD<br/>
                  245 BLACKBURN ROAD<br/>
                  ACCRINGTON, LANCASHIRE, BB5 0AA<br/>                  
                </address>
              </div>
            </div>
            <div class='verta-box_cnt'>
              <div class="grid_4">
                <ul class="inline-list">
                  <li><a href="https://www.facebook.com/RoopBeauty1" class="fa fa-facebook" target="_blank"></a></li>
                  <li><a href="https://www.instagram.com/roopsalonuk" class="fa fa-instagram" target="_blank"></a></li>
                  <li><a href="https://twitter.com/roopsalonuk" class="fa fa-twitter" target="_blank"></a></li>
                </ul>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
<?php
if (is_front_page())
{
  ?>
    <section class="map">
     <iframe width="100%" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=roop%20beauty&key=AIzaSyDXxKeuZWmGtCWneShuGPjCuRzDYEb6DR8" allowfullscreen></iframe>
    </section>
<?php } ?>    
  </footer>
</div>
<script src="<?php echo get_template_directory_uri().'/js/script.js'; ?>"></script>
</body>
</html>