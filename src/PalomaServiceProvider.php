<?php

namespace Revo\Paloma;

use Nexmo\Client;
use Revo\Paloma\Commands\PalomaCommand;
use Revo\Paloma\Contracts\Sender;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PalomaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('paloma')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_sent_sms_table')
            ->hasCommand(PalomaCommand::class);
    }

    public function register()
    {
        parent::register();
        $this->app->bind(Sender::class, Client::class);
    }
}
