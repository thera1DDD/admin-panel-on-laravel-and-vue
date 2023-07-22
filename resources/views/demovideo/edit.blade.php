@extends('layouts.admin')

@section('title')
    Редактировать демо видео
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
                    <label for="name">Название</label>
                    <div class="form-group">
                        <input type="text" value="{{ $demovideo->name ?? old('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>

                    <label for="demovideo_file">Демо видео</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="video_file" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите видео</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="courses_id">Курс</label>
                        <select  name="courses_id"  id="courses_id"  class="form-control select2" data-placeholder="Module" style="width: 100%;">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $demovideo->courses_id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach()
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea id="description" name="description"  style="width: 500px" class="form-control" rows="7">{{$demovideo->description}} </textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="course_card_description">Описание №2</label>
                        <textarea id="course_card_description" name="course_card_description"  style="width: 500px" class="form-control" rows="7">{{$demovideo->course_card_description}} </textarea>
                        @error('course_card_description')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
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
