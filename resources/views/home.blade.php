@extends('master.master')

@section('content')
    <div class="container main">

        @include('includes.categories')

        <section class="topics">
        
            @if(empty($topics[0]))
                <h2 class="text-center">Nenhum Tópico Encontrado!</h2>
            @else
                @foreach($topics as $topic)
                    @include('includes.topic_item_preview')
                @endforeach
            @endif

        </section>

        @include("includes.ads")

    </div>
@endsection
