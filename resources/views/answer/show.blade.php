@extends('layouts.admin')

@section('title')
    Answers of test
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Answers</h3>

            <div class="card-tools">
                <a href="{{ route('test.index') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Edit test</a>
            </div>
        </div>
        <!-- /.card-header -->

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Answer</th>
                <th>Correct</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($answers as $answer)
                <tr>
                    <td>{{ $answer->id }}</td>
                    <td>{{ $answer->name }}</td>
                    @if($answer->is_correct==1)
                        <td>Правильный</td>
                    @else
                        <td>Не правильный</td>
                    @endif
                    <td>{{ $answer->created_at }}</td>
                    <td>
                        <a style="width: 66px"  href="{{ route('answer.edit', $answer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <br>
                        <form action="{{route('answer.delete',$answer->id) }}" method="post">
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
        <!-- /.card-body -->
    </div>
@endsection
