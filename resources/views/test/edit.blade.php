@extends('layouts.admin')

@section('title')
    Edit Test
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('test.update',$test->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="name">Name</label>
                    <div class="form-group">
                        <input type="text" value="{{ $test->name ?? old('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div hidden="hidden" class="form-group">
                        <label for="name">Module type</label>
                        <select  name="testable_type"  id="testable_type" class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                            <option value="App\Models\Module">Module</option>
                        </select>
                        @error('testable_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Module</label>
                        <select name="testable_id"  class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                            @foreach($modules as $module)
                                <option value="{{$module->id}}">{{$module->name}}</option>
                            @endforeach()
                        </select>
                        @error('testable_id')
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
