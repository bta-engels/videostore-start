@extends('layouts.default')

@section('title', __('Todos'))
@section('header', __('Todos'))

@section('content')
    <div>
        @if( $data->count() > 0 )
            {{ $data->links() }}
            <table class="table table-striped">
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('done') }}</th>
                    <th>{{ __('Text') }}</th>
                    <th>{{ __('created_at') }}</th>
                    <th>{{ __('updated_at') }}</th>
                </tr>
                <!-- table data -->
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><i class="fas fa-{{ $item->done ? 'check' : 'times' }}"></i></td>
                        <td><a href="{{ route('todos.show', ['todo' => $item->id]) }}">
                                {{ $item->text }}</a>
                        </td>
                        <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $item->updated_at }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <!-- wenn nicht, dann ausgeben: keine daten vorhanden -->
            <h3>{{ __('no data available') }}</h3>
        @endif
    </div>
@endsection
