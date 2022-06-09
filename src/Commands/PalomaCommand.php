<?php

namespace Revo\Paloma\Commands;

use Illuminate\Console\Command;

class PalomaCommand extends Command
{
    public $signature = 'paloma';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
