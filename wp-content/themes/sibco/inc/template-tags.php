<?php
/**
 * Custom template tags and helper functions for SIBCO theme.
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Safely retrieve ACF field value with a fallback.
 *
 * @param string $field_name ACF Field Name.
 * @param mixed  $fallback   Default fallback value if ACF field is empty or ACF not active.
 * @param mixed  $post_id    Post ID or 'option'. Defaults to current post.
 * @return mixed
 */
function sibco_get_field( $field_name, $fallback = '', $post_id = false ) {
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $field_name, $post_id );
		if ( ! empty( $val ) ) {
			return $val;
		}
	}
	return $fallback;
}

/**
 * Echoes ACF field with fallback and escaping.
 *
 * @param string $field_name ACF Field Name.
 * @param string $fallback   Default fallback value.
 * @param mixed  $post_id    Post ID.
 */
function sibco_the_field( $field_name, $fallback = '', $post_id = false ) {
	echo esc_html( sibco_get_field( $field_name, $fallback, $post_id ) );
}

/**
 * Safely retrieve image URL from ACF image field (which might be array, int ID, or string URL).
 *
 * @param mixed  $image_field ACF image field value.
 * @param string $fallback_url Fallback URL.
 * @param string $size         Image size (e.g., 'full', 'large').
 * @return string
 */
function sibco_get_image_url( $image_field, $fallback_url = '', $size = 'full' ) {
	if ( empty( $image_field ) ) {
		return $fallback_url;
	}

	if ( is_array( $image_field ) ) {
		if ( isset( $image_field['sizes'][ $size ] ) ) {
			return $image_field['sizes'][ $size ];
		}
		if ( isset( $image_field['url'] ) ) {
			return $image_field['url'];
		}
	}

	if ( is_numeric( $image_field ) ) {
		$url = wp_get_attachment_image_url( (int) $image_field, $size );
		if ( $url ) {
			return $url;
		}
	}

	if ( is_string( $image_field ) ) {
		return $image_field;
	}

	return $fallback_url;
}

/**
 * Safely retrieve image alt text from ACF image field.
 *
 * @param mixed  $image_field ACF image field value.
 * @param string $fallback_alt Fallback alt text.
 * @return string
 */
function sibco_get_image_alt( $image_field, $fallback_alt = '' ) {
	if ( is_array( $image_field ) && ! empty( $image_field['alt'] ) ) {
		return $image_field['alt'];
	}

	if ( is_numeric( $image_field ) ) {
		$alt = get_post_meta( (int) $image_field, '_wp_attachment_image_alt', true );
		if ( ! empty( $alt ) ) {
			return $alt;
		}
	}

	return $fallback_alt;
}

/**
 * Render custom logo or site name fallback.
 */
function sibco_custom_logo() {
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo();
	} else {
		$home_url = esc_url( home_url( '/' ) );
		$site_title = esc_html( get_bloginfo( 'name' ) );
		if ( empty( $site_title ) || 'WordPress' === $site_title ) {
			$site_title = 'SIBCO';
		}
		echo '<a href="' . $home_url . '" class="nav-logo text-white font-bold text-2xl tracking-tight transition-colors duration-300">' . $site_title . '</a>';
	}
}
