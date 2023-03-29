<?php

/**
 * Block: Cover - Two Columns
 * Display a full-width cover area with two columns: text and media.
 */

	// Block classes
	$classNames = array_filter([
		'cover-two-cols',
		'alignfull',
		$block['className']
	]);

	// Block data
  $media_type = get_field('media_type');
	if($media_type === 'image') {
		$image_id = get_field('image');
	} elseif($media_type === 'video') {
		$placeholder_id = get_field('video_placeholder');
		$url = get_field('video_url');
	}
  if(!empty($url) || $image_id):
?>
	<section class="<?= implode(' ', $classNames) ?>">
		<div class="cover-two-cols__inner">
			<div class="cover-two-cols__inner-content">
				<div>
					<InnerBlocks />
				</div>
			</div>
			<div class="cover-two-cols__inner-media">
				<?php if($image_id) :?>
					<?= wp_get_attachment_image($image_id, 'full'); ?>
				<?php elseif(!empty($url)) :?>
					<div class="video-play-box">
						<?= wp_get_attachment_image($placeholder_id, 'full', '', ['class' => 'video-play-box__image']); ?>
						<button data-src="<?= $url ?>" type="button" class="video-play-box__btn" aria-label="Play video">
							<?= inline_svg('images/icon-play--white.svg') ?>
						</button>
						<video class="video-play-box__video">
							<source src="<?= $url ?>" type="video/mp4">
						</video>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php elseif ($is_preview): ?>
	<p class="text-error">Please include all required fields.</p>
<?php endif; ?>