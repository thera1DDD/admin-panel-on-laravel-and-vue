@extends('layouts.admin')

@section('title')
    Edit Demo Video
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('demovideo.update',$demovideo->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Name</label>
                    <div class="form-group">
                        <input type="text" value="{{ $demovideo->name ?? old('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <label for="description">Description</label>
                    <div class="form-group">
                        <input type="text" value="{{ $demovideo->description ?? old('description') }}" name="description" class="form-control" placeholder="Description">
                    </div>
                    <label for="demovideo_file">Demo Video</label>
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
                        <label for="courses_id">Course</label>
                        <select  name="courses_id"  id="courses_id"  class="form-control select2" data-placeholder="Module" style="width: 100%;">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $demovideo->courses_id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach()
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Постер</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="poster" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
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
