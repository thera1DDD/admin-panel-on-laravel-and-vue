@extends('layouts.admin')

@section('title')
     Перевод
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form method="POST" action="{{ route('translate.store') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Слово</label>
                    <div class="form-group">
                        <select  name="words_id"  id="words_id" class="form-control select2" data-placeholder="Выберите слово" style="width: 100%;">
                            <option value="{{$word->id}}">{{$word->name}}</option>
                        </select>
                        @error('words_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="languages_id">Язык</label>
                        <select name="languages_id"  id="languages_id" class="form-control select2"  style="width: 100%;">
                            @foreach($languages as $language)
                                <option value="{{$language->id}}">{{$language->name}}</option>
                            @endforeach()
                        </select>
                        @error('languages_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="translate">Перевод</label>
                        <input type="text" name="translate"  id="translate" class="form-control @error('translate') is-invalid @enderror" value="{{ old('translate') }}" required placeholder="Перевод">
                        @error('translate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Добавить" >
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
