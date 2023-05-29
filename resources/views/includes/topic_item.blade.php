<div class="modal fade" id="modalDeleteTopic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-dark">
        Deseja mesmo Deletar Este Tópico?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" id="confirmDeletionTopic" class="btn btn-primary">Deletar</button>
      </div>
    </div>
  </div>
</div>

    @if(session('message'))
        <x-alert type="success" message="{{session('message')}}"/>
    @endif

<div class="topic-item" data-id="{{$topic->id}}">

    <div class="topic-item-head">
        <div class="topic-item-info">
            <div class="user-avatar" style="background-image: url('{{Storage::url($topic->user->avatar)}}');"></div>
            <div>
                <a href="{{route('users.show', ['user'=>$topic->user->id])}}" class="username">{{$topic->user->name}}</a>
                <p>{{$topic->matter->title}}  - {{$topic->user->period}} ºano <span id="replyDate">{{$topic->created_at}}</span></p>
            </div>
        </div>

        <span class="topic-item-states">
        <i class="bi bi-chat-dots-fill"></i>
            <span>

                @if($topic->answers()->count())
                    Respondido
                @else
                    Não Respondido
                @endif
            </span>
        </span>
    </div>

    <div class="topic-item-body">
        <div class="topic-item-content">
            {!! $topic->content !!}
        </div>
    </div>

    <div class="answer-topic">
        @if($errors->any())
            <x-alert type="danger" :message="$errors->all()[0]"/>
        @endif
        
        <div class="topic-actions">
            <span id="answer" class="btn btn-primary">Responder</span>   
            <div>
                @if($topic->user->id == auth()->id())
                    <abbr title="Deletar Tópico">
                    <i id="delete-topic" data-bs-toggle="modal" data-bs-target="#modalDeleteTopic" class="bi bi-trash3-fill"></i>
                    </abbr>
                    <abbr title="Tópico Concluído">
                        @if(!$topic->state)
                            <i id="completed-topic" class="bi bi-check-circle-fill"></i>
                        @else
                            <i id="completed-topic" class="bi bi-check-circle"></i>
                        @endif
                    </abbr>
                @endif
               <!-- <span><abbr title="Denunciar"><i class="bi bi-flag-fill"></i></abbr></span> -->
                
            </div>
        </div>

        <div class="write-answer hide-write-answer">
            
            <form method="POST" action="{{route('answers.store')}}">
                @csrf
                <input type="hidden" name="topic" value="{{$topic->id}}">
                <x-head.tinymce-config id="answerContent"/>
                <x-forms.tinymce-editor id="answerContent" name="content"/>                

                <button type="submit" id="sendAnswerBtn" type="button" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"></path>
                        </svg>
                        Enviar
                </button>
            </form>

        </div>

    </div>
</div>