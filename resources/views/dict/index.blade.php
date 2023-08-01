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
{{--            <a href="{{ route('dict.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить новое слово </a>--}}
{{--            <a href="{{ route('translate.allTranslates') }}" class="btn btn-primary"> Все переводы </a>--}}
            <form action="{{ route('dict.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <button type="submit">Загрузить</button>
            </form>
        </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>text</th>
                    <th>locale</th>
                    <th>ids</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
            @if(count($dicts) > 0)
                @forelse ($dicts as $dict)
                    <tr>
                        <td>{{ $dict->id }}</td>
                        <td>{{ $dict->text }}</td>
                        <td>{{ $dict->locale }}</td>
                        <td>{{ $dict->ids }}</td>
                        <td>{{ $dict->created_at }}</td>
                        <td>
                            <form action="{{route('dict.delete',$dict->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button style="width: 130px"  class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Удалить </button>
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
            @endif
            </tbody>
        </table>
    </div>
    <div class="card-footer"  style="width:150px ">
        <div class="pagination">
            {{ $dicts->links() }}
        </div>
    </div>
    <!-- /.card-body -->
  </div>
@endsection

