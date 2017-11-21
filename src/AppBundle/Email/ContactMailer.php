<?php

namespace AppBundle\Email;

use AppBundle\Entity\Contact;

class ContactMailer
{
    /**
     * @var \Swift_Mailer
     */

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewNotification(Contact $contact)
    {
        $message = new \Swift_Message(
            'Nouveau message',
            'Bonjour, vous avez reçu un nouveau message.'
        );

        $message->addTo($contact->getEmail())

        ->addFrom('david.alfaro.chiva@gmail.com');

        $this->mailer->send($message);
    }

}