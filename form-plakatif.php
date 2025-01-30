<?php
/*
Plugin Name: Form Plakatif
Plugin URI: 
Description: Multistep Form
Version: 2.0.2
Author: Jürgen Hall | Spezialfabrik
Author URI: https://spezialfabrik.net
*/

require_once plugin_dir_path(__FILE__) . 'config.php';

function formplakatif($atts) {

	wp_register_script('form-plakatif-js-jquery.validate', 				plugins_url("js/lib/jquery.validate.min.js", __FILE__), 			array('jquery'), '1.0.0', true );
	wp_enqueue_script('form-plakatif-js-jquery.validate');
	
	// localization of validation messages
	//wp_register_script('form-plakatif-js-jquery.validate.messages_de', 	plugins_url("js/lib/jquery.validate.messages_de.js", __FILE__), 	array('jquery'), '1.0.0', true );
	//wp_enqueue_script('form-plakatif-js-jquery.validate.messages_de');

	wp_register_script('form-plakatif-js-app', 							plugins_url("js/app.js", __FILE__),								array('jquery'), '1.0.2', true );
	wp_enqueue_script('form-plakatif-js-app');
	

	// plugin frontend css
	wp_register_style("form-plakatif-css-bootstrap", 		plugins_url("css/bootstrap.min.css", __FILE__) );
	wp_register_style("form-plakatif-css-style", 			plugins_url("css/form-plakatif-style.css", __FILE__) );
	wp_enqueue_style("form-plakatif-css-bootstrap");
	wp_enqueue_style("form-plakatif-css-style");

	
	if (is_admin()){
		$nonce_field = "";
	}
	else{
		$nonce_field = wp_nonce_field( 'custom_action_nonce', 'form_plakatif_nonce', true, false);
	}
   


    // Load form template
    $template = file_get_contents(plugin_dir_path(__FILE__) . 'templates/form.html');

    // replace variables
	$template = str_replace('%plugin_path%', plugin_dir_path(__FILE__), $template);
    $template = str_replace('%nonce_field%', $nonce_field, $template);
    $template = str_replace('%admin_url%', admin_url('admin-ajax.php'), $template);

    return $template;
	

}
add_shortcode('form-plakatif', 'formplakatif');







add_action( 'wp_ajax_custom_action', 'handle_submission' );
add_action( 'wp_ajax_nopriv_custom_action', 'handle_submission' );

function handle_submission() {

	// nonce check
    if ( ! isset( $_POST['form_plakatif_nonce'] ) || ! wp_verify_nonce( $_POST['form_plakatif_nonce'], 'custom_action_nonce') ) {
        exit('The form is not valid');
    }

    // A default response holder, which will have data for sending back to our js file
    $response = array(
    	'error' => false,
	);

	// sanitize 
	//
	$keys = Array('username', 'goal', 'projecttype', 'budget', 'email', 'phone');
	$cleanData = array();
	foreach($keys as $key){
		$cleanData[$key] = trim(sanitize_text_field($_POST[$key]));
	}

    if ($cleanData['email'] == '') {
    	$response['error'] = true;
    	$response['error_message'] = 'Email is required';
 
    	// Exit here, for not processing further because of the error
    	exit(json_encode($response));
	}

	if (!filter_var($cleanData['email'], FILTER_VALIDATE_EMAIL)) {
    	$response['error'] = true;
    	$response['error_message'] = 'Email is invalid';
 
    	// Exit here, for not processing further because of the error
    	exit(json_encode($response));
	}




	// Email to Customer
	//
	$recipient = $cleanData['email'];
	
	$params = array(
		'email' => $recipient
	);
	sendmailToCustomer($params);




	// Notification to Siteowner
	//
	if(TEST_MODE===true){

		// in test mode we send both mails to the entered email address..
		$recipient = $cleanData['email'];
	}
	else{
		$recipient = MAIL_SITEOWNER;
	}

	$params = array(
		'email' => $recipient,
		'formdata' => $cleanData
	);

	sendmailToSiteowner($params);



    // Don't forget to exit at the end of processing
    exit(json_encode($response));
}




function sendmailToCustomer($params){

	$to = $params['email'];
	$subject = "Your Request";

	include('templates/email/mail_template_customer.php');			

	$headers = array('Content-Type: text/html; charset=UTF-8');
	
	// attach document
	//$attachments = array();
	//$attachments[] = plugin_dir_path(__FILE__) . 'assets/pdf/dummy.pdf' .
	
	wp_mail( $to, $subject, $body, $headers, $attachments );
}

function sendmailToSiteowner($params){

	$to = $params['email'];

	if(TEST_MODE===true){
		$to = TEST_MAIL_SITEOWNER;
	}

	$subject = 'New request notification';

	include('templates/email/mail_template_siteowner.php');			
	
	$headers = array('Content-Type: text/html; charset=UTF-8');

	wp_mail( $to, $subject, $body, $headers );

}

function generateRandomString($length = 5) {
    $characters = '0123456789ABCDEF';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
