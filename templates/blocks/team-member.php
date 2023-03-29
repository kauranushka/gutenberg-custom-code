<?php

/**
 * Block: Team Member
 */

$name = get_field("name");
$linkedin_url = get_field("linkedin_url");
$title = get_field("title");
$photo_id = get_field("photo");
?>

<?php if (!empty($name)): ?>
  <div class="team-member">
    <?php if (!empty($photo_id)): ?>
      <div class="team-member__img-mask">
        <?= wp_get_attachment_image($photo_id, "medium") ?>
      </div>
    <?php endif; ?>
    <h3 class="team-member__name"><?= $name ?></h3>
    <?php if (!empty($title)): ?>
      <p class="team-member__title"><?= $title ?></p>
    <?php endif; ?>
    <?php if (!empty($linkedin_url)): ?>
      <a href="<?= $linkedin_url; ?>" target="_blank">
        <?= inline_svg("images/icon-linked-in--jade.svg") ?>
      </a>
    <?php endif; ?>
  </div>
<?php endif; ?>
