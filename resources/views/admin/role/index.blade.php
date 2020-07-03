@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        @can('create role')
        <a href="{{ route('roles.create') }}" class="btn btn-info">Create New</a>
        @endcan
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th style="width: 55%">
                    Name
                </th>
                <th>
                    Created At
                </th>
                <th style="width: 15%">
                    Updated At
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td>{{ $role->updated_at }}</td>
                    <td class="row">
                        @can('update role')
                        <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="btn btn-warning col"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('destroy role')
                        <form class="col" method="post" action="{{ route('roles.destroy', ['role' => $role->id]) }}">
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