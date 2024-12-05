<?php
class MyLog
{
    private $log;

    public function __construct(string $filename)
    {
        $this->log = new Monolog\Logger('name');
        $this->log->pushHandler(
            new Monolog\Handler\StreamHandler($filename, Monolog\Level::Info)
        );
    }
    
}
