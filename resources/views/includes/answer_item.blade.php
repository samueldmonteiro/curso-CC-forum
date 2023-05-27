
<div class="modal fade" id="modalDeleteAnswer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            Deseja Deletar sua resposta?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary confirm">Deletar</button>
      </div>
    </div>
  </div>
</div>

<div class="answer-item" data-id="{{$answer->id}}">
    <h4>Resposta</h4>
    <div class="answer-item-head">
        <div class="answer-item-info topic-item-info">
            <div class="user-avatar" style="background-image: url('{{Storage::url($answer->user->avatar)}}');"></div>
            <div>
                <a href="{{route('users.show', ['user'=> $answer->user->id])}}" class="username">{{$answer->user->name}}</a>
                <p>{{$answer->user->shift}}  - {{$answer->user->period}}ºano</p>
            </div>
        </div>

        <span class="topic-item-states">
            <i class="bi bi-clock-fill"></i>
            <span>{{$answer->created_at}}</span>
        </span>
    </div>

    <div class="answer-item-body">
        <div class="answer-item-content">
            {!! $answer->content !!}
        </div>
    </div>

    <div class="answer-item-actions">
        <button id="like-answer">
            @if(auth()->user()->likeThisAnswer($answer->id))
                <i class="bi bi-heart-fill liked"></i>
            @else
                <i id="answer-like" class="bi bi-heart liked"></i>
            @endif
            <span class="count-like">{{ $answer->likes()->count() }}</span>
        </button>

        <span class="buttons-action">
            @if($answer->user->id == auth()->id())
                <i  data-url="{{ route('answers.destroy', ['answer'=>$answer->id]) }}" data-bs-toggle="modal" data-bs-target="#modalDeleteAnswer" id="button-delete-answer" class="bi bi-trash3-fill"></i>
            @endif
            <abbr title="Denunciar">
                <i class="bi bi-flag-fill"></i>
            </abbr>
        </span>                
    </div>
</div>