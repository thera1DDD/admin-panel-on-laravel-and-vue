@extends('layouts.admin')

@section('title')
    Moduls
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Moduls</h3>

            <div class="card-tools">
                <a href="{{ route('module.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new modul</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Number</th>
                    <th>Course</th>
                    <th>Main Image</th>
                    <th>Slug</th>
                    <th>Test</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($modules as $module)
                    <tr>
                        <td>{{ $module->id }}</td>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->description }}</td>
                        <td>{{ $module->number }}</td>
                        <td>{{ $module->course->name}}</td>
                        <td>{{ $module->main_image }}</td>
                        <td>{{ $module->slug }}</td>
                        <td>{{ $module->test}}</td>
                        <td>{{ $module->created_at }}</td>
                        <td>
                            <a style="width: 66px"  href="{{ route('module.edit', $module->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <br>

                            <form action="{{route('module.delete',$module->id) }}" method="post">
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
