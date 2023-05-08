<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\StoreRequest;
use App\Http\Requests\Photo\UpdateRequest;
use App\Models\Module;
use App\Models\Question;
use App\Models\Photo;
use App\Service\PhotoService;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{

    use ImageUploadTrait;
    protected $photoService;
    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function getRecordsByType($type)
    {
        $model = "App\Models\\" . $type;
        $records = $model::all();
        return response()->json($records);
    }

    public function index(){
        $photos = Photo::all();
//      $recordsOfmodel = $photos->photoable_type::all()->where($photos->id,'=',$photos->photable_id);
        return view('photo.index',compact('photos'));
    }

   public function create(){
        $modules = Module::all();$records = Module::all();
        return view('photo.create',compact('modules','records'));
   }

    public function edit(Photo $photo){
        $recordsOfModel = $photo->photoable_type::all();
        return view('photo.edit',compact('photo','recordsOfModel'));
    }
    public function delete(Photo $photo){
        $photo->delete();
        return redirect()->route('photo.index')->with('success','Photo deleted');
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        if(isset($data['filename'])){
            $this->uploadImage($data['filename'],'/images/photos',false,'public');
        }
        $this->photoService->store($data);
        return redirect()->route('photo.index')->with('success','Photo created');
    }
    public function update(UpdateRequest $request,Photo $photo){
        $data = $request->validated();
        if(isset($data['filename'])){
            $this->uploadImage($data['filename'],'/images/photos', false,'public');
        }
        $this->photoService->update($data,$photo);
        return redirect()->route('photo.index')->with('success','Photo updated');
    }
}
