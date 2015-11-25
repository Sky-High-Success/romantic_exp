<?php
/**
 * Template name: Supplier Sign Up
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

if(isset($_POST['type_hidden']) && $_POST['type_hidden'] == "signup" && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	$email = esc_sql ( isset ( $_REQUEST ['signup_email'] ) ? $_REQUEST ['signup_email'] : '' );
	$password = esc_sql ( isset ( $_REQUEST ['signup_password'] ) ? $_REQUEST ['signup_password'] : '' );
	$gst= esc_attr(strip_tags($_POST['signup_GST']));
	$company= esc_attr(strip_tags($_POST['signup_company']));
	$contact= esc_attr(strip_tags($_POST['signup_contact']));
	$cost= esc_attr(strip_tags($_POST['signup_cost']));
	$date= date_format(date_create_from_format('d/M/Y', esc_attr(strip_tags($_POST['signup_date'])) ), 'Y-m-d');  
	$details= esc_attr(strip_tags($_POST['signup_details']));
	$location= esc_attr(strip_tags($_POST['signup_location']));
	$phone= esc_attr(strip_tags($_POST['signup_phone']));
	$position= esc_attr(strip_tags($_POST['signup_position']));

	$userdata = array(
			'user_login'  =>  $email,
			'user_email'  =>  $email,
			'user_pass'   =>  $password,  // When creating an user, `user_pass` is expected.
			'role' => 'author',
	);
	
	$user_id = wp_insert_user( $userdata ) ;
	
	if ( is_wp_error( $user_id ) ) {
	
		wp_redirect( add_query_arg('error_msg',urlencode("Supplier creation failed, supplier email has to be unique."),get_home_url(null, "")) ); exit;
	
	}else{
	
		if ( $_FILES ) {
			
				$files = $_FILES['signup_image'];
				foreach ($files['name'] as $key => $value) {
					if ($files['name'][$key]) {
						$file = array(
							'name'     => $files['name'][$key],
							'type'     => $files['type'][$key],
							'tmp_name' => $files['tmp_name'][$key],
							'error'    => $files['error'][$key],
							'size'     => $files['size'][$key]
						);
			 
						$_FILES = array("signup_image" => $file);
						foreach ($_FILES as $file => $array) {
							
							error_log($file);
							$newupload = custom_insert_attachment($file);
						}
					}
				}
		 }
		
		 add_supplier_meta($user_id, $gst, $company, $contact, $cost, $date, $details, $location, $phone, $position);
		 wp_redirect( add_query_arg('msg',urlencode("Supplier has been successfully added."),get_home_url(null, "")) ); exit;
	
	
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
					<span class="fa fa-4x fa-heart"></span>
				</div>
				<div class="info">

					<!-- Form -->
					<form role="form" id="loginform" action="" method="post"  enctype="multipart/form-data"
						class="form-signin">
						<div class="row">
							<div class="col-md-7 column-1">
								<h4 class="text-center text-warning">Register Your Interest</h4>
								
								<?php 
								global $login_user;
								if ( is_wp_error($login_user) ){
									    echo '<div class="form-group has-warning text-center">';
										echo $login_user->get_error_message();
										echo '</div>';
								}?>

								<div class="form-group has-warning">
								
									
									<input type="text" id="signup_GST" name="signup_GST"
										placeholder="GST number"
										class="form-control form-input empty">
									<p class="help-block">
										Are you registered for GST or Not? If yes what is your GST number?
									</p>


								</div>
								
								<div class="form-group has-warning">

									<input type="text" id="signup_company" required="" name="signup_company"
										placeholder="Company Name"
										class="form-control form-input empty">



								</div>
								
								<div class="form-group has-warning">

									<input type="text" id="signup_contact" name="signup_contact"
										placeholder="Contact Name"
										class="form-control form-input empty">

								</div>
								
								<div class="form-group has-warning">

									<input type="text" id="signup_position" name="signup_position"
										placeholder="Position Held"
										class="form-control form-input empty">

								</div>
								
								<div class="form-group has-warning">

									<input type="text" required="" id="signup_email" name="signup_email"
										placeholder="Email Address"
										class="form-control form-input empty">
								</div>
								
								<div class="form-group has-warning">

									<input type="text" id="signup_phone" name="signup_phone"
										placeholder="Phone Number"
										class="form-control form-input empty">
								</div>
								
								<div class="form-group has-warning">

									<input type="text" id="signup_location" name="signup_location"
										placeholder="Location of Deal"
										class="form-control form-input empty">
								</div>
								
								<div class="form-group has-warning">
									<textarea class="form-control" id="signup_details" name="signup_details" placeholder="Details of the package you would like to offer"></textarea>
								</div>
								
								<div class="form-group has-warning">

									<input type="text" id="signup_cost" name="signup_cost"
										placeholder="Approximate Deal cost (RRP)"
										class="form-control form-input empty">
								</div>
								
								
								<div class="form-group has-warning">

									<input type="date" id="signup_date"
										placeholder="Time period the offer is valid (if limited)" name="signup_date"
										class="form-control form-input empty">

								</div>
								
								<div class="form-group has-warning">
									<input type="file" id="signup_image"
										name="signup_image[]"
										accept="image/png, image/jpeg" multiple>
									<input class="form-control form-input empty" type="text" placeholder="Image(s) of offer- if available" readonly="">

								</div>
								
								<div class="form-group has-warning">

									<input type="password" id="signup_password"
										placeholder="Set Password" required="" name="signup_password"
										class="form-control form-input empty">

								</div>

								<div class="form-group has-warning">

									<input type="hidden" name="type_hidden" value="signup">
											  
  	             					<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
								
									<button id="loginbtn" type="submit"
										class="btn btn-warning center-block">Submit</button>
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

	$('#signup_date').datepicker({
		format: 'dd/M/yyyy',
	    startDate: '-1d',
	});

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

