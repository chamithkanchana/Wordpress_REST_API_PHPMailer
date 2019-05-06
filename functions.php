<?php

/* CUSTOM REST API ENDPOINTS START */

	function sendWithPhpMailer($subject, $body, $reply) {

    /* Import PHPMailter */
		require 'src/PHPMailer.php';
		require 'src/SMTP.php';

		$mail = new PHPMailer\PHPMailer\PHPMailer();

		$mail->SMTPDebug = 2;  /* 0=Debug OFF | 1=Debug Client | 2=debug Server */                             
		$mail->isSMTP();                                    
		$mail->Host = "Your host name";
		$mail->SMTPAuth = true;                          
		$mail->Username = "user name or email";                 
		$mail->Password = "password";                           
		$mail->SMTPSecure = "tls";                           
		$mail->Port = 587;                                   
		$mail->From = "from email address";
		$mail->FromName = "from name";
		$mail->addAddress("to address", "Recepient Name");
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AltBody = "This is the plain text version of the email content";
		$send = false;

		if(!$mail->send()){
			echo "Mailer Error: " . $mail->ErrorInfo;
			$send = false;
		}else{
			$send = true;
		}
		return $send;
	}

	function sendCustomEmail(WP_REST_Request $request) {

		$subject = "Your Email Subject";
		$themeURL = get_template_directory_uri() . '/emails/demo.html'; // Using the email template. You can comment these two lines if you aren't using a html template.
		$body = file_get_contents($themeURL);

		if ( sendWithPhpMailer( $subject, $body, $contactEmail ) ) {
			$response['status'] = 200;
			$response['message'] = 'Form sent successfully.';
		}
		
		return json_decode( json_encode( $response ) );
		exit();
	}
  
	add_action( 'rest_api_init', function () {
		register_rest_route( 'contact/v1', '/send', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => 'sendCustomEmail'
		));
	});

/* CUSTOM REST API ENDPOINTS ENDS */

?>
