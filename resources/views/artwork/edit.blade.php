@extends('layouts.admin')

@section('title')
    Редактировать книгу
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('artwork.update',$artwork->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{$artwork->name}}" required placeholder="Название">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Описание</label>
                        <input type="text" name="description"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $artwork->description }}" required placeholder="Описание">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Язык</label>
                        <select  name="languages_id"  id="languages_id"  class="form-control select2" data-placeholder="Language" style="width: 100%;">
                            @foreach($languages as $language)
                                <option value="{{$language->id }}" {{$language->id == $artwork->languages_id ? 'selected' : ''}}>
                                    {{$language->name }}
                                </option>
                            @endforeach()
                        </select>
                        @error('language_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="documentType">Тип документа</label>
                        <select  name="documentType"  id="status" class="form-control select2" style="width: 100%;">
                            @if($artwork->documentType == 'book')
                                <option value="book">Книга</option>
                                <option value="document">Документ</option>
                            @else
                                <option value="document">Документ</option>
                                <option value="book">Книга</option>
                            @endif
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="filename">Файл</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="filename" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="filename">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                        @error('filename')
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
