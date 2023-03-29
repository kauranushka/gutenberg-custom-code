<?php
 /**
 * Block: Accordion
 * Displays collapsible sections of content
 */

	// Block classes
	$classNames = array_filter([
		'accordion',
		$block['className']
	]);

  if (have_rows("accordion")):
?>
  <div class="<?= implode(' ', $classNames) ?>" id="<?= $block["id"] ?>">
    <?php
    $i = 0;
    while (have_rows("accordion")):
      the_row();

      $title = get_sub_field("title");
      $subtitle = get_sub_field("subtitle");
      $content = get_sub_field("content");
      $button = get_sub_field("button");

      // Check to ensure there is content and a title before outputting the item
      if(!empty($title) && !empty($content)) :
    ?>
        <div class="accordion-item">
          <h3 class="accordion-header" id="heading-<?= $block["id"] ?>-<?= $i ?>">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $block["id"] ?>-<?= $i ?>" aria-expanded="false" aria-controls="<?= $block["id"] ?>-<?= $i ?>">
              <span class="d-block mr-3">
                <span class="d-block lead text-trout font-weight-semibold"><?= $title ?></span>
                <?php if(!empty($subtitle)) : ?>
                  <span class="d-block h5 text-gull font-weight-normal mt-2"><?= $subtitle ?></span>
                <?php endif; ?>
              </span>
            </button>
          </h3>

          <div id="<?= $block["id"] ?>-<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#<?= $block["id"] ?>" aria-labelledby="#heading-<?= $block["id"] ?>-<?= $i ?>">
            <div class="accordion-body">
              <div><?= $content ?></div>
              <?php if($button) :
                $button_url = $button['url'];
                $button_title = $button['title'];
                $button_target = $button['target'] ? $button['target'] : '_self';
              ?>
                <a href="<?= esc_url( $button_url ); ?>" target="<?= esc_attr( $button_target ); ?>" class="btn btn-primary mt-4"><?= esc_html( $button_title ); ?></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php $i++;?>
      <?php endif; ?>
    <?php endwhile; ?>
  </div>
<?php elseif ($is_preview): ?>
	<p class="text-error">Please include all required fields.</p>
<?php endif; ?>
