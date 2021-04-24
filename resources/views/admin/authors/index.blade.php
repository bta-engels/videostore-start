@extends('layouts.default')

@section('title','Autoren')
@section('header','Autoren')

@section('content')
    <div class="m-0">
        <a role="button" class="btn btn-primary" href="{{ route('authors.create') }}">
            <i class="fas fa-plus-square"></i>Create new Author</a>
    </div>
    <div class="mt-3">

        {{ $data->links() }}

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th colspan="2"><br></th>
            </tr>
            @foreach($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td><a class="link" href="{{ route('authors.show', ['author' => $item->id]) }}">
                            {{ $item->name }}</a></td>
                    <td><a role="button" class="btn-sm btn-primary"
                           href="{{ route('authors.edit', ['author' => $item->id]) }}"><i class="fas fa-edit"></i>Edit</a></td>
                    <td><a role="button" class="btn-sm btn-danger"
                           onclick="return confirm('Datensatz wirklich löschen?')"
                           href="{{ route('authors.destroy', ['author' => $item->id]) }}"><i class="fas fa-trash-alt"></i>Löschen</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

