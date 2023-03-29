<?php
	$linked_in = get_field('linked_in', 'option');
	$youtube = get_field('youtube', 'option');
	$facebook = get_field('facebook', 'option');
	$email = get_field('email', 'option');

	if(!empty($linked_in) || !empty($youtube) || !empty($facebook) || !empty($email)) :
?>
	<ul class="social-links">
		<?php if(!empty($linked_in)) : ?>
			<li>
				<a href="<?= $linked_in ?>" target="_blank" aria-label="Atlas LinkedIn">
					<?= inline_svg('images/icon-linkedin.svg'); ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if(!empty($youtube)) : ?>
			<li>
				<a href="<?= $youtube ?>" target="_blank" aria-label="Atlas YouTube">
					<?= inline_svg('images/icon-youtube.svg'); ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if(!empty($facebook)) : ?>
			<li>
				<a href="<?= $facebook ?>" target="_blank" aria-label="Atlas Facebook">
					<?= inline_svg('images/icon-facebook.svg'); ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if(!empty($email)) : ?>
			<li>
				<a href="mailto:<?= $email ?>" target="_blank" aria-label="Email Atlas">
					<?= inline_svg('images/icon-envelope.svg'); ?>
				</a>
			</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>