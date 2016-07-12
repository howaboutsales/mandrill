<?php

namespace Shareworks\Component\Mandrill\Tests;

use JMS\Serializer\SerializerBuilder;
use Shareworks\Component\Mandrill\Email\Message;
use Shareworks\Component\Mandrill\Email\Recipient;
use Shareworks\Component\Mandrill\Mandrill;

class MandrillTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Mandrill
     */
    private static $mandrill;

    public function testCommandNotExists()
    {
        $this->setExpectedException('InvalidArgumentException');

        static::$mandrill->command('foo.bar', ['foo' => 'bar']);
    }

    public function testCommandMissingParameters()
    {
        $this->setExpectedException('Symfony\Component\OptionsResolver\Exception\MissingOptionsException');

        static::$mandrill->command('message.send', []);
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $serializer = SerializerBuilder::create()->build();
        $options = [
            'token' => 'LQtVSYd7hHiaEJDVA457-g',
        ];

        static::$mandrill = new Mandrill($serializer, $options);
    }

    public static function tearDownAfterClass()
    {
        static::$mandrill = null;

        parent::tearDownAfterClass();
    }
}
