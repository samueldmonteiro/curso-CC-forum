
<section class="categories">
    <p class="title">Matérias</p>
    <ul class="navbar-nav">

        <?php foreach([] as $category):?>
            <li class="nav-item">
                <a href="categories.php?category=<?=$category->name ?? null?>" class="nav-link"><i class="bi bi-play-fill"></i><?=$category->name?></a>
            </li>
        <?php endforeach?>

        <li class="nav-item more-categories">
            <a href="categories.php"><i class="bi bi-three-dots"></i></a>
        </li>
    </ul>
</section>