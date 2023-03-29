<?php
 /**
 * Block: Vertical Slider - Scroll
 * Display a vertical slider with a title and content section
 */

	// Block classes
	$classNames = array_filter([
		'vertical-slider-scroll',
		$block['className']
	]);

  if (have_rows("tabbar_section")):
?>

<div class="<?= implode(' ', $classNames) ?>" id="<?= $block["id"] ?>">
  <section class="tabbar-section">
      <div class="container">
         <div class="row">
            <?php
              $i = 0;
              while (have_rows("tabbar_section")):
                the_row();

                $image = get_sub_field("image");
                $title = get_sub_field("title");
                $sub_title_1 = get_sub_field("sub_title_1");
                $paragraph_1 = get_sub_field("paragraph_1");
                $sub_title_2 = get_sub_field("sub_title_2");
                $paragraph_2 = get_sub_field("paragraph_2");

                // Check to ensure there is content and a title before outputting the item
                if(!empty($image)) :
              ?>
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"></button>
                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"></button>
                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"></button>
                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"></button>
                </div>
              <div class="col-md-12 col-lg-6 ">
                <div class="platform-container">
                    <div class="team-title"><?= $title ?></div>
                    <div class="platform-sr-list ">
                        <div class="platform-sr-list-title"><?= $sub_title_1 ?></div>
                        <p><?= $paragraph_1 ?></p>
                    </div>
                    <div class="platform-sr-list ">
                        <div class="platform-sr-list-title"><?= $sub_title_2 ?></div>
                        <p><?= $paragraph_2 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6"><?= wp_get_attachment_image( $image, 'full', ["class" => "img-fluid"] ); ?></div>
                
                  <?php $i++;?>
                <?php endif; ?>
              <?php endwhile; ?>
          </div>
       </div>
  </section>
  <section class="tabbar-section">
    <div class="container d-view">
        <div class="d-flex align-items-start">
            <div class="slider-tab">
                <div class="slider-1-sc slider-for-all">
                    
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  </div>
<?php elseif ($is_preview): ?>
	<p class="text-error">Please include all required fields.</p>
<?php endif; ?>
