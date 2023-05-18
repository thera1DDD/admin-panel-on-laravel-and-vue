@extends('layouts.admin')

@section('title')
    Edit Question
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('answer.update',$answer->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Name</label>
                    <div class="form-group">
                        <input type="text" value="{{ $answer->name ?? old('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Corect</label>
                        <select  name="is_correct"  id="is_correct" class="form-control select2" data-placeholder="IsCorrect" style="width: 100%;">
                            @if($answer->is_correct ==1)
                                <option value="1">Правильный</option>
                                <option value="0">Не правильный</option>
                            @else
                                <option value="0">Не правильный</option>
                                <option value="1">Правильный</option>
                            @endif
                        </select>
                        @error('is_correct')
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
