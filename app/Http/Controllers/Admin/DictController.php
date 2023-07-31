<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DictTestImport;
use App\Models\Dict;
use Illuminate\Http\Request;
use App\Jobs\ProcessUploadedFile;
use Maatwebsite\Excel\Facades\Excel;


class DictController extends Controller
{
   public function index(){
       $dicts = Dict::paginate(40);
       return view('dict.index',compact('dicts'));
   }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');
        $filePath = $file->path();


        Excel::import(new DictTestImport(), $filePath);

        return redirect()->back()->with('success', 'Файл успешно импортирован.');
    }
}
