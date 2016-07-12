<?php

namespace Shareworks\Component\Mandrill\Webhook;

use Shareworks\Component\Mandrill\Mandrill;

/**
 * Webhook manager.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Manager
{
    private $mandrill;

    /**
     * Constructor.
     *
     * @param Mandrill $mandrill
     */
    public function __construct(Mandrill $mandrill)
    {
        $this->mandrill = $mandrill;
    }

    /**
     * Register a webhook.
     *
     * @param string $url
     * @param array  $events
     * @param string $description
     *
     * @return Webhook
     */
    public function register($url, array $events, $description = null)
    {
        $parameters = [
            'url' => $url,
            'events' => $events,
            'description' => $description,
        ];

        return $this->mandrill->command('webhook.create', $parameters);
    }

    /**
     * Find a webhook by its URL.
     *
     * @param string $url
     *
     * @return Webhook
     */
    public function find($url)
    {
        foreach ($this->all() as $webhook) {
            if ($url === $webhook->getUrl()) {
                return $webhook;
            }
        }

        return null;
    }

    /**
     * List all registered webhooks.
     *
     * @return Webhook[]
     */
    public function all()
    {
        return $this->mandrill->command('webhook.list');
    }

    /**
     * Update the webhook.
     *
     * @param Webhook $webhook
     */
    public function update(Webhook $webhook)
    {
        $parameters = [
            'id' => $webhook->getId(),
            'url' => $webhook->getUrl(),
            'description' => $webhook->getDescription(),
            'events' => $webhook->getEvents(),
        ];

        $this->mandrill->command('webhook.update', $parameters);
    }

    /**
     * Delete the webhook.
     *
     * @param Webhook $webhook
     */
    public function delete(Webhook $webhook)
    {
        $parameters = [
            'id' => $webhook->getId(),
        ];

        $this->mandrill->command('webhook.delete', $parameters);
    }
}
