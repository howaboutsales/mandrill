<?php

namespace Shareworks\Component\Mandrill\Email;

use JMS\Serializer\Annotation as Serializer;
use Shareworks\Component\Mandrill\Message\AbstractMessage;

abstract class AbstractEmail extends AbstractMessage
{
    /**
     * @var Recipient[] The list of recipients for this email message
     * @Serializer\SerializedName("to")
     * @Serializer\Type("array<Shareworks\Component\Mandrill\Email\Recipient>")
     */
    protected $recipients = [];

    /**
     * @var string The email address from which the email is sent
     * @Serializer\Type("string")
     */
    protected $fromEmail;

    /**
     * @var string The name from which the email is sent
     * @Serializer\Type("string")
     */
    protected $fromName;

    /**
     * @var string The HTML email body
     * @Serializer\SerializedName("html")
     * @Serializer\Type("string")
     */
    protected $htmlBody;

    /**
     * @var string The text email body
     * @Serializer\SerializedName("text")
     * @Serializer\Type("string")
     */
    protected $textBody;

    /**
     * @var array The message headers
     * @Serializer\Type("array<string,string>")
     */
    protected $headers = [];

    public function addRecipient(Recipient $recipient)
    {
        $this->recipients[] = $recipient;

        return $this;
    }

    public function getRecipients()
    {
        return $this->recipients;
    }

    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    public function setFrom($email, $name = null)
    {
        $this->fromEmail = $email;
        $this->fromName = $name;

        return $this;
    }

    public function getFromName()
    {
        return $this->fromName;
    }

    public function getHtmlBody()
    {
        return $this->htmlBody;
    }

    public function setHtmlBody($htmlBody)
    {
        $this->htmlBody = $htmlBody;

        return $this;
    }

    public function getTextBody()
    {
        return $this->textBody;
    }

    public function setTextBody($textBody)
    {
        $this->textBody = $textBody;

        return $this;
    }

    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
