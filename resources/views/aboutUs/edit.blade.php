@extends('layouts.admin')

@section('title')
    Редактировать язык
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('aboutUs.update',$aboutUs->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="firstQuote">Первая цитата:</label>
                        <textarea id="firstQuote" name="firstQuote"  style="width: 500px" class="form-control" rows="4">{{$aboutUs->firstQuote}}</textarea>
                        @error('firstQuote')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="secondQuote">Вторая цитата</label>
                        <textarea id="secondQuote" name="secondQuote"  style="width: 500px" class="form-control" rows="4">{{$aboutUs->secondQuote}}</textarea>
                        @error('secondQuote')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">SVG Фото</label>
                        <textarea id="image" name="image"  style="width: 500px" class="form-control" rows="20">{{$aboutUs->image}}</textarea>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="big_image">Главное фото</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="big_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите фото</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                        @error('big_image')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="text_content">Основной текст</label>
                        <textarea id="text_content" name="text_content"  style="width: 500px" class="form-control" rows="10">{{$aboutUs->text_content}}</textarea>
                        @error('text_content')
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
