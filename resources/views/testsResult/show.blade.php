@extends('layouts.admin')

@section('title')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Тесты и задания</h3>
            <div class="card-tools">
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название теста</th>
                    <th>Курс</th>
                    <th>Кол-во вопросов</th>
                    <th>Кол-во правильных ответов</th>
                    <th>Время прохождения теста</th>
                    <th>Прохождение</th>

                </tr>
                </thead>
                <tbody>
                @forelse ($testsResults as $testsResult)
                    <tr>
                        <td>{{ $testsResult->id }}</td>
                        <td>{{ $testsResult->test->name }}</td>
                    @if($testSource = $testsResult->test->testable_type::findOrFail($testsResult->test->testable_id) ?? 'null')
                        <td>{{$testSource->course->name ?? 'Удаленный курс'}} </td>
                    @endif
                        <td>{{ $testsResult->questions_total }}</td>
                        <td>{{ $testsResult->questions_correct }}</td>
                        <td>{{ $testsResult->passing_time }}</td>
                        <td>@if($testsResult->is_passed == 1){{'Пройден'}} @else{{'Не пройден'}}@endif</td>
                        <td>
                            <a style="width: 110px" href="{{ route('testsResult.edit',$testsResult->id )}}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{route('testsResult.delete',$testsResult->id)}}" method="post">
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
