@extends('laradmin::layouts.layout')
@section('title', 'Super Admin Dashboard')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-wrap" id="icons-container">
        <div class="card icon-card cursor-pointer text-center mb-6 mx-3">
            <div class="card-body">
                {{ $usersCount }}
                <p class="icon-name text-capitalize text-truncate mb-0">Total Users</p>
            </div>
        </div>
        <div class="card icon-card cursor-pointer text-center mb-6 mx-3">
            <div class="card-body">
                {{ $rolesCount }}
                <p class="icon-name text-capitalize text-truncate mb-0">Total Roles</p>
            </div>
        </div>
    </div>
</div>
@endsection