<?php

namespace App\Jobs;

use App\Models\Dict;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportDictJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rows = Excel::toCollection([], $this->file);

        // Iterate through the rows and save them to the "dict" table
        foreach ($rows as $row) {
            // Assuming your Excel has columns in the order of text, locale, ids
            $data = [
                'text' => $row[1],
                'locale' => $row[2],
                'ids' => $row[3],
            ];

            Dict::create($data);
        }
    }
}
