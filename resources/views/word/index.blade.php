@extends('layouts.admin')

@section('title')
Слова
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ url()->current() }}" method="GET">
            <input type="text" name="query" placeholder="Поиск...">
            <button type="submit">Найти/Очистить</button>
        </form>
        <div class="card-tools">
            <a href="{{ route('word.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить новое слово </a>
        </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Слово</th>
                    <th>Дата создания</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
            @if(count($words) > 0)
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
            @endif
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection
