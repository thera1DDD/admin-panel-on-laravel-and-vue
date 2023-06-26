<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">

                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <p>
                            <i class="nav-icon fas fa-power-off"></i>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/signup.ico') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Admin
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('course.index')}}" class="nav-link">
                                            <i class="nav-icon fas fa-chalkboard"></i>
                                            <p>
                                                Курсы
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('module.index')}}" class="nav-link">
                                            <i class="nav-icon fas fa-chalkboard"></i>
                                            <p>
                                                Модули
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('language.index')}}" class="nav-link">
                                            <i class="nav-icon fas fa-chalkboard"></i>
                                            <p>
                                                Языки
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('video.index')}}" class="nav-link">
                                            <i class="nav-icon fas fa-chalkboard"></i>
                                            <p>
                                                Видео
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('demovideo.index')}}" class="nav-link">
                                            <i class="nav-icon fas fa-chalkboard"></i>
                                            <p>
                                              Демо Видео
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('role.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-chalkboard"></i>
                                            <p>Роли</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('permission.index') }}" class="nav-link">
                                            <i class="nav-icon fas fa-chalkboard"></i>
                                            <p>Права</p>
                                        </a>
                                    </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Пользователи{{' '. \App\Models\User::all()->count()}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('comment.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Комментарии</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('photo.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Фото</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('word.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Общий словарь</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('favourite.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Избранное</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('stat.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Прогресс</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('task.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Задания</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('upgrade.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Обновления</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('log.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Логи</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('teacher.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Учителя</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('artwork.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Произведения</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('popularQuestion.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Популярные вопросы</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('column.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Колоны</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Категории</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('switchLang.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Переключатели словаря</p>
                                    </a>
                                </li>

                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link active">
                                        <i class="nav-icon fas fa-cogs"></i>
                                        <p>
                                            Опросы
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('surveyQuestion.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    Опрос
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('surveyResult.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    Результаты опроса
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link active">
                                        <i class="nav-icon fas fa-cogs"></i>
                                        <p>
                                            Тесты
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('test.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    Тесты
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('testsResult.index') }}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>Результаты тестов</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('question.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    Вопросы
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('answer.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    Ответы
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @elseif(Auth::user()->role === 'moderator')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Модератор
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('course.index')}}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>
                                            Курсы
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('module.index')}}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>
                                            Модули
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('video.index')}}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>
                                            Видео
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('demovideo.index')}}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>
                                            Демо Видео
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('word.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Общий словарь</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('task.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Задания</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('artwork.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard"></i>
                                        <p>Произведения</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link active">
                                        <i class="nav-icon fas fa-cogs"></i>
                                        <p>
                                            Тесты
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('test.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    Тесты
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('question.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    Вопросы
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('answer.index')}}" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    Ответы
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                        <li class="nav-item">
                            <a href="{{ route('user.profile') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Аккаунт
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    Выход
                                </p>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 399px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('pageName')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @include('partials.alert')
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <!-- Default to the left -->
            <strong>Copyright © 2014-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
        <div id="sidebar-overlay"></div>
    </div>
    <!-- ./wrapper -->
    </body>

</html>
