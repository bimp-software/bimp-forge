<?php

namespace Bimp\Forge\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as EmailException;

class ForgeMail {
   public static function send($to, $subject, $body, $alt = null, $bcc = null, $reply_to = null, $attachments = [], $template = 'emailTemplate') {
        $mail     = new PHPMailer(true);
         
        $template = PHPMAILER_TEMPLATE;

        $mail->SMTPAuth = true;
        
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.bimp-software.cl';
            $mail->SMTPAuth   = true;
            $mail->Username = CORREO_EMPRESA; 
            $mail->Password = CLAVE_EMPRESA; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465; 
            $mail->CharSet = 'UTF-8';

            // Remitente
            $mail->setFrom(CORREO_EMPRESA, get_sitename());

            // Destinatario
            $mail->addAddress($to);

            if ($reply_to != null) {
                $mail->addReplyTo($reply_to);
            }

            if ($bcc != null) {
                $mail->addBCC($bcc);
            }

            // Attachments
            if (!empty($attachments)) {
                foreach ($attachments as $file) {
                    if (!is_file($file)) {
                        continue;
                    }

                    $mail->addAttachment($file);
                }
            }

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = get_module($template, ['alt' => $alt, 'body' => $body, 'subject' => $subject]);
            $mail->AltBody = $alt;

            $mail->send();
            return true;

        } catch (EmailException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}