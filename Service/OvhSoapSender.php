<?php
namespace GergelyPolonkai\SmsSenderBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use RuntimeException;
use GergelyPolonkai\SmsSender\OvhSoapSender as BaseSender;

/**
 * @author Gergely Polonkai
 *
 * SMS Sending service for OVH Soap based SMS Sender server
 */
class OvhSoapSender
{
    private $loggedIn;

    private $sender;

    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->sender = new BaseSender(
                $this->container->getParameter('sender_url'),
                $this->container->getParameter('sms_account_id'),
                $this->container->getParameter('from'));
    }

    public function login()
    {
        if ($this->sender->login($this->container->getParameter('username'), $this->container->getParameter('password'))){
            $this->loggedIn = true;
        } else {
            throw new \RuntimeException('Unable to login to gateway!');
        }
    }

    public function sendMessage($recipient, $message, array $passwordLocations)
    {
        if (!$this->loggedIn) {
            return false;
        }
        $this->sender->sendMessage($recipient, $message, $passwordLocations);
    }

    public function logout()
    {
        if (!$this->loggedIn) {
            return false;
        }
        $this->sender->logout();
    }
}
