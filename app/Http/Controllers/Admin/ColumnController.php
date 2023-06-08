<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Column\StoreRequest;
use App\Http\Requests\Column\UpdateRequest;
use App\Models\Column;
use App\Service\ColumnService;

class ColumnController extends Controller
{


    protected $columnService;

    public function __construct(ColumnService $columnService)
    {
        $this->columnService = $columnService;
    }
    public function create($id){
        $column = Column::findOrfail($id);
        return view('column.create',compact('column'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->columnService->store($data);
        return redirect()->route('column.show',$data['columns_id'])->with('success','Column created');
    }

    public function edit(Column $column){
        $columns = Column::all();
        return view('column.edit',compact('column','columns'));
    }

    public function index(){
      $columns =  Column::all();
      return view('column.index',compact('columns'));
    }

    public function update(UpdateRequest $request,Column $column){
        $data = $request->validated();
        $this->columnService->update($data,$column);
        return redirect()->route('column.show',$column['columns_id'])->with('success','Column updated');
    }

    public function delete(Column $column){
        $column->delete();
        return redirect()->route('column.show',$column['columns_id'])->with('success','Column deleted');
    }
}
