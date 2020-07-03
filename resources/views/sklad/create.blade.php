@extends('layouts.app')

@section('title')
    - Создать Продукт
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
            <form action="{{ route('sklader.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label for="user-safe-name">Имя</label>
                        <input type="text" name="name" id="user-safe-name" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="user-safe-type">Тип</label>
                        <select id="user-safe-type" name="type" class="form-control">
                            <option value="detail">Деталь</option>
                            <option value="material">материал</option>
                            <option value="purchased">покупный</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="user-safe-in">На складе</label>
                        <input type="number" name="in" id="user-safe-in" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="user-safe-out">Зарезервираванно</label>
                        <input type="number" name="out" id="user-safe-out" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block btn-lg col-md-12 mt-3">Добавить наименование</button>
            </form>
            {{--{!! Form::open(['action' => 'SkladController@store', 'method' => 'POST']) !!}--}}
            {{--<div class="form-group">--}}
                {{--{{ Form::label('name' ,'Имя',['class'=>'form-label']) }}--}}
                {{--{{ Form::text('name', null,['class'=>'form-control', 'placeholder' => 'Название наименования']) }}--}}
            {{--</div>--}}
            {{--<div class="form-inline">--}}
                {{--<div class="form-group col-md-6">--}}
                    {{--{{ Form::label('in' ,'На складе',['class'=>'form-label']) }}--}}
                    {{--{{ Form::number('in', null,['class'=>'form-control']) }}--}}
                {{--</div>--}}
                {{--<div class="form-group col-md-6">--}}
                    {{--{{ Form::label('out' ,'Зарезервираванно',['class'=>'form-label']) }}--}}
                    {{--{{ Form::number('out', null,['class'=>'form-control']) }}--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--{{ Form::submit('Добавить наименование',['class'=>'btn btn-success btn-block btn-lg col-md-12','style' => 'margin-top: 25px;']) }}--}}

            {{--{!! Form::close() !!}--}}
        </section>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
@endpush