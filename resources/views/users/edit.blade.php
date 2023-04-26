@extends('master.master')

@section('content')
<div class="container main">
    <div class="user-settings">
        @if($errors->any())
            <x-alert type="danger" :message="$errors->all()[0]"/>
        @endif

        @if(session('message'))
            <x-alert type="success" :message="session('message')"/>
        @endif

        <form method="POST" action="{{route('users.update', ['user'=>$user->id])}}" class="form-user-settings">

            @method('PUT')
            @csrf
            <div class="edit-info-user">
                <div class="form-register-head">
                    <h2>Editar Conta</h2>
                </div>
                <div class="form-register-body">

                    <label>
                        <i class="bi bi-person-fill"></i>
                        <input type="text" name="name" placeholder="Nome completo" value="{{$user->name}}">
                    </label>

                    <label>
                        <i class="bi bi-envelope-fill"></i>
                        <input type="email" disabled="off" name="email" placeholder="Seu Email" value="{{$user->email}}">
                    </label>

                    <label>
                        <i class="bi bi-people-fill"></i>
                        <select class="form-select" aria-label="Default select example" name="period">
                            <option value="{{$user->period}}">{{$user->period}}º ano</option>
                            <option value="1">1º período</option>
                            <option value="2">2º período</option>
                            <option value="3">3° período</option>
                            <option value="4">4° período</option>
                            <option value="5">5° período</option>
                        </select>
                    </label>

                    <label>
                        <i class="bi bi-calendar-event-fill"></i>
                        <select class="form-select" aria-label="Default select example" name="shift">
                            <option value="{{$user->shift}}">{{$user->shift}}</option>
                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                            <option value="Noturno">Noturno</option>
                        </select>
                    </label>
                    <button class="btn btn-primary">Efetuar Mudanças</button>

                </div>
            </div>

            <div class="edit-reset-password">
                <div class="form-register-head">
                    <h2>Resetar Senha</h2>
                </div>
                <div class="form-register-body">
                    <label>
                        <i class="bi bi-incognito"></i>
                        <input type="password" name="password" placeholder="Sua Senha">
                    </label>

                    <label>
                        <i class="bi bi-incognito"></i>
                        <input type="password" name="confirm_password" placeholder="Confirme a Senha">
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection