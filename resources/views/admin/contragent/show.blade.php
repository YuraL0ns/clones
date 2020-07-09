@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
	
	<div class="container-fluid">
		<h3>Карточка контрагента : <strong> {{ $contragent->first_name }} {{ $contragent->second_name }} {{ $contragent->three_name }}</strong></h3>
		<hr>

			<div class="row text-center">
				<div class="col-md-4">
					<span class="badge badge-info text-uppercase">Контактная информация</span>
		
					<div class="info_block">
						<i class="fas fa-phone"></i> Телефон : <a href="tel:{{ $contragent->phone }}">{{ $contragent->phone }}</a><br> 
	
						<i class="fas fa-envelope"></i> Email : <a href="mailto:{{ $contragent->phone }}">{{ $contragent->email }}</a><br>
					</div>
				</div>
				<div class="col-md-4">
					<span class="badge badge-info text-uppercase">Местонахождение</span>

					<div class="info_block">
						<i class="fas fa-map-marker"></i> {{ $contragent->region }}
					</div>
				</div>
				<div class="col-md-4">
					<span class="badge badge-info text-uppercase">информация о компании</span>
					
					<div class="info_block">
						<i class="far fa-building"></i> {{ $contragent->company }}
					</div>
				</div>
			</div>
		
		
		</div>



@endsection

@push('styles')
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
	<script src="{{ asset('js/datatables.js') }}"></script>
@endpush