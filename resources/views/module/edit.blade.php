@extends('layouts.admin')

@section('title')
    Редактировать модуль
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('module.update',$module->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Код модуля</label>
                    <div class="form-group">
                        <input type="text" value="{{ $module->code ?? old('code') }}" name="code" class="form-control" placeholder="Name">
                    </div>
                    <label for="name">Название</label>
                    <div class="form-group">
                        <input type="text" value="{{ $module->name ?? old('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <label for="description">Описание</label>
                    <div class="form-group">
                        <input type="text" value="{{ $module->description ?? old('description') }}" name="description" class="form-control" placeholder="Description">
                    </div>
                    <label for="number">Глава</label>
                    <div class="form-group">
                        <input type="text" value="{{ $module->number ?? old('number') }}" name="number" class="form-control" placeholder="Number">
                    </div>
                    <div class="form-group">
                        <label for="main_image">Главное фото</label>
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
                        <label for="courses_id">Курс</label>
                        <select  name="courses_id"  id="courses_id"  class="form-control select2" style="width: 100%;">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $module->courses_id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Slug</label>
                        <input type="text" value="{{ $module->slug ?? old('slug') }}" name="slug" class="form-control" placeholder="slug">
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
