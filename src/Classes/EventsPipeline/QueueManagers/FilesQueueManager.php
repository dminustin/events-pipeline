<?php

declare(strict_types=1);

namespace App\Classes\EventsPipeline\QueueManagers;

use App\Classes\EventsPipeline\EventData;

class FilesQueueManager extends AbstractQueueManager
{
    public function send(string $pipeName, EventData $data): bool|string
    {
        return true;
    }

    public function receive(string $pipeName): ?EventData
    {
        // TODO: Implement receive() method.
    }

}