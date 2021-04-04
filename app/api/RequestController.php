<?php

require "Sender.php";
require "User.php";

class RequestController
{
    protected const COOKIE_NAME = 'user_verify';

    protected $request_method;
    protected $request_action;

    public function __construct(string $request_method, string $request_action)
    {
        $this->request_method = $request_method;
        $this->request_action = $request_action;
    }

    public function processRequest()
    {
        if ($this->request_method === 'GET') {
            return $this->getRequest();
        }

        if ($this->request_method === 'POST') {
            return $this->postRequest();
        }

        return $this->notFoundResponse();
    }


    protected function getRequest()
    {
        if ($this->request_action !== 'profile') {
            throw new \LogicException('Invalid action');
        }

        if (!isset($_COOKIE[self::COOKIE_NAME])) {
            throw new \LogicException('User unauthorized');
        }

        $user = User::getUserByCookie($_COOKIE[self::COOKIE_NAME]);

        exit(serialize($user));
    }

    protected function postRequest()
    {
        if ($this->request_action === 'reg' && !empty($_POST['phone_number'])) {
            $sender = new Sender();

            if ($sender->sendMessage($_POST['phone_number'])) {
                exit($_POST['phone_number']);
            }

            throw new \LogicException('Message was not sent');
        }

        if ($this->request_action === 'confirm' && !empty($_POST['verify_code'])) {
            setcookie(self::COOKIE_NAME, md5($_POST['verify_code']));

            exit('OK');
        }

        return $this->notFoundResponse();
    }

    protected function notFoundResponse(): array
    {
        throw new \LogicException('Response not found');
    }
}