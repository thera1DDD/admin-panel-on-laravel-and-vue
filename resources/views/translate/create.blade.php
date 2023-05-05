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
                        <select name="words_id"  id="words_id" class="form-control select2" data-placeholder="Выберите слово" style="width: 100%;">
                            <option value="{{$word->id}}">{{$word->name}}</option>
                        </select>
                        @error('words_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Язык</label>
                        <select name="language"  id="language" class="form-control select2" data-placeholder="Выберите word" style="width: 100%;">
                              <option value="Лезгинский">Лезгинский язык</option>
                              <option value="Аварский">Аварский язык</option>
                        </select>
                        @error('language')
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
