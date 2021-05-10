@php
$currentRouteName = Route::currentRouteName();
$routes = ['authors','movies','todos']
@endphp

<ul class="navbar-nav mr-auto">

    <li class="nav-item">
        <a class="nav-link activeRoute" href="{{ route('authors') }}">Autoren</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('movies') }}">Filme</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('todos') }}">Todos</a>
    </li>
</ul>
