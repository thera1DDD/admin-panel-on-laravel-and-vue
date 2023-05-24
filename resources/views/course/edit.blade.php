@extends('layouts.admin')

@section('title')
    Редактировать курс
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('course.update',$course->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Название</label>
                    <div class="form-group">
                        <input type="text" value="{{ $course->name ?? old('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Главное фото</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="main_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Язык</label>
                        <select  name="languages_id"  id="languages_id"  class="form-control select2" data-placeholder="Language" style="width: 100%;">
                            @foreach($languages as $language)
                                <option value="{{$language->id }}" {{$language->id == $course->languages_id ? 'selected' : ''}}>
                                    {{$language->name }}
                                </option>
                            @endforeach()
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Slug</label>
                        <input type="text" value="{{ $course->slug ?? old('slug') }}" name="slug" class="form-control" placeholder="slug">
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
