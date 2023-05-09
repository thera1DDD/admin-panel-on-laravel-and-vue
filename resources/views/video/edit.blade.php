@extends('layouts.admin')

@section('title')
    Edit Video
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('video.update',$video->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Name</label>
                    <div class="form-group">
                        <input type="text" value="{{ $video->name ?? old('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <label for="description">Description</label>
                    <div class="form-group">
                        <input type="text" value="{{ $video->description ?? old('description') }}" name="description" class="form-control" placeholder="Description">
                    </div>
                    <label for="video_file">Video</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="video_file" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="modules_id">Module</label>
                        <select  name="modules_id"  id="modules_id"  class="form-control select2" data-placeholder="Module" style="width: 100%;">
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}" {{ $module->id == $video->modules_id ? 'selected' : '' }}>
                                    {{ $module->name }}
                                </option>
                            @endforeach()
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Редактировать" >
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
