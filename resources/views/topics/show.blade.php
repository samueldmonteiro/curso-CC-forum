@extends('master.master')


@section('content')
    <div class="container main">

        <section class="discussion">
            @include('includes.topic_item')

            @if($topic->answers()->count())

                @foreach($topic->answers()->orderBy('id', 'desc')->get() as $answer)
                    @include('includes.answer_item')
                @endforeach
            @endif
            
        </section>

        @include("includes.ads")

    </div>

@endsection

@push('js')
<script src="{{ mix('js/answerActions.js') }}"></script>
<script src="{{ mix('js/topicActions.js') }}"></script>
@endpush