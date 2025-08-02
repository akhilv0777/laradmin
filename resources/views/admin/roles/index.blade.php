@extends('laradmin::layouts.layout')
@section('title', 'Roles')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card ">
            <div class="card-body">
                <ul>
                    @foreach ($roles as $r)
                        <li>
                            {{ $r->name }}
                            @if ($r->name !== 'super_admin')
                                <form method="POST" action="{{ route('laradmin.roles.destroy', $r) }}" style="display:inline">
                                    @csrf @method('DELETE') <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <form method="POST" class="input-group" action="{{ route('laradmin.roles.store') }}">
                    @csrf
                    <input type="text" class="form-control" name="name" placeholder="new role">
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
