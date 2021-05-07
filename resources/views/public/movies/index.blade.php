@extends('layouts.default')

@section('title',__('Movies'))
@section('header',__('Movies'))

@section('content')
    <div class="mt-3">
        <div class="m-0 float-right">
            <div class="float-right row mr-3">
                <x-select-author :options="$authorOptions" :author="$selectedAuthor" />
            </div>
        </div>

        @if( $data->count() > 0 )

            {{ $data->links() }}

            <!-- wenn ja, dann tabelle darstellen -->
            <table class="table table-striped">
                <tr>
                    <th>{{__('ID')}}</th>
                    <th>{{__('Author')}}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Price')}}</th>
                </tr>
                <!-- table data -->
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->author }}</td>
                        <td><a href="{{ route('movies.show', ['movie' => $item->id]) }}">
                                {{ $item->translation->title ?? $item->title }}</a></td>
                        <td>{{ $item->price }} €</td>
                    </tr>
                @endforeach
            </table>
        @else
            <!-- wenn nicht, dann ausgeben: keine daten vorhanden -->
            <h3>{{__('Sorry, no data available')}}</h3>
        @endif
    </div>
@endsection
