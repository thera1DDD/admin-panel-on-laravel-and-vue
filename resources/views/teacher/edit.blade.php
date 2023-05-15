@extends('layouts.admin')

@section('title')
    Edit Course
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('teacher.update',$teacher->id)}}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="name">Должность</label>
                        <input type="text" name="position"   id="position" class="form-control @error('position') is-invalid @enderror" value="{{$teacher->position}}" required placeholder="Название">
                        @error('position')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Пользователь</label>
                        <select  name="users_id"  id="users_id"  class="form-control select2" data-placeholder="Пользователь" style="width: 100%;">
                            @foreach($users as $user)
                                <option value="{{$user->id }}" {{$user->id == $teacher->users_id ? 'selected' : ''}}>
                                    {{$user->name }}
                                </option>
                            @endforeach()
                        </select>
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
