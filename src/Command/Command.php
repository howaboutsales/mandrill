<?php

namespace Shareworks\Component\Mandrill\Command;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Mandrill API command.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Command
{
    private $initialized = false;
    private $name;
    private $path;
    private $responseType;
    private $resolver;

    public function __construct($name, $path, $responseType)
    {
        $this->name = $name;
        $this->path = $path;
        $this->responseType = $responseType;
        $this->resolver = new OptionsResolver();
    }

    public static function create($name, $path, $responseType)
    {
        return new static($name, $path, $responseType);
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getParameters()
    {
        return $this->resolver->getDefinedOptions();
    }

    public function getResponseType()
    {
        return $this->responseType;
    }

    public function resolveParameters(array $parameters)
    {
        return $this->resolver->resolve($parameters);
    }

    public function setupParameterResolver(array $required = [], array $optional = [])
    {
        if ($this->initialized) {
            throw new \BadMethodCallException('Cannot set up parameter resolver, already set up.');
        }

        $this->resolver->setRequired($required);
        $this->resolver->setOptional($optional);

        $this->initialized = true;
    }
}
