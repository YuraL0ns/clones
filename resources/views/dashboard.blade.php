@extends('layouts.app')

@section('title')
	- Панель управления | Главная страница
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
			@can('show project')
				<a href="/project" type="button" class="btn btn-info btn-lg btn-block">Проекты</a>
			@endcan
			@role('Администратор|Директор|Снабжение|Склад|Инжинер|Конструктор\АСУ')
			<a href="/sklader" type="button" class="btn btn-warning btn-lg btn-block">Склад</a>
			@endrole
			{{-- button type="button" class="btn btn-primary btn-lg btn-">Бухгалтерия</button>
            <a type="button" class="btn btn-primary btn-lg btn-">Снабжение</a>
            <a type="button" class="btn btn-primary btn-lg btn-">Директора</a>--}}
			@role('Администратор|Директор')<a href="/kh-admin" type="button" class="btn btn-danger btn-lg btn-block">Администрация</a>@endrole
		</section>
	</div>
@endsection

@push('styles')
	<link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
@endpush