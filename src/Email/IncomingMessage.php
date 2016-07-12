<?php

namespace Shareworks\Component\Mandrill\Email;

use JMS\Serializer\Annotation as Serializer;

/**
 * Incoming email message.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class IncomingMessage extends AbstractEmail
{
    /**
     * @var string The raw email message (headers + content)
     * @Serializer\SerializedName("raw_msg")
     * @Serializer\Type("string")
     */
    protected $raw;

    /**
     * @var string The email address at which the incoming message was received
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @var string The email address that sent the message
     * @Serializer\Type("string")
     */
    protected $sender;

    public function getRaw()
    {
        return $this->raw;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSender()
    {
        return $this->sender;
    }
}
