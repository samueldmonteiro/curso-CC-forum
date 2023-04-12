@extends('master.master')

@section('content')
<div class="container main">

    @include('includes/categories.php')

    <section class="topics">
    
    <?php foreach($topicsHome as $topicItemPreview):?>
        @include("includes/topic_item_preview.php")
    <?php endforeach?>
    <?php if(!null):?>
        <h3>Nenhum Tópico Encontrado!</h3>
    <?php endif?>

        <nav class="pagination-menu" aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="<?=$base?>?page=<?=$previusPage?>">Anterior</a></li>
                <?php for($page=0;$page<$totalPages;$page++):?>
                    <li class="page-item"><a class="page-link" href="<?=$base?>?page=<?=$page + 1?>"><?=$page + 1?></a></li>
                <?php endfor?>
                <li class="page-item"><a class="page-link" href="<?=$base?>?page=<?=$nextPage?>">Próxima</a></li>
            </ul>
        </nav>
       
    </section>

@endsection