<?php
/**
 * Anu functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Anu
 * @since 1.0.0
 */

if (!defined("LOCAL_DOMAIN")):
  define("LOCAL_DOMAIN", "anu.local");
endif;

/**
 * Includes
 */
array_map(
  function ($file) {
    if ("blocks" === $file):
      foreach (
        glob(get_stylesheet_directory() . "/includes/blocks/*.php")
        as $filename
      ):
        require_once $filename;
      endforeach;
    endif;
    $filepath = "/includes/{$file}.php";
    require_once get_stylesheet_directory() . $filepath;
  },
  ["blocks", "post-types", "taxonomies"],
);

/**
 * Define Constants
 */
define("ANU_VERSION", "1.0.0");

define("ANU_ENDEAVOR", "#0064ab");
define("ANU_JADE", "#487F7E");
define("ANU_BAY", "#00A3AA");
define("ANU_AQUA", "#8AC2C8");
define("ANU_ZIGGURAT", "#c2dcdf");
define("ANU_TROUT", "#4f5961");
define("ANU_GULL", "#a2afb9");
define("ANU_GEYSER", "#d7dde2");
define("ANU_FOG", "#f7f8f9");
define("ANU_WHITE", "#ffffff");

/**
 * Add theme colors for Gutenberg
 */
add_theme_support("editor-color-palette", [
  [
    "name" => "Endeavor",
    "slug" => "endeavor",
    "color" => ANU_ENDEAVOR,
  ],
  [
    "name" => "Jade",
    "slug" => "jade",
    "color" => ANU_JADE,
  ],
  [
    "name" => "Bay",
    "slug" => "bay",
    "color" => ANU_BAY,
  ],
  [
    "name" => "Aqua",
    "slug" => "aqua",
    "color" => ANU_AQUA,
  ],
  [
    "name" => "ZigguratT",
    "slug" => "ziggurat",
    "color" => ANU_ZIGGURAT,
  ],
  [
    "name" => "White",
    "slug" => "white",
    "color" => ANU_WHITE,
  ],
  [
    "name" => "Trout",
    "slug" => "trout",
    "color" => ANU_TROUT,
  ],
  [
    "name" => "Gull",
    "slug" => "gull",
    "color" => ANU_GULL,
  ],
  [
    "name" => "Geyser",
    "slug" => "geyser",
    "color" => ANU_GEYSER,
  ],
  [
    "name" => "Fog",
    "slug" => "fog",
    "color" => ANU_FOG,
  ],
]);

/**
 * Asset path helper
 */
function asset_path($path) {
  global $manifest;

  $is_dev = $_SERVER["HTTP_HOST"] == LOCAL_DOMAIN;
  if (!$is_dev):
    if (empty($manifest)):
      $manifest_path = dirname(__FILE__) . "/dist/manifest.json";
      $manifest = file_exists($manifest_path)
        ? json_decode(file_get_contents($manifest_path), true)
        : [];
    endif;
    $filename = pathinfo($path)["basename"];
    $path = $manifest[$filename] ?? $path;
  endif;

  $asset_path = $is_dev
    ? "http://localhost:9000/assets"
    : get_stylesheet_directory_uri();
  return "$asset_path/$path";
}

/**
 * Inline SVG helper
 */

function is_dev($ignore_dist = false) {
  $test_dist = $ignore_dist || !file_exists(dirname(__FILE__) . "/dist/");
  return $_SERVER["HTTP_HOST"] == LOCAL_DOMAIN && $test_dist;
}

function inline_svg($path) {
  $is_dev = is_dev();
  $is_local = is_dev(true /* ignore dist */);
  $asset_path = asset_path($path);
  $svg_path = $is_dev
    ? str_replace("http://localhost:9000", dirname(__FILE__), $asset_path)
    : $asset_path;
  $stream_context = $is_local
    ? stream_context_create([
      "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
      ],
    ])
    : null;
  return file_get_contents($svg_path, false, $stream_context);
}

/**
 * Setup theme
 */
add_action("init", function () {
  add_post_type_support("page", "excerpt");

  /**
   * Enable plugins to manage the document title
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
   */
  add_theme_support("title-tag");

  /**
   * Enable post thumbnails
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support("post-thumbnails");

  /**
   * Enable HTML5 markup support
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
   */
  add_theme_support("html5", [
    "caption",
    "comment-form",
    "comment-list",
    "gallery",
    "search-form",
  ]);

  /**
   * Block editor features
   */
  add_theme_support("align-wide");
  add_theme_support("disable-custom-font-sizes");
  remove_theme_support("core-block-patterns");

  add_theme_support("editor-styles");
  add_editor_style(asset_path("styles/editor.css"));
});

/**
 * Enqueue additional block editor assets
 */
add_action("enqueue_block_editor_assets", "anu_custom_block_styles");
function anu_custom_block_styles($hook) {
  add_editor_style('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
  wp_enqueue_script(
    "anu-editor-js",
    asset_path("scripts/editor.js"),
    ["wp-blocks", "wp-dom"],
    ANU_VERSION,
    true,
  );
}

/**
 * Enqueue styles
 */
add_action("wp_enqueue_scripts", "anu_enqueue_assets", 15);
function anu_enqueue_assets() {
  wp_enqueue_style(
    "anu-css",
    asset_path("styles/main.css"),
    [],
    ANU_VERSION,
    "all",
  );
  wp_enqueue_script(
    "anu-js",
    asset_path("scripts/main.js"),
    ["jquery"],
    ANU_VERSION,
    true,
  );
}

/**
 * Register navigation menus
 */
register_nav_menus([
  "primary_navigation" => __("Primary Navigation", "anu"),
  "footer_navigation" => __("Footer Navigation", "anu"),
]);

/**
 * Adds Reusable Blocks to ACF post types
 */
add_filter("acf/get_post_types", function ($post_types) {
  if (!in_array("wp_block", $post_types)):
    $post_types[] = "wp_block";
  endif;
  return $post_types;
});

/**
 * Create a Custom Category (custom-blocks) and reorder all categories so it is at the top
 * https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#managing-block-categories
 * https://wordpress.org/support/topic/reorder-editor-inserter-blocks/
 */
function custom_block_category($categories, $editor_context) {
	// Make sure a post is provided
	if (!empty($editor_context->post)) {

		// Create new category, Custom
		$custom_category = [
			'slug' => 'custom-blocks',
			'title' => __('Custom Blocks', 'custom-layout' ),
		];

		// Move the Custom category to the top
		$reordered_categories = [];
		$reordered_categories[0] = $custom_category;

		// Rebuild cats array
		foreach($categories as $category) {
			$reordered_categories[] = $category;
		}

		return $reordered_categories;
	}
}
add_filter('block_categories_all', 'custom_block_category', 10, 2);

/**
 * Register Widgets
 */

function anu_widgets_init() {
  register_sidebar([
    "name" => __("Footer column 1", "anu"),
    "id" => "sidebar-1",
    "before_widget" => '<div class="f-logo">',
    "after_widget" => "</div>",
    "before_title" => '<h3 class="widget-title">',
    "after_title" => "</h3>",
  ]);

  register_sidebar([
    "name" => __("Footer column 2", "anu"),
    "id" => "sidebar-2",
    "before_widget" => '<div class="">',
    "after_widget" => "</div>",
    "before_title" => '<h6 class="fw-bold text-uppercase text-gray-700">',
    "after_title" => "</h6>",
  ]);
  register_sidebar([
    "name" => __("Footer column 3", "anu"),
    "id" => "sidebar-3",
    "before_widget" => '<div class="">',
    "after_widget" => "</div>",
    "before_title" => '<h6 class="fw-bold text-uppercase text-gray-700">',
    "after_title" => "</h6>",
  ]);
  register_sidebar([
    "name" => __("Footer column 4", "anu"),
    "id" => "sidebar-4",
    "before_widget" => '<div class="">',
    "after_widget" => "</div>",
    "before_title" => '<h6 class="fw-bold text-uppercase text-gray-700">',
    "after_title" => "</h6>",
  ]);
  register_sidebar([
    "name" => __("Footer column 5", "anu"),
    "id" => "sidebar-5",
    "before_widget" => '<div class="">',
    "after_widget" => "</div>",
    "before_title" => '<h6 class="fw-bold text-uppercase text-gray-700">',
    "after_title" => "</h6>",
  ]);
  register_sidebar([
    "name" => __("Footer column 6", "anu"),
    "id" => "sidebar-6",
    "before_widget" => '<div class="">',
    "after_widget" => "</div>",
    "before_title" => '<h6 class="fw-bold text-uppercase text-gray-700">',
    "after_title" => "</h6>",
  ]);
}

add_action("widgets_init", "anu_widgets_init");

if (function_exists("acf_add_options_page")) {
  acf_add_options_page([
    "page_title" => "Theme General Settings",
    "menu_title" => "Theme Settings",
    "menu_slug" => "theme-general-settings",
    "capability" => "edit_posts",
    "redirect" => false,
  ]);
}


/**
 * Update width of editor to site's max-width for a more reflective editing experience
 * Remove flex added to the editor wrapper
 */
function reset_gutenberg_max_width() {
	echo '
		<style>
			body.block-editor-page .bb-section {
				overflow-x: visible;
			}

			body.block-editor-page .edit-post-visual-editor__post-title-wrapper,
			body.block-editor-page .block-editor-block-list__layout,
			.wp-block-building-blocks-section.bb-section>.bb-container {
				max-width: 1226px;
				margin: 0 auto;
			}

			body.block-editor-page .edit-post-visual-editor__post-title-wrapper .wp-block,
			body.block-editor-page .block-editor-block-list__layout .wp-block {
				max-width: 100%;
			}

      .editor-styles-wrapper {
          overflow-x: hidden;
      }
		</style>
	';
}
add_action('admin_head', 'reset_gutenberg_max_width');
