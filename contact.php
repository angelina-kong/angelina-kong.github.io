<?php 
$name = $email = $subject = $message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email_to = "angelinakong905@gmail.com";
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
     
    if (empty($_POST["name"])) {
        $nameErr = "Please enter a name";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Invalid name format, please include only letters or spaces";
        }
    }
    
    if (empty($_POST["email"])) {
            $emailErr = "Please enter an email";
    } else{
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }  
    
    if (empty($_POST["subject"])) {
        $subjectErr = "Please enter a subject";
    } else {
        $subject = test_input($_POST["subject"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$subject)) {
            $subjectErr = "Invalid name format, please include only letters or spaces";
        }
    }
    if (empty($_POST["message"])) {
        $messageErr = "Please enter a message";
    } else {
        $message = test_input($_POST["comment"]);
    }
    
    $email_message = "Form details below.\n\n";
    
    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }
    
    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Subject: " . clean_string($subject) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";
    
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $subject, $email_message, $headers);
?>
  Thank you for contacting! A respond will be made as soon as possible.

<?php
}
?>