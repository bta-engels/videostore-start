@extends('layouts.default')

@section('title',__('Todos'))
@section('header',__('Todos'))

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
                    <th>{{__('Done')}}</th>
                    <th>{{__('Text')}}</th>
                </tr>
                <!-- table data -->
                @foreach($data as $item)
                    <tr>
                        <td>
                            <a href="{{ route('todos.show', ['todo' => $item->id]) }}">
                                {{ $item->id }}
                            </a>
                        </td>

                        <td>
                            {{ $item->done }}
                        </td>
                        <td>
                            {{ $item->text  }}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <!-- wenn nicht, dann ausgeben: keine daten vorhanden -->
            <h3>{{__('no_data_available')}}</h3>
        @endif
    </div>
@endsection
