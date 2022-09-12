<?php

if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: index.html" );
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';

$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$residence = $_POST['residence'];
$motive = $_POST['motive'];
$comment = $_POST['comment'];
$subject = 'Mensaje recibido desde aliciabarreto.com';

if( empty(trim($name)) ) $name = 'anonimo';

$body = <<<HTML
    <h1 style="font-size: 20px;">Mensaje recibido desde aliciabarreto.com</h1>
    <p>De: $name | $email</p>
    <p>Teléfono: $telephone | Reside en Capital: $residence</p>
    <p>Motivo: $motive</p>
    <hr />
    $comment
HTML;

$mailer = new PHPMailer(true);

try {
    //Server setting
    $mailer->SMTPDebug = 0;
    $mailer->isSMTP();
    $mailer->Host = 'c1491759.ferozo.com';
    $mailer->SMTPAuth = true;  
    $mailer->Username = 'no-reply@c1491759.ferozo.com';
    $mailer->Password = 'REHiW3C69@';                          
    $mailer->SMTPSecure = 'ssl';
    $mailer->Port = 465;

    //Recipients
    $mailer->setFrom( $email, "$name" );
    $mailer->addAddress('no-reply@c1491759.ferozo.com','Sitio web');

    //Content
    $mailer->isHTML(true);
    $mailer->Subject = $subject;
    $mailer->msgHTML($body);
    $mailer->AltBody = strip_tags($body);
    $mailer->CharSet = 'UTF-8';

    $mailer->send();
    header("Location: thank-you.html" );

} catch (Exception $e) {
    return "El mensaje no pudo ser enviado. Error: $mailer->ErrorInfo";
}

?>