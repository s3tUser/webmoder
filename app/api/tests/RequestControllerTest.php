<?php

require __DIR__ . "/../RequestController.php";

class RequestControllerTest extends PHPUnit\Framework\TestCase
{
    public function testRequestExceptionOnInvalidMethod()
    {

        $this->expectException(LogicException::class);

        $request = new RequestController('DELETE', 'test');
        $request->processRequest();
    }

    public function testGetRequestExceptionOnInvalidAction()
    {

        $this->expectException(LogicException::class);

        $request = new RequestController('GET', 'test');
        $request->processRequest();
    }

    public function testGetRequestExceptionOnUnauthorized()
    {

        $this->expectException(LogicException::class);

        $request = new RequestController('GET', 'profile');
        $request->processRequest();
    }

    public function testPostRequestExceptionOnInvalidAction()
    {

        $this->expectException(LogicException::class);

        $request = new RequestController('POST', 'test');
        $request->processRequest();
    }

    public function testPostRequestExceptionMethodConfirmWhenEmptyPost()
    {

        $this->expectException(LogicException::class);

        $request = new RequestController('POST', 'confirm');
        $request->processRequest();
    }

    public function testPostRequestExceptionMethodRegWhenEmptyPost()
    {

        $this->expectException(LogicException::class);

        $request = new RequestController('POST', 'reg');
        $request->processRequest();
    }
}