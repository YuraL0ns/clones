@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>
                    Email
                </th>
                <th style="width: 15%">
                    Created At
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td class="row">
                        @can('update user')
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning col"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('destroy user')
                        <form class="col" method="post" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
@endpush