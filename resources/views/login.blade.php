@extends('master.auth')

@section('content')
    <div class="login">
        <form method="POST" action="login_action.php" class="form-login">
            <div class="form-login-head">
                <div class="icon-user">
                    <i class="bi bi-person"></i>
                </div>

                <h2>Acesse</h2>
            </div>

            <div class="form-login-body">

                <?php if(false):?>
                <div class="alert message alert-danger" role="alert">
                    message
                </div>
                <?php endif?>

                <label>
                    <i class="bi bi-envelope-fill"></i>
                    <input type="email" name="email" placeholder="Seu Email">
                </label>

                <label>
                    <i class="bi bi-incognito"></i>
                    <input type="password" name="password" placeholder="Sua Senha">
                </label>

                <button class="btn btn-primary">Login</button>

                <div class="links">
                    <a href="">Esqueceu a senha?</a>
                    <a href="{{ route('registerForm') }}">Criar Conta</a>
                </div>
            </div>
        </form>
    </div>
@endsection