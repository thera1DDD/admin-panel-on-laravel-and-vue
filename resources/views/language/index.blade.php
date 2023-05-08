@extends('layouts.admin')

@section('title')
Languages
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Language</h3>

        <div class="card-tools">
            <a href="{{ route('language.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new language</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($languages as $language)
                    <tr>
                        <td>{{ $language->id }}</td>
                        <td>{{ $language->name }}</td>
                        <td>{{ $language->created_at }}</td>
                        <td>
                            <a style="width: 66px" href="{{ route('language.edit', $language->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>

                            <form action="{{route('language.delete',$language->id) }}" method="post">
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
    </div>
    <!-- /.card-body -->
  </div>
@endsection
