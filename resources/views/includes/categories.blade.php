
<section class="categories">
    <p class="title">Matérias</p>
    <ul class="navbar-nav">

        @foreach($matters as $matter)
            <li class="nav-item">
                <a href="{{route('forum.topicsByMatter', ['matter'=>$matter->uri])}}" class="nav-link"><i class="bi bi-play-fill"></i>{{$matter->title}}</a>
            </li>
        @endforeach

        <!--<li class="nav-item more-categories">
            <a href="categories.php"><i class="bi bi-three-dots"></i></a>
        </li>-->
    </ul>
</section>