<?php

namespace Shareworks\Component\Mandrill\Email;

use JMS\Serializer\Annotation as Serializer;

/**
 * The response for sent messages.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class StatusResponse
{
    const STATUS_SENT = 'sent';
    const STATUS_QUEUED = 'queued';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_REJECTED = 'rejected';
    const STATUS_INVALID = 'invalid';

    const REASON_HARD_BOUNCE = 'hard-bounce';
    const REASON_SOFT_BOUNCE = 'soft-bounce';
    const REASON_SPAM = 'spam';
    const REASON_UNSUBSCRIBED = 'unsub';
    const REASON_INVALID_SENDER = 'invalid-sender';
    const REASON_INVALID = 'invalid';
    const REASON_RULE = 'rule';
    const REASON_TEST_LIMIT = 'test-mode-limit';
    const REASON_CUSTOM = 'custom';

    /**
     * @var string The message id
     * @Serializer\SerializedName("_id")
     * @Serializer\Type("string")
     */
    protected $id;

    /**
     * @var string The recipient's email address
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     */
    protected $recipient;

    /**
     * @var string The message status
     * @Serializer\Type("string")
     */
    protected $status;

    /**
     * @var string The reason for a 'rejected' status
     * @Serializer\Type("string")
     */
    protected $reason;

    public function getId()
    {
        return $this->id;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getReason()
    {
        return $this->reason;
    }
}
