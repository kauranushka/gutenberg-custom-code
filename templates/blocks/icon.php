<?php

/**
 * Block: Icon
 * Display an icon and style it with various options.
 */

	// Block classes
	$classNames = array_filter([
		'icon-block',
		$block['align'],
		$block['className'],
	]);

	// Block data
  $icon = get_field('icon');
  $size = get_field('size');
  $bkg = get_field('background');
  if($icon):
?>
<div class="<?= implode(' ', $classNames) ?> <?= $size ?> <?= $bkg ?>">
	<figure>
		<?= wp_get_attachment_image($icon, 'full'); ?>
	</figure>
</div>
<?php elseif ($is_preview): ?>
	<p class="text-error">Please include all required fields.</p>
<?php endif; ?>