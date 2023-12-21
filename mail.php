<?php
// Only process POST requests.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);


    // How to validate a form using Javscript?
    // Check that data was sent to the mailer.
    if (empty($_POST['name']) OR empty($_POST['email']) OR empty($_POST['subject']) OR empty($_POST['message'])) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address.
    // FIXME: Update this to your desired email address.
    $recipient = 'uhuribhang211@gmail.com';
    $from = 'from'.$email;

    // Set the email subject.
    $subject = '$subject'.$subject;

    // Build the email content.
    $body ='Name: '.$name. '\n Email: '.$email. '\n $Subject: '.$subject. '\n $Message: '.$message;

    mail($recipient, $from, $subject, $body);

    // $email_content = "Name: $name\n";
    // $email_content .= "Email: $email\n\n";
    // $email_content .= "Subject: $subject\n\n";
    // $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
