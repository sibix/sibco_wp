<?php
/**
 * Register Custom Post Type for B2B Quote Requests and Inquiries.
 *
 * Ensures all product quotation leads submitted via on-page modals and contact forms
 * are permanently recorded in the database in addition to email dispatch.
 *
 * @package SIBCO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Quote Requests Post Type
 */
function sibco_register_quote_cpt() {
	$labels = array(
		'name'               => _x( 'Quote Requests', 'Post type general name', 'sibco' ),
		'singular_name'      => _x( 'Quote Request', 'Post type singular name', 'sibco' ),
		'menu_name'          => _x( 'Quote Requests', 'Admin Menu text', 'sibco' ),
		'name_admin_bar'     => _x( 'Quote Request', 'Add New on Toolbar', 'sibco' ),
		'all_items'          => __( 'All Quote Requests', 'sibco' ),
		'edit_item'          => __( 'View Quote Request', 'sibco' ),
		'view_item'          => __( 'View Quote Request', 'sibco' ),
		'search_items'       => __( 'Search Quote Requests', 'sibco' ),
		'not_found'          => __( 'No quote requests found.', 'sibco' ),
		'not_found_in_trash' => __( 'No quote requests found in Trash.', 'sibco' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'capabilities'       => array(
			'create_posts' => 'do_not_allow', // Front-end submissions only
		),
		'map_meta_cap'       => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-email-alt2',
		'supports'           => array( 'title' ),
		'show_in_rest'       => false,
	);

	register_post_type( 'sibco_quote', $args );
}
add_action( 'init', 'sibco_register_quote_cpt' );

/**
 * Custom Admin Columns for Quote Requests
 */
function sibco_quote_admin_columns( $columns ) {
	$new_columns = array(
		'cb'          => $columns['cb'],
		'title'       => __( 'Inquiry Subject', 'sibco' ),
		'product'     => __( 'Product of Interest', 'sibco' ),
		'quantity'    => __( 'Quantity / Volume', 'sibco' ),
		'buyer'       => __( 'Buyer Details', 'sibco' ),
		'country'     => __( 'Destination', 'sibco' ),
		'mail_status' => __( 'Email Dispatch', 'sibco' ),
		'date'        => __( 'Date Received', 'sibco' ),
	);
	return $new_columns;
}
add_filter( 'manage_sibco_quote_posts_columns', 'sibco_quote_admin_columns' );

/**
 * Render Content for Custom Admin Columns
 */
function sibco_quote_custom_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'product':
			$prod = get_post_meta( $post_id, '_sibco_product_name', true );
			$cat  = get_post_meta( $post_id, '_sibco_product_category', true );
			if ( ! empty( $prod ) ) {
				echo '<strong>' . esc_html( $prod ) . '</strong>';
				if ( ! empty( $cat ) ) {
					echo '<br><span style="color:#777;font-size:11px;">' . esc_html( $cat ) . '</span>';
				}
			} else {
				echo '<span style="color:#999;">' . esc_html__( 'General Inquiry', 'sibco' ) . '</span>';
			}
			break;

		case 'quantity':
			$qty = get_post_meta( $post_id, '_sibco_quantity', true );
			echo ! empty( $qty ) ? esc_html( $qty ) : '<span style="color:#aaa;">—</span>';
			break;

		case 'buyer':
			$name    = get_post_meta( $post_id, '_sibco_buyer_name', true );
			$email   = get_post_meta( $post_id, '_sibco_buyer_email', true );
			$phone   = get_post_meta( $post_id, '_sibco_buyer_phone', true );
			$company = get_post_meta( $post_id, '_sibco_company', true );

			echo '<strong>' . esc_html( $name ) . '</strong>';
			if ( ! empty( $company ) ) {
				echo '<br><span style="color:#555;font-size:12px;">' . esc_html( $company ) . '</span>';
			}
			if ( ! empty( $email ) ) {
				echo '<br><a href="mailto:' . esc_attr( $email ) . '" style="font-size:11px;">' . esc_html( $email ) . '</a>';
			}
			if ( ! empty( $phone ) ) {
				echo '<br><span style="color:#666;font-size:11px;">' . esc_html( $phone ) . '</span>';
			}
			break;

		case 'country':
			$country = get_post_meta( $post_id, '_sibco_country', true );
			echo ! empty( $country ) ? esc_html( $country ) : '<span style="color:#aaa;">—</span>';
			break;

		case 'mail_status':
			$status     = get_post_meta( $post_id, '_sibco_mail_status', true );
			$recipients = get_post_meta( $post_id, '_sibco_recipients', true );
			if ( 'sent' === $status ) {
				echo '<span style="background:#e6f4ea;color:#137333;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:600;">✓ ' . esc_html__( 'Sent via Email', 'sibco' ) . '</span>';
			} else {
				echo '<span style="background:#fef7e0;color:#b06000;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:600;">ℹ ' . esc_html__( 'Logged (Pending/Local)', 'sibco' ) . '</span>';
			}
			if ( ! empty( $recipients ) ) {
				echo '<br><span style="color:#888;font-size:10px;">To: ' . esc_html( $recipients ) . '</span>';
			}
			break;
	}
}
add_action( 'manage_sibco_quote_posts_custom_column', 'sibco_quote_custom_column_content', 10, 2 );

/**
 * Add Meta Box for Quote Details
 */
function sibco_quote_add_meta_box() {
	add_meta_box(
		'sibco_quote_details',
		__( 'Quote Request & Buyer Specifications', 'sibco' ),
		'sibco_quote_render_meta_box',
		'sibco_quote',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'sibco_quote_add_meta_box' );

/**
 * Render Meta Box Content
 */
function sibco_quote_render_meta_box( $post ) {
	$name       = get_post_meta( $post->ID, '_sibco_buyer_name', true );
	$email      = get_post_meta( $post->ID, '_sibco_buyer_email', true );
	$phone      = get_post_meta( $post->ID, '_sibco_buyer_phone', true );
	$company    = get_post_meta( $post->ID, '_sibco_company', true );
	$country    = get_post_meta( $post->ID, '_sibco_country', true );
	$product    = get_post_meta( $post->ID, '_sibco_product_name', true );
	$category   = get_post_meta( $post->ID, '_sibco_product_category', true );
	$quantity   = get_post_meta( $post->ID, '_sibco_quantity', true );
	$message    = get_post_meta( $post->ID, '_sibco_message', true );
	$status     = get_post_meta( $post->ID, '_sibco_mail_status', true );
	$recipients = get_post_meta( $post->ID, '_sibco_recipients', true );
	$mail_error = get_post_meta( $post->ID, '_sibco_mail_error', true );
	?>
	<style>
		.sibco-quote-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
		.sibco-quote-table th { width: 220px; text-align: left; padding: 10px 14px; background: #f8f9fa; border: 1px solid #e2e4e7; font-size: 13px; font-weight: 600; color: #333; }
		.sibco-quote-table td { padding: 10px 14px; border: 1px solid #e2e4e7; font-size: 13px; color: #222; }
		.sibco-quote-message-box { background: #fafafa; border: 1px solid #e2e4e7; border-radius: 6px; padding: 14px 18px; margin-top: 10px; font-size: 14px; line-height: 1.6; white-space: pre-wrap; }
		.sibco-quote-badge { display: inline-block; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600; }
		.sibco-quote-badge-success { background: #e6f4ea; color: #137333; }
		.sibco-quote-badge-warning { background: #fef7e0; color: #b06000; }
	</style>

	<table class="sibco-quote-table">
		<tr>
			<th><?php esc_html_e( 'Product of Interest', 'sibco' ); ?></th>
			<td><strong style="font-size:15px; color:#1F3025;"><?php echo esc_html( ! empty( $product ) ? $product : __( 'General Catalog Inquiry', 'sibco' ) ); ?></strong></td>
		</tr>
		<?php if ( ! empty( $category ) ) : ?>
		<tr>
			<th><?php esc_html_e( 'Product Category', 'sibco' ); ?></th>
			<td><?php echo esc_html( $category ); ?></td>
		</tr>
		<?php endif; ?>
		<tr>
			<th><?php esc_html_e( 'Requested Quantity / Volume', 'sibco' ); ?></th>
			<td><strong><?php echo esc_html( ! empty( $quantity ) ? $quantity : '—' ); ?></strong></td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Buyer Full Name', 'sibco' ); ?></th>
			<td><?php echo esc_html( $name ); ?></td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Business Work Email', 'sibco' ); ?></th>
			<td>
				<a href="mailto:<?php echo esc_attr( $email ); ?>" style="font-weight:600; text-decoration:underline;">
					<?php echo esc_html( $email ); ?>
				</a>
				<a href="mailto:<?php echo esc_attr( $email ); ?>?subject=<?php echo esc_attr( rawurlencode( 'SIBCO Export Quotation: ' . $product ) ); ?>" class="button button-small" style="margin-left: 10px;">
					✉ <?php esc_html_e( 'Reply via Email', 'sibco' ); ?>
				</a>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Phone / WhatsApp', 'sibco' ); ?></th>
			<td>
				<?php if ( ! empty( $phone ) ) : ?>
					<a href="tel:<?php echo esc_attr( $phone ); ?>" style="font-weight:600;">
						<?php echo esc_html( $phone ); ?>
					</a>
				<?php else : ?>
					<span style="color:#888;">—</span>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Company / Business Name', 'sibco' ); ?></th>
			<td><?php echo esc_html( ! empty( $company ) ? $company : '—' ); ?></td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Destination Country / Port', 'sibco' ); ?></th>
			<td><strong><?php echo esc_html( ! empty( $country ) ? $country : '—' ); ?></strong></td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Email Dispatch Status', 'sibco' ); ?></th>
			<td>
				<?php if ( 'sent' === $status ) : ?>
					<span class="sibco-quote-badge sibco-quote-badge-success">✓ <?php esc_html_e( 'Successfully Dispatched to Email', 'sibco' ); ?></span>
				<?php else : ?>
					<span class="sibco-quote-badge sibco-quote-badge-warning">ℹ <?php esc_html_e( 'Logged in Database (Local environment or SMTP offline)', 'sibco' ); ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $recipients ) ) : ?>
					<div style="margin-top:6px; color:#666; font-size:12px;">
						<strong><?php esc_html_e( 'Target Recipients:', 'sibco' ); ?></strong> <?php echo esc_html( $recipients ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $mail_error ) ) : ?>
					<div style="margin-top:4px; color:#d93025; font-size:12px;">
						<strong><?php esc_html_e( 'Mail Diagnostic:', 'sibco' ); ?></strong> <?php echo esc_html( $mail_error ); ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
	</table>

	<h4 style="margin:20px 0 6px 0; font-size:14px; font-weight:600; color:#333;"><?php esc_html_e( 'Custom Specifications / Notes from Buyer', 'sibco' ); ?></h4>
	<div class="sibco-quote-message-box">
		<?php echo esc_html( ! empty( $message ) ? $message : __( 'No special notes or custom specifications provided.', 'sibco' ) ); ?>
	</div>
	<?php
}

/**
 * Save Quote Submission to Database
 *
 * @param array  $data      Sanitized quote data array.
 * @param bool   $mail_sent Whether wp_mail dispatched successfully.
 * @param string $error_msg Optional error message if mail failed.
 * @return int|WP_Error Post ID on success.
 */
function sibco_save_quote_entry( $data, $mail_sent = false, $error_msg = '' ) {
	$name     = isset( $data['name'] ) ? $data['name'] : '';
	$email    = isset( $data['email'] ) ? $data['email'] : '';
	$product  = isset( $data['product'] ) ? $data['product'] : '';
	$company  = isset( $data['company'] ) ? $data['company'] : '';
	$quantity = isset( $data['quantity'] ) ? $data['quantity'] : '';

	// Build meaningful post title
	if ( ! empty( $product ) ) {
		$title = sprintf( '%s — %s%s', $product, $name, ( ! empty( $company ) ? " ({$company})" : '' ) );
	} else {
		$title = sprintf( 'Export Enquiry — %s%s', $name, ( ! empty( $company ) ? " ({$company})" : '' ) );
	}

	$post_id = wp_insert_post( array(
		'post_type'   => 'sibco_quote',
		'post_status' => 'publish',
		'post_title'  => $title,
	) );

	if ( is_wp_error( $post_id ) ) {
		return $post_id;
	}

	// Save all metadata
	update_post_meta( $post_id, '_sibco_buyer_name', $name );
	update_post_meta( $post_id, '_sibco_buyer_email', $email );
	update_post_meta( $post_id, '_sibco_buyer_phone', isset( $data['phone'] ) ? $data['phone'] : '' );
	update_post_meta( $post_id, '_sibco_company', $company );
	update_post_meta( $post_id, '_sibco_country', isset( $data['country'] ) ? $data['country'] : '' );
	update_post_meta( $post_id, '_sibco_product_name', $product );
	update_post_meta( $post_id, '_sibco_product_category', isset( $data['category'] ) ? $data['category'] : '' );
	update_post_meta( $post_id, '_sibco_quantity', $quantity );
	update_post_meta( $post_id, '_sibco_message', isset( $data['message'] ) ? $data['message'] : '' );
	update_post_meta( $post_id, '_sibco_mail_status', $mail_sent ? 'sent' : 'logged' );
	update_post_meta( $post_id, '_sibco_recipients', isset( $data['recipients'] ) ? implode( ', ', (array) $data['recipients'] ) : '' );
	if ( ! empty( $error_msg ) ) {
		update_post_meta( $post_id, '_sibco_mail_error', $error_msg );
	}

	return $post_id;
}

/**
 * Admin Submenu: Email & SMTP Diagnostics
 */
function sibco_quote_add_submenu_diagnostics() {
	add_submenu_page(
		'edit.php?post_type=sibco_quote',
		__( 'Email & SMTP Settings', 'sibco' ),
		__( 'Email & SMTP Settings', 'sibco' ),
		'manage_options',
		'sibco-quote-email-settings',
		'sibco_quote_render_diagnostics_page'
	);
}
add_action( 'admin_menu', 'sibco_quote_add_submenu_diagnostics' );

/**
 * Render Email & SMTP Diagnostics Page
 */
function sibco_quote_render_diagnostics_page() {
	$notice = '';

	// Handle Test Email Dispatch
	if ( isset( $_POST['sibco_send_test_email'] ) && check_admin_referer( 'sibco_test_email_action', 'sibco_test_nonce' ) ) {
		$test_recipient = isset( $_POST['test_email'] ) ? sanitize_email( wp_unslash( $_POST['test_email'] ) ) : '';
		if ( is_email( $test_recipient ) ) {
			$site_name = get_bloginfo( 'name' );
			$subject   = "[SIBCO Test] Email Delivery Verification - {$site_name}";
			$headers   = array(
				'Content-Type: text/html; charset=UTF-8',
				'From: SIBCO Export Portal <' . esc_attr( get_option( 'admin_email' ) ) . '>',
			);
			$body = '<div style="font-family:sans-serif;padding:24px;background:#f9f9f9;border-radius:10px;">'
				  . '<h2 style="color:#1F3025;margin-top:0;">SIBCO Email System Test Successful</h2>'
				  . '<p style="color:#444;">This email confirms that your WordPress environment and mail sender can successfully dispatch emails to external inboxes.</p>'
				  . '<p style="color:#777;font-size:12px;">Sent at: ' . esc_html( current_time( 'mysql' ) ) . '</p>'
				  . '</div>';

			$last_error = '';
			$error_catcher = function( $err ) use ( &$last_error ) {
				$last_error = $err->get_error_message();
			};
			add_action( 'wp_mail_failed', $error_catcher );

			$sent = wp_mail( $test_recipient, $subject, $body, $headers );
			remove_action( 'wp_mail_failed', $error_catcher );

			if ( $sent ) {
				$notice = '<div class="notice notice-success is-dismissible"><p><strong>' . sprintf( esc_html__( '✓ Test email was successfully dispatched to %s!', 'sibco' ), esc_html( $test_recipient ) ) . '</strong></p></div>';
			} else {
				$msg = ! empty( $last_error ) ? $last_error : __( 'mail() returned false. Please verify your SMTP settings.', 'sibco' );
				$notice = '<div class="notice notice-error"><p><strong>' . sprintf( esc_html__( '✕ Failed to send test email: %s', 'sibco' ), esc_html( $msg ) ) . '</strong></p></div>';
			}
		} else {
			$notice = '<div class="notice notice-error"><p>' . esc_html__( 'Please enter a valid email address.', 'sibco' ) . '</p></div>';
		}
	}

	$opt_quote_email   = function_exists( 'sibco_get_field' ) ? sibco_get_field( 'quote_notification_email', '', 'option' ) : '';
	$opt_contact_email = function_exists( 'sibco_get_field' ) ? sibco_get_field( 'contact_email', '', 'option' ) : '';
	$admin_email       = get_option( 'admin_email' );
	?>
	<div class="wrap">
		<h1 style="margin-bottom: 20px;"><?php esc_html_e( 'SIBCO Product Quote Email Configuration', 'sibco' ); ?></h1>
		<?php echo $notice; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<div style="display:grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 1100px;">
			
			<!-- Current Recipients Card -->
			<div class="card" style="margin: 0; padding: 20px;">
				<h2 style="font-size: 16px; margin-top: 0;"><?php esc_html_e( 'Current Quote Email Recipients', 'sibco' ); ?></h2>
				<p class="description"><?php esc_html_e( 'When a buyer clicks "Send Quote Request" on any product card or submits an inquiry, emails are automatically dispatched to:', 'sibco' ); ?></p>
				<table class="widefat striped" style="margin-top: 15px;">
					<thead>
						<tr>
							<th><?php esc_html_e( 'Source', 'sibco' ); ?></th>
							<th><?php esc_html_e( 'Configured Email', 'sibco' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong><?php esc_html_e( 'Quote Notification Email (ACF)', 'sibco' ); ?></strong></td>
							<td><?php echo ! empty( $opt_quote_email ) ? esc_html( $opt_quote_email ) : '<span style="color:#888;">' . esc_html__( '(Not set - falls back to below)', 'sibco' ) . '</span>'; ?></td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'Primary Contact Email (ACF)', 'sibco' ); ?></strong></td>
							<td><?php echo ! empty( $opt_contact_email ) ? esc_html( $opt_contact_email ) : 'export@sibco.in'; ?></td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'Site Administrator Email (WP)', 'sibco' ); ?></strong></td>
							<td><?php echo esc_html( $admin_email ); ?></td>
						</tr>
					</tbody>
				</table>
				<p style="margin-top: 16px;">
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=acf-options-site-settings' ) ); ?>" class="button button-secondary">
						⚙ <?php esc_html_e( 'Edit Recipients in Site Settings', 'sibco' ); ?>
					</a>
				</p>
			</div>

			<!-- Test Email Dispatcher Card -->
			<div class="card" style="margin: 0; padding: 20px;">
				<h2 style="font-size: 16px; margin-top: 0;"><?php esc_html_e( 'Send a Test Quote Email', 'sibco' ); ?></h2>
				<p class="description"><?php esc_html_e( 'Send a test email directly from this WordPress instance to verify your mail delivery setup.', 'sibco' ); ?></p>
				<form method="post" style="margin-top: 15px;">
					<?php wp_nonce_field( 'sibco_test_email_action', 'sibco_test_nonce' ); ?>
					<table class="form-table" style="margin: 0;">
						<tr>
							<th scope="row" style="padding: 10px 0;"><label for="test_email"><?php esc_html_e( 'Recipient Email:', 'sibco' ); ?></label></th>
							<td style="padding: 10px 0;">
								<input type="email" id="test_email" name="test_email" value="<?php echo esc_attr( $admin_email ); ?>" class="regular-text" required style="width:100%;">
							</td>
						</tr>
					</table>
					<p style="margin-top: 15px;">
						<input type="submit" name="sibco_send_test_email" class="button button-primary" value="<?php esc_attr_e( 'Send Test Email Now', 'sibco' ); ?>">
					</p>
				</form>
			</div>

		</div>

		<!-- SMTP Helper Guidance -->
		<div class="card" style="margin-top: 24px; max-width: 1100px; padding: 20px;">
			<h2 style="font-size: 16px; margin-top: 0;"><?php esc_html_e( 'Setting Up SMTP for 100% Reliable Delivery', 'sibco' ); ?></h2>
			<p>
				<?php esc_html_e( 'On local development (e.g. XAMPP) or servers without local sendmail, WordPress requires SMTP to send live emails to inboxes (like Gmail, Outlook, or corporate domains).', 'sibco' ); ?>
			</p>
			<p>
				<?php esc_html_e( 'You can configure SMTP in two ways:', 'sibco' ); ?>
			</p>
			<ol style="margin-left: 20px; line-height: 1.8;">
				<li>
					<strong><?php esc_html_e( 'Option A: Via wp-config.php (Instant, no extra plugins needed)', 'sibco' ); ?></strong><br>
					<code>define( 'SIBCO_SMTP_HOST', 'smtp.gmail.com' );</code><br>
					<code>define( 'SIBCO_SMTP_PORT', 587 );</code><br>
					<code>define( 'SIBCO_SMTP_USER', 'your-email@gmail.com' );</code><br>
					<code>define( 'SIBCO_SMTP_PASS', 'your-gmail-app-password' );</code><br>
					<code>define( 'SIBCO_SMTP_SECURE', 'tls' );</code>
				</li>
				<li style="margin-top: 10px;">
					<strong><?php esc_html_e( 'Option B: Install any free WordPress SMTP plugin', 'sibco' ); ?></strong><br>
					<?php esc_html_e( 'Install and activate plugins such as WP Mail SMTP, Post SMTP, or FluentSMTP to route all outgoing emails through SendGrid, Amazon SES, Brevo, or Gmail API.', 'sibco' ); ?>
				</li>
			</ol>
			<p style="margin-top: 12px; color: #555; font-size: 13px;">
				ℹ <?php esc_html_e( 'Note: Even if SMTP is temporarily unconfigured or offline on localhost, all quote submissions are permanently saved under "Quote Requests" in this admin dashboard.', 'sibco' ); ?>
			</p>
		</div>
	</div>
	<?php
}
