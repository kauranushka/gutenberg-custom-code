<?php
  /**
   * Block: Testimonial
   * Displays testimonials as a full-width slider
   */

  // Block classes
  $classNames = array_filter([
    'testimonials-slider',
    'owl-carousel',
    $block['align'],
    $block['className'],
  ]);

  // Block data
  $testimonials = get_field('choosen_testimonials');

  if($testimonials) :
?>
  <div class="<?= implode(' ', $classNames) ?>">
    <?php foreach($testimonials as $testimonial):
      setup_postdata($testimonial);

      // Ensure we have content before outputting a slide
      $content = get_the_content();
    ?>
      <?php if(!empty($content)):
        $blurb = get_field('slider_blurb', $testimonial->ID);
      ?>
        <div class="testimonials-slider__item testimonials-slider__item--benefits">
          <?php if(!empty($blurb)): ?>
            <p class="testimonials-slider__item-blurb h6 font-weight-bold">
              <?= $blurb ?>
            </p>
          <?php endif; ?>
          <div class="testimonials-slider__item-content h5 font-weight-light">
            <?= $content ?>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; wp_reset_postdata(); ?>
  </div>
<?php elseif ($is_preview): ?>
	<p class="text-error">Please include all required fields.</p>
<?php endif; ?>
