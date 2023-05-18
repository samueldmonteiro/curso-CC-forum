@extends('master.master')

@section('content')

<div class="container main">

    <section class="profile">
        <div class="profile-head">
            <div class="profile-head-cover">
                <img src="{{asset('images/back.png')}}" alt="">
            </div>

            <div class="profile-head-info">
                <div class="profile-head-info-user">
                    <div class="user-avatar" style="background-image: url('{{Storage::url($user->avatar)}}');"></div>

                    <div>
                        <div class="username">{{$user->name}}</div>
                        <p>{{$user->shift}} - {{$user->period}}ºano</p>
                    </div>
                </div>

                <div class="profile-head-actions">
                    <div>
                        <p>{{$user->topics()->count()}}</p>
                        <p>Perguntas</p>
                    </div>

                    <div>
                        <p>{{$user->answers()->count()}}</p>
                        <p>Respostas</p>
                    </div>

                    <div>
                        <p>indefinido</p>
                        <p>Likes</p>
                    </div>
                </div>
            </div>


        </div>

        <div class="profile-body">
            <div class="info-user">
                <ul>
                    <li><i class="bi bi-calendar-check-fill"></i> <a href="">{{$user->period}}ºano</a></li>
                    <li><i class="bi bi-clock-fill"></i><a href="">{{$user->shift}}</a></li>
                </ul>
            </div>

            <div class="topics-user">
                <h4>Meus Tópicos</h4>
                @foreach($user->topics()->get() as $topic)
                @include('includes.topic_item_preview')
                @endforeach
            </div>
        </div>

    </section>
</div>

@endsection
