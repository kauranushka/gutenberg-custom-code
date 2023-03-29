<?php
 /**
 * Block: Vertical Slider - Short Form
 * Display a vertical slider with a title and content section
 */

	// Block classes
	$classNames = array_filter([
		'vertical-slider--short',
		$block['className']
	]);

  if (have_rows("vertical_slider_short")):
?>
  <section class="<?= implode(' ', $classNames) ?>" id="<?= $block["id"] ?>">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-7 desktop-view">
          <?php
            $i = 0;
            while (have_rows("vertical_slider_short")):
              the_row();
              $image = get_sub_field("image");
              if(!empty($image)) :
          ?>
              <div id="tab-<?= $i ?>" class="tabcontent" style="display:<?php if($i == 0){ ?> block <?php }else{ ?> none <?php } ?>">
                <div class="vertical-slider--short__media">
                  <?= wp_get_attachment_image( $image, 'full', ["class" => "img-fluid"] ); ?>
                </div>
              </div>
              <?php $i++;?>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>

        <div class="col-12 col-md-5 desktop-view">
          <div class="vertical-slider--short__content">
            <?php
              $i = 0;
              while (have_rows("vertical_slider_short")):
                the_row();

                $title = get_sub_field("title");
                $content = get_sub_field("content");

                if(!empty($title) && !empty($content)) :
            ?>
                <div class="tablinks <?php if($i == 0){ ?>active <?php } ?>" data-tab="tab-<?= $i ?>">
                  <div class="nav-link text-trout">
                    <h2 class="h4 text-trout"><?= $title ?></h2>
                    <div class="adjust-wysiwyg"><?= $content ?></div>
                  </div>
                </div>
                <?php $i++;?>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        </div>
        <div class="col-12 mobile-view">
          <?php
            while (have_rows("vertical_slider_short")):
              the_row();
              $image = get_sub_field("image");
              $title = get_sub_field("title");
              $content = get_sub_field("content");
              if(!empty($image)) :
          ?>
              <div class="mobile-tabcontent">
                <div class="vertical-slider--short__media">
                  <?= wp_get_attachment_image( $image, 'full', ["class" => "img-fluid"] ); ?>
                  <div class="tablinks active">
                    <h2 class="h4 text-trout"><?= $title ?></h2>
                    <div class="adjust-wysiwyg"><?= $content ?></div>
                  </div>
                </div>
              </div>
              <?php $i++;?>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
<?php elseif ($is_preview): ?>
  <p class="text-error">Please include all required fields.</p>
<?php endif; ?>