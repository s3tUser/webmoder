<?php

class User
{
    public static function getUserByCookie(string $cookie): array
    {
        $user_list = self::getUsers();

        if (!isset($user_list[$cookie])) {
            return [];
        }

        return $user_list[$cookie];
    }

    protected static function getUsers(): array
    {
        $users = [];
        $i     = 1;

        do {
            $key = md5((10000 + $i));

            if (isset($users[$key])) {
                continue;
            }

            $users[$key] = [
                'id'           => $i++,
                'is_confirmed' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];
        } while (count($users) < 10);

        return $users;
    }
}