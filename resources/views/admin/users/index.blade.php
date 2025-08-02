@extends('laradmin::layouts.layout')
@section('title', 'Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-wrap" id="icons-container">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Users</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Assign</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                                <tr>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->roles->pluck('name')->join(', ') ?: '-' }}</td>
                                    <td>
                                        <form method="POST" class="input-group"
                                            action="{{ route('laradmin.users.assignRole', $u) }}">
                                            @csrf
                                            <select class="form-select" name="role">
                                                @foreach ($roles as $r)
                                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $users->links() }}
@endsection
