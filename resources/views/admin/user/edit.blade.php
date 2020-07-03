@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('users.update', ['user' => $model->id]) }}">
            @csrf
            @method('put')
            <div class="form-group row">
                <label for="first-name-edit" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                <div class="col-md-6">
                    <input id="first-name-edit" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $model->first_name }}">

                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="last-name-edit" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                <div class="col-md-6">
                    <input id="last-name-edit" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $model->last_name }}">

                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <hr>
            <h3>Assign Role</h3>
            @foreach($roles as $key => $role)
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="roles[]" id="role-permission-{{ $key }}" {{ $model->hasRole($role) ? 'checked' : '' }} value="{{ $role->id }}">
                    <label class="form-check-label" for="role-permission-{{ $key }}">{{ $role->name }}</label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
@endpush