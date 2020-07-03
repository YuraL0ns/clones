@extends('theme.main')
@section('page-name')
 Изменить {{ $project->name }}
@endsection
@section('content')
{!! Form::open(['action' => ['ProjectController@update', $project->id], 'method' => 'PUT']) !!}
<div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Основное</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="inputName">Название Проекта</label>
            {{ Form::text('name', $project->name,['class'=>'form-control', 'placeholder' => 'название проекта', 'id'=>'inputName']) }}
          </div>
          <div class="form-group">
            <label for="inputDescription">Общая задача проекта</label>
            {{ Form::textarea('quest', $project->quest,['class'=>'form-control', 'placeholder' => 'Общее описание проекта', 'rows'=>'4','id'=>'inputDescription']) }}
          </div>
          <div class="form-group">
            <label for="inputStatus">Статус проекта</label>
            <select class="form-control custom-select">
              <option selected disabled>Выберите один</option>
              <option>У проектирования</option>
              <option>У снабжения</option>
              <option selected>У производства</option>
            </select>
          </div>
            <div class="form-group">
                <label for="project-owner">Пользователь</label>
                <select id="project-owner" class="form-control custom-select" name="owner">
                    <option selected disabled>Выберите один</option>
                    @foreach($users as $user)
                        @if(!$user->hasRole('Администратор'))
                            <option value="{{ $user->email }}" {{ $project->owner && ($project->owner->email === $user->email) ? 'selected' : '' }}>{{ $user->name }}({{ $user->email }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Даты проекта</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">

          <div class="form-group">
            <label for="inputEstimatedBudget">Дата начала и конца проекта</label>
            <div class="row">
                <div class="col-6">
                    {{ Form::date('start',  $project->start,['class'=>'form-control']) }}
                </div>
                <div class="col-6">
                    {{ Form::date('end',  $project->start,['class'=>'form-control']) }}
                </div>
            </div>
            <label for="inputEstimatedBudget">Проектирование</label>
            <div class="row">
                <div class="col-6">
                    {{ Form::date('ps',  $project->ps,['class'=>'form-control']) }}
                </div>
                <div class="col-6">
                    {{ Form::date('pe',  $project->pe,['class'=>'form-control']) }}
                </div>
            </div>
          <div class="form-group">
            <label for="inputSpentBudget">Снабжение</label>
            <div class="row">
                <div class="col-6">
                    {{ Form::date('ss',  $project->ss,['class'=>'form-control']) }}
                </div>
                <div class="col-6">
                    {{ Form::date('se',  $project->se,['class'=>'form-control']) }}
                </div>
            </div>
          </div>
          </div>
          <div class="form-group">
            <label for="inputEstimatedDuration">Производство</label>
            <div class="row">
                <div class="col-6">
                    {{ Form::date('prs',  $project->prs,['class'=>'form-control']) }}
                </div>
                <div class="col-6">
                    {{ Form::date('pre',  $project->pre,['class'=>'form-control']) }}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="/project/{{$project->id}}" class="btn btn-secondary">Отменить</a>
      <input type="submit" value="Сохранить" class="btn btn-success float-right">
    </div>
  </div>

   
{!! Form::close() !!}
@endsection