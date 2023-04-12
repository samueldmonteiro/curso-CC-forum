
<div class="modal fade" id="modalDeleteAnswer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            Deseja Deletar esta Publicação?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary delete-ok">Deletar</button>
      </div>
    </div>
  </div>
</div>

<div class="answer-item" data-id="<?=$answerItem->id?>">
    <h4>Resposta</h4>
    <div class="answer-item-head">
        <div class="answer-item-info topic-item-info">
            <div class="user-avatar" style="background-image: url('<?=$base?>media/avatars/<?=$answerItem->user->avatar?>');"></div>
            <div>
                <a href="<?=$base?>profile.php?id=<?=$answerItem->user->id?>" class="username"><?=$answerItem->user->shortName()?></a>
                <p><?=$answerItem->user->shift?>  - <?=$answerItem->user->grade?>ºano</p>
            </div>
        </div>

        <span class="topic-item-states">
            <i class="bi bi-clock-fill"></i>
            <span><?=$answerItem->replyDate()?></span>
        </span>
    </div>

    <div class="answer-item-body">
        <div class="answer-item-content">
            <?=nl2br($answerItem->getBody())?>
        </div>
    </div>

    <div class="answer-item-actions">
        <button id="like-answer">
            <?php if($answerItem->isLiked):?>
                <i class="bi bi-heart-fill liked"></i>
            <?php else:?>
                <i id="answer-like" class="bi bi-heart liked"></i>
            <?php endif?>
            <span class="count-like"><?=$answerItem->countLikes?></span>
        </button>

        <span class="buttons-action">
            <?php if($answerItem->mine):?>
                <i  data-bs-toggle="modal" data-bs-target="#modalDeleteAnswer" id="button-delete-answer" class="bi bi-trash3-fill"></i>
            <?php endif?>
            <abbr title="Denunciar">
                <i class="bi bi-flag-fill"></i>
            </abbr>
        </span>                
    </div>
</div>