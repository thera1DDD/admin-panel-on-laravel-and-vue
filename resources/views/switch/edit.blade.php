@extends('layouts.admin')

@section('title')
    Редактировать переключатель
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('switchLang.update',$switchLang->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{$switchLang->name}}" required placeholder="Название">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Описание</label>
                            <input type="text" name="description"  id="description" class="form-control @error('description') is-invalid @enderror" value="{{$switchLang->description}}" required placeholder="Описание">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="switch">Переключатель</label>
                            <input type="text" name="switch"  id="switch" class="form-control @error('switch') is-invalid @enderror" value="{{ $switchLang->switch }}" required placeholder="Переключатель">
                            @error('switch')
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
