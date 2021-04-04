<?php

$redis = new Redis();
$redis->connect('redis');

while (true) {
    $phone_number = $redis->rawCommand('LPOP', getenv('REDIS_LIST'));

    if (!$phone_number) {
        sleep(1);

        continue;
    }

    $code = random_int(10000, 99999);

    file_put_contents('/var/www/webmoder/fake_sms/codes.log', $phone_number . ' - ' . $code . PHP_EOL);

    echo 'Ok', PHP_EOL;
}