<?php

namespace Revo\Paloma;

use Revo\Paloma\Commands\PalomaCommand;
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
            ->hasMigration('create_paloma_table')
            ->hasCommand(PalomaCommand::class);
    }
}
