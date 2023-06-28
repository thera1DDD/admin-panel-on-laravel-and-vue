@extends('layouts.admin')

@section('title')
   Перевод
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Перевод</h3>
            <div class="card-tools">
                <a href="{{ route('translate.create',$words_id)}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить новый перевод</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Язык</th>
                    <th>Перевод</th>
                    <th>Дата добавления</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($translates as $translate)
                    <tr>
                        <td>{{ $translate->id }}</td>
                        <td>{{$translate->language->name ?? ''}}</td>
                        <td>{{$translate->translate}}</td>
                        <td>{{ $translate->created_at }}</td>
                        <td>
                            <a style="width: 105px" href="{{ route('translate.edit', $translate->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <br>
                            <form action="{{route('translate.delete',$translate->id) }}" method="post">
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
