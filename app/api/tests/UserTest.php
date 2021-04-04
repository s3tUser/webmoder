<?php

require __DIR__ . "/../User.php";

class UserTest extends PHPUnit\Framework\TestCase
{
    public function testUserIsArray()
    {
        $cookie = md5(random_int(10000, 99999));

        $this->assertIsArray(User::getUserByCookie($cookie));
    }

    public function testUserConsistId()
    {
        $cookie = md5(10003);

        $this->assertArrayHasKey('id', User::getUserByCookie($cookie));
    }
}