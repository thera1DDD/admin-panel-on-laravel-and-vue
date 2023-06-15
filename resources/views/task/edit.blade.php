@extends('layouts.admin')

@section('title')
    Редактировать слово
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('task.update',$task->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="word">Слово</label>
                    <div class="form-group">
                        <input type="text" value="{{ $task->word ?? old('word') }}" name="word" class="form-control" placeholder="Слово">
                    </div>
                    <label for="number">Номер</label>
                    <div class="form-group">
                        <input type="text" value="{{ $task->number ?? old('number') }}" name="number" class="form-control" placeholder="Номер">
                    </div>
                    <div class="form-group">
                        <label for="name">Название задания</label>
                        <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{$task->name}}" required placeholder="Слово">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Описание</label>
                        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{$task->description}}" required placeholder="Слово">
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Модуль</label>
                        <select name="modules_id"  id="modules_id" class="form-control select2" data-placeholder="Выберите task" style="width: 100%;">
                            @foreach($modules as $module)
                                <option value="{{$module->id}}" {{ $module->id == $task->modules_id ? 'selected' : '' }}  >
                                    {{$module->name}}
                                </option>
                            @endforeach()
                        </select>
                        @error('modules_id')
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
