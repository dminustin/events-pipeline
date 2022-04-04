<?php

namespace EventsPipeline;

use FastController\Console\FastControllerGenerateCommand;
use Illuminate\Support\ServiceProvider;

class EventsPipelineServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        // Publish a config file
        $configPath = __DIR__ . '/../config/events-pipeline.php';
        $this->publishes([
            $configPath => config_path('events-pipeline.php'),
        ], 'config');
        
        //publish project classes
        $uploads = array_merge(
            $this->getFiles('Classes/EventsPipeline'),
            $this->getFiles('Classes/EventsPipeline/QueueManagers'),
            $this->getFiles('Providers'),
        );
        $this->publishes($uploads, 'events-pipeline');
    }
    
    protected function getFiles($prefix): array
    {
        $uploads = [];
        $files = glob(__DIR__. '/' . $prefix . '/*.php');
        foreach($files as $file) {
            $uploads[$file] = app_path() . '/' . $prefix . '/'  . basename($file);
        }
        return $uploads;
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/events-pipeline.php';
        $this->mergeConfigFrom($configPath, 'events-pipeline');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
