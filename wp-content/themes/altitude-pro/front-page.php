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
	) );

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2"><div class="solid-section"><div class="flexible-widgets widget-area' . altitude_widget_area_class( 'front-page-2' ) . '"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

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

// changed by Jack
//remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

remove_action( 'genesis_footer', 'genesis_do_footer' );

remove_action( 'genesis_footer', 'rainmaker_footer_menu', 7 );

add_action( 'genesis_footer', 'romantic_widget_footer' );

function romantic_widget_footer(){ ?>

	<div class="container">

		<div class="row visible-xs">
			<div class="col-lg-12">
				<a href="javascript:;" class="expand-footer"></a>
			</div>
		</div>

		<div class="row hidden-xs footer-widgets">

			<div class="col-sm-3">
				<div class="sidebar widget_text text-5">
					<h3>Customer Service</h3>
					<div class="textwidget">
						<ul id="menu-help" class="menu">
							<li id="menu-item-387"
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-387"><a
								href="javascript:;">
									1300 766 000</a></li>
							<li id="menu-item-385"
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-385"><a
								href="javascript:;">
									Contact Us</a></li>
							<li id="menu-item-386"
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-386"><a
								href="javascript:;">
									FAQ's</a></li>
							<li id="menu-item-388"
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-388"><a
								href="javascript:;">
									Live Chat</a></li>
<!-- 							<li id="menu-item-385" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-385"><a -->
<!-- 								href="https://originalthreads.com.au/product-category/womens/hoodies/">Womens -->
<!-- 									Hoodies </a></li> -->
<!-- 							<li id="menu-item-388" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-388"><a -->
<!-- 								href="https://originalthreads.com.au/product-category/accessories/">Accessories</a></li> -->
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="sidebar widget_text text-2">
					<h3>My Account</h3>
					<div class="textwidget">
						<ul id="menu-help" class="menu">
							<li id="menu-item-387"
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-387"><a
								href="javascript:;">Account Login</a></li>
							<li id="menu-item-385"
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-385"><a
								href="javascript:;">Sign Up</a></li>
							<li id="menu-item-386"
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-386"><a
								href="javascript:;">My Orders</a></li>
<!-- 							<li id="menu-item-388" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-388"><a -->
<!-- 								href="https://originalthreads.com.au/contact/">Contact Us</a></li> -->
<!-- 							<li id="menu-item-385" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-385"><a -->
<!-- 								href="https://originalthreads.com.au/apparel-printing/">Apparel -->
<!-- 									Printing</a></li> -->
<!-- 							<li id="menu-item-388" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-388"><a -->
<!-- 								href="https://originalthreads.com.au/wholesale/"><i -->
<!-- 									class="fa fa-cubes"></i> Wholesale</a></li> -->
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="sidebar widget_text text-2">
					<h3>The Romantic Group</h3>
					<div class="textwidget">
						<ul id="menu-help" class="menu">
							<li 
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-387"><a
								href="javascript:;">Romantic Travel</a></li>
							<li 
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-385"><a
								href="javascript:;">Send Hugs & Kisses</a></li>
							<li 
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-386"><a
								href="javascript:;">Romantic Ideas</a></li>
							<li 
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-388"><a
								href="javascript:;">Romantic Experiences</a></li>
<!-- 							<li id="menu-item-385" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-385"><a -->
<!-- 								href="https://originalthreads.com.au/apparel-printing/">Apparel -->
<!-- 									Printing</a></li> -->
<!-- 							<li id="menu-item-388" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-388"><a -->
<!-- 								href="https://originalthreads.com.au/wholesale/"><i -->
<!-- 									class="fa fa-cubes"></i> Wholesale</a></li> -->
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="sidebar widget_text text-2">
					<h3>Suppliers</h3>
					<div class="textwidget">
						<ul id="menu-help" class="menu">
							<li 
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-387"><a
								href="javascript:;">Become a Supplier</a></li>
							<li 
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-385"><a
								href="javascript:;">Supplier Login</a></li>
							<li 
								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-386"><a
								href="javascript:;">About Suppliers</a></li>
<!-- 							<li  -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-388"><a -->
<!-- 								href="javascript:;">Romantic Experiences</a></li> -->
<!-- 							<li id="menu-item-385" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-385"><a -->
<!-- 								href="https://originalthreads.com.au/apparel-printing/">Apparel -->
<!-- 									Printing</a></li> -->
<!-- 							<li id="menu-item-388" -->
<!-- 								class="menu-item menu-item-type-custom menu-item-object-custom menu-item-388"><a -->
<!-- 								href="https://originalthreads.com.au/wholesale/"><i -->
<!-- 									class="fa fa-cubes"></i> Wholesale</a></li> -->
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="sidebar widget_text text-3">
					<h3>Follow us!</h3>
					<div class="textwidget">
						<a href="javascript:;">
						<span class="fa-stack fa-lg">
  							<i class="fa fa-circle fa-stack-2x"></i>
  							<i class="fa fa-facebook fa-stack-1x follow-us-icon-color"></i>
						</span>
						</a>
					</div>
					<div class="textwidget">
						<a href="javascript:;">
						<span class="fa-stack fa-lg">
  							<i class="fa fa-circle fa-stack-2x"></i>
  							<i class="fa fa-twitter fa-stack-1x follow-us-icon-color"></i>
						</span>
						</a>
					</div>
					<div class="textwidget">
						<a href="javascript:;">
						<span class="fa-stack fa-lg">
  							<i class="fa fa-circle fa-stack-2x"></i>
  							<i class="fa fa-instagram fa-stack-1x follow-us-icon-color"></i>
						</span>
						</a>
					</div>
					<div class="textwidget">
						<a href="javascript:;">
						<span class="fa-stack fa-lg">
  							<i class="fa fa-circle fa-stack-2x"></i>
  							<i class="fa fa-linkedin fa-stack-1x follow-us-icon-color"></i>
						</span>
						</a>
					</div>
				</div>
			</div>

		</div>

		<div class="footer-bottom">

			<div class="row">
				<div class="col-md-12">Copyright © 2015 · THE ROMANTIC GROUP™ · T&C · PRIVACY POLICY</div>
			</div>

		</div>
	</div>

<?php }

add_action ( 'wp_footer', 'romantic_custom_after_footer', 100 );

function romantic_custom_after_footer() {
	?>
<script type="text/javascript">
    jQuery(document).ready(function($){

		// Footer Expand
		$(".site-footer").find('.expand-footer').on('click', function(ev)
		{
			ev.preventDefault();
			$(".site-footer").find('.footer-widgets').children().removeClass("col-sm-3");

			$(".site-footer").find('.footer-widgets').removeClass('hidden-xs').prev().removeClass('visible-xs').addClass('hidden');
		});


    });


</script>



<?php
}

genesis();
