@extends('master.master')

@section('content')
    <div class="container main">

        @include('includes.categories')

        <section class="topics">
        
            @foreach($topics as $topic)
                @include('includes.topic_item_preview')
            @endforeach

        </section>

        @include("includes.ads")

    </div>
@endsection
