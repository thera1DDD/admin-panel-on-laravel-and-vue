@extends('layouts.admin')

@section('title')
 О нас
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Цитаты О нас</h3>

        <div class="card-tools">
            <a href="{{ route('aboutUs.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить цитаты</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Первая цитата</th>
                    <th>Вторая цитата</th>
                    <th>Фото</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($aboutUss as $aboutUs)
                    <tr>
                        <td>{{ $aboutUs->id }}</td>
                        <td>{{ $aboutUs->firstQuote }}</td>
                        <td>{{ $aboutUs->secondQuote }}</td>
                        <td>{!!$aboutUs->image !!} </td>
                        <td>{{ $aboutUs->created_at }}</td>
                        <td>
                            <a style="width: 110px" href="{{ route('aboutUs.edit', $aboutUs->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>

                            <form action="{{route('aboutUs.delete',$aboutUs->id) }}" method="post">
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
