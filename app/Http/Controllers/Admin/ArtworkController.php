<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Artwork\StoreRequest;
use App\Http\Requests\Artwork\UpdateRequest;
use App\Models\Artwork;
use App\Models\Language;
use App\Service\ArtworkService;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    use ImageUploadTrait;
    protected $artworkService;
    public function __construct(ArtworkService $artworkService)
    {
        $this->artworkService = $artworkService;
    }

    public function  index(){
        $artworks = Artwork::all();
        return view('artwork.index',compact('artworks'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        if ($request->hasFile('filename')) {
            $path = $request->file('filename')->store('artworks', 'public');
            $data['filename'] = Storage::disk('public')->url($path);
        }
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('artworks/posters', 'public');
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $this->artworkService->store($data);
        return redirect()->route('artwork.index')->with('success','Artwork created');
    }


    public function create(){
        $artworks = Artwork::all();$languages = Language::all();
        return view('artwork.create',compact('artworks','languages'));
    }


    public function update(UpdateRequest  $request, Artwork $artwork){
        $data = $request->validated();
        if ($request->hasFile('filename')) {
            $path = $request->file('filename')->store('artworks', 'public');
            $data['filename'] = Storage::disk('public')->url($path);
        }
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('artworks/posters', 'public');
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $this->artworkService->update($artwork,$data);
        return redirect()->route('artwork.index')->with('success','Artwork updated');
    }

    public function show(Artwork $artworks,Language $languages ){
        return view('artwork.show',compact('artworks','languages'));
    }

    public function edit(Artwork $artwork){
        $languages = Language::all();
        return view('artwork.edit',compact('artwork','languages'));
    }
    public function delete(Artwork $artwork){
        $artwork->delete();
        return redirect()->route('artwork.index')->with('success','Artwork deleted');
    }
}
