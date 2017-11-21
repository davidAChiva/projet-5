<?php

namespace AppBundle\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use AppBundle\Email\ContactMailer;
use AppBundle\Entity\Contact;

class ContactListener
{
    /**
     * @var ContactMailer
     */
    private $contactMailer;

    public function __construct(ContactMailer $contactMailer)
    {
        $this->contactMailer = $contactMailer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Contact)
        {
            return;
        }

        $this->contactMailer->sendNewNotification($entity);
    }
}