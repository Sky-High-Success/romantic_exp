<?php
/**
 * Template name: Supplier Log In
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage classiads
 * @since classiads 1.2.2
 */

/*
Template Name: Landing
*/


if ( is_user_logged_in() ) {

	wp_redirect(get_home_url());
	exit();
}

if(isset($_POST['type_hidden']) && $_POST['type_hidden'] == "login" && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	$email = esc_sql ( isset ( $_REQUEST ['login_email'] ) ? $_REQUEST ['login_email'] : '' );
	$password = esc_sql ( isset ( $_REQUEST ['login_password'] ) ? $_REQUEST ['login_password'] : '' );
	$remember = esc_attr(strip_tags($_POST['remember_me']));

	if ($remember)
		$remember = true;
	else
		$remember = false;

	$creds = array();
	$creds['user_login'] = $email;
	$creds['user_password'] = $password;
	$creds['remember'] = $remember;

	global $login_user;
	$login_user = wp_signon( $creds, false );
	
	if ( !is_wp_error($login_user) ){
		wp_redirect(get_home_url());
		exit();
	}

}

add_action ( 'wp_enqueue_scripts', 'login_pre' );
function login_pre() {
	// Template	
	wp_enqueue_style ( 'Boxes-style', get_stylesheet_directory_uri () . '/css/Boxes.css', array (), '1' );
	
	wp_enqueue_style( 'material-style', get_stylesheet_directory_uri() . '/css/material.min.css', array('bootstrap3-style'), '1' );
	wp_enqueue_style( 'ripples-style', get_stylesheet_directory_uri() . '/css/ripples.min.css', array('material-style'), '1' );
	
	
	wp_enqueue_style( 'login-style', get_stylesheet_directory_uri() . '/css/login.css', array('ripples-style'), '1' );
	
	wp_enqueue_script( 'material-js', get_stylesheet_directory_uri() . '/js/material.min.js', array( 'bootstrap3-js' ), '2014-07-18', true );	
	
	wp_enqueue_script( 'ripples-js', get_stylesheet_directory_uri() . '/js/ripples.min.js', array( 'bootstrap3-js' ), '2014-07-18', true );

	// Loads JavaScript file with functionality specific to classiads.

}


// Add custom body class to the head
add_filter( 'body_class', 'altitude_add_body_class' );
function altitude_add_body_class( $classes ) {

   $classes[] = 'featured-section';
   return $classes;
   
}

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

//* Remove site header elements
// remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
// remove_action( 'genesis_header', 'genesis_do_header' );
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

//* Remove navigation
remove_action( 'genesis_header', 'genesis_do_nav', 12 );
remove_action( 'genesis_header', 'genesis_do_subnav', 5 );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove site footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Remove site footer elements
//remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
//remove_action( 'genesis_footer', 'genesis_do_footer' );
//remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );


remove_action ( 'genesis_post_content', 'genesis_do_post_content' );
remove_action ( 'genesis_entry_content', 'genesis_do_post_content' );

add_action ( 'genesis_post_content', 'romantic_page_content' );
add_action ( 'genesis_entry_content', 'romantic_page_content' );

function romantic_page_content(){ ?>

<div class="login-container container">
	<div class="row">
		<div
			class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-12 col-lg-offset-1 col-lg-10">
			<div class="box">
				<div class="box-icon">
					<span class="fa fa-4x fa-lock"></span>
				</div>
				<div class="info">

					<!-- Form -->
					<form role="form" id="loginform" action="" method="post"
						class="form-signin">
						<div class="row">
							<div class="col-md-6 column-1">
								<h4 class="text-center text-warning">Login</h4>
								
								<?php 
								global $login_user;
								if ( is_wp_error($login_user) ){
									    echo '<div class="form-group has-warning text-center">';
										echo $login_user->get_error_message();
										echo '</div>';
								}?>

								<div class="form-group has-warning">

									<input type="text" required="" id="userid" name="login_email"
										placeholder="ENTER YOUR USER ID (EMAIL)"
										class="form-control form-input empty">



								</div>
								<div class="form-group has-warning">

									<input type="password" id="password"
										placeholder="ENTER PASSWORD" required="" name="login_password"
										class="form-control form-input empty">

								</div>

								<div class="form-group has-warning item-group-2">
									<div class="form-control-wrapper">
										<div class="row">
											<div class="checkbox col-sm-6">
												<label> <input type="checkbox" name="remember_me"
													value="remember_me"> Remember Me
												</label>
											</div>

											<div class="col-sm-6 forget-password">
												<a class="" href="#"> Forgot your password?</a>
											</div>
										</div>

									</div>
								</div>

								<div class="form-group has-warning">

									<input type="hidden" name="type_hidden" value="login">
											  
  	             					<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
								
									<button id="loginbtn" type="submit"
										class="btn btn-warning center-block">Sign in</button>
								</div>

								<div class="form-group has-warning">

									<p class="switch-forms text-center">
										<span id="switch-form-login"> Not registered with Romantic
											Experience? <a class="pointer">Register
												now</a>
										</span>
									</p>
								</div>

							</div>
							<div class="col-md-6 login-form-border column-2">

								<h4 class="text-center text-warning social-text">Social</h4>

								<div class="form-group has-warning">
									<a
										class="btn social-login-button social-login-button-facebook c-rounded-corners5 center-block"
										href="<?php echo wp_login_url( get_home_url()); ?>&action=wordpress_social_authenticate&provider=Facebook"
										id="loginFacebookButton"> <span class="social-login-icon"><i
											class="fa fa-facebook"></i></span> <span
										class="social-login-text"><span class="login-text c-hide"><span
												class="link-text">Sign in with </span><span class="link">Facebook</span></span></span>
									</a>
								</div>

								<div class="form-group has-warning">
									<a
										class="btn social-login-button social-login-button-google c-rounded-corners5 center-block"
										href="<?php echo wp_login_url( get_home_url());?>&action=wordpress_social_authenticate&provider=Google"
										id="loginGoogleButton"> <span class="social-login-icon"><i
											class="fa fa-google-plus"></i></span> <span
										class="social-login-text"> <span class="login-text c-hide"> <span
												class="link-text">Sign in with </span> <span class="link">Google</span>
										</span>
									</span>
									</a>
								</div>

							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
}

add_action ( 'wp_footer', 'romantic_custom_after_footer_login', 100 );
function romantic_custom_after_footer_login() {
	?>

<script>

jQuery(document).ready(function ($) {

	$.material.init();

	$(".login-container .box-icon").addClass("animated rubberBand");
	$("#loginform h4").addClass("animated rubberBand");

	$("#loginform .column-2 .form-group ").addClass("animated slideInRight");

	$("#loginform .column-1 .form-group").addClass("animated slideInLeft");
	//$(".ads-main-page").css("background-image",'url("<?php echo get_stylesheet_directory_uri () . '/images/6885777-blurred.jpg'; ?>")');
                // This command is used to initialize some elements and make them work properly
                
            });
        
</script>

<?php 
}

include_once "theme_footer.php";

//* Run the Genesis loop
genesis();
