<?php

declare(strict_types=1);

namespace App\Classes\EventsPipeline;

class EventsPipelineSender
{
    /**
     * The name of the default driver.
     *
     * @var QueueManagers\AbstractQueueManager
     */
    protected $manager;

    /**
     * The Redis server configurations.
     *
     * @var array
     */
    protected $config;

    protected $app;
    
    const ERROR_EMPTY_MAPPING = 'empty_mapping';
    const ERROR_EMPTY_EVENT = 'empty_event';
    

    public function __construct($app, QueueManagers\AbstractQueueManager $manager, array $config)
    {
        $this->app = $app;
        $this->manager = $manager;
        $this->config = $config;
    }

    public function send(string $event, EventData $data): bool|string
    {
        if (!isset($this->config['mapping'])) {
            return self::ERROR_EMPTY_MAPPING;
        }
        $mapping = $this->config['mapping'];
        if (!isset($mapping[$event])) {
            return self::ERROR_EMPTY_EVENT;
        }
        $result = true;
        foreach ($mapping[$event] as $pipe) {
            $result = $result && $this->manager->send($pipe, $data);
        }
        return $result;
    }
}
