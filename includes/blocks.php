<?php

// Custom ACF Blocks
add_action("acf/init", function () {
  if (function_exists("acf_register_block_type")):

    acf_register_block_type([
      "name" => "accordion",
      "title" => __("Accordion"),
      "description" => __("Displays collapsible sections of content"),
      "render_template" => "./templates/blocks/accordion.php",
      "category" => "custom-blocks",
      "icon" => "editor-insertmore",
      "keywords" => ["accordion", "dropdown"],
      'mode' => 'preview',
    ]);

    acf_register_block_type([
      'name' => 'cover-two-cols',
      'title' => __('Cover - Two Columns'),
      'description' => __('Display a full-width cover area with two columns: text and media'),
      'render_template' => './templates/blocks/cover-two-cols.php',
      'category' => 'custom-blocks',
      'icon' => 'columns',
      'keywords' => array('cover', 'two-columns'),
      'mode' => 'preview',
      "supports" => ["jsx" => true],
    ]);

    acf_register_block_type([
      'name' => 'icon',
      'title' => __('Icon'),
      'description' => __('Display an icon and style it with various options'),
      'render_template' => './templates/blocks/icon.php',
      'category' => 'custom-blocks',
      'icon' => 'yes-alt',
      'keywords' => array('icon', 'image'),
      'mode' => 'preview',
      "supports" => ["align" => ["center"]],
    ]);

    acf_register_block_type([
      "name" => "team-member",
      "title" => __("Team Member"),
      "description" => __( "Displays team member card with image, name, role, and Linked In"),
      "render_template" => "./templates/blocks/team-member.php",
      "category" => "custom-blocks",
      "icon" => "admin-users",
      "keywords" => ["team", "about", "members"],
      'mode' => 'preview',
      "supports" => ["jsx" => true, "align" => ["full"]],
    ]);

    acf_register_block_type([
      "name" => "testimonials-slider",
      "title" => __("Testimonials Slider"),
      "description" => __("Displays testimonials as a full-width slider"),
      'render_template' => './templates/blocks/testimonials-slider.php',
      'enqueue_script' => asset_path('scripts/testimonials-slider.js'),
      "category" => "custom-blocks",
      "icon" => "testimonial",
      "keywords" => ["testimonial", "review", "slider"],
      'mode' => 'preview',
      "align" => "full",
      "supports" => ["jsx" => true, "align" => ["full"]],
    ]);

    acf_register_block_type([
      "name" => "vertical-slider",
      "title" => __("Vertical Slider - Short"),
      "description" => __("Display a vertical slider with a title and content section"),
      "render_template" => "./templates/blocks/vertical-slider--short.php",
      'enqueue_script' => asset_path('scripts/vertical-slider.js'),
      "category" => "custom-blocks",
      "icon" => "image-flip-vertical",
      "keywords" => ["slider", "vertical"],
      'mode' => 'preview',
    ]);

    acf_register_block_type([
      "name" => "vertical-slider-scroll",
      "title" => __("Vertical Slider - Scroll"),
      "description" => __("Display a vertical slider with a title and content section"),
      "render_template" => "./templates/blocks/vertical-slider--scroll.php",
      //'enqueue_script' => asset_path('scripts/vertical-slider.js'),
      "category" => "custom-blocks",
      "icon" => "image-flip-vertical",
      "keywords" => ["slider", "vertical"],
      'mode' => 'preview',
    ]);

  endif;
});