<?php
/**
 * Register Custom Post Types and Taxonomies for SIBCO
 *
 * Provides native WordPress catalog management without ACF Pro repeaters or WooCommerce bloat.
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Products Custom Post Type and Product Categories Taxonomy.
 */
function sibco_register_product_cpt() {
	// 1. Register Taxonomy: Product Categories (product_cat)
	$taxonomy_labels = array(
		'name'              => _x( 'Product Categories', 'taxonomy general name', 'sibco' ),
		'singular_name'     => _x( 'Product Category', 'taxonomy singular name', 'sibco' ),
		'search_items'      => __( 'Search Categories', 'sibco' ),
		'all_items'         => __( 'All Categories', 'sibco' ),
		'parent_item'       => __( 'Parent Category', 'sibco' ),
		'parent_item_colon' => __( 'Parent Category:', 'sibco' ),
		'edit_item'         => __( 'Edit Category', 'sibco' ),
		'update_item'       => __( 'Update Category', 'sibco' ),
		'add_new_item'      => __( 'Add New Category', 'sibco' ),
		'new_item_name'     => __( 'New Category Name', 'sibco' ),
		'menu_name'         => __( 'Categories', 'sibco' ),
	);

	$taxonomy_args = array(
		'hierarchical'      => true,
		'labels'            => $taxonomy_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'         => 'product-category',
			'with_front'   => false,
			'hierarchical' => true,
		),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'product_cat', array( 'sibco_product' ), $taxonomy_args );

	// 2. Register Post Type: Products (sibco_product)
	$cpt_labels = array(
		'name'                  => _x( 'Products', 'Post type general name', 'sibco' ),
		'singular_name'         => _x( 'Product', 'Post type singular name', 'sibco' ),
		'menu_name'             => _x( 'Products', 'Admin Menu text', 'sibco' ),
		'name_admin_bar'        => _x( 'Product', 'Add New on Toolbar', 'sibco' ),
		'add_new'               => __( 'Add New', 'sibco' ),
		'add_new_item'          => __( 'Add New Product', 'sibco' ),
		'new_item'              => __( 'New Product', 'sibco' ),
		'edit_item'             => __( 'Edit Product', 'sibco' ),
		'view_item'             => __( 'View Product', 'sibco' ),
		'all_items'             => __( 'All Products', 'sibco' ),
		'search_items'          => __( 'Search Products', 'sibco' ),
		'parent_item_colon'     => __( 'Parent Products:', 'sibco' ),
		'not_found'             => __( 'No products found.', 'sibco' ),
		'not_found_in_trash'    => __( 'No products found in Trash.', 'sibco' ),
	);

	$cpt_args = array(
		'labels'             => $cpt_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array(
			'slug'       => 'product',
			'with_front' => false,
		),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-products',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'sibco_product', $cpt_args );
}
add_action( 'init', 'sibco_register_product_cpt', 0 );

/**
 * Redirect single product views to the category products page.
 * Keeps quote capture and browsing consolidated on the category listing page.
 */
function sibco_redirect_single_product_view() {
	if ( is_singular( 'sibco_product' ) ) {
		$terms = get_the_terms( get_the_ID(), 'product_cat' );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			$category = reset( $terms );
			wp_safe_redirect( get_term_link( $category ), 301 );
			exit;
		}
		wp_safe_redirect( home_url( '/products/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'sibco_redirect_single_product_view' );
