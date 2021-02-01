<?php

namespace Notification;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{

    private $mail = \stdClass::class;

    public function __construct()
    {

        // Server settings
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = 2;
        $this->mail->isSMTP();
        $this->mail->Host       = 'host.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'email';
        $this->mail->Password   = 'password';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port       = 587;
        $this->mail->CharSet = 'utf-8';
        $this->mail->setLanguage('br');
        $this->mail->isHTML();
        $this->mail->setFrom('email@email.com', 'Teste Local Envio de Email');
    }

    public function sendMail($subject, $body, $replyEmail, $replayName, $addressEmail, $addressName)
    {

        $this->mail->Subject = (string) $subject;
        $this->mail->Body = $body;

        $this->mail->addReplyTo($replyEmail, $replayName);
        $this->mail->addAddress($addressEmail, $addressName);

        try {
            $this->mail->send();
        } catch (Exception $e) {
            echo 'Erro ao enviar o e-mail {$this->mail->ErrorInfo} {$e->getMessage()}';
        }
    }
}
