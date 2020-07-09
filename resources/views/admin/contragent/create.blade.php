@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
	
	<div class="container-fluid">
		
        <section class="content">
            <form action="{{ route('contragent.store') }}" method="post" enctype="multipart/form-data">
                @csrf


                    
					<div class="row">
						<div class="form-group col-4">
	                        <label for="inputSname">Фамилия</label>
	                        <input type="text" id="inputSname" class="form-control" name="second_name">
	                    </div>
	                    <div class="form-group  col-4">
	                        <label for="inputFname">Имя</label>
	                        <input type="text" id="inputFname" class="form-control" name="first_name">
	                    </div>
	                    <div class="form-group col-4">
	                        <label for="inputTname">Отчество</label>
	                        <input type="text" id="inputTname" class="form-control" name="three_name">
	                    </div>
					</div>
                    
                    <div class="row">
						<div class="form-group col-6">
	                        <label for="phone">Phone</label>
	                        <input type="tel" id="phone" class="form-control" name="phone" placeholder="+7(992)2883858" pattern="([0-9]{3})[0-9]{7}" 
	                        value="+7">
	                    </div>
	                    <div class="form-group  col-6">
	                        <label for="email">Email</label>
	                        <input type="text" id="email" class="form-control" name="email">
	                    </div>
	                </div>

	                <div class="row">
						<div class="form-group col-6">
	                        <label for="region">Регион</label>
	                        <input type="text" id="region" class="form-control" name="region">
	                    </div>
	                    <div class="form-group  col-6">
	                        <label for="company">Компания</label>
	                        <input type="text" id="company" class="form-control" name="company">
	                    </div>
	                </div>


                
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('contragent.index') }}" class="btn btn-secondary">Отмена</a>
                        <input type="submit" value="Добавить контрагента" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
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
@endpush