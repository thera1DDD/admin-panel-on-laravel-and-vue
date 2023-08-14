@extends('layouts.admin')

@section('title')
Languages
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Язык</h3>

        <div class="card-tools">
            <a href="{{ route('language.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить язык</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Язык</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($languages as $language)
                    <tr>
                        <td>{{ $language->id }}</td>
                        <td>{{ $language->name }}</td>
                        <td>{{  \Carbon\Carbon::parse($language->created_at)->diffForHumans() ?? null }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('language.edit', $language->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('language.delete',$language->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width: 110px;"  type="submit" value="Удалить" class="btn btn-danger">
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
