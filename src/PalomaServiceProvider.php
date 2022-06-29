<?php

namespace Revo\Paloma;

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
            ->hasMigration('create_sent_sms_table');
    }

    public function register()
    {
        parent::register();
        $this->app->bind(\Revo\Paloma\Contracts\Sender::class, \Revo\Paloma\Sender::class);
    }
}
