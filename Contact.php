<?php
if (isset($_POST['Submit'])) {

    function problem($error)
    {
        echo 'Apologies, but error(s) were detected: \n \n';
        echo $error '\n \n';
        echo 'Please go back to the contact form. \n \n';
        die();
    }

    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Apologies, but there appears to be a problem.');
    }

    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $message = $_POST['Message'];

    $error_message = " ";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'The E-mail address you entered does not appear to be valid.';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'The Name you entered does not appear to be valid.';
    }

    if (strlen($message) < 2) {
        $error_message .= 'The Message you entered does not appear to be valid.';
    }

    

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    $email_to = "frederic.fyon@gmail.com";
    $email_subject = "Email from $name (website)";
    
    $headers = 'From: ' . $name . "\r\n" .
        'e-mail: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    if(mail($email, $name, $email_message, $headers)) {
	    $messageForUser = "Your message has been sent successfully.";
	}
?>

    

<?php
}
?>