@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <form class="w-75 m-auto" method="post" action="{{ route('permissions.store') }}">
            @csrf
            <div class="form-group">
                <label for="role-name">Name</label>
                <input type="text" class="form-control" id="permission-name" name="name" placeholder="Ex. post create">
            </div>
            <button type="submit" class="btn btn-primary">Store</button>
        </form>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
@endpush