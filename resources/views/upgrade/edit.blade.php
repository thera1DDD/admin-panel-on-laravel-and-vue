@extends('layouts.admin')

@section('title')
    Edit Language
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('upgrade.update',$upgrade->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="name">Текст</label>
                        <textarea  type="text" name="text"  id="text"  class="form-control @error('text') is-invalid @enderror"  required placeholder="Текст" > {{$upgrade->text}}</textarea>
                        @error('text')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Заголовок</label>
                        <input type="text" name="header"  value="{{$upgrade->header}}" id="header" class="form-control @error('header') is-invalid @enderror"  required placeholder="Заголовок">
                        @error('name')
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
