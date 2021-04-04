<?php

require __DIR__ . "/../Sender.php";

class SenderTest extends PHPUnit\Framework\TestCase
{
    public function testFailSendMsg()
    {
        $sender = new Sender('127.0.0.1');
        $this->assertFalse($sender->sendMessage('84359435435'));
    }
}