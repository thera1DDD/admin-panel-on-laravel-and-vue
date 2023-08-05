@extends('layouts.admin')

@section('title')
    Переводы
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('translate.allTranslates') }}" method="GET">
                <div>
                    <label for="query">Поиск:</label>
                    <input type="text" name="query" placeholder="Поиск..." value="{{ $query }}">
                    @if (($query || $languageId) && $translates->count() >= 0)
                        <button type="submit" name="reset" value="true" >Сбросить</button>
                    @else
                        <button type="submit">Найти</button>
                    @endif
                </div>
                <div>
                    <label for="language">Язык:</label>
                    <select name="language" id="language">
                        <option value="">Все</option>
                        @foreach ($languages as $id => $name)
                            <option value="{{ $id }}" {{ $languageId == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="card-tools">
                <a href="{{ route('word.index') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Все русские слова</a>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Перевод</th>
                    <th>Язык</th>
                    <th>Слово</th>
                    <th>Дата создания</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($translates as $translate)
                    <tr>
                        <td>{{ $translate->id }}</td>
                        <td>{{ $translate->translate }}</td>
                        <td>{{ $translate->language->name }}</td>
                        <td>{{ $translate->word->name }}</td>
                        <td>{{ $translate->created_at }}</td>
                        <td>
                            <a style="width: 105px" href="{{ route('translate.edit', $translate->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <br>
                            <form action="{{ route('translate.delete', $translate->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input style="width: 105px;" type="submit" value="Удалить" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Нет доступных переводов</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer"  style="width:150px ">
            <div class="pagination">
                {{ $translate->links() }}  <!-- Это отобразит ссылки пагинации -->
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
