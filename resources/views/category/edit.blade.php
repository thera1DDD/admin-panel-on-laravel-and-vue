@extends('layouts.admin')

@section('title')
    Редактировать категорию
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Категория</label>
                    <div class="form-group">
                        <input type="text" value="{{ $category->name ?? old('name') }}" name="name" class="form-control" placeholder="Название категории">
                    </div>
                    <div class="form-group">
                        <label for="location">Местоположение</label>
                        <select  name="location" id="location" class="form-control select2" style="width: 100%;">
                            <option value="header" {{ $category->location == 'header' ? 'selected' : '' }}>Header</option>
                            <option value="footer" {{ $category->location == 'footer' ? 'selected' : '' }}>Footer</option>
                            <option value="menu" {{ $category->location == 'menu' ? 'selected' : '' }}>Menu</option>
                            <option value="underMenu" {{ $category->location == 'underMenu' ? 'selected' : '' }}>UnderMenu</option>
                        </select>
                        @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label for="name">Путь</label>
                    <div class="form-group">
                        <input type="text" value="{{ $category->path ?? old('name') }}" name="path" class="form-control" placeholder="Ссылка на категорию">
                    </div>
                    <div class="form-group">
                        <label for="status">Активность</label>
                        <select  name="status"  id="status" class="form-control select2" style="width: 100%;">
                            @if($category->status == 1)
                                <option value="1">Активен</option>
                                <option value="0">Не Активен</option>
                            @else
                                <option value="0">Не Активен</option>
                                <option value="1">Активен</option>
                            @endif
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Колона</label>
                        <select name="columns_id"  id="columns_id" class="form-control select2"  style="width: 100%;">
                            @foreach($columns as $column)
                                <option value="{{$column->id }}" {{$column->id == $column->columns_id ? 'selected' : ''}}>
                                    {{$column->name }}
                                </option>
                            @endforeach()
                        </select>
                        @error('columns_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Постер</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="poster" type="file" class="custom-file-input" id="exampleInputFile" accept="image/*">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                        @error('poster')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
