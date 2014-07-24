<?php
/**
 * PHP contact form
 */
 

// If the form have been submitted and the spam check field is empty
if ( isset( $_POST['email'] ) && empty( $_POST['s_check'] ) ) :
	
	/**
	 * Language strings
	 */
	$strings = array(
		'default_subject' => 'Message on your website',
		'default_name'    => 'Anonymous',
		'error_message'   => '<strong>Error:</strong> %s cannot be left blank', // %s is the error name
		'invalid_email'   => '<strong>Error:</strong> Email address is invalid',
		'email_success'   => 'Thank you! Your email has been sent',
		'email_error'     => 'There was a problem sending your email. Please try again'
	);

	/**
	 * Required fields
	 * We'll check and see if any of the required fields are empty.
	 */
	$required = array(
		'name'    => 'Name',
		'email'   => 'Email'
	);

	// Declare our $errors variable we will be using later to store any errors.
	$errors = array();

	/**
	 * Get form values and sanitize them
	 */
	$name    = sanitize_string( $_POST['name'] );
	$from    = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
	$type    = sanitize_string( $_POST['type'] );
	$budget  = sanitize_string( $_POST['budget'] );
	$start  = sanitize_string( $_POST['start'] );
	$finish  = sanitize_string( $_POST['finish'] );
	$comments = sanitize_string( $_POST['comments'] );

	// Validate the sanitized email
	if ( ! filter_var( $from, FILTER_VALIDATE_EMAIL ) )
		   $errors[] = $strings['invalid_email'];

	// PREPARE THE BODY OF THE MESSAGE
	$message .= "<html><body>";
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
	$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Type:</strong> </td><td>" . strip_tags($_POST['type']) . "</td></tr>";
	$message .= "<tr><td><strong>Budget:</strong> </td><td>" . strip_tags($_POST['budget']) . "</td></tr>";
	$message .= "<tr><td><strong>Start:</strong> </td><td>" . strip_tags($_POST['start']) . "</td></tr>";
	$message .= "<tr><td><strong>Finish:</strong> </td><td>" . strip_tags($_POST['finish']) . "</td></tr>";
	$message .= "<tr><td><strong>Comments:</strong> </td><td>" . strip_tags($_POST['comments']) . "</td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
		 
		
	//  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
	$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
    if (preg_match($pattern, trim(strip_tags($_POST['email'])))) { 
        $cleanedFrom = trim(strip_tags($_POST['email'])); 
    } else { 
        return "The email address you entered was invalid. Please try again!"; 
    }
	
	//   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
	$to = 'marisa.miranda.roque@gmail.com';
	$subject = 'Pixel Sweet Pixel';
	$headers = "From: " . $name. "<" . $cleanedFrom . ">" . "\r\n"; 
	$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	/**
	 * Loops through each required $_POST value
	 * Checks to ensure it is not empty.
	 */
	foreach ( $required as $key => $value ) :
		if ( isset( $_POST[$key] ) && ! empty( $_POST[$key] ) )
			continue;
		else
			$errors[] = sprintf( $strings['error_message'], $value );
	endforeach;

	/**
	 * Now check to see if there are any errors
	 */
	if ( empty( $errors ) ) {

		// No errors, send mail using conditional to ensure it was sent.
		if ( mail( $to, "$subject", utf8_decode( $message ), $headers ) )
			echo '<p class="alert alert-success">' . $strings['email_success'] . '</p>';
		else
			echo '<p class="alert alert-error">' . $strings['email_error'] . '</p>';

	} else {
		// Errors were found, output all errors to the user.
		echo '<div class="alert alert-warning">';
			echo implode( '<br />', $errors );
		echo '</div>';
	}

else :

	// The user have tried to access thid page directly or is a spambot
	die("You're not allowed to access this page directly");

endif;

/**
 * Sanitize inputs
 *
 * @uses  FILTER_SANITIZE_STRING 		Strip tags
 * @uses  FILTER_FLAG_NO_ENCODE_QUOTES 	Prevents encoding of quotes
 * @uses  stripslashes() 				Removes slashes added to quotes
 *
 * @since  Jayj HTML5 theme 2.1
 * @param  string  $string The string to be sanitized
 * @return string          The sanitized string
 */
function sanitize_string( $string ) {
	return stripslashes( filter_var( $string, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES ) );
}

?>
