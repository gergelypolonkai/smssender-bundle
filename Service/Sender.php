<?php
namespace GergelyPolonkai\SMSSenderBundle\Service;

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

    public function login($username, $password)
    {
        var_dump($this->sender->login($username, $password));
    }

    public function sendMessage($recipient, $message, array $passwordLocations)
    {
        var_dump($this->sender->sendMessage($recipient, $message, $passwordLocations));
    }

    public function logout()
    {
        var_dump($this->sender->logout());
    }
}
