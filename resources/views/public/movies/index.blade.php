@extends('layouts.default')

@section('title','Movies')
@section('header','Movies')

@section('content')

    <div>
        <!-- hier todos tabellarisch darstellen -->
        <!-- if abfrage, ob welche vorhanden sind -->

        @if( $data->count() > 0 )

            {{ $data->links() }}

            <!-- wenn ja, dann tabelle darstellen -->
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Autor</th>
                    <th>Titel</th>
                    <th>Preis</th>
                </tr>
                <!-- table data -->
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->author }}</td>
                        <td><a href="{{ route('movies.show', ['movie' => $item->id]) }}">
                                {{ $item->title }}</a></td>
                        <td>{{ $item->price }} €</td>
                    </tr>
                @endforeach
            </table>
        @else
            <!-- wenn nicht, dann ausgeben: keine daten vorhanden -->
            <h3>Keine Daten vorhanden</h3>
        @endif
    </div>
@endsection
