@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
		<a href="{{ route('sklad.create') }}" class="btn btn-success btn-block mb-3">Добавить наименование</a>

		<label for="filter-safe-table-admin">Фильтр</label>
		<select id="filter-safe-table-admin" class="form-control mb-5 w-25">
			<option value="" selected>-- Please Select --</option>
			<option value="detail">Деталь</option>
			<option value="material">материал</option>
			<option value="purchased">покупный</option>
		</select>

		<table id="admin-safe-table" class="table">
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
			let table = $('#admin-safe-table').DataTable();

			$('#filter-safe-table-admin').change(function () {
				let _this = $(this),
						val = _this.val();

				table.search(val).draw();
			})
		})
	</script>
@endpush