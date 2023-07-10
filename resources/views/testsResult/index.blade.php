@extends('layouts.admin')

@section('title')
    Результаты пользователей
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Результаты пользователей</h3>
        <div class="card-tools">
            <form action="{{ url()->current() }}" method="GET">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Поиск">
                    @unless ($search)
                        <button type="submit">Найти</button>
                    @endunless
                    @if ($search)
                    <button type="submit">Очистить</button>
                        <input type="hidden" name="search" value="">
                    @endif
                </form>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Фото</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($testsResults as $testsResult)
                    <tr>
                        <td>{{$testsResult->users_id}}</td>
                        <td><a href="{{ route('testsResult.show', $testsResult->users_id) }}">{{( $testsResult->user->name). ' ' . ($testsResult->user->surname?? null) }}</a></td>
                        <td><img src="{{getImage($testsResult->user->photo ?? 'Удаленное фото')}}"style="width: 100px" >  </td>
                    </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection
