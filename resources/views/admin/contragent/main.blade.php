@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')

	<div class="container-fluid">
		<a href="{{ route('contragent.create') }}" class="btn btn-sm btn-success mb-3"><i class="fas fa-plus"></i> Добавить контрагента</a>
		<table class="table table-reponsive">
			<thead>
				<th>#</th>
				<th>Имя</th>
				<th>Фамилия</th>
				<th>Номер телефона</th>
				<th>Email</th>
				<th>Действия</th>
			</thead>
			<tbody>
				@foreach($contragent as $contragent)
				<tr>
					<td>{{ $contragent->id }}</td>
					<td>{{ $contragent->first_name }}</td>
					<td>{{ $contragent->second_name }}</td>
					<td>{{ $contragent->phone }}</td>
					<td>{{ $contragent->email }}</td>
					<td>
						<div class="row">
							<a class="btn btn-sm btn-info mr-2" href="{{ route('contragent.show', ['contragent' => $contragent->id]) }}" alt="Просмотр" title="Просмотр">
							<i class="fas fa-eye"></i> 
						</a>

						<a class="btn btn-sm btn-warning mr-2" href="{{ route('contragent.edit', ['contragent' => $contragent->id]) }}" alt="Изменить" title="Изменить">
							<i class="fas fa-pen"></i> 
						</a>

						<form method="post" action="{{ route('contragent.destroy', ['contragent' => $contragent-> id ]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="mr-2 btn btn-danger btn-sm" title="Удалить"><i class="fas fa-times"></i></button>
                        </form>

						
						</div>
					</td>	
				</tr>
				@endforeach
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
@endpush