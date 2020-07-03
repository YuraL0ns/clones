@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        @can('create permission')
        <a href="{{ route('permissions.create') }}" class="btn btn-info">Create New</a>
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
            @foreach($models as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->created_at }}</td>
                    <td>{{ $permission->updated_at }}</td>
                    <td class="row">
                        @can('update permission')
                        <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}" class="btn btn-warning col"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('destroy permission')
                        <form class="col" method="post" action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}">
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