<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
</head>

<body>
    <header>
        <nav class="container navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
              <a class="navbar-brand logo" href="{{route('home')}}">Fórum <span>Escolar</span></a>

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="search.php" class="search-topics">
                    <div class="input-group mb-3">
                        <button><i class="bi bi-search"></i></button>
                        <input type="text" class="" placeholder="Pesquise por tópicos" name="search"  value="">
                      </div>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4 my-questions-link">
                        <a data-bs-toggle="modal" data-bs-target="#modal-topic" data-bs-whatever="@mdo" class="nav-link active" id="create-topic" aria-current="page" href="#"><i class="bi bi-question-circle"></i>Perguntar</a>
                    </li>
                    <li>
                        <a class="nav-link active nav-link-mobile" href="settings.php"> <i class="bi bi-sliders"></i>Configurações</a>
                    </li>
                    <li>
                        <a class="nav-link active nav-link-mobile" href="profile.php"><i class="bi bi-person-fill"></i>Meu Perfil</a>
                    </li>
                    <li>
                        <a class="nav-link active nav-link-mobile" href="logout.php"><i class="bi bi-person-fill"></i>Logout</a>
                    </li>
                    <li class="nav-item dropdown">
                        <div data-bs-toggle="dropdown" class="dropdown-action">
                            <span>{{$user->name}}</span><div class="user-avatar" style="background-image: url('{{Storage::url($user->avatar)}}');"></div>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="profile.php"><i class="bi bi-person-fill"></i>Meu Perfil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="settings.php"> <i class="bi bi-sliders"></i>Configurações</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php"><i class="bi bi-person-fill"></i>Logout</a>
                            </li>
                        </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

    </header>

    <div class="modal fade" id="modal-topic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Criar Tópico</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-create-topic">
                    <div class="alert message m-hide text-center" role="alert">
                    
                    </div>
                        <label>
                            <i class="bi bi-people-fill"></i>
                            <select class="form-select" aria-label="Default select example" name="category">

                                @foreach($matters as $matter)
                                    <option value="{{$matter->id}}">{{$matter->title}}</option>
                                @endforeach
                            </select>
                        </label>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Escreva aqui sua Pergunta:</label>
                            <textarea class="form-control" id="message-text" name="content"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Postar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('includes.submenu_mobile')

    @yield('content', '')

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>

</body>

</html>

