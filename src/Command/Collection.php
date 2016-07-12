<?php

namespace Shareworks\Component\Mandrill\Command;

use Symfony\Component\Config\FileLocator;

class Collection
{
    private $commands = [];
    private $locator;

    /**
     * Constructor.
     *
     * @param string $baseDir The base directory for command definition files.
     */
    public function __construct($baseDir)
    {
        $this->locator = new FileLocator($baseDir);
    }

    /**
     * Load commands from the given YAML file.
     *
     * @param string $file The name of the file (inside the $baseDir)
     */
    public function load($file)
    {
        $path = $this->locator->locate($file);

        $this->commands += Parser::parse($path);
    }

    /**
     * @param string $name The name of the command
     *
     * @return Command
     */
    public function get($name)
    {
        if (!array_key_exists($name, $this->commands)) {
            throw new \InvalidArgumentException('The command "'.$name.'" does not exist.');
        }

        return $this->commands[$name];
    }
}
