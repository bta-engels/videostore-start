@extends('layouts.default')

@section('title', __('Todos'))
@section('header', __('Todos'))

@section('content')
    <div class="m-0">
        <a role="button" class="btn btn-primary" href="{{ route('authors.create') }}">
            <i class="fas fa-plus-square"></i>Create new Author</a>
    </div>
    <div class="mt-3">

        {{ $data->links() }}

        <table class="table table-striped">
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('done') }}</th>
                <th>{{ __('Text') }}</th>
                <th>{{ __('created_at') }}</th>
                <th>{{ __('updated_at') }}</th>
                <th><br></th>
            </tr>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><i class="fas fa-{{ $item->done ? 'check' : 'times' }}"></i></td>
                    <td><a href="{{ route('todos.show', ['todo' => $item->id]) }}">
                            {{ $item->text }}</a>
                    </td>
                    <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td class="float-right">
                        <a role="button" class="btn-sm btn-primary"
                           href="{{ route('todos.edit', ['todo' => $item->id]) }}"><i class="fas fa-edit"></i>Edit</a>
                        <a role="button" class="btn-sm btn-danger"
                           onclick="return confirm('Datensatz wirklich löschen?')"
                           href="{{ route('todos.destroy', ['todo' => $item->id]) }}"><i class="fas fa-trash-alt"></i>Löschen</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

