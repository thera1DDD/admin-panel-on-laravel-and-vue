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
                <form action="{{route('language.update',$language->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Язык</label>
                    <div class="form-group">
                        <input type="text" value="{{ $language->name ?? old('name') }}" name="name" class="form-control" placeholder="Язык">
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
