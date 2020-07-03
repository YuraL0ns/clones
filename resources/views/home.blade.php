@extends('theme.main')

@section('page-name')
Страница допуска
@endsection

@section('content')
    <div class="container-fluid">
        <div class="alert alert-info">
             @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Вы успешно зарегистрировались в панели управления .     <br>
                    <strong>Сообщите Вашему системному-администратору, о том на какую вакансию вас устроили, после чего вам будет открыт доступ в панель управления </strong>
        </div>
   </div>
@endsection