<?php

namespace Shareworks\Component\Mandrill\Email;

use Shareworks\Component\Mandrill\Mandrill;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Mandrill email dispatcher.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Dispatcher
{
    private $mandrill;
    private $options;

    /**
     * Constructor.
     *
     * @param Mandrill $mandrill
     * @param array    $options
     */
    public function __construct(Mandrill $mandrill, array $options = [])
    {
        $defaults = [
            'async' => true,
        ];

        $this->mandrill = $mandrill;
        $this->options = $this->resolveOptions($options, $defaults);
    }

    /**
     * Send a message.
     *
     * @param Message $message The message
     * @param array   $options The message options (async, ip_pool, send_at)
     *
     * @return StatusResponse[] An array of statuses for each recipient of the message
     */
    public function send(Message $message, array $options = [])
    {
        $options['message'] = $message;
        $parameters = $this->resolveOptions($options, $this->options);

        return $this->mandrill->command('message.send', $parameters);
    }

    /**
     * Send a message using a Mandrill template.
     *
     * @param Message $message  The message
     * @param string  $template The template name
     * @param array   $blocks   The template blocks
     * @param array   $options  The message options (async, ip_pool, send_at)
     *
     * @return StatusResponse[] An array of statuses for each recipient of the message
     */
    public function sendTemplate(Message $message, $template, array $blocks, array $options = [])
    {
        $options['message'] = $message;
        $options['template_name'] = $template;
        $options['template_content'] = $blocks;
        $parameters = $this->resolveOptions($options, $this->options);

        return $this->mandrill->command('message.sendTemplate', $parameters);
    }

    private function resolveOptions(array $options, array $defaults = [])
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults($defaults);
        $resolver->setOptional(['message', 'async', 'ip_pool', 'send_at', 'template_name', 'template_content']);

        return $resolver->resolve($options);
    }
}
