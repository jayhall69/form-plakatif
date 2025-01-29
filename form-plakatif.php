<?php
/*
Plugin Name: Form Plakatif
Plugin URI: 
Description: Mehrseitiges Formular
Version: 2.0.2
Author: Jürgen Hall | Spezialfabrik
Author URI: https://spezialfabrik.net
*/



//include 'MailChimp.php';
//use \DrewM\MailChimp\MailChimp;



if( strpos($_SERVER['SERVER_NAME'], 'ddev')!==false ){


	define("TEST_MODE", true);
	// local dev site
	define("TEST_MAIL_USER", 'dino@localhost.localdomain');
	define("TEST_MAIL_SITEOWNER", 'dino@localhost.localdomain');
}
elseif( strpos($_SERVER['SERVER_NAME'], 'spezialfabrik.net')!==false ){
	define("TEST_MODE", false);
	define("MAIL_SITEOWNER", 'info@spezialfabrik.net');
	define("TEST_MAIL_USER", 'juergen@plakatif.net');
	define("TEST_MAIL_SITEOWNER", 'juergen@plakatif.net');
}



function formplakatif($atts) {

	wp_register_script('form-plakatif-js-jquery.validate', 				plugins_url("js/jquery.validate.min.js", __FILE__), 			array('jquery'), '1.0.0', true );
	wp_enqueue_script('form-plakatif-js-jquery.validate');
	
	wp_register_script('form-plakatif-js-jquery.validate.messages_de', 	plugins_url("js/jquery.validate.messages_de.js", __FILE__), 	array('jquery'), '1.0.0', true );
	wp_enqueue_script('form-plakatif-js-jquery.validate.messages_de');

	wp_register_script('form-plakatif-js-app', 							plugins_url("js/app.js", __FILE__),								array('jquery'), '1.0.2', true );
	wp_enqueue_script('form-plakatif-js-app');
	

	// plugin frontend css
	wp_register_style("form-plakatif-css-bootstrap", 		plugins_url("css/bootstrap.min.css", __FILE__) );
	wp_register_style("form-plakatif-css-style", 			plugins_url("css/style.css", __FILE__) );
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
    $template = str_replace('%nonce_field%', $nonce_field, $template);
    $template = str_replace('%admin_url%', admin_url('admin-ajax.php'), $template);

    return $template;
	

}
add_shortcode('form-plakatif', 'formplakatif');







add_action( 'wp_ajax_custom_action', 'custom_action' );
add_action( 'wp_ajax_nopriv_custom_action', 'custom_action' );
function custom_action() {

	// nonce check
    if ( ! isset( $_POST['form_plakatif_nonce'] ) || ! wp_verify_nonce( $_POST['form_plakatif_nonce'], 'custom_action_nonce') ) {
        exit('The form is not valid');
    }

    // A default response holder, which will have data for sending back to our js file
    $response = array(
    	'error' => false,
	);

	
	/*
	Array
	(
		[form_plakatif_nonce] => 617d9782c0
		[_wp_http_referer] => /strategiesession/
		[action] => custom_action
		[username] => Jürgen Hall
		[goal] => Ich will Sex
		[projecttype] => Optimierung einer bestehenden Strategie
		[budget] => 5.000 - 15.0000 €
		[email] => juergen@plakatif.net
		[phone] => 098765
	)
	*/
	

	// sanizite + Validierung 
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



/*
	// Email an User
	//
	$recipient = $cleanData['email'];
	
	$params = array(
		'email' => $recipient,
		'wert' => $w,
	);
	sendmailToCustomer($params);
	*/



	// Email an Websitebetreiber
	//
	if(TEST_MODE===true){
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
	$subject = "Ergebnis";

	include('mail_template_customer.php');			

	$headers = array('Content-Type: text/html; charset=UTF-8');
	
	$attachments = array();
	//$attachments[] = WP_CONTENT_DIR . '/uploads/2020/05/Anwendung_und_Grenzen_des_Multiple_Verfahrens.pdf';
	//$attachments[] = WP_CONTENT_DIR . '/uploads/2020/05/Berechnung_der_Equity_Bridge.pdf';
	

	wp_mail( $to, $subject, $body, $headers, $attachments );
}

function sendmailToSiteowner($params){

	$to = $params['email'];

	if(TEST_MODE===true){
		$to = TEST_MAIL_SITEOWNER;
	}

	$subject = 'spezialfabrik development studio : Anfrage Angebot';

	include('mail_template_siteowner.php');			
	
	$headers = array('Content-Type: text/html; charset=UTF-8');

	if(TEST_MODE===false && strpos($_SERVER['SERVER_NAME'], 'hall')===false){
		$headers[] = 'Cc: juergen@plakatif.net';
		$headers[] = 'Cc: juergen@plakatif.net';
	}


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
