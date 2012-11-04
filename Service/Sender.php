<?php
namespace GergelyPolonkai\SmsSenderBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use RuntimeException;
use GergelyPolonkai\SmsSender\Sender as BaseSender;

/**
 * @author Gergely Polonkai
 *
 * SMS Sending service for JSON-RPC based SMS Sender server
 */
class Sender
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
                $this->container->getParameter('content_type'),
                $this->container->getParameter('content_encoding'),
                $this->container->getParameter('verify_ssl'),
                $this->container->getParameter('verbose_curl')
        );
    }

    public function login()
    {
        if ($this->sender->login($this->container->getParameter('username'), $this->container->getParameter('password')) === true) {
            $this->loggedIn = true;
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
