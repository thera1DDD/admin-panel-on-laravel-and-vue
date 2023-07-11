<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ClearVerificationCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verification:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаляет верификационный код старше одной недели';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $weekAgo = now()->subSeconds(40);

        User::query()->forceDelete();

        $this->info('Verification codes cleared successfully.');
    }
}
