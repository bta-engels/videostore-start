@php
$currentRouteName = Route::currentRouteName();
$routes = ['authors','movies','todos']
@endphp

<ul class="navbar-nav mr-auto">
    @foreach($routes as $route)
        <li class="nav-item @if($route === $currentRouteName) active @endif">
            <a class="nav-link" href="{{ route($route) }}">{{ ucfirst($route) }}</a>
        </li>
    @endforeach
</ul>
