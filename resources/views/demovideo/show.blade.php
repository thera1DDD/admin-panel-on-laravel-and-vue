@extends('layouts.admin')

@section('title')
    Demo Video
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Demo Videos</h3>

            <div class="card-tools">
                <a href="{{ route('demovideo.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new video</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <video class="video_show"  controls src="{{$video_file_path}}" ></video>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
