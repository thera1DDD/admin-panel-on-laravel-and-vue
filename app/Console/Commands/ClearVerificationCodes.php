<?php

namespace App\Console\Commands;

use App\Models\TestResult;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
//        $weekAgo = now()->subSeconds(40);
//
//        User::whereNotNull('verification_code')
//            ->where('created_at', '<=', $weekAgo)
//            ->forceDelete();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('words')->truncate();
        DB::table('translates')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        $this->info('Verification codes cleared successfully.');
    }
}
