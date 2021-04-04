<?php

class Sender
{
    protected $redis;

    public function __construct(string $host_name = 'redis')
    {
        try {
            $this->redis = new Redis();
            $this->redis->connect($host_name);
        } catch (RedisException $e) {
            // logging
            $this->redis = null;
        }
    }

    public function sendMessage(string $phone): bool
    {
        try {
            if (!$this->redis instanceof Redis || !$this->redis->ping()) {
                return false;
            }

            return (bool)$this->redis->rawCommand('RPUSH', getenv('REDIS_LIST'), $phone);
        } catch (RedisException $e) {
            return false;
        }
    }
}