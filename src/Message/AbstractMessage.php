<?php

namespace Shareworks\Component\Mandrill\Message;

use JMS\Serializer\Annotation as Serializer;

/**
 * Base Mandrill message.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
abstract class AbstractMessage
{
    /**
     * @var string The message subject
     * @Serializer\Type("string")
     */
    protected $subject;

    /**
     * @var string The name of the Mandrill subaccount (when used instead of main account)
     * @Serializer\Type("string")
     */
    protected $subaccount;

    /**
     * @var array The metadata associated with the message
     * @Serializer\Type("array<string,string>")
     */
    protected $metadata = [];

    /**
     * @var array The tags set for this message
     * @Serializer\Type("array<string>")
     */
    protected $tags = [];

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return static
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubaccount()
    {
        return $this->subaccount;
    }

    /**
     * @param string $subaccount
     *
     * @return static
     */
    public function setSubaccount($subaccount)
    {
        $this->subaccount = $subaccount;

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return static
     */
    public function addMetadata($key, $value)
    {
        $this->metadata[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param string $tag
     *
     * @return static
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }
}
