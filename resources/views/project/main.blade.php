@extends('layouts.app')

@section('title')
	- Проекты
@endsection

@section('sidebar')
	@include('layouts.sidebar')
@endsection

@section('header')
	@include('admin.layouts.header')
@endsection

@section('content')
	<div class="container-fluid">
		<section class="content">
			<a href="{{ route('project.create') }}" class="btn btn-lg btn-success btn-block mb-3">СОЗДАТЬ ПРОЕКТ</a>

			<table class="table table-striped projects">
				<thead>
				<tr>
					<th style="width: 55%">
						Название проекта
					</th>
					<th>
						Статус
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
							{{--@foreach($project->status as $status)--}}
							{{--<span class="badge">{{ $status->status_id }}</span>--}}
							{{--@endforeach--}}
						</td>
						<td>
							{{$project->start}}
						</td>
						<td class="row">
							{{--<a href="{{ route('project.edit', ['project' => $project->id]) }}" class="btn btn-warning col"><i class="fas fa-edit"></i> Редактировать проекта</a>--}}
							<a href="{{ route('project.show', ['project' => $project->id]) }}" class="btn btn-info col"><i class="fas fa-eye"></i> Просмотр проекта</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</section>
	</div>
@endsection

@push('styles')
	<link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
@endpush