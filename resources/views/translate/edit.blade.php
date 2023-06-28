@extends('layouts.admin')

@section('title')
    Обновить перевод
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form method="POST" action="{{ route('translate.update',$translate->id) }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="name">Язык</label>
                        <select  name="languages_id"  id="languages_id"  class="form-control select2" data-placeholder="Language" style="width: 100%;">
                            @foreach($languages as $language)
                                <option value="{{$language->id }}" {{$language->id == $translate->languages_id ? 'selected' : ''}}>
                                    {{$language->name }}
                                </option>
                            @endforeach()
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="translate">Перевод</label>
                        <input type="text" name="translate"    id="translate" class="form-control @error('translate') is-invalid @enderror" value="{{$translate->translate}}" required placeholder="Перевод">
                        @error('translate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Обновить" >
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
