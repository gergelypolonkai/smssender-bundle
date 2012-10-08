<?php
namespace BrokernetGroup\Common\SMSSenderBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity to spool SMS messages
 *
 * @ORM\MappedSuperclass
 */
class SpooledSms
{
    /**
     * The recipient's mobile phone number
     *
     * @var string $recipient
     *
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    protected $recipient;

    /**
     * The message itself
     *
     * @var string $message
     *
     * @ORM\Column(type="text", nullable=false)
     */
    protected $message;

    /**
     * Password locations. This must be an array of arrays containing the
     * password's location and length
     *
     * @var array $passwordLocations
     *
     * @ORM\Column(type="array", name="password_locations", nullable=true)
     */
    protected $passwordLocations;

    /**
     * True if the message is already sent
     *
     * @var boolean $sent
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $sent;
}

