<?php

namespace Shareworks\Component\Mandrill;

use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;
use JMS\Serializer\SerializerInterface;
use Shareworks\Component\Mandrill\Command\Collection;
use Shareworks\Component\Mandrill\Exception\MandrillException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Wrapper for the Mandrill service to allow better integration with the service container.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Mandrill
{
    const API_BASE_URL = 'https://mandrillapp.com/api/1.0/';

    private static $clientOptions = [
        'defaults' => [
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent' => 'Mandrill/1.0 (shareworks; php)'
            ],
        ],
    ];

    private $client;
    private $serializer;
    private $token;
    private $commands;

    /**
     * Constructor.
     *
     * Initializes the Guzzle HTTP client and the available Mandrill API commands.
     *
     * @param SerializerInterface $serializer The serializer, for transforming the request and response data
     * @param array               $options    Options for the Mandrill API
     */
    public function __construct(SerializerInterface $serializer, array $options = [])
    {
        $options = $this->resolveOptions($options);

        $this->token = $options['token'];
        $this->serializer = $serializer;

        static::$clientOptions['base_url'] = $options['base_url'];

        // TODO: Abstract to service
        $this->client = new Client(static::$clientOptions);

        // TODO: Abstract to service
        $this->commands = new Collection($options['commands_dir']);
        $this->commands->load('messages.yml');
        $this->commands->load('webhooks.yml');
    }

    /**
     * Execute a command against the Mandrill API.
     *
     * @param string $name       The name of the command
     * @param array  $parameters The parameters for the command
     *
     * @return mixed The response, transformed into the type that is defined for the given command
     *
     * @throws MandrillException If the request was unsuccessful
     */
    public function command($name, array $parameters = [])
    {
        $parameters['key'] = $this->token;

        $command = $this->commands->get($name);
        $parameters = $command->resolveParameters($parameters);

        $response = $this->post($command->getPath(), $parameters);

        if ($response->getStatusCode() !== 200) {
            throw $this->responseToException($response);
        }

        return $this->serializer->deserialize($response->getBody(), $command->getResponseType(), 'json');
    }

    /**
     * Perform a POST request to the Mandrill API.
     *
     * @param string $path The path for the API call
     * @param array  $data The data for the API call (will be passed through a serializer to create a JSON string)
     *
     * @return ResponseInterface
     */
    private function post($path, array $data)
    {
        $body = $this->serializer->serialize($data, 'json');
        $path .= '.json';
        $path = ltrim($path, '/');

        return $this->client->post($path, ['body' => $body]);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return MandrillException
     */
    private function responseToException(ResponseInterface $response)
    {
        $body = $response->getBody();
        $error = json_decode($body, true);

        return MandrillException::createFromError($error['message'], $error['code']);
    }

    /**
     * Parse the options that can be set for this service.
     *
     * @param array $options
     *
     * @return array
     */
    private function resolveOptions(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(['token']);
        $resolver->setDefaults([
            'base_url' => static::API_BASE_URL,
            'commands_dir' => __DIR__.'/Resources/commands',
        ]);

        return $resolver->resolve($options);
    }
}
