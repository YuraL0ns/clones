@extends('layouts.app')

@section('title')
    - Создать Проект
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
            <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Основное</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">*Название проекта</label>
                                    <input type="text" id="inputName" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="inputQuest">Задача проекта(общая)</label>
                                    <textarea id="inputQuest" class="form-control" rows="4" name="quest"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Даты работы проекта</h3>
                            </div>
                            <div class="card-body">                                   
                                <div class="form-group">
                                    <label for="project-start-input">Начало и конец проекта</label>
                                    <div class="form-group row d-flex justify-content-between">
                                        с <input type="date" id="project-start-input" class="form-control" name="start">
                                        до
                                        <input type="date" id="project-end-input" class="form-control" name="end">
                                    </div>
                                    <label for="project-time-input-start">Время для проектирования</label>
                                    <div class="form-group row d-flex justify-content-between">
                                        с <input type="date" id="project-time-input-start" class="form-control" name="ps">
                                        до
                                        <input type="date" id="project-time-input-end" class="form-control" name="pe">
                                    </div>
                                    <label for="snabjeni-start">Время для снабжения</label>
                                    <div class="form-group row d-flex justify-content-between">
                                        с <input type="date" id="snabjeni-start" class="form-control" name="ss">
                                        до
                                        <input type="date" id="snabjeni-end" class="form-control" name="se">
                                    </div>
                                    <label for="creation-date-start">Время на производство</label>
                                    <div class="form-group row d-flex justify-content-between">
                                        с <input type="date" id="creation-date-start" class="form-control" name="prs">
                                        до
                                        <input type="date" id="creation-date-end" class="form-control" name="pre">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
               {{-- <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Задача для пользователей</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="project-create-users-select">Пользователи</label>
                                    <select id="project-create-users-select" class="js-example-basic-multiple w-100" name="users[]" multiple="multiple">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name . ' - ' . $user->email }}</option>
                                        @endforeach
                                    </select>

                                    <div class="card border-0 mt-3 mb-3 tasks-section">
                                        <div class="card-title">Задачи пользователя</div>
                                        <div class="card-body">
                                            <div class="row border-warning border p-4 tasks">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>--}}
                {{--<div class="row">--}}
                    {{--@can('create file')--}}
                    {{--<div class="col-6">--}}
                        {{--<div class="card card-secondary">--}}
                            {{--<div class="card-header">--}}
                                {{--<h3 class="card-title">Add Files</h3>--}}
                            {{--</div>--}}
                            {{--<div class="card-body project-files">--}}
                                {{--<div class="form-group file-input row">--}}
                                    {{--<div class="form-group col-6">--}}
                                        {{--<label for="project-add-file">Upload File</label>--}}
                                        {{--<input type="file" id="project-add-file" class="form-control" name="files[]">--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group col-6">--}}
                                        {{--<label for="file-type">File Type</label>--}}
                                        {{--<select id="file-type" class="form-control" name="file_types[]">--}}
                                            {{--<option value="drawing">Чертеж</option>--}}
                                            {{--<option value="report">отчет</option>--}}
                                            {{--<option value="document">Документ</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card-footer">--}}
                                {{--<button type="button" class="btn btn-warning add-file-btn"><i class="fas fa-plus-circle"></i></button>--}}
                            {{--</div>--}}
                            {{--<!-- /.card-body -->--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--@endcan--}}
                    {{--@role('Конструктор\АСУ')--}}
                    {{--<div class="col-6">--}}
                        {{--<div class="card card-secondary">--}}
                            {{--<div class="card-header">--}}
                                {{--<h3 class="card-title">Выбирать Продукты</h3>--}}
                            {{--</div>--}}
                            {{--<div class="card-body">--}}
                                {{--<div class="form-group row">--}}
                                    {{--<div class="form-group col-4">--}}
                                        {{--<label for="project-safe-type-select">тип продукта</label>--}}
                                        {{--<select id="project-safe-type-select" class="form-control" name="safe_types[]">--}}
                                            {{--<option value="" selected>-- Please Select --</option>--}}
                                            {{--<option value="detail">Детали</option>--}}
                                            {{--<option value="material">Материалы</option>--}}
                                            {{--<option value="purchased">Купленные</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group col-4">--}}
                                        {{--<label for="project-safe-name-select">наименование</label>--}}
                                        {{--<select id="project-safe-name-select" class="form-control" name="safe_names[]"></select>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group col-4">--}}
                                        {{--<label for="project-safe-count-select">кол-во</label>--}}
                                        {{--<input type="number" name="safe_counts[]" id="project-safe-count-select" class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<!-- /.card-body -->--}}
                            {{--<div class="card-footer">--}}
                                {{--<button type="button" class="btn btn-warning add-safe-btn"><i class="fas fa-plus-circle"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--@endrole--}}
                {{--</div>--}}
                {{--<div class="row">
                    <div class="col-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Добавить Продукт И Использовать</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="project-new-safe-name">Имя</label>
                                    <input type="text" name="new_safe_name" id="project-new-safe-name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="project-new-safe-type">Тип Продукта</label>
                                    <select id="project-new-safe-type" class="form-control" name="new_safe_type">
                                        <option selected value="">-- Please Select --</option>
                                        <option value="detail">Деталь</option>
                                        <option value="material">материал</option>
                                        <option value="purchased">покупный</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="project-new-safe-count">кол-во</label>
                                    <input type="number" name="new_safe_count" id="project-new-safe-count" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="project-new-safe-use">зарезервировать</label>
                                    <input type="number" name="new_safe_use" id="project-new-safe-use" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Отмена</a>
                        <input type="submit" value="Создать проект" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            let selectBox = $('.js-example-basic-multiple'),
                tasksSection = $('.tasks-section .tasks');

            selectBox.select2();

            selectBox.on('select2:select', function (e) {
                let data = e.params.data,
                    html = '';

                    html = '<div class="card col-3 task" data-id="'+data.id+'">\n' +
                        '   <div class="card-body">\n' +
                        '       <h5 class="card-title">'+data.text.split(' - ')[0]+'</h5>\n' +
                        '       <h6 class="card-subtitle mb-2 text-muted">'+data.text.split(' - ')[1]+'</h6>\n' +
                        '       <div class="form-group">\n' +
                        '         <label for="task-description">Задача</label>\n' +
                        '         <textarea id="task-description" class="card-text form-control" name="descriptions['+data.id+']"></textarea>\n' +
                        '       </div>\n' +
                        '       <div class="form-group">\n' +
                        '         <label for="task-start-date">Start Date</label>\n' +
                        '         <input id="task-start-date" type="date" class="form-control" name="start_dates['+data.id+']">\n' +
                        '       </div>\n' +
                        '       <div class="form-group">\n' +
                        '          <label for="task-end-date">End Date</label>\n' +
                        '          <input id="task-end-date" type="date" class="form-control" name="end_dates['+data.id+']">\n' +
                        '       </div>\n' +
                        '    </div>\n' +
                        '</div>';

                    tasksSection.append(html);
            });

            selectBox.on('select2:unselect', function (e) {
                let data = e.params.data,
                    tasks = document.querySelectorAll('.tasks-section .tasks .task');

                tasks.forEach(function (item, index) {
                    let id = $(item).attr('data-id');

                    if (parseInt(data.id) === parseInt(id)) {
                        $(item).remove()
                    }
                })
            });

            selectBox.on('select2:clear', function (e) {
                tasksSection.empty()
            });

            // $('.add-file-btn').click(function () {
            //     let filesDiv = $('.project-files');
            //
            //     let html = '<div class="form-group file-input row">\n' +
            //         '     <div class="form-group col-5">\n' +
            //         '        <label for="project-add-file">Upload File</label>\n' +
            //         '         <input type="file" id="project-add-file" class="form-control" name="files[]">\n' +
            //         '     </div>\n' +
            //         '      <div class="form-group col-5">\n' +
            //         '       <label for="file-type">File Type</label>\n' +
            //         '         <select id="file-type" class="form-control" name="file_types[]">\n' +
            //         '            <option value="drawing">Чертеж</option>\n' +
            //         '             <option value="report">отчет</option>\n' +
            //         '            <option value="document">Документ</option>\n' +
            //         '          </select>\n' +
            //         '        </div>\n' +
            //         '<div class="col-2 d-flex align-items-center justify-content-center"> <button type="button" class="btn btn-danger btn-sm delete-file-btn"><i class="fas fa-minus-circle"></i></button></div>' +
            //         '    </div>';
            //     filesDiv.append(html);
            // });
            //
            // $(document).on('click', '.delete-file-btn', function () {
            //     let _this = $(this),
            //         div = _this.closest('.file-input');
            //
            //     div.remove();
            // })
        });
    </script>
@endpush