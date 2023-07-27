<?php

namespace App\Jobs;
use App\Imports\DictTestImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessUploadedFile implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        set_time_limit(0);
        ini_set('memory_limit', '2048M');
        // Обрабатываем файл по указанному пути
        // Например, можно использовать Maatwebsite\Excel для импорта данных из файла
        Excel::import(new DictTestImport(), $this->filePath);
    }
}
