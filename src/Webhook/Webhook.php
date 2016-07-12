<?php

namespace Shareworks\Component\Mandrill\Webhook;

use JMS\Serializer\Annotation as Serializer;

/**
 * Webhook class.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Webhook
{
    /**
     * @var integer The webhook id
     * @Serializer\Type("integer")
     */
    protected $id;

    /**
     * @var string The webhook URL
     * @Serializer\Type("string")
     */
    protected $url;

    /**
     * @var string The description for the webhook
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * @var string The API key that was used to register this webhook
     * @Serializer\Type("string")
     */
    protected $authKey;

    /**
     * @var array The events that are registered for this webhook
     * @Serializer\Type("array<string>")
     */
    protected $events = [];

    /**
     * @var \DateTime The time this webhook was created
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    protected $createdDate;

    /**
     * @var \DateTime The time this webhook was last used
     * @Serializer\SerializedName("last_used_at")
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    protected $lastEventDate;

    /**
     * @var integer The number of event batches sent
     * @Serializer\SerializedName("batches_sent")
     * @Serializer\Type("integer")
     */
    protected $batchesSent;

    /**
     * @var integer The number of events sent
     * @Serializer\SerializedName("events_sent")
     * @Serializer\Type("integer")
     */
    protected $eventsSent;

    /**
     * @var string The last seen error message
     * @Serializer\Type("string")
     */
    protected $lastError;

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function getEvents()
    {
        return $this->events;
    }

    public function setEvents($events)
    {
        $this->events = $events;

        return $this;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function getLastEventDate()
    {
        return $this->lastEventDate;
    }

    public function getBatchesSent()
    {
        return $this->batchesSent;
    }

    public function getEventsSent()
    {
        return $this->eventsSent;
    }

    public function getLastError()
    {
        return $this->lastError;
    }
}
