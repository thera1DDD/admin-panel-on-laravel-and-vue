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
                <form action="{{route('question.update',$question->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Name</label>
                    <div class="form-group">
                        <input type="text" value="{{ $question->name ?? old('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Test</label>
                        <select name="tests_id"  id="tests_id" class="form-control select2" data-placeholder="Выберите question" style="width: 100%;">
                            @foreach($tests as $test)
                                <option value="{{$test->id}}">{{$test->name}}</option>
                            @endforeach()
                        </select>
                        @error('tests_id')
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
