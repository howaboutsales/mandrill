<?php

namespace Shareworks\Component\Mandrill\Tests\Email;

use JMS\Serializer\SerializerBuilder;
use Shareworks\Component\Mandrill\Email\Dispatcher;
use Shareworks\Component\Mandrill\Email\Message;
use Shareworks\Component\Mandrill\Email\Recipient;
use Shareworks\Component\Mandrill\Email\StatusResponse;
use Shareworks\Component\Mandrill\Mandrill;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Dispatcher
     */
    private static $dispatcher;

    public function testSend()
    {
        $message = Message::create();
        $message->addRecipient(Recipient::to('user@example.com', 'Foo Bar'));
        $message->setSubject('Lorem Ipsum');
        $message->setFrom('sender@example.com');
        $message->setHtmlBody('<html><body>Lorem ipsum dolor sit amet</body></html>');

        $response = static::$dispatcher->send($message);
        $this->assertNotEmpty($response);
        $response = $response[0];
        $this->assertInstanceOf('Shareworks\Component\Mandrill\Email\StatusResponse', $response);
        $this->assertEquals(StatusResponse::STATUS_SENT, $response->getStatus());
        $this->assertEquals('user@example.com', $response->getRecipient());
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $serializer = SerializerBuilder::create()->build();
        $options = [
            'token' => 'LQtVSYd7hHiaEJDVA457-g',
        ];

        $mandrill = new Mandrill($serializer, $options);
        static::$dispatcher = new Dispatcher($mandrill);
    }

    public static function tearDownAfterClass()
    {
        static::$dispatcher = null;

        parent::tearDownAfterClass();
    }
}
