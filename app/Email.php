<?php

namespace Notification\App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Email {

    private $mail;

    public function __construct($smtpDebug, $host, $user, $pass, $smtpSecure, $port, $setFromEmail, $setFromName) {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = $smtpDebug;                                   // Enable verbose debug output
        $this->mail->isSMTP();                                                 // Send using SMTP
        $this->mail->Host = $host;                                             // Atualize com o endereço correto do servidor SMTP
        $this->mail->SMTPAuth = true;                                          // Enable SMTP authentication
        $this->mail->Username = $user;                                         // SMTP username
        $this->mail->Password = $pass;                                         // SMTP password
        $this->mail->SMTPSecure = $smtpSecure;                                 // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also accepted
        $this->mail->Port = $port;                                             // TCP port to connect to; use 465 for SMTPS
        $this->mail->CharSet = 'utf-8';
        $this->mail->setLanguage('br');
        $this->mail->isHTML(true);
        $this->mail->setFrom($setFromEmail, $setFromName);
    }

    public function sendEmail($subject, $body, $replyEmail, $replyName, $addressEmail, $addressName) {
        $this->mail->Subject = (string)$subject;
        $this->mail->Body = $body;

        $this->mail->addReplyTo($replyEmail, $replyName);
        $this->mail->addAddress($addressEmail, $addressName);

        try {
            $this->mail->send();
            echo "Email enviado com sucesso!";
        } catch (Exception $e) {
            echo "Erro ao enviar o email: {$e->getMessage()}";
            echo "Detalhes do erro: " . $this->mail->ErrorInfo;
        }
    }
}
