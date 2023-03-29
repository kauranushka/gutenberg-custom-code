<?php

// Custom Post Types

add_action('init', function () {
	// Testimonials
	register_post_type('testimonial',
		array(
			'labels' => array(
				'name' => __('Testimonials'),
				'singular_name' => __('Testimonial'),
				'add_new' => __('Add New'),
				'add_new_item' => __('Add New Testimonial'),
				'edit' => __('Edit'),
				'edit_item' => __('Edit Testimonial'),
				'view' => __('View'),
				'view_item' => __('View Testimonial'),
				'search_items' => __('Search Testimonials'),
				'all_items' => __('All Testimonials'),
				'not_found' => __('No testimonials found.'),
				'not_found_in_trash' => __('No testimonials found in Trash.'),
			),
			'supports' => array(
				'title', 'editor',
			),
			'has_archive' => false,
			'public' => true,
			'exclude_from_search' => true,
			'menu_icon' => 'dashicons-testimonial',
			'menu_position' => 4
		)
	);
});
