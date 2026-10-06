<?php
/**
 * Template Name: Contact Page
 *
 * @package SIBCO
 */

get_header();

// Subpage Hero Banner
get_template_part( 'template-parts/page-hero' );

$page_id = get_the_ID();

// ACF Fields
$badge     = sibco_get_field( 'contact_page_badge', 'Contact Us', $page_id );
$title     = sibco_get_field( 'contact_page_title', 'Get in Touch With Our Export Team', $page_id );
$desc      = sibco_get_field( 'contact_page_description', 'Discuss custom specifications, request sample swatches, or receive a formal export quotation.', $page_id );

$email     = sibco_get_field( 'contact_direct_email', sibco_get_field( 'contact_email', 'export@sibco.in', 'option' ), $page_id );
$phone     = sibco_get_field( 'contact_direct_phone', sibco_get_field( 'contact_phone', '+91 XXX XXX XXXX', 'option' ), $page_id );
$location  = sibco_get_field( 'contact_direct_location', sibco_get_field( 'contact_location', 'Kerala, India', 'option' ), $page_id );
$address   = sibco_get_field( 'contact_direct_address', sibco_get_field( 'contact_address', "SIBCO Coir Exports\nIndustrial Estate, Alappuzha\nKerala, India - 688001", 'option' ), $page_id );
$hours     = sibco_get_field( 'contact_office_hours', 'Monday - Saturday: 9:00 AM - 6:00 PM IST (Export desk available 24/7)', $page_id );

// Map Section
$map_badge = sibco_get_field( 'map_badge', 'Global Reach', $page_id );
$map_title = sibco_get_field( 'map_title', 'Trusted by Importers Across Europe & North America', $page_id );
$map_desc  = sibco_get_field( 'map_description', 'Supporting international buyers through reliable export manufacturing while maintaining complete confidentiality of our existing OEM partnerships. Our products reach major markets through established shipping routes and trusted logistics partners.', $page_id );
?>

	<!-- ============ CONTACT INFORMATION & FORM ============ -->
	<section id="contact-info" class="py-24 lg:py-32 bg-cream-50">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<!-- Header -->
			<div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
				<?php if ( ! empty( $badge ) ) : ?>
				<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
					<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
					<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $badge ); ?></span>
				</div>
				<?php endif; ?>

				<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] tracking-tight mb-5">
					<?php echo esc_html( $title ); ?>
				</h2>

				<?php if ( ! empty( $desc ) ) : ?>
				<p class="text-charcoal-400 text-base lg:text-lg leading-relaxed">
					<?php echo esc_html( $desc ); ?>
				</p>
				<?php endif; ?>
			</div>

			<div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-start">
				<!-- Contact Details Column (5 cols) -->
				<div class="lg:col-span-5 space-y-6 animate-left">
					<!-- Email Card -->
					<div class="bg-white rounded-2xl p-6 border border-cream-400 shadow-sm card-hover flex items-start gap-4">
						<div class="w-12 h-12 rounded-xl bg-coir-50 text-coir-600 flex items-center justify-center flex-shrink-0">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
						</div>
						<div>
							<div class="text-charcoal-400 text-xs uppercase tracking-wider font-semibold mb-1"><?php esc_html_e( 'Direct Export Email', 'sibco' ); ?></div>
							<a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-charcoal-800 font-semibold text-lg hover:text-coir-600 transition-colors"><?php echo esc_html( $email ); ?></a>
							<div class="text-charcoal-400 text-xs mt-1"><?php esc_html_e( 'Guaranteed response within 24 hours', 'sibco' ); ?></div>
						</div>
					</div>

					<!-- Phone Card -->
					<div class="bg-white rounded-2xl p-6 border border-cream-400 shadow-sm card-hover flex items-start gap-4">
						<div class="w-12 h-12 rounded-xl bg-coir-50 text-coir-600 flex items-center justify-center flex-shrink-0">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
						</div>
						<div>
							<div class="text-charcoal-400 text-xs uppercase tracking-wider font-semibold mb-1"><?php esc_html_e( 'Phone / WhatsApp', 'sibco' ); ?></div>
							<div class="text-charcoal-800 font-semibold text-lg"><?php echo esc_html( $phone ); ?></div>
							<div class="text-charcoal-400 text-xs mt-1"><?php esc_html_e( 'International calling desk available', 'sibco' ); ?></div>
						</div>
					</div>

					<!-- Factory Location Card -->
					<div class="bg-white rounded-2xl p-6 border border-cream-400 shadow-sm card-hover flex items-start gap-4">
						<div class="w-12 h-12 rounded-xl bg-coir-50 text-coir-600 flex items-center justify-center flex-shrink-0">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
						</div>
						<div>
							<div class="text-charcoal-400 text-xs uppercase tracking-wider font-semibold mb-1"><?php esc_html_e( 'Factory & Office Location', 'sibco' ); ?></div>
							<div class="text-charcoal-800 font-semibold text-base whitespace-pre-line"><?php echo esc_html( $address ); ?></div>
							<div class="text-coir-600 text-xs mt-2 font-medium"><?php echo esc_html( $location ); ?></div>
						</div>
					</div>

					<!-- Hours Card -->
					<div class="bg-cream-100 rounded-2xl p-6 border border-cream-300">
						<div class="text-charcoal-700 font-semibold text-sm mb-1"><?php esc_html_e( 'Operating Hours', 'sibco' ); ?></div>
						<p class="text-charcoal-500 text-xs leading-relaxed"><?php echo esc_html( $hours ); ?></p>
					</div>
				</div>

				<!-- Interactive Quote Form (7 cols) -->
				<div class="lg:col-span-7 animate-right">
					<div class="bg-white rounded-3xl p-8 lg:p-10 border border-cream-400 shadow-lg shadow-charcoal-700/5">
						<h3 class="font-serif text-2xl font-600 text-charcoal-800 mb-2"><?php esc_html_e( 'Request a Custom Export Quote', 'sibco' ); ?></h3>
						<p class="text-charcoal-400 text-sm mb-8"><?php esc_html_e( 'Submit your specifications, dimensions, and estimated volumes for a formal quotation.', 'sibco' ); ?></p>

						<div id="formStatus" class="hidden"></div>

						<form id="sibcoContactForm" class="space-y-5">
							<div class="grid sm:grid-cols-2 gap-5">
								<div>
									<label for="contact_name" class="block text-xs font-semibold uppercase tracking-wider text-charcoal-600 mb-2"><?php esc_html_e( 'Full Name *', 'sibco' ); ?></label>
									<input type="text" id="contact_name" name="name" required class="w-full px-4 py-3 bg-cream-50 border border-cream-400 rounded-xl text-charcoal-800 text-sm focus:outline-none focus:border-coir-500 focus:bg-white transition-all" placeholder="John Doe">
								</div>
								<div>
									<label for="contact_email_input" class="block text-xs font-semibold uppercase tracking-wider text-charcoal-600 mb-2"><?php esc_html_e( 'Work Email *', 'sibco' ); ?></label>
									<input type="email" id="contact_email_input" name="email" required class="w-full px-4 py-3 bg-cream-50 border border-cream-400 rounded-xl text-charcoal-800 text-sm focus:outline-none focus:border-coir-500 focus:bg-white transition-all" placeholder="john@company.com">
								</div>
							</div>

							<div class="grid sm:grid-cols-2 gap-5">
								<div>
									<label for="contact_company" class="block text-xs font-semibold uppercase tracking-wider text-charcoal-600 mb-2"><?php esc_html_e( 'Company Name', 'sibco' ); ?></label>
									<input type="text" id="contact_company" name="company" class="w-full px-4 py-3 bg-cream-50 border border-cream-400 rounded-xl text-charcoal-800 text-sm focus:outline-none focus:border-coir-500 focus:bg-white transition-all" placeholder="Global Imports Ltd.">
								</div>
								<div>
									<label for="contact_country" class="block text-xs font-semibold uppercase tracking-wider text-charcoal-600 mb-2"><?php esc_html_e( 'Destination Country', 'sibco' ); ?></label>
									<input type="text" id="contact_country" name="country" class="w-full px-4 py-3 bg-cream-50 border border-cream-400 rounded-xl text-charcoal-800 text-sm focus:outline-none focus:border-coir-500 focus:bg-white transition-all" placeholder="e.g. Germany, USA, UK">
								</div>
							</div>

							<div class="grid sm:grid-cols-2 gap-5">
								<div>
									<label for="contact_product" class="block text-xs font-semibold uppercase tracking-wider text-charcoal-600 mb-2"><?php esc_html_e( 'Product of Interest', 'sibco' ); ?></label>
									<select id="contact_product" name="product" class="w-full px-4 py-3 bg-cream-50 border border-cream-400 rounded-xl text-charcoal-800 text-sm focus:outline-none focus:border-coir-500 focus:bg-white transition-all">
										<option value="Panama Coir Grill Mat">Rubber Backed Panama Coir Grill Mat</option>
										<option value="Brush Coir Grill Mat">Rubber Backed Brush Coir Grill Mat</option>
										<option value="Brush Coir Mat">Rubber Backed Brush Coir Mat</option>
										<option value="Coir Embossing Mat">Coir Embossing Mat</option>
										<option value="Rubber Grill Mat">Rubber Grill Mat</option>
										<option value="LED Light Mat">Motion Sensor LED Light Mat</option>
										<option value="Custom OEM Solution">Custom OEM / Private Label</option>
									</select>
								</div>
								<div>
									<label for="contact_quantity" class="block text-xs font-semibold uppercase tracking-wider text-charcoal-600 mb-2"><?php esc_html_e( 'Estimated Quantity', 'sibco' ); ?></label>
									<input type="text" id="contact_quantity" name="quantity" class="w-full px-4 py-3 bg-cream-50 border border-cream-400 rounded-xl text-charcoal-800 text-sm focus:outline-none focus:border-coir-500 focus:bg-white transition-all" placeholder="e.g. 5,000 units / 1 FCL">
								</div>
							</div>

							<div>
								<label for="contact_msg" class="block text-xs font-semibold uppercase tracking-wider text-charcoal-600 mb-2"><?php esc_html_e( 'Specifications / Requirements', 'sibco' ); ?></label>
								<textarea id="contact_msg" name="message" rows="4" class="w-full px-4 py-3 bg-cream-50 border border-cream-400 rounded-xl text-charcoal-800 text-sm focus:outline-none focus:border-coir-500 focus:bg-white transition-all" placeholder="Please mention sizes, backing type, private labeling requirements, target port, etc."></textarea>
							</div>

							<button type="submit" class="btn-primary w-full bg-coir-500 hover:bg-coir-600 text-white font-semibold py-4 rounded-xl text-base transition-colors duration-200 flex items-center justify-center gap-2">
								<?php esc_html_e( 'Submit Export Enquiry', 'sibco' ); ?>
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ============ GLOBAL REACH MAP SECTION ============ -->
	<section id="global" class="py-24 lg:py-32 bg-white border-t border-cream-400">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
				<!-- Map SVG -->
				<div class="animate-left relative">
					<div class="bg-cream-50 rounded-2xl border border-cream-400 p-8 lg:p-12 relative overflow-hidden">
						<!-- Simplified SVG World Map -->
						<svg viewBox="0 0 800 400" class="w-full" fill="none" xmlns="http://www.w3.org/2000/svg">
							<!-- Grid lines -->
							<line x1="0" y1="100" x2="800" y2="100" stroke="#E5DDD3" stroke-width="0.5" stroke-dasharray="4 4"/>
							<line x1="0" y1="200" x2="800" y2="200" stroke="#E5DDD3" stroke-width="0.5" stroke-dasharray="4 4"/>
							<line x1="0" y1="300" x2="800" y2="300" stroke="#E5DDD3" stroke-width="0.5" stroke-dasharray="4 4"/>
							<line x1="200" y1="0" x2="200" y2="400" stroke="#E5DDD3" stroke-width="0.5" stroke-dasharray="4 4"/>
							<line x1="400" y1="0" x2="400" y2="400" stroke="#E5DDD3" stroke-width="0.5" stroke-dasharray="4 4"/>
							<line x1="600" y1="0" x2="600" y2="400" stroke="#E5DDD3" stroke-width="0.5" stroke-dasharray="4 4"/>

							<!-- North America -->
							<path d="M80 80 L180 60 L220 80 L240 120 L230 160 L200 180 L180 200 L140 210 L100 190 L70 160 L60 120 Z" fill="#F5F0EB" stroke="#D4C8B8" stroke-width="1"/>
							<!-- South America -->
							<path d="M180 230 L210 220 L230 250 L240 300 L220 340 L190 360 L170 340 L160 290 L165 250 Z" fill="#F5F0EB" stroke="#D4C8B8" stroke-width="1"/>
							<!-- Europe -->
							<path d="M360 70 L420 60 L450 80 L440 110 L420 130 L390 140 L360 130 L350 100 Z" fill="#F5F0EB" stroke="#D4C8B8" stroke-width="1"/>
							<!-- Africa -->
							<path d="M370 160 L420 150 L450 180 L460 240 L440 300 L410 320 L380 310 L360 270 L350 210 Z" fill="#F5F0EB" stroke="#D4C8B8" stroke-width="1"/>
							<!-- Asia -->
							<path d="M460 60 L560 50 L640 70 L680 110 L670 160 L640 190 L580 200 L520 190 L480 160 L460 120 Z" fill="#F5F0EB" stroke="#D4C8B8" stroke-width="1"/>
							<!-- India (highlighted) -->
							<path d="M550 140 L580 130 L600 150 L595 190 L575 210 L555 200 L545 170 Z" fill="#E0CFB0" stroke="#A67C2E" stroke-width="1.5"/>
							<!-- Australia -->
							<path d="M600 280 L660 270 L700 290 L690 320 L650 330 L610 320 L595 300 Z" fill="#F5F0EB" stroke="#D4C8B8" stroke-width="1"/>

							<!-- Export lines from India -->
							<line x1="570" y1="155" x2="400" y2="100" stroke="#A67C2E" stroke-width="1" stroke-dasharray="4 4" opacity="0.5"/>
							<line x1="570" y1="155" x2="160" y2="130" stroke="#A67C2E" stroke-width="1" stroke-dasharray="4 4" opacity="0.5"/>

							<!-- India dot -->
							<circle cx="570" cy="155" r="6" fill="#A67C2E"/>
							<circle cx="570" cy="155" r="12" fill="#A67C2E" opacity="0.2" class="map-dot-ping"/>

							<!-- Europe dot -->
							<circle cx="400" cy="100" r="5" fill="#A67C2E"/>
							<circle cx="400" cy="100" r="10" fill="#A67C2E" opacity="0.2" class="map-dot-ping" style="animation-delay: 0.5s"/>

							<!-- US dot -->
							<circle cx="160" cy="130" r="5" fill="#A67C2E"/>
							<circle cx="160" cy="130" r="10" fill="#A67C2E" opacity="0.2" class="map-dot-ping" style="animation-delay: 1s"/>

							<!-- Labels -->
							<text x="380" y="88" fill="#A67C2E" font-size="11" font-weight="600" font-family="Plus Jakarta Sans">EUROPE</text>
							<text x="120" y="118" fill="#A67C2E" font-size="11" font-weight="600" font-family="Plus Jakarta Sans">USA</text>
							<text x="555" y="230" fill="#8B6914" font-size="10" font-weight="600" font-family="Plus Jakarta Sans">INDIA</text>
						</svg>
					</div>
				</div>

				<!-- Global Reach Text -->
				<div class="animate-right">
					<?php if ( ! empty( $map_badge ) ) : ?>
					<div class="inline-flex items-center gap-2 bg-coir-50 border border-coir-200 rounded-full px-4 py-1.5 mb-6">
						<span class="w-1.5 h-1.5 bg-coir-500 rounded-full"></span>
						<span class="text-coir-700 text-xs font-semibold tracking-wider uppercase"><?php echo esc_html( $map_badge ); ?></span>
					</div>
					<?php endif; ?>

					<h2 class="font-serif text-3xl lg:text-4xl xl:text-5xl font-600 text-charcoal-800 leading-[1.15] tracking-tight mb-6">
						<?php echo esc_html( $map_title ); ?>
					</h2>

					<p class="text-charcoal-400 text-base leading-relaxed mb-8">
						<?php echo esc_html( $map_desc ); ?>
					</p>

					<!-- Stats Grid -->
					<div class="grid grid-cols-2 gap-6">
						<?php
						if ( function_exists( 'have_rows' ) && have_rows( 'map_stats', $page_id ) ) :
							while ( have_rows( 'map_stats', $page_id ) ) :
								the_row();
								$sval = get_sub_field( 'stat_value' );
								$slbl = get_sub_field( 'stat_label' );
								?>
								<div class="bg-cream-50 rounded-xl border border-cream-400 p-6">
									<div class="text-coir-600 font-bold text-3xl font-serif"><?php echo esc_html( $sval ); ?></div>
									<div class="text-charcoal-400 text-sm font-medium mt-1"><?php echo esc_html( $slbl ); ?></div>
								</div>
								<?php
							endwhile;
						else :
							?>
							<div class="bg-cream-50 rounded-xl border border-cream-400 p-6">
								<div class="text-coir-600 font-bold text-3xl font-serif">26</div>
								<div class="text-charcoal-400 text-sm font-medium mt-1"><?php esc_html_e( 'Years of Export', 'sibco' ); ?></div>
							</div>
							<div class="bg-cream-50 rounded-xl border border-cream-400 p-6">
								<div class="text-coir-600 font-bold text-3xl font-serif">1000s</div>
								<div class="text-charcoal-400 text-sm font-medium mt-1"><?php esc_html_e( 'Shipments Delivered', 'sibco' ); ?></div>
							</div>
							<div class="bg-cream-50 rounded-xl border border-cream-400 p-6">
								<div class="text-coir-600 font-bold text-3xl font-serif">2</div>
								<div class="text-charcoal-400 text-sm font-medium mt-1"><?php esc_html_e( 'Major Export Markets', 'sibco' ); ?></div>
							</div>
							<div class="bg-cream-50 rounded-xl border border-cream-400 p-6">
								<div class="text-coir-600 font-bold text-3xl font-serif">100%</div>
								<div class="text-charcoal-400 text-sm font-medium mt-1"><?php esc_html_e( 'Reliable Supply Chain', 'sibco' ); ?></div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Reusable Trust Bar -->
	<?php get_template_part( 'template-parts/trust-bar' ); ?>

	<!-- Reusable Bottom CTA -->
	<?php get_template_part( 'template-parts/cta-banner' ); ?>

<?php
get_footer();
