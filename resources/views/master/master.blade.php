<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! $head ?? '' !!}
    <link rel="shortcut icon" href="{{ asset('images/fav.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
    @stack('css')

    <x-head.tinymce-config id="topicBody" />
</head>

<body>
    <header>
        <nav class="container navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand logo" href="{{route('home')}}">Fórum <span>C. C.</span></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form action="" class="search-topics">
                        <div class="input-group mb-3">
                            <button><i class="bi bi-search"></i></button>
                            <input type="text" id="search" placeholder="Pesquise por tópicos" name="search" value="">
                        </div>
                    </form>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item me-4 my-questions-link">
                            <a data-bs-toggle="modal" data-bs-target="#modal-topic" data-bs-whatever="@mdo" class="nav-link active" id="create-topic" aria-current="page" href="#"><i class="bi bi-question-circle"></i>Criar Tópico</a>
                        </li>
                        <li>
                            <a class="nav-link active nav-link-mobile" href="{{route('users.edit', ['user'=>$currentUser->id])}}"> <i class="bi bi-sliders"></i>Configurações</a>
                        </li>
                        <li>
                            <a class="nav-link active nav-link-mobile" href="{{route('users.show', ['user'=>$currentUser->id])}}"><i class="bi bi-person-fill"></i>Meu Perfil</a>
                        </li>
                        <li>
                            <a class="nav-link active nav-link-mobile" href="{{route('logout')}}"><i class="bi bi-person-fill"></i>Logout</a>
                        </li>
                        <li class="nav-item dropdown">
                            <div data-bs-toggle="dropdown" class="dropdown-action">
                                <span>{{$currentUser->name}}</span>
                                <div class="user-avatar" style="background-image: url('{{Storage::url($currentUser->avatar)}}');"></div>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{route('users.show', ['user'=>$currentUser->id])}}"><i class="bi bi-person-fill"></i>Meu Perfil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('users.edit', ['user'=>$currentUser->id])}}"> <i class="bi bi-sliders"></i>Configurações</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('logout')}}"><i class="bi bi-person-fill"></i>Logout</a>
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
                    <h4 class="modal-title" id="exampleModalLabel">Novo Tópico</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-create-topic" action="{{route('topics.store')}}">
                        <div class="alert message m-hide text-center" role="alert">

                        </div>
                        <label>
                            <i class="bi bi-people-fill"></i>
                            <select class="form-select" aria-label="Default select example" name="category" id="t-category">

                                @foreach($matters as $matter)
                                <option value="{{$matter->id}}">{{$matter->title}}</option>
                                @endforeach
                            </select>
                        </label>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Crie seu tópico abaixo:</label>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="t-title" placeholder="Título do seu tópico">
                        </div>

                        <div class="mb-3">
                            <x-forms.tinymce-editor id="topicBody" />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Criar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('includes.submenu_mobile')

    @yield('content', '')

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/newTopic.js') }}"></script>
    @stack('js')

</body>

</html>
