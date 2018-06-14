<?php

namespace App\EventSubscriber;

use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_PERSIST => 'encodePassword',
            EasyAdminEvents::PRE_UPDATE => 'encodePassword',
        ];
    }

    public function encodePassword(GenericEvent $event)
    {
        $admin = $event->getSubject();

        if (!$admin instanceof Admin) {
            return;
        }

        if (!$admin->getRawPassword()) {
            return;
        }

        $encodedPassword = $this
            ->passwordEncoder
            ->encodePassword($admin, $admin->getRawPassword())
        ;
        $admin->setPassword($encodedPassword);
    }
}
