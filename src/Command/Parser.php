<?php

namespace Shareworks\Component\Mandrill\Command;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

/**
 * Parser for command definition files.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Parser
{
    /** @var OptionsResolver */
    private static $resolver;

    private static function initialize()
    {
        static::$resolver = new OptionsResolver();
        static::$resolver->setRequired(['name', 'path']);
        static::$resolver->setDefaults([
            'parameters' => [],
            'response' => 'array<string,string>',
        ]);
    }

    public static function parse($path)
    {
        if (null === static::$resolver) {
            static::initialize();
        }

        if (!file_exists($path)) {
            throw new \InvalidArgumentException('File at path "'.$path.'" does not exist.');
        }

        $data = file_get_contents($path);
        $data = Yaml::parse($data);

        $commands = [];

        foreach ($data as $name => $options) {
            $options['name'] = $name;
            $commands[$name] = static::createCommand($options);
        }

        return $commands;
    }

    private static function createCommand($options)
    {
        $options = static::$resolver->resolve($options);
        $command = Command::create($options['name'], $options['path'], $options['response']);

        list($required, $optional) = static::parseParameters($options['parameters']);
        $command->setupParameterResolver($required, $optional);

        return $command;
    }

    private static function parseParameters(array $parameters)
    {
        $required = [];
        $optional = [];

        foreach ($parameters as $parameter) {
            if (0 === strpos($parameter, '?')) {
                $optional[] = substr($parameter, 1);
            } else {
                $required[] = $parameter;
            }
        }

        return [$required, $optional];
    }
}
