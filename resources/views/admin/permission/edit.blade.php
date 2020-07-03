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
                <form method="post" action="{{ route('permissions.update', ['permission' => $model->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="role-name-edit">Name</label>
                        <input type="text" class="form-control" id="permission-name-edit" name="name" placeholder="Ex. post create" value="{{ $model->name }}">
                    </div>
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