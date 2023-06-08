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
                <form action="{{route('column.update',$column->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Название</label>
                    <div class="form-group">
                        <input type="text" value="{{ $column->name ?? old('name') }}" name="name" class="form-control" placeholder="Название колоны">
                    </div>
                    <label for="name">Очередь</label>
                    <div class="form-group">
                        <input type="text" value="{{ $column->queue ?? old('queue') }}" name="queue" class="form-control" placeholder="Очередь">
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
