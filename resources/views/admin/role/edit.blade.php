@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card w-75 m-auto">
            <div class="card-header">Permissions</div>
            <div class="card-body">
                <form method="post" action="{{ route('roles.update', ['role' => $model->id]) }}">
                    @csrf
                    @method('put')
                    @foreach($permissions as $key => $permission)
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="permission[]" id="role-permission-{{ $key }}" {{ $model->hasPermissionTo($permission) ? 'checked' : '' }} value="{{ $permission->id }}">
                            <label class="form-check-label" for="role-permission-{{ $key }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
@endpush