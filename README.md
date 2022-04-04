#Events Pipeline

##Version
1.0

##Installation
``composer require --dev dminustin/events-pipeline``

##Publish necessary files
``php artisan vendor:publish --provider "EventsPipeline\EventsPipelineServiceProvider"``

##Add to config/app.php
``\App\Providers\EventsPipelineServiceProvider::class``