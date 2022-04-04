<?php

return [
    'watcher_sleep_ms'=> '10000',
    'manager' => \App\Classes\EventsPipeline\QueueManagers\FilesQueueManager::class, //
    'mappging' => [
        'event1' => ['pipe1', 'pipe2', 'pipe3'], //Multiple pipes per event
        'event2' => ['pipe3'], //Multiple pipes per event
    ]
];
