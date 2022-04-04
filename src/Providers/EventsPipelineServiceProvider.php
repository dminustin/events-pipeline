<?php

namespace App\Providers;

use App\Classes\EventsPipeline\EventsPipelineSender;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class EventsPipelineServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(EventsPipelineSender::class, function (Application $app) {
            $config = $app->make('config')->get('events-pipeline', []);
            $class = $config['manager'];
            if(class_exists($class)) {
                $manager = new $class();
                return new EventsPipelineSender($app, $manager, $config);
            }
            throw new \Exception(sprintf('Events pipeline manager "%s" not found', $class));
        });
        $this->app->alias(EventsPipelineSender::class, 'events-pipeline');
    }

    public function provides()
    {
        return ['events-pipeline'];
    }
}
