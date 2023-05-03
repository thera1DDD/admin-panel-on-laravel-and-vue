@extends('layouts.admin')

@section('title')
Words
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Word</h3>

        <div class="card-tools">
            <a href="{{ route('word.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new word</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Word</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($words as $word)
                    <tr>
                        <td>{{ $word->id }}</td>
                        <td><a href="{{route('translate.index', $word->id)}}">{{$word->name}}</a></td>
                        <td>{{ $word->created_at }}</td>
                        <td>
                            <a style="width: 105px" href="{{ route('word.edit', $word->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <br>
                            <a style="width: 105px" href="{{ route('translate.create', $word->id) }}" class="btn btn-sm btn-warning">Перевести</a>
                            <br>
                            <br>

                            <form action="{{route('word.delete',$word->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width: 105px;"  type="submit" value="Удалить" class="btn btn-danger">
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
