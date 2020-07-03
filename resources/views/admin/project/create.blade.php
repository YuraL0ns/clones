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
            <form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Основное</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Название проекта</label>
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
                                    <label for="inputEstimatedDuration">Начало и конец проекта</label>
                                    <div class="form-group row d-flex justify-content-between">
                                        с <input type="date" id="inputName" class="form-control" name="start"> 
                                        до
                                        <input type="date" id="inputName" class="form-control" name="end">
                                    </div>
                                    <label for="inputEstimatedDuration">Время для проектирования</label>
                                    <div class="form-group row d-flex justify-content-between">
                                        с <input type="date" id="inputName" class="form-control" name="ps"> 
                                        до
                                        <input type="date" id="inputName" class="form-control" name="pe">
                                    </div>
                                    <label for="inputEstimatedDuration">Время для снабжения</label>
                                    <div class="form-group row d-flex justify-content-between">
                                        с <input type="date" id="inputName" class="form-control" name="ss">
                                        до
                                        <input type="date" id="inputName" class="form-control" name="se">
                                    </div>
                                    <label for="inputEstimatedDuration">Время на производство</label>
                                    <div class="form-group row d-flex justify-content-between">
                                        с <input type="date" id="inputName" class="form-control" name="prs">
                                        до
                                        <input type="date" id="inputName" class="form-control" name="pre">
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
                </div>
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
                        '         <div class="task-box"><label for="task-description">Задача 1</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions['+data.id+']"></textarea></div>\n' +
                        '         <div class="task-box"><label for="task-description">Задача 2</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions1['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 3</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions2['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 4</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions3['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 5</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions4['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 6</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions5['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 7</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions6['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 8</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions7['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 9</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions8['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 10</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions9['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 11</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions10['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 12</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions11['+data.id+']"></textarea></div>\n' +
                        '         <div class="task-box"><label for="task-description">Задача 13</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions12['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 14</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions13['+data.id+']"></textarea></div>\n' +
                        '         <div  class="task-box"><label for="task-description">Задача 15</label>\n' +
                        '           <textarea id="task-description" class="card-text form-control" name="descriptions14['+data.id+']"></textarea></div>\n' +
                        // '       <button type="button" class="mt-2 task-btn btn btn-success btn-sm"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Добавить</button></div>\n' +
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

                $(document).on('click', '.task-btn', function() {
  
                        $('.task-box').attr("true", "false");
                        console.log($('.task-box').attr("true"));
                    });

                /*let i = 2;
                    $(document).on('click', '.task-btn', function() {
  
                        if(i >10) return;
                        $(this).before('<label for="task-description">Задача '+ i +'</label><textarea id="task-description" class="card-text form-control" name="descriptions'+ i +'"></textarea>');
                        i++;
                    });*/
                
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




            $('.add-file-btn').click(function () {
                let filesDiv = $('.project-files');

                let html = '<div class="form-group file-input row">\n' +
                    '     <div class="form-group col-5">\n' +
                    '        <label for="project-add-file">Загрузить файл</label>\n' +
                    '         <input type="file" id="project-add-file" class="form-control" name="files[]">\n' +
                    '     </div>\n' +
                    '      <div class="form-group col-5">\n' +
                    '       <label for="file-type">Категория файла</label>\n' +
                    '         <select id="file-type" class="form-control" name="file_types[]">\n' +
                    '            <option value="drawing">Чертеж</option>\n' +
                    '             <option value="report">отчет</option>\n' +
                    '            <option value="document">Документ</option>\n' +
                    '          </select>\n' +
                    '        </div>\n' +
                    '<div class="col-2 d-flex align-items-center justify-content-center"> <button type="button" class="btn btn-danger btn-sm delete-file-btn"><i class="fas fa-minus-circle"></i></button></div>' +
                    '    </div>';
                filesDiv.append(html);
            });

            $(document).on('click', '.delete-file-btn', function () {
                let _this = $(this),
                    div = _this.closest('.file-input');

                div.remove();
            })


             
        });
    </script>
@endpush