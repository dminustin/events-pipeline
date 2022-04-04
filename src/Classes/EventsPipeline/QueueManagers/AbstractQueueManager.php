<?php

namespace App\Classes\EventsPipeline\QueueManagers;

use App\Classes\EventsPipeline\EventData;

abstract class AbstractQueueManager
{
    public abstract function send(EventData $data): bool|string;

    public abstract function receive(string $pipeName): ?EventData;
    
    public function watch(string $pipeName)
    {
        $sleepTime = config()->get('events-pipeline.watcher_sleep_ms', 100);
        for(;;) {
            if(!$this->receive($pipeName)) {
                usleep($sleepTime);
                continue;
            }
        }
    }
}