<?php

namespace Shareworks\Component\Mandrill\Message;

use JMS\Serializer\Annotation as Serializer;

/**
 * Mandrill message status.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class StatusMessage extends AbstractMessage
{
    /**
     * @var string The message id
     * @Serializer\SerializedName("_id")
     * @Serializer\Type("string")
     */
    protected $id;

    /**
     * @var string The message state
     * @Serializer\Type("string")
     */
    protected $state;

    /**
     * @var string The recipient's email address
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     */
    protected $recipient;

    /**
     * @var string The originating email address
     * @Serializer\SerializedName("sender")
     * @Serializer\Type("string")
     */
    protected $from;

    /**
     * @var \DateTime The moment the message was generated
     * @Serializer\SerializedName("ts")
     * @Serializer\Type("DateTime<'U'>")
     */
    protected $sendDate;

    /**
     * @var string The template name
     * @Serializer\Type("string")
     */
    protected $template;

    /**
     * @var MessageAction[]
     * @Serializer\SerializedName("clicks_detail")
     * @Serializer\Type("array<Shareworks\Component\Mandrill\Message\MessageAction>")
     */
    protected $clicks;

    /**
     * @var MessageAction[]
     * @Serializer\SerializedName("opens_detail")
     * @Serializer\Type("array<Shareworks\Component\Mandrill\Message\MessageAction>")
     */
    protected $opens;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return \DateTime
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return MessageAction[]
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * @return MessageAction[]
     */
    public function getClicks()
    {
        return $this->clicks;
    }
}
