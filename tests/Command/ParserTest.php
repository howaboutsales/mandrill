<?php

namespace Shareworks\Component\Mandrill\Tests\Command;

use Shareworks\Component\Mandrill\Command\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParser()
    {
        $commands = Parser::parse(__DIR__.'/yml/commands.yml');

        $this->assertArrayHasKey('foo.bar', $commands);

        $command = $commands['foo.bar'];
        $this->assertInstanceOf('Shareworks\Component\Mandrill\Command\Command', $command);
        $this->assertEquals('/foo/bar', $command->getPath());
        $this->assertEquals('Foo\Bar', $command->getResponseType());

        $parameters = $command->getParameters();
        $this->assertNotEmpty($parameters);
        $this->assertEquals(['req_param', 'opt_param'], $parameters);
    }
}
