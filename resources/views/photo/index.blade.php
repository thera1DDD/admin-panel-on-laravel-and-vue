@extends('layouts.admin')

@section('title')
    Photo
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Photo</h3>

            <div class="card-tools">
                <a href="{{ route('photo.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new photo</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>FileName</th>
                    <th>Model</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($photos as $photo)
                    <tr>
                        <td>{{ $photo->id }}</td>
                        <td>{{ $photo->filename }}</td>
                        <td>{{ $photo->photoable_type }}</td>
                        <td>{{ $photo->created_at }}</td>
                        <td>
                            <a style="width: 66px"  href="{{ route('photo.edit', $photo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>

                            <form action="{{route('photo.delete',$photo->id) }}" method="post">
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
