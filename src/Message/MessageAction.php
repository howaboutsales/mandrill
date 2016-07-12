<?php

namespace Shareworks\Component\Mandrill\Message;

use JMS\Serializer\Annotation as Serializer;

/**
 * Message action: open, click.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class MessageAction
{
    /**
     * @var \DateTime The action date.
     * @Serializer\SerializedName("ts")
     * @Serializer\Type("DateTime<'U'>")
     */
    protected $date;

    /**
     * @var string The action location.
     * @Serializer\Type("string")
     */
    protected $location;

    /**
     * @var string The action user agent string.
     * @Serializer\SerializedName("ua")
     * @Serializer\Type("string")
     */
    protected $userAgent;

    /**
     * @var string The action IP address.
     * @Serializer\SerializedName("ip")
     * @Serializer\Type("string")
     */
    protected $ipAddress;

    /**
     * @var string The action url.
     * @Serializer\Type("string")
     */
    protected $url;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return static
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     *
     * @return static
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     *
     * @return static
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     *
     * @return static
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return static
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
