<?php
/**
 * This file adds the Home Page to the Altitude Pro Theme.
 *
 * @author StudioPress
 * @package Altitude
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'altitude_front_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function altitude_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) || is_active_sidebar( 'front-page-5' ) || is_active_sidebar( 'front-page-6' ) || is_active_sidebar( 'front-page-7' ) ) {

		//* Enqueue scripts
		add_action( 'wp_enqueue_scripts', 'altitude_enqueue_altitude_script' );
		function altitude_enqueue_altitude_script() {

			wp_enqueue_script( 'altitude-script', get_bloginfo( 'stylesheet_directory' ) . '/js/home.js', array( 'jquery' ), '1.0.0' );
			wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
			wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );

		}

		//* Add front-page body class
		add_filter( 'body_class', 'altitude_body_class' );
		function altitude_body_class( $classes ) {

   			$classes[] = 'front-page';
  			return $classes;

		}

		//* Force full width content layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add homepage widgets
		add_action( 'genesis_loop', 'altitude_front_page_widgets' );

		//* Add featured-section body class
		if ( is_active_sidebar( 'front-page-1' ) ) {

			//* Add image-section-start body class
			add_filter( 'body_class', 'altitude_featured_body_class' );
			function altitude_featured_body_class( $classes ) {

				$classes[] = 'featured-section';				
				return $classes;

			}

		}

	}

}

//* Add markup for front page widgets
function altitude_front_page_widgets() {

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div id="front-page-1" class="front-page-1"><div class="image-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-1' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );  ?>

<div class="front-page-2" id="front-page-2">
	<div class="solid-section">
		<div class="flexible-widgets widget-area widget-full">
			<div class="container">
				
					<div class="row">
						<h4 class="widget-title widgettitle">What would you like to do?</h4>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/Luxury_Experiences.png">
							</a>
									
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/Proposal_Experiences.png">
							</a>
									
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/ROMANCE_AT_HOME_EXPERIENCES.png">
							</a>
									
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/Romantic_Adventures.png">
							</a>
									
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/Romantic_Cruises.png">
							</a>
									
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/Romantic_Day_Experiences.png">
							</a>
									
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/Romantic_Dinners.png">
							</a>
									
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/Romantic_Holiday.png">
							</a>
									
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<a class="hvr-pulse-grow" href="javascript:;">
								<img class="heart_img" alt=""
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/Romantic_Weekends.png">
							</a>
									
						</div>
					</div>
			
			</div>
		</div>
	</div>
</div>
<?php

	genesis_widget_area( 'front-page-3', array(
		'before' => '<div id="front-page-3" class="front-page-3"><div class="image-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-3' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-4', array(
		'before' => '<div id="front-page-4" class="front-page-4"><div class="solid-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-4' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-5', array(
		'before' => '<div id="front-page-5" class="front-page-5"><div class="image-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-5' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-6', array(
		'before' => '<div id="front-page-6" class="front-page-6"><div class="solid-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-6' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-7', array(
		'before' => '<div id="front-page-7" class="front-page-7"><div class="image-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-7' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

}

include_once "theme_footer.php";

genesis();
