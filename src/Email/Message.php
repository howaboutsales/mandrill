<?php

namespace Shareworks\Component\Mandrill\Email;

use JMS\Serializer\Annotation as Serializer;

/**
 * Email message.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Message extends AbstractEmail
{
    /**
     * @var boolean Mark the message as important
     * @Serializer\Type("boolean")
     */
    protected $important;

    // TODO: Add other fields

    public static function create()
    {
        return new static();
    }

    public function setSubaccount($subaccount)
    {
        $this->subaccount = $subaccount;

        return $this;
    }

    public function isImportant()
    {
        return $this->important;
    }

    public function setImportant($important)
    {
        $this->important = $important;

        return $this;
    }
}
