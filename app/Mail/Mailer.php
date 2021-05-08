<?php

namespace App\Mail;

class Mailer
{

    // message
    private $message;

    // Mailer
    private $mailer;

    // The path to your logo
    private $logo;

    // Our server details, Might change it to an environmental variable
    private $from = ['localhost@yahoo.com' => 'Localhost'];
    
    /**
     * Format for our mails
     */
    public function index($user)
    {
        $subject = 'Subject of the Mail';

        $htmlBody = '<img src="'.$this->getmessage()->embed($this->logo).'" style="width: 100%; height: auto;" />

                    <p>Dear '.$user->first_name.',</p>

                    <p>This is the mail body</p>

                    <p>Thank you for using my template.</p>';
        
        $plainBody =<<<BODY
Dear {$user->first_name},

This is the mail body

Thank you for using my template.
BODY;

        $message = $this->getMessage()->setSubject($subject)
                                    ->setTo($user->email)
                                    ->setFrom($this->from)
                                    ->setBody($htmlBody, 'text/html')
                                    ->addPart($plainBody, 'text/plain');

        $this->getMailer()->send($message);
    }

    /**
     * Mailer Instance
     */
    private function getMailer()
    {
        if (!isset($this->mailer)) {
            // Mail Transport
            $transport = (new \Swift_SmtpTransport)
                        ->setHost($_ENV['MAIL_HOST'])
                        ->setPort($_ENV['MAIL_PORT'])
                        ->setUsername($_ENV['MAIL_USERNAME'])
                        ->setPassword($_ENV['MAIL_PASSWORD'])
                        ->setEncryption($_ENV['MAIL_ENCRYPTION']);

            // Mailer Initialization
            return $this->mailer = new \Swift_Mailer($transport);
        }

        return $this->mailer;
    }

    /**
     * Message Instance
     */
    private function getMessage() {
        if (!isset($this->message)) {
            return $this->message = new \Swift_Message;
        }

        return $this->message;
    }

}