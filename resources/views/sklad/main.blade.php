@extends('layouts.app')

@section('title')
	- Склад
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
			<a href="{{ route('sklader.create') }}" class="btn btn-success btn-block mb-3">Добавить наименование</a>

			<label for="filter-safe-table">Фильтр</label>
			<select id="filter-safe-table" class="form-control mb-5 w-25">
				<option value="" selected>-- Please Select --</option>
				<option value="detail">Деталь</option>
				<option value="material">материал</option>
				<option value="purchased">покупный</option>
			</select>
			<table class="table" id="user-safe-table">
				<thead>
					<tr>
						<th>Название</th>
						<th>Тип</th>
						<th>Кол-во на складе</th>
						<th>Кол-во зарезервираванно</th>
					</tr>
				</thead>
				<tbody>

				@foreach($sklad as $sklad)<tr>
					<td>{{ $sklad->name }}</td>
					<td>{{ ucfirst($sklad->type) }}</td>
					<td>{{ $sklad->in }}</td>
					<td>{{ $sklad->out }}</td>
				</tr>@endforeach
				</tbody>
			</table>
		</section>
   </div>
@endsection

@push('styles')
	<link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@endpush

@push('scripts')
	<script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
	<script src="{{ asset('js/datatables.js') }}"></script>
	<script>
		$(document).ready(function () {
			let table = $('#user-safe-table').DataTable();

			$('#filter-safe-table').change(function () {
				let _this = $(this),
					val = _this.val();

				table.search(val).draw();
			})
		})
	</script>
@endpush