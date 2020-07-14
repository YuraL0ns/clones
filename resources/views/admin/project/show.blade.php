@extends('layouts.app')

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Детали проекта "{{ $project->name }}"</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <div class="alert bg-info" role="alert">
                                          <h4 class="alert-heading text-gray-100">Проектирование</h4>
                                          <p class="text-gray-100">{{ \Carbon\Carbon::parse($project->ps)->format('d.m.Y')}}  до {{ \Carbon\Carbon::parse($project->pe)->format('d.m.Y')}}</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                         <div class="alert bg-danger" role="alert">
                                          <h4 class="alert-heading text-gray-100">Снабжение</h4>
                                          <p class="text-gray-100">{{ \Carbon\Carbon::parse($project->ss)->format('d.m.Y')}}  до {{ \Carbon\Carbon::parse($project->se)->format('d.m.Y')}}</p>
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <div class="alert bg-success" role="alert">
                                          <h4 class="alert-heading text-gray-100">Производство</h4>
                                          <p class="text-gray-100">{{ \Carbon\Carbon::parse($project->prs)->format('d.m.Y')}}  до {{ \Carbon\Carbon::parse($project->pre)->format('d.m.Y')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4>Задачи</h4>
                        <button type="button" class=" mb-2 btn-sm btn btn-danger" data-toggle="modal" data-target="#modalQuest">
                            <i class="fas fa-plus"></i> Добавить задачу пользователям
                        </button>
                        <!-- Модалка Задача -->
                        <div class="modal fade" id="modalQuest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Складской учет по задачи</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              
                                <form method="POST" action="/project/{{ $project->id }}/showQuest">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                      <label for="inputUser">Выбор пользователя</label>
                                      <select id="inputUser" class="form-control">
                                        <option selected>--- Список с пользователями в нутри ---</option>
                                        <option>
                                        
                                        </option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <lable name="description">Задача пользователю</lable>
                                        <textarea class="form-control" rows="5" name="description" cols="50"></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <input class="form-control " type="date">
                                            <div class="mx-auto">До</div>
                                        <input class="form-control " type="date">
                                    </div>
                                </form>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-success btn-sm">Добавить задачу</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Модалка задача -->
                         
                             <table class="table table-bordered dataTable">
                                <thead>
                                    <th width="3%">
                                        Статус
                                    </th>
                                    <th width="20%">
                                        Имя
                                    </th>
                                    <th width="36%">Задача</th>
                                    <th width="9%">Учет</th>
                                    <th width="18%">Время работы</th>
                                    <th width="14%">Статус задачи</th>
                                </thead>
                                <tbody>
                                     @foreach($project->tasks as $key => $task)
                                    <tr>
                                        <td>
                                            <i class="fas fa-check"></i>
                                        </td>
                                        <td>{{ $task->owner->full_name }}</td>
                                        <td>{{ $task->descriptions }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileModal">
                                                <i class="far fa-folder"></i> 
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#skladModal">
                                                <i class="fas fa-clipboard-list"></i> 
                                            </button>
                                        </td>
                                        <td>
                                           <small><b> {{  \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') }} до {{ \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') }}</b></small>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success">Выполнено</a>
                                        </td>
                                    </tr>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        <!-- Модалка файлов -->
                        <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Файлы отоносящиеся к задаче</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                 @foreach($files as $file)
                                <li>
                                    <a href="{{ route('admin.download', ['name' => $file->name, 'project' => $project->id]) }}" class="btn-link text-secondary"><i class="far fa-fw {{ $file->icon }}"></i>{{ $file->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @can('create file')
                        <div class="text-center mt-5 mb-3">
                            <form action="{{ route('admin.add.file', ['project' => $project->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group file-input row">
                                    <div class="form-group col-6">
                                        <label for="project-add-file-show">Загрузка файла</label>
                                        <input type="file" id="project-add-file-show" class="form-control" name="file">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="file-type-show">Тип загружаемого фала</label>
                                        <select id="file-type-show" class="form-control" name="file_type">
                                            <option value="drawing">Чертеж</option>
                                            <option value="report">Отчет</option>
                                            <option value="document">Документ</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Добавить файл</button>
                            </form>
                        </div>
                        @endcan
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-primary btn-sm">Сохранить</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Модалка файлов -->
                        <!-- Модалка Склада -->
                        <div class="modal fade" id="skladModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Складской учет по задачи</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <a href="#" class="btn btn-sm btn-success">Добавить</a>
                                <table class="table">
                                    <tr class="col-md-12">
                                      <td>
                                                <label for="-type-show">Что добавляем</label>
                                                <select id="-type-show" class="form-control" name="">
                                                    <option value="drawing">Список всех наименований на складе</option>
                                                </select>
                                      </td>
                                      <td> <label for="-type-show">Кол-во</label>
                                           <input type="text" class="form-control" placeholder="Кол-во">
                                      </td>
                                    </tr>
                                </table>
                                <div class="clearfix">&nbsp;</div>
                                <table class="table table-bordered datatable">
                                    <thead>
                                        <th>Код</th>
                                        <th>Наименование</th>
                                        <th>Количество</th>
                                        <th colspan="2">Наличие</th>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td>Проверка</td>
                                            <td>Проверка - деталь 1</td>
                                            <td>12</td>
                                            <td colspan="1" >
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" id="dones">Есть
                                            </td>
                                            <td colspan="1" >
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" id="buyers">Купить
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-primary btn-sm">Сохранить</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Модалка Склада -->
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h4>Комментарии</h4>
                                <hr>
                                <div class="post">
                                    @foreach( $project->comments as $comment )
                                        <p>
                                            {{ $comment->body }}
                                        </p>
                                    @endforeach
                                </div>
                                <div class="card-block">
                                    <form method="POST" action="/project/{{ $project->id }}/comments">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input name="body" class="form-control" id="textarea" placeholder="Напишите что нибудь !">
                                        </div>
                                        <button type="submit" class="btn btn-success">Ответить</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-tasks"></i> {{ $project->name }}</h3>
                        <p class="text-muted">{{ $project->quest }}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Дата начала проекта и его конец
                                <b class="d-block">с {{ \Carbon\Carbon::parse($project->start)->format('d.m.Y')}} до {{ \Carbon\Carbon::parse($project->end)->format('d.m.Y')}}</b>
                            </p>
                            
                        </div>

                        <h5 class="mt-5 text-muted">Файлы проекта</h5>
                        <ul class="list-unstyled">
                            @foreach($files as $file)
                                <li>
                                    <a href="{{ route('admin.download', ['name' => $file->name, 'project' => $project->id]) }}" class="btn-link text-secondary"><i class="far fa-fw {{ $file->icon }}"></i>{{ $file->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @can('create file')
                        <div class="text-center mt-5 mb-3">
                            <form action="{{ route('admin.add.file', ['project' => $project->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group file-input row">
                                    <div class="form-group col-6">
                                        <label for="project-add-file-show">Загрузуть файл</label>
                                        <input type="file" id="project-add-file-show" class="form-control" name="file">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="file-type-show">Тип файла</label>
                                        <select id="file-type-show" class="form-control" name="file_type">
                                            <option value="drawing">Чертеж</option>
                                            <option value="report">Отчет</option>
                                            <option value="document">Документ</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Добавить файл</button>
                            </form>
                        </div>
                        @endcan

                    </div>

                </div>
            </div>
            <!-- /.card-body -->
             <h3>Складирование</h3>
             <hr>
             <div class="row">
                 <div class="col-4">
                    <span class="badge badge-info mb-2">Металопрокат</span>
                     <table class="table table-bordered">
                         <thead>
                             <th>Наименование</th>
                             <th>Количество</th>
                         </thead>
                         <tbody>
                             <tr>
                                 <td>Лист 6*30</td>
                                 <td>20 .м</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
                 <div class="col-4">
                    <span class=" badge badge-info mb-2">Детали</span>
                     <table class="table table-bordered">
                         <thead>
                             <th>Код</th>
                             <th>Наименование</th>
                             <th>Количество</th>
                         </thead>
                         <tbody>
                             <tr>
                                 <td>00101</td>
                                 <td>Гвоздь</td>
                                 <td>300 .шт</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
                 <div class="col-4">
                    <span class="badge badge-info mb-2">Расходные детали</span>
                     <table class="table table-bordered">
                         <thead>
                             <th>Наименование</th>
                             <th>Количество</th>
                         </thead>
                         <tbody>
                             <tr>
                                 <td>Шайба 100*500</td>
                                 <td>100500 .шт</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
@endpush