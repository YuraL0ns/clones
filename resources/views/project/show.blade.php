@extends('layouts.app')

@section('title')
  - {{ $project->name }}
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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Детали проекта</h3>
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
              <h4>Задача конструкторам</h4>
              @hasanyrole('Администратор|Директор|Программист|Инжинер|Конструктор\АСУ')
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
              @endhasanyrole
              
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h3 class="text-primary"><i class="fas fa-tasks"></i> {{ $project->name }}</h3>
              <p class="text-muted">{{ $project->quest }}</p>
              <br>
              <div class="text-muted">
                <p class="text-sm">Дата начала проекта и его конец
                  <b class="d-block">с {{ $project->start }} до {{ $project->end }}</b>
                </p>
                <p class="text-sm">Кто заказал
                  <b class="d-block">Тут будет контрагент</b>
                </p>
                <p class="text-sm">Главный проекта
                  <b class="d-block">Tут кто отвечает головой за проект</b>
                </p>
              </div>

              <h5 class="mt-5 text-muted">Файлы проекта</h5>
              <ul class="list-unstyled">
                @foreach($files as $file)
                  <li>
                    <a href="{{ route('user.download', ['name' => $file->name, 'project' => $project->id]) }}" class="btn-link text-secondary"><i class="far fa-fw {{ $file->icon }}"></i>{{ $file->name }}</a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </section>
  </div>
@endsection

@push('styles')
  <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
  <style>
    .safe-input {
      position: relative;
    }
    .safe-input .delete-safe-btn {
      position: absolute;
      top: -5px;
      right: -5px;
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('.add-file-btn').click(function () {
        let filesDiv = $('.project-files');

        let html = '<div class="form-group file-input row">\n' +
                '     <div class="form-group col-5">\n' +
                '        <label for="project-add-file">Upload File</label>\n' +
                '         <input type="file" id="project-add-file" class="form-control" name="files[]">\n' +
                '     </div>\n' +
                '      <div class="form-group col-5">\n' +
                '       <label for="file-type">File Type</label>\n' +
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
      });

      $('.add-safe-btn').click(function () {
        let safesDiv = $('.project-safes');

        let html = '<div class="form-group row safe-input">' +
                '     <div class="form-group col-4">' +
                '      <label for="project-safe-type-select">тип продукта</label>' +
                '      <select id="project-safe-type-select" class="form-control project-safe-type-select" name="safe_types[]">' +
                '        <option value="" selected>-- Please Select --</option>' +
                '        <option value="detail">Детали</option>' +
                '        <option value="material">Материалы</option>' +
                '        <option value="purchased">Купленные</option>' +
                '        </select>' +
                '     </div>' +
                '    <div class="form-group col-4">' +
                '     <label for="project-safe-name-select">наименование</label>' +
                '     <select id="project-safe-name-select" class="form-control project-safe-name-select" name="safe_names[]"></select>' +
                '   </div>' +
                '<div class="form-group col-4">' +
                '<label for="project-safe-count-select">кол-во</label>' +
                '<input type="number" name="safe_counts[]" id="project-safe-count-select" class="form-control">' +
                '</div>' +
                '<button type="button" class="btn btn-danger btn-sm delete-safe-btn btn-circle"><i class="fas fa-minus-circle"></i></button>'+
                '</div>';

        safesDiv.append(html);
      });

      $(document).on('click', '.delete-safe-btn', function () {
        let _this = $(this),
            div = _this.closest('.safe-input');

        div.remove();
      });

      $(document).on('change', '.project-safe-type-select', function () {
        let _this = $(this),
            val = _this.val(),
            namesSection = _this.closest('.safe-input').find('.project-safe-name-select'),
            safes = '{!! json_encode(array_values($safes->toArray())) !!}',
            parsedSafes = JSON.parse(safes);

            namesSection.empty();
            for (key in parsedSafes) {
              let item = parsedSafes[key];

              if (item.type === val) {
                namesSection.append('<option value="'+item.id+'">'+item.name+'</option>')
              }
            }
      });
    })
  </script>
@endpush