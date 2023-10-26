 <?php
 $raw_title = get_the_archive_title();
 $formatted_title = str_replace('Archives:', '',$raw_title);
 ?>
<section class="breadcrumb-section" style="background-image:url(<?php echo GT_IMAGES; ?>/page-title/bg-author-page-title.jpg)">
        <div class="tf-container">
          <div class="row">
            <div class="col-lg-12">
              <div class="page-title">
                <h4><?php echo $formatted_title ?></h4>
                <div class="widget-menu-link">
                  <ul>
                    <li><a href="home-01.html">Home</a></li>
                    <li><a href="#">Find Talent</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>