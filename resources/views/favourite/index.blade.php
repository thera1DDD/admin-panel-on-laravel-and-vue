@extends('layouts.admin')

@section('title')
Избранное
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Избранное</h3>

        <div class="card-tools">
            <a href="{{ route('favourite.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить пользователя в Избарнное</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Курс</th>
                    <th>Пользователь</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($favourites as $favourite)
                    <tr>
                        <td>{{ $favourite->id }}</td>
                        <td>{{ $favourite->course->name ?? 'Удаленный курс'}}</td>
                        <td>{{ $favourite->user->name ?? 'Удаленынй пользователь'}}</td>
                        <td>{{ $favourite->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('favourite.edit', $favourite->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>

                            <form action="{{route('favourite.delete',$favourite->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="height: 30px;"  type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection
