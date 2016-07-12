<?php

namespace Shareworks\Component\Mandrill\Email;

use JMS\Serializer\Annotation as Serializer;

/**
 * Email recipient.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Recipient
{
    const FIELD_TO = 'to';
    const FIELD_CC = 'cc';
    const FIELD_BCC = 'bcc';

    /**
     * @var string The email address of the recipient
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @var string The name of the recipient
     * @Serializer\Type("string")
     */
    protected $name;

    /**
     * @var string The field in which the recipient should be placed (defaults to 'to')
     * @Serializer\Type("string")
     */
    protected $type = self::FIELD_TO;

    public function __construct($email, $name = null, $type = self::FIELD_TO)
    {
        $this->email = $email;
        $this->name = $name;
        $this->type = $type;
    }

    public static function to($email, $name = null)
    {
        return new static($email, $name, static::FIELD_TO);
    }

    public static function cc($email, $name = null)
    {
        return new static($email, $name, static::FIELD_CC);
    }

    public static function bcc($email, $name = null)
    {
        return new static($email, $name, static::FIELD_BCC);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
