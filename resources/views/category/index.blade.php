@extends('layouts.admin')

@section('title')
    Локация
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Локация</h3>
        <div class="card-tools">
            <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Добавить категорию</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Местоположение</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                    <tr>
                        <td>{{$locationIds[$location]}}</td>

                        <td><a href="{{ route('category.show',$location )}}">{{$location}}</a></td>
                        <td>
                            <a style="width: 110px" href="{{ route('category.edit',$locationIds[$location] )}}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{route('category.delete',$locationIds[$location])}}" method="post">
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
