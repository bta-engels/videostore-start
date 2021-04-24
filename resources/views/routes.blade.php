@extends('layouts.default')

@section('title','Routen')

@section('content')
    <table class="routes table-sm table-striped">
        <tr>
            <th>Methode</th>
            <th>Route</th>
            <th>Action</th>
            <th>Middleware</th>
        </tr>
        @foreach($routes as $item)
        <tr>
            <td>{{ implode(', ',$item->methods()) }}</td>
            <td>{{ $item->uri }}</td>
            <td>{{ $item->action['controller'] ?? null }}</td>
            <td>{{ implode(', ', $item->middleware()) ?? null }}</td>
        </tr>
        @endforeach
    </table>
@endsection
