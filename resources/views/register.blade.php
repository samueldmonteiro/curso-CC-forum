@extends('master.auth')

@section('content')
    <div class="login register">
        <form action="signup_action.php" class="form-register">
            <div class="form-register-head">
                <div class="icon-user">
                    <i class="bi bi-person"></i>
                </div>

                <h2>Criar Conta</h2>
            </div>


            <div class="form-register-body">

            <div class="alert message m-hide" role="alert">
                
            </div>
                
                <label>
                    <i class="bi bi-person-fill"></i>
                    <input type="text" name="name" placeholder="Nome completo">
                </label>

                <label>
                    <i class="bi bi-envelope-fill"></i>
                    <input type="email" name="email" placeholder="Seu Email">
                </label>


                <label>
                    <i class="bi bi-incognito"></i>
                    <input type="password" name="password" placeholder="Sua Senha">
                </label>

                <label>
                    <i class="bi bi-incognito"></i>
                    <input type="password" name="confirm_password" placeholder="Confirme a Senha">
                </label>
               
                <button class="btn btn-primary">Criar</button>

                <div class="links">
                    <a href="">Esqueceu a senha?</a>
                    <a href="login.php">Já tem uma conta?</a>
                </div>
            </div>
        </form>
    </div>
@endsection