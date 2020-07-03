@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        @can('create project')
        <a href="{{ route('projects.create') }}" class="btn btn-info">Создать проект</a>
        @endcan
        <table class="table table-striped projects mt-3">
            <thead>
            <tr>
                <th style="width: 55%">
                    Название проекта
                </th>
                <th style="width: 15%">
                    Дата начала проекта
                </th>
                <th style="width: 20%">
                    Действия
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>
                        {{ $project->name }}
                    </td>
                    <td>
                        {{$project->start}}
                    </td>
                    <td class="row">
                        @can('show project')
                        <a href="{{ route('projects.show', ['project' => $project->id]) }}" class="btn btn-secondary btn-sm col"><i class="fas fa-eye"></i> Просмотр</a>
                        @endcan
                        @can('update project')
                        <a href="{{ route('projects.edit', ['project' => $project->id]) }}" class="btn btn-warning btn-sm col"><i class="fas fa-edit"></i> Изменить</a>
                        @endcan
                        @can('destroy project')
                        <form class="col" method="post" action="{{ route('projects.destroy', ['project' => $project->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Удалить</button>
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