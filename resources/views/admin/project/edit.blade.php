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
            <form action="{{ route('projects.update', ['project' => $project->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Основное</h3>

                                
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">*Название проекта</label>
                                    <input type="text" id="inputName" class="form-control" name="name" value="{{ 
                                        $project->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputQuest">Описание проекта</label>
                                    <textarea id="inputQuest" class="form-control" rows="4" name="quest" value="{{ $project->quest }}">{{ $project->quest }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Дата работы</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputSpentBudget">Время работы над проектом</label>
                                    <input type="date" id="inputName" class="form-control" name="start" value="{{ 
                                        $project->start }}">
                                    <input type="date" id="inputName2" class="form-control" name="end" value="{{ 
                                        $project->end }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputSpentBudget">Проектирование</label>
                                    <input type="date" id="inputName3" class="form-control" name="ps" value="{{ 
                                        $project->ps }}">
                                    <input type="date" id="inputName4" class="form-control" name="pe" value="{{ 
                                        $project->pe }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputSpentBudget">Снабжение</label>
                                    <input type="date" id="inputName5" class="form-control" name="ss" value="{{ 
                                        $project->ss }}">
                                    <input type="date" id="inputName6" class="form-control" name="se" value="{{ 
                                        $project->se }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputSpentBudget">Производство</label>
                                    <input type="date" id="inputName7" class="form-control" name="prs" value="{{ 
                                        $project->prs }}">
                                    <input type="date" id="inputName8" class="form-control" name="pre" value="{{ 
                                        $project->pre }}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Задача для конструкторов АСУ</h3>

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
                                                @foreach($project->tasks as $task)
                                                    <div class="card col-3 task" data-id="{{ $task->owner->id }}">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $task->owner->full_name }}</h5>
                                                            <h6 class="card-subtitle mb-2 text-muted">{{ $task->owner->email }}</h6>
                                                            <div class="form-group">
                                                                <label for="task-description">Задача</label>
                                                                <textarea id="task-description" class="card-text form-control" name="descriptions[{{ $task->owner->id }}]">{{ $task->description }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="task-start-date">Начало задачи</label>
                                                                <input id="task-start-date" type="date" class="form-control" name="start_dates[{{ $task->owner->id }}]" value="{{ $task->start_date }}">
                                                             </div>
                                                            <div class="form-group">
                                                                <label for="task-end-date">Конец задачи</label>
                                                                <input id="task-end-date" type="date" class="form-control" name="end_dates[{{ $task->owner->id }}]" value="{{ $task->end_date }}">
                                                            </div>
                                                         </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Отмена</a>
                        <input type="submit" value="Обновить проект" class="btn btn-success float-right">
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

            selectBox.select2({
                multiple: true,
                tokenSeparators: [',']
            });


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

            let users = '{!! json_encode($project->owners->toArray()) !!}',
                keys = [];
            users = JSON.parse(users);

            for (let key in users) {
                keys.push(users[key].id)
            }
            selectBox.val(keys).trigger('change');
        });
    </script>
@endpush