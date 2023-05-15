<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $logs = Log::query();
        if ($request->has('query')) {
            $query = $request->input('query');
            $logs->where('action_type', 'like', "%{$query}%");
        }
        $logs = $logs->get();
        return view('log.index', ['logs' => $logs]);
    }

    public function delete(Log $log){
        $log->delete();
        return redirect()->route('log.index')->with('Успешно','Логи удаленны!');
    }
}
