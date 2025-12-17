<style>
    @media (max-width: 375px) {
      .normalDev {
        margin-bottom: 78px;
      }

      .normalDev2{
        margin-top: -55px !important;
      }
    }

.test {
  bottom: 50% !important;
}
</style>
<div class="<?php echo $page->post_name; ?> position-relative">
  <div
    style="min-height: 240px;background-image: url(<?php get_featured_image_by_post_id($page->ID); ?>)"
    class="modal-header-container">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
          <h1 class="modal-header-title text-white text-shadow">
						<?php echo $page->post_title ?>
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-body position-relative" style="padding-bottom: 80px;">
    <div class="container mb-3">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto p-0 body-content scrollbar-rail">
          <div class="clear px-5">
						<?php echo wpautop($page->post_content); ?>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
   <?php
      if(isset($button_meta) && !empty($button_meta)){
        ?>
        <a href="<?php echo $button_meta['button_url'];?>" class="btn px-3 btn-modal-meta btn-sm btn-rounded"
           style="background-color: <?php echo $button_meta['button_color'] ?>; color: white">
          <?php echo $button_meta['label_button']  ?>
        </a>
    <?php
      }

    ?>
  </div>
  <?php if(isset($next_link) && $next_link != ''):?>
    <div
      data-id="<?php echo $next_link->ID; ?>"
      class="modal-next-page-container <?php echo $position; ?> text-center cursor-pointer">
      <?php echo $next_link -> post_title; ?>
      <br>
      <i class="fa <?php echo $position == 'right' ? 'fa-arrow-right' : 'fa-arrow-left'?>"></i>
    </div>
  <?php endif;?>
	<?php if(isset($before_link) && $before_link != ''):?>
    <div
      data-id="<?php echo $before_link->ID; ?>"
      class="modal-next-page-container left text-center cursor-pointer">
			<?php echo $before_link -> post_title; ?>
      <br>
      <i class="fa fa-arrow-left"></i>
    </div>
	<?php endif;?>
</div>
