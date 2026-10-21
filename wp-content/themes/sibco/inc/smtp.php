<?php
/**
 * SMTP and PHPMailer Configuration for SIBCO
 *
 * Ensures proper sender headers, prevents localhost sender errors,
 * and enables optional SMTP routing via wp-config.php constants or ACF settings.
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configure PHPMailer for Outgoing Emails
 *
 * @param PHPMailer\PHPMailer\PHPMailer $phpmailer The PHPMailer instance.
 */
function sibco_configure_phpmailer( $phpmailer ) {
	// 1. Ensure From Email is valid and RFC compliant (avoids 'wordpress@localhost' failure)
	$admin_email = get_option( 'admin_email' );
	$from_email  = ! empty( $admin_email ) && is_email( $admin_email ) ? $admin_email : 'export@sibco.in';

	// If From is invalid or contains localhost, replace with valid email
	if ( empty( $phpmailer->From ) || ! filter_var( $phpmailer->From, FILTER_VALIDATE_EMAIL ) || false !== strpos( $phpmailer->From, '@localhost' ) ) {
		$phpmailer->From     = $from_email;
		$phpmailer->FromName = get_bloginfo( 'name' );
	}

	// 2. Check wp-config.php constants first
	if ( defined( 'SIBCO_SMTP_HOST' ) && ! empty( SIBCO_SMTP_HOST ) ) {
		$phpmailer->isSMTP();
		$phpmailer->Host       = SIBCO_SMTP_HOST;
		$phpmailer->SMTPAuth   = true;
		$phpmailer->Port       = defined( 'SIBCO_SMTP_PORT' ) ? intval( SIBCO_SMTP_PORT ) : 587;
		$phpmailer->Username   = defined( 'SIBCO_SMTP_USER' ) ? SIBCO_SMTP_USER : '';
		$phpmailer->Password   = defined( 'SIBCO_SMTP_PASS' ) ? SIBCO_SMTP_PASS : '';
		$phpmailer->SMTPSecure = defined( 'SIBCO_SMTP_SECURE' ) ? SIBCO_SMTP_SECURE : 'tls';
		return;
	}

	// 3. Check ACF Site Settings for Custom SMTP
	if ( function_exists( 'sibco_get_field' ) ) {
		$enable_smtp = sibco_get_field( 'enable_custom_smtp', false, 'option' );
		if ( $enable_smtp ) {
			$host = sibco_get_field( 'smtp_host', '', 'option' );
			$user = sibco_get_field( 'smtp_user', '', 'option' );
			$pass = sibco_get_field( 'smtp_pass', '', 'option' );
			$port = sibco_get_field( 'smtp_port', 587, 'option' );
			$enc  = sibco_get_field( 'smtp_encryption', 'tls', 'option' );

			if ( ! empty( $host ) && ! empty( $user ) ) {
				$phpmailer->isSMTP();
				$phpmailer->Host       = $host;
				$phpmailer->SMTPAuth   = true;
				$phpmailer->Port       = intval( $port );
				$phpmailer->Username   = $user;
				$phpmailer->Password   = $pass;
				$phpmailer->SMTPSecure = $enc;
			}
		}
	}
}
add_action( 'phpmailer_init', 'sibco_configure_phpmailer' );

/**
 * Filter wp_mail_from to always ensure a valid email address is used
 */
function sibco_fix_wp_mail_from( $from_email ) {
	if ( empty( $from_email ) || false !== strpos( $from_email, '@localhost' ) || ! filter_var( $from_email, FILTER_VALIDATE_EMAIL ) ) {
		$admin = get_option( 'admin_email' );
		if ( ! empty( $admin ) && filter_var( $admin, FILTER_VALIDATE_EMAIL ) && false === strpos( $admin, '@localhost' ) ) {
			return $admin;
		}
		return 'export@sibco.in';
	}
	return $from_email;
}
add_filter( 'wp_mail_from', 'sibco_fix_wp_mail_from', 999 );

/**
 * Filter wp_mail_from_name to use site name
 */
function sibco_fix_wp_mail_from_name( $from_name ) {
	if ( empty( $from_name ) || 'WordPress' === $from_name ) {
		return get_bloginfo( 'name' );
	}
	return $from_name;
}
add_filter( 'wp_mail_from_name', 'sibco_fix_wp_mail_from_name', 999 );
