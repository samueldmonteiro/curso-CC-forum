<div class="topic-item topic-item-preview">

    <div class="topic-item-head">
        <div class="topic-item-info">
            <div class="user-avatar" style="background-image: url('{{Storage::url($topic->user->avatar)}}');"></div>
            <div>
                <a href="{{route('users.show', ['user'=> $topic->user->id])}}" class="username">{{$topic->user->name}}</a>
                <p class="short-info">{{$topic->matter->title}}  - {{$topic->user->period}}ºano <span id="replyDate"></span></p>
            </div>
        </div>

        <div class="topic-item-states">
            <span class="state {{$topic->state == 0 ? 'open' : 'resolved'}}">{{$topic->state == 0 ? 'Aberto' : 'Concluído'}}</span>
            <span class="count-answers"><i class="bi bi-chat-dots-fill"></i><span>{{$topic->answers()->count()}}</span> Respostas</span>
        </div>
    </div>
    
    <div class="topic-item-body">
        <div class="topic-item-content topic-subject">
            {{ $topic->title}}
        </div>
    </div>

    <div class="answer-topic">
        <a href="{{route('topics.show', ['topic'=> $topic->uri])}}" id="answer" class="btn btn-primary">Responder</a>
    </div>
</div>